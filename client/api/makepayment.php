<?php
  include('connection.php');
  require_once('emailer.php');

  $reference_number = $_POST['reference_number'];
  $amount = $_POST['amount'];
  $gcash = $_POST['gcash'];
  $email = $_POST['email'];
  $today = date("F j, Y, g:i a");

  $sql = "INSERT INTO payments(gcash, amount, reference_number, transaction_date, email) VALUES(
    '$gcash',
    '$amount',
    '$reference_number',
    '$today',
    '$email'
  )";

  $result = $conn -> query($sql);

  if($result){
    echo 1;
  }else {
    echo 0;
  }


  $conn -> close();
?>