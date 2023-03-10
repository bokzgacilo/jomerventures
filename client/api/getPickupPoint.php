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
    <h4 class='is-size-6 mb-3'>Pickup Point</h4>
    <div class='select w-100 mb-2'>
      <select id='newPickupLocation' required class='w-100'>
        <option>SM MOA</option>
        <option>SM Aura</option>
        <option>Market Market</option>
        <option>PITX</option>
      </select>
    </div>
    <button id='$tourID' class='button is-primary' onclick='changePickupLocation(this.id)'>Change Pickup Location</button>
    ";
  }

  $conn -> close();
?>