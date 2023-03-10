<?php
  include('connection.php');
  require_once('emailer.php');

  $email = $_POST['email'];
  $reference_number = $_POST['reference_number'];

  $sql = "DELETE FROM transactions WHERE email='$email' AND reference_number='$reference_number'";
  $result = $conn -> query($sql);

  if($result){
    echo 1;
    cancelTour($email, $reference_number);
  }else {
    echo 0;
  }

  $conn -> close(); 
?>