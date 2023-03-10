<?php
  include('connection.php');

  $newPickup = $_POST['newPickup'];
  $tourID = $_POST['tourID'];

  $sql = "UPDATE proceed_to_pay SET pickup='$newPickup' WHERE ref='$tourID'";
  $result = $conn -> query($sql);

  if($result){
    echo 1;
  }else {
    echo 0;
  }

  $conn -> close();
?>