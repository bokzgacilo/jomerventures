<?php
  session_start();

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
  $price = '';
  $pax = '';
  $totalPrice = '';
  $today = date("F j, Y, g:i a");
  $selectTour = $conn -> query("SELECT * FROM my_post WHERE id='$tourID'");
  
  while($row = $selectTour -> fetch_array()){
    $price = $row['promo_price'];
  }

  $totalPrice = $persons * $price;

  $sql = "INSERT INTO proceed_to_pay(
    email, 
    ref, 
    phone, 
    fullname, 
    booking_date, 
    price, 
    pax, 
    price_to_pay, 
    pickup,
    balance, 
    code, 
    promo_id, 
    status, 
    mode, 
    date_created
  ) VALUES(
      '$email', 
      '$referenceNumber', 
      '$phone', 
      '$fullname', 
      '$date', 
      '$price', 
      '$persons', 
      '$totalPrice', 
      '$pickup_point', 
      '$totalPrice', 
      '$referenceNumber', 
      '$tourID', 
      'Waiting for Payment', 
      'CARD', 
      '$today'
    )";

  $result = $conn -> query($sql);

  if($result){
    notifyProcessBookingPaymentPayment($email, $fullname, $referenceNumber);

    echo 1;
  }else {
    echo 0;
  }

  $conn -> close();
?>