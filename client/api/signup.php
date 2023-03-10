<?php
  include('connection.php');
  require_once('emailer.php');

  $email = $_POST['email'];
  $fullname = $_POST['fullname'];
  $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
  $password = substr(str_shuffle($str_result), 0, 16);
  $today = date("F j, Y, g:i a");
  
  $checkEmailIfDuplicate = $conn -> query("SELECT * FROM clients WHERE email='$email'");
  if($checkEmailIfDuplicate -> num_rows == 0){
    $sql = "INSERT INTO users(email, fullname, password, temporary_password, date_created, status)
    VALUES('$email','$fullname','$password','$password','$today', 'VALID')";
  
    $result = $conn -> query($sql);
    if($result){
      echo 1;
  
      getTemporaryPassword($email, $fullname, $password);
    }else {
      echo 0;
    }
  }else {
    echo 0;
  }
  
  $conn -> close();
?>