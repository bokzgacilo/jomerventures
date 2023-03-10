<?php
  include('emailer.php');
  include('connection.php');

  $email = $_GET['email'];
  $tempo = rand(1000000, 9999999);

  $sql = "UPDATE users SET temporary_password='$tempo' WHERE email='$email'";
  $result = $conn -> query($sql);

  if($result){
    echo 1;
    sendTempoPass($email, $tempo);
  }else {
    echo 0;
  }

  $conn -> close();
?>