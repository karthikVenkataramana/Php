<?php
 if($_SERVER["REQUEST_METHOD"] == "POST"){
  require_once('connections.php');
   display();
 }
 function display(){
   global $conn;
   $sql = "SELECT * FROM players";
   $result = $conn -> query($sql);
   $temparray = array();
   if($result -> num_rows > 0){
     while($row = $result -> fetch_assoc()){
         $temparray[] = $row;
     }
   }
   header('Content-Type: application/json');
   echo json_encode(array("players" => $temparray));
   $conn -> close();
 }
 ?>
