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
  $price = '';
  $pax = '';
  $totalPrice = '';
  $today = date("F j, Y, g:i a");
  $selectTour = $conn -> query("SELECT * FROM promos WHERE id='$tourID'");
  
  while($row = $selectTour -> fetch_array()){
    $price = $row['price'];
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
      '$total_amount_paid', 
      '$referenceNumber', 
      '$tourID', 
      'Processing Payment', 
      'GCASH', 
      '$today'
    )";

  $result = $conn -> query($sql);

  if($result){
    $inserToPayment = "INSERT INTO payments(type, gcash, amount, reference_number, transaction_date, email) VALUES(
      'Booking',
      '$gcash_reference',
      '$total_amount_paid',
      '$referenceNumber',
      '$today',
      '$email'
    )";

    notifyProcessBookingPayment($email, $fullname, $referenceNumber);

    $conn -> query($inserToPayment);
    echo 1;
  }else {
    echo 0;
  }

  $conn -> close();
?>