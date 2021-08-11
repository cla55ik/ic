<?php 

class connect{
    private $dbname = 'u193192659_ic';
    private $dbuser = 'u193192659_icuser';
    private $dbpass = 'JtU+l6zs=4x$';
    public $conn;
  
  
    public function getConnect(){
      $this->conn = null;
      try {
        $this->conn = new PDO("mysql:host=localhost;dbname={$this->dbname}", $this->dbuser, $this->dbpass);
        //echo 'connected';
      } catch (PDOException $e) {
        print "Error!: " . $e->getMessage();
  
      }
      return $this->conn;
  
    }

}