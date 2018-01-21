<?php

$login_status = array("login_status" => "Ok");
if($_SERVER["REQUEST_METHOD"] == "POST"){
  include('connections.php');
  login();
}


function login(){
  global $login_status;
  $attribute = "";
  $value = "";

  if(isset($_POST["username"])){
  $attribute = "username";
  $value = testinput($_POST["username"]);
  }

  if(isset($_POST["email"])){
  $attribute = "email";
  $value = testinput($_POST["email"]);
  }

  $password = md5($_POST["password"]);
  authenticate($attribute, $value, $password);

  echo json_encode($login_status);
}



function authenticate($attribute , $value,  $password){
  global $conn, $login_status;

  $sql = "SELECT * FROM PLAYERS WHERE $attribute = '$value' and password = '$password' ";
  $result =  $conn -> query($sql);
  if($result -> num_rows > 0)
    return;
  else
      $login_status["login_status"]  = "Invalid Username or Password";
}

?>
