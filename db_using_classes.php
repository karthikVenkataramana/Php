<?php

$host = "localhost";
$username = "root" ;
$password = "";
$db_name = "test";

class Emp{
  public $id;
  public $name;
  public function __construct($id, $name){
    $this -> id = $id;
    $this -> name = $name;
  }

}

class Connection{
  private $_conn;
  public function __construct($conn){
    $this -> _conn = $conn;
  }
  public function bind($emp){
    $sql = "INSERT INTO EMP (ID, NAME) VALUES (?,?)";
    if($stmt =  $this->_conn-> prepare($sql)){
      $stmt -> bind_param("ds",$emp -> id, $emp -> name);
    }else{
      echo "Died due to ". $this -> _conn -> error;
    }
    $stmt -> execute();
    $stmt -> close();
  }
  public function __destruct(){
    $this -> _conn -> close();
  }
}

$conn = new mysqli($host, $username, $password, $db_name);
$db = new Connection($conn);
$entry = new Emp(2,"Karthik");
$db -> bind($entry);
$json_entry = json_encode($entry);
echo $json_entry;

?>
