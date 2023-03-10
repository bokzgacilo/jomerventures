<?php
  include('connection.php');
  require_once('emailer.php');

  $tourID = $_POST['tourID'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $fullname = $_POST['fullname'];
  $date = $_POST['date'];
  $persons = $_POST['persons'];
  $pickup_point = $_POST['pickup_point'];
  $referenceNumber = rand(1000000, 9999999);
  $reserve_mode_payment = $_POST['reserve_mode_payment'];
  $price = '';
  $pax = '';
  $totalPrice = '';
  $today = date("F j, Y, g:i a");
  $selectTour = $conn -> query("SELECT * FROM my_post WHERE id='$tourID'");
  
  while($row = $selectTour -> fetch_array()){
    $price = $row['promo_price'];
  }

  $totalPrice = $persons * $price;
  $balance = $totalPrice + 500;

  $sql = "INSERT INTO proceed_to_pay(
    email, 
    ref, 
    phone, 
    fullname, 
    booking_date, 
    price, 
    pax, 
    price_to_pay, 
    balance,
    pickup, 
    code, 
    promo_id, 
    status, 
    mode, 
    type,
    date_created) VALUES(
      '$email', 
      '$referenceNumber', 
      '$phone', 
      '$fullname', 
      '$date', 
      '$price', 
      '$persons', 
      '$totalPrice', 
      '$balance',
      '$pickup_point', 
      '$referenceNumber', 
      '$tourID', 
      'Waiting for Reservation Fee', 
      '$reserve_mode_payment', 
      'reserve',
      '$today'
    )";

  $result = $conn -> query($sql);

  if($result){
    notifyProcessReservationFee($email, $fullname, $referenceNumber);

    echo 1;
  }else {
    echo 0;
  }

  $conn -> close();
?>