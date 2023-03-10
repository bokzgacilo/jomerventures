<?php
  include('connection.php');
  require_once('emailer.php');

  $gcash_reference = $_POST['gcash_reference_number'];
  $total_amount_paid = $_POST['total_amount_paid'];
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
  $selectTour = $conn -> query("SELECT * FROM promos WHERE id='$tourID'");
  $status = 'Processing GCash Payment for Reservation Fee';
  
  while($row = $selectTour -> fetch_array()){
    $price = $row['price'];
  }

  $totalPrice = $persons * $price;
  $balance = $totalPrice + $total_amount_paid;

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
    type,w
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
      '$gcash_reference', 
      '$tourID', 
      '$status', 
      '$reserve_mode_payment', 
      'reserve',
      '$today'
    )";

  $result = $conn -> query($sql);

  if($result){
    $inserToPayment = "INSERT INTO payments(type, gcash, amount, reference_number, transaction_date, email) VALUES(
      'Reservation',
      '$gcash_reference',
      '$total_amount_paid',
      '$referenceNumber',
      '$today',
      '$email'
    )";
    notifyProcessReservationFee($email, $fullname, $referenceNumber);
    $conn -> query($inserToPayment);
    echo 1;
  }else {
    echo 0;
  }

  $conn -> close();
?>