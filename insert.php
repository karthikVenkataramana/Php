<?php
$status = array("username" => "Ok" , "password" =>"Ok", "email" => "Ok");
if($_SERVER["REQUEST_METHOD"] == "POST"){ // If we get a post request to the server.
  require_once('connections.php');
  insert();
}

function insert(){
  global $conn;
  global $status;
  $username = testinput($_POST['username']);
  $password = testinput($_POST['password']);
  $email = testinput($_POST['email']);
  if((!isPresent($username, "username")) & (!isPresent($email, "email")) & (isValidUser($username)) &(isValidEmail($email)) & (isValidPassword($password)) ){
    $password = md5($password);
    $sql = "INSERT INTO players(username, password, email) VALUES(?,?,?)";
    $stmt = $conn -> prepare($sql);
    $stmt -> bind_param("sss", $username, $password, $email);
    $stmt -> execute();
    $stmt -> close();
    }
  echo  json_encode (array("status" => $status));
  $conn -> close();
}

function isValidUser($user){
  global $status;
if(!preg_match('/^[a-zA-Z0-9]{5,}/', $user)) {
  $status["username"] = "User name must be atleast 5 letters!";
  return false;
  }
  return true;
}


function isValidPassword($pwd){
  global $status;
  if(strlen($pwd) > 6)
    return true;
   else
    $status["password"] = "Must be more than 6 characters";
  return false;
}

function isPresent($row , $attribute){
  global $conn,$status;
  $sql = "SELECT * FROM players where $attribute = '$row'";
  $result = $conn -> query($sql);
  if($result -> num_rows > 0){
      $status[$attribute] = $attribute. " is already present!";
      return true;
  }
    return false;
}
 ?>
