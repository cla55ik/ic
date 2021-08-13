<?php 
//session_start();
include_once($_SERVER['DOCUMENT_ROOT'].'/controllers/connect.php');


$database = new connect();
$db = $database->getConnect();

class Auth{

    private $conn;

    public function __construct($db){
      $this->conn=$db;
    }

    public function isAuth()
    {
        if (isset($_SESSION['is_auth'])) {
            return $_SESSION['is_auth'];
        }else{
            return false;
        }
    }

    public function auth($cur_user, $cur_pass)
    {
        if($this->isUser($cur_user)){
            $cur_pass = md5($cur_pass);
            if ($cur_pass == $this->getPassByUser($cur_user)) {
                $_SESSION["is_auth"] = true;
                $_SESSION["login"] = $cur_user;
                return true;
            }else{
                $_SESSION["is_auth"] = false;
                return false;
            }
        }else{
            $_SESSION["is_auth"] = false;
            return false;
        }

        
    }

    public function getLogin() {
        if ($this->isAuth()) { 
            return $_SESSION["login"];
        }
    }

    public function out()
    {
        $_SESSION = array();
        session_destroy();
    }

    private function isUser($user){

        $query = "SELECT * FROM `users` WHERE user = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$user]);
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $res = count($users) > 0 ? true : false;
        return $res;
    }

    private function getPassByUser($user){
        $query = "SELECT password FROM `users` WHERE user = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$user]);
        $pass = $stmt->fetch(PDO::FETCH_ASSOC);
        $pass = $pass['password'];
        return $pass;
    }
}