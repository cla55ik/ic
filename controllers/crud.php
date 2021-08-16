<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/controllers/connect.php');


$database = new connect();
$db = $database->getConnect();


class Crud{
    private $conn;
    private $category_arr = array();

    public function __construct($db){
      $this->conn=$db;
      $this->category_arr = $this->getCategory();
    }

    private function getCategory() {
        $query = $this->conn->prepare("SELECT * FROM `data`"); //Готовим запрос
        $query->execute(); //Выполняем запрос
        //Читаем все строчки и записываем в переменную $result
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        //Перелапачиваем массим (делаем из одномерного массива - двумерный, в котором 
        //первый ключ - parent_id)
        $return = array();
        foreach ($result as $value) { //Обходим массив
            $return[$value->parentid][] = $value;
        }
        return $return;
    }

    public function outTree($parentid, $level) {
        if (isset($this->category_arr[$parentid])) { //Если категория с таким parent_id существует
            if ($parentid != 0) {
                echo "<ul class='hidden'>";
            }
            //echo "<div class='btn-create'  id='btn_create' onclick='createData(\"{$parentid}\")'>ДобавитьГз</div>";
            foreach ($this->category_arr[$parentid] as $value) { //Обходим ее
                /**
                 * Выводим категорию 
                 *  $level * 25 - отступ, $level - хранит текущий уровень вложености (0,1,2..)
                 */
                $currid = $value->id;
                $next = $value->id +1;
                echo "<li>" .$value->name . "<div class='btn-update' id='btn_update' onclick='updateData(\"{$value->id}\",\"{$value->name}\")'>Обновить</div><div class='btn-delete' id='btn_delete' onclick='deleteData(\"{$value->id}\",\"{$value->name}\")'>Удалить</div> <div class='btn-create'  id='btn_create' onclick='createData(\"{$currid}\")'>Добавить</div><span>+</span>";
                // if(isset($this->category_arr[$next])){
                   
                // }
                // print_r( $value);
                // else{
                //     echo "<li>" . $value->name . "<div class='btn-update' id='btn_update' onclick='updateData(\"{$value->id}\",\"{$value->name}\")'>Обновить</div><div class='btn-delete' id='btn_delete' onclick='deleteData(\"{$value->id}\",\"{$value->name}\")'>Удалить</div> <div class='btn-create'  id='btn_create' onclick='createData(\"{$currid}\")'>Добавить</div> </li>";
                // }
                
                
                
                // echo ;
                $level++; //Увеличиваем уровень вложености
                //Рекурсивно вызываем этот же метод, но с новым $parent_id и $level
                
                $this->outTree($value->id, $level);
                
                $level--; //Уменьшаем уровень вложености
                
            }
            
            echo "</ul></li>";
        }
    }

    public function outTreeLight($parentid, $level) {
        if (isset($this->category_arr[$parentid])) { //Если категория с таким parent_id существует
            if ($parentid != 0) {
                echo "<ul class='hidden'>";
            }
            
            foreach ($this->category_arr[$parentid] as $value) { //Обходим ее
                /**
                 * Выводим категорию 
                 *  $level * 25 - отступ, $level - хранит текущий уровень вложености (0,1,2..)
                 */
                
                echo "<li>" .$value->name . "<span>+</span>";
                
                $level++; //Увеличиваем уровень вложености
                //Рекурсивно вызываем этот же метод, но с новым $parent_id и $level
                
                $this->outTreeLight($value->id, $level);
                
                $level--; //Уменьшаем уровень вложености
            }
            echo "</ul></li>";
        }
    }

    
 


    public function getAll(){
        $query = "SELECT * FROM data";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    public function getIdByName($name, $parentid){
        $query = "SELECT id FROM data WHERE name = :name AND parentid = :parentid";
        $stmt = $this->conn->prepare($query);
        $params =[
            'name'=>$name,
            'parentid'=> $parentid
        ];
        $stmt->execute($params);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        return $res;

    }
    public function createData($array){
        $query = "INSERT INTO `data`(name, parentid) 
                        VALUES (:name, :parentid)";
        $params = [
            'name'=>$array['name'],
            'parentid'=>$array['parentid']
        ];
        $stmt = $this->conn->prepare($query);
        $stmt ->execute($params);


    }
    public function deleteDataById($id){
        $query = "DELETE FROM `data` WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt ->execute([$id]);
    }

    public function updateDataById($name,$id){
        $query = "UPDATE `data` SET name = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt ->execute([$name, $id]);
    }
}
