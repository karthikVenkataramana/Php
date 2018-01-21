<?php
$host = "localhost";
$username = "root" ;
$password = "";
$db_name = "test";

$conn = new mysqli($host, $username, $password, $db_name);
if($conn->connect_error){
  die("Conenction failed". $conn->error);
}

$id = 1;
$name = "Sukesh";
// Prepared Statement.
$stmt = $conn->prepare("INSERT into EMP(ID, Name) VALUES(?,?)");
$stmt->bind_param("ds",$id, $name);
$stmt->execute();

$id = 2;
$name = " dfjdf";
$stmt -> execute();

$stmt -> close();

$sql_query = "SELECT * FROM EMP";
$result = $conn->query($sql_query);
if($result->num_rows > 0){
  while($row = $result->fetch_assoc()) {
      echo "ID ".$row['ID']. " VALUE ".$row['NAME'] . "<br/>";
  }
}

$conn -> close();
 ?>
