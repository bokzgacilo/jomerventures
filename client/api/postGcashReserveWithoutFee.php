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
  $selectTour = $conn -> query("SELECT * FROM promos WHERE id='$tourID'");
  $status = 'Waiting for payment of Reservation Fee';
  
  while($row = $selectTour -> fetch_array()){
    $price = $row['price'];
  }

  $totalPrice = $persons * $price;
  $balance = $totalPrice + 200;

  $sql = "INSERT INTO transactions(
    email, 
    reference_number, 
    phone, 
    fullname, 
    booking_date, 
    price, 
    pax, 
    price_to_pay, 
    balance,
    pickup_point, 
    code, 
    promo_id, 
    status, 
    mode, 
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
      '0', 
      '$tourID', 
      '$status', 
      '$reserve_mode_payment', 
      '$today'
    )";

  $result = $conn -> query($sql);

  if($result){
    $conn -> query($inserToPayment);
    notifyProcessReservationFee($email, $fullname, $referenceNumber);
    echo 1;
  }else {
    echo 0;
  }

  $conn -> close();
?>