<?php
  include('connection.php');

  $email = $_GET['email'];
  $password = $_GET['password'];
  $phone = $_GET['phone'];

  $sql = "UPDATE users SET password='$password', temporary_password='$password', phone='$phone' WHERE email='$email'";
  $result = $conn -> query($sql);

  if($result){
    echo 1;
  }else {
    echo 0;
  }

  $conn -> close();
?>