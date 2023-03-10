<?php
  include('connection.php');
  $tourID = $_GET['tourID'];

  $sql = "SELECT * FROM proceed_to_pay WHERE ref='$tourID'";
  $result = $conn -> query($sql);
  
  while($row = $result -> fetch_array()){
    $promoID = $row['promo_id'];

    $start = '';
    $end = '';

    $getStartEnd = $conn -> query("SElECT * FROM my_post WHERE id='$promoID'");
    while($get = $getStartEnd -> fetch_array()){
      $start = $get['promo_start'];
      $end = $get['promo_end'];
    }

    echo "
    <h4 class='is-size-6 mb-3'>Booking Date</h4>
    <input type='date' min='$start' value='".$row['booking_date']."' max='$end' required id='updatedTravelDate' class='input mb-2'>
    <button id='$tourID' class='button is-primary' onclick='changeTravelDate(this.id)'>Change Travel Date</button>
    ";
  }

  $conn -> close();
?>