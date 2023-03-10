<?php
  include('connection.php');

  $newDate = $_POST['newDate'];
  $tourID = $_POST['tourID'];

  $sql = "UPDATE proceed_to_pay SET booking_date='$newDate' WHERE ref='$tourID'";
  $result = $conn -> query($sql);

  if($result){
    echo 1;
  }else {
    echo 0;
  }

  $conn -> close();
?>