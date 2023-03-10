<?php
  include('../connection/connection.php');
  $transaction = $_POST['transaction'];
  
  $sql = "UPDATE proceed_to_pay SET balance='0', status='PAID' WHERE ref='$transaction'";
  $result = $conn -> query($sql);

  if($result){
    echo 1;
    $conn -> query("DELETE FROM payments WHERE gcash='$transaction'");
  }else {
    echo 0;
  }
?>