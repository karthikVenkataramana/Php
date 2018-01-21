<?php
  define("HOST", "localhost" );
  define("DATABASE", "biskit");
  define("USERNAME", "root");
  define("PASSWORD" , "");

  $conn = new mysqli(HOST, USERNAME , PASSWORD, DATABASE);
  function testinput($input){
     $input = trim($input);
     $input = stripslashes($input);
     $input = htmlspecialchars($input);
     return $input;
  }
  function isValidEmail($email){
    global $status;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $status["email"] = "Invalid Email ID";
    return false;
    }
    return true;
  }
 ?>
