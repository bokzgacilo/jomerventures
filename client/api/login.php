<?php
  include('connection.php');
  $email = $_GET['email'];
  $password = $_GET['password'];
  $checkEmail = $conn -> query("SELECT * FROM users WHERE email='$email'");
  if($checkEmail -> num_rows == 0){
    echo 0;
  }else {
    $p1 = '';
    $p2 = '';

    while($row = $checkEmail -> fetch_array()){
      $p1 = $row['password'];
      $p2 = $row['temporary_password'];
    }

    if($password == $p1 || $password == $p2){
      echo 1;
    }
  }
  $conn -> close(); 
?>