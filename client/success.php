<?php 
  session_start();
  require_once('api/connection.php');
  include('success-emailer.php');

  if(!isset($_SESSION['MODE'])){
    header('location: ../client/');
  }

  $transactionID = rand(100000000, 999999999);

  $today = date("F j, Y, g:i a");			

  if($_SESSION['MODE'] == 'PAYPAL'){
    $today = date("F j, Y, g:i a");

    $insertToPayment = "INSERT INTO payments(type, gcash, amount, reference_number, transaction_date, email) VALUES(
      '".$_SESSION['type']."',
      '$transactionID',
      '".$_SESSION['lastprice']."',
      '".$_SESSION['lastpaymentID']."',
      '$today',
      '".$_SESSION['lastemail']."'
    )";
  
    $result = $conn -> query($insertToPayment);
  
    if($result){
      $balance = '';
      $fullname = '';
      $price_to_pay = '';
      $promo_id = '';
      $status = '';
      $persons = '';
      $pickup = '';
      $getBalance = $conn -> query("SELECT * FROM proceed_to_pay WHERE ref='".$_SESSION['lastpaymentID']."'");
      
      while($row = $getBalance -> fetch_array()){
        $balance = $row['balance'];
        $fullname = $row['fullname'];
        $price_to_pay = $row['price_to_pay'];
        $status = $row['status'];
        $promo_id = $row['promo_id'];
        $persons = $row['pax'];
        $pickup = $row['pickup'];
      }

      if($_SESSION['type'] == 'Reservation'){
        $newbalance = $balance - 500;
        $updatePayment = $conn -> query("UPDATE proceed_to_pay SET balance='$newbalance', status='UNPAID' WHERE ref='".$_SESSION['lastpaymentID']."'");
      }else {
        $getPromo = $conn -> query("SELECT * FROM my_post WHERE id='$promo_id'");

        $start = '';
        $ending = '';
        $destination = '';
        $tourtitle = '';

        while($promo = $getPromo -> fetch_array()){
          $tourtitle = $promo['promo_name'];
          $start = $promo['promo_start'];
          $ending = $promo['promo_end'];
          $destination = $promo['destination_city'] . ', ' . $promo['destination_province'];
        }
        // WHEN PAID
        $updatePayment = $conn -> query("UPDATE proceed_to_pay SET balance='0', status='PAID' WHERE ref='".$_SESSION['lastpaymentID']."'");
        $tourdetail = "
        <br><p>Reference Number: ".$_SESSION['lastpaymentID']."</p>
        <p>Tour Title: $tourtitle</p>
        <p>Starting Date: $start</p>
        <p>Ending Date: $ending</p>
        <p>Destination: $destination</p>
        <p>Pickup Point: $pickup</p>
        <p>Price: $price_to_pay</p>
        <p>Person Included $persons</p>
        <p>Mode of Payment: ".$_SESSION['MODE']."</p>
        <p>Status: PAID</p>
        ";
        sendTourDetail($_SESSION['lastemail'], $fullname, $_SESSION['lastpaymentID'], $tourdetail);
      }

      $message = "
      <p>Transaction Date: $today</p>
      <p>Transaction ID: $transactionID</p>
      <p>Transaction Type: ".$_SESSION['MODE']."</p>
      <p>Tour Reference Number: ".$_SESSION['lastpaymentID']."</p>
      <p>Client Email: ".$_SESSION['lastemail']."</p>
      <p>Paid Amount: ".$_SESSION['lastprice']."</p>
      ";

      sendReceipt($_SESSION['lastemail'], $fullname, $message);
    }
  } 
  
  if($_SESSION['MODE'] == 'CARD'){
    require_once('api/stripe-config.php');

    $pageview = $_GET['getID']; 
    $payment_id = $statusMsg = '';
    $ordStatus = 'error';
  
    if(!empty($_GET['session_id'])){
      $session_id = $_GET['session_id'];

      require_once 'api/stripe-php/init.php';

      \Stripe\Stripe::setApiKey(STRIPE_API_KEY);

      try {
        $checkout_session = \Stripe\Checkout\Session::retrieve($session_id);
      }catch(Exception $e) { 
        $api_error = $e -> getMessage(); 
      }
          
      if(empty($api_error) && $checkout_session){

        try {
          $intent = \Stripe\PaymentIntent::retrieve($checkout_session->payment_intent);
        } catch (\Stripe\Exception\ApiErrorException $e) {
          $api_error = $e->getMessage();
        }
        
        try {
          $customer = \Stripe\Customer::retrieve($checkout_session->customer);
        } catch (\Stripe\Exception\ApiErrorException $e) {
          $api_error = $e->getMessage();
        }
        
        if(empty($api_error) && $intent){ 
          if($intent -> status == 'succeeded'){
            $name = $customer -> name;
            $email = $customer -> email;
            
            $paidAmount = $intent -> amount;
            $paidAmount = ($paidAmount/100);
            $paidCurrency = $intent->currency;
            $paymentStatus = $intent->status;
            $sql = '';

            $balance = '';
            $fullname = '';
            $price_to_pay = '';
            $promo_id = '';
            $status = '';
            $persons = '';
            $pickup = '';
            $getBalance = $conn -> query("SELECT * FROM proceed_to_pay WHERE ref='".$_SESSION['lastpaymentID']."'");
            
            while($row = $getBalance -> fetch_array()){
              $balance = $row['balance'];
              $fullname = $row['fullname'];
              $price_to_pay = $row['price_to_pay'];
              $status = $row['status'];
              $promo_id = $row['promo_id'];
              $persons = $row['pax'];
              $pickup = $row['pickup'];
            }

            if($_SESSION['type'] == 'Reservation'){
              $newbalance = $balance - 500;

              $sql = "INSERT INTO payments(type, gcash, amount, reference_number, transaction_date, email) VALUES(
                'Reservation',
                '$transactionID',
                '$paidAmount',
                '".$_SESSION['lastpaymentID']."',
                '$today',
                '$email'
              )";

              $updatePayment = $conn -> query("UPDATE proceed_to_pay SET balance='$newbalance', status='UNPAID' WHERE ref='".$_SESSION['lastpaymentID']."'");
            }else {
              $sql = "INSERT INTO payments(type, gcash, amount, reference_number, transaction_date, email) VALUES(
                'Booking',
                '$transactionID',
                '$paidAmount',
                '".$_SESSION['lastpaymentID']."',
                '$today',
                '$email'
              )";

              $getPromo = $conn -> query("SELECT * FROM my_post WHERE id='$promo_id'");

              $start = '';
              $ending = '';
              $destination = '';
              $tourtitle = '';

              while($promo = $getPromo -> fetch_array()){
                $tourtitle = $promo['promo_name'];
                $start = $promo['promo_start'];
                $ending = $promo['promo_end'];
                $destination = $promo['destination_city'] . ', ' . $promo['destination_province'];
              }
              // WHEN PAID
              $updatePayment = $conn -> query("UPDATE proceed_to_pay SET balance='0', status='PAID' WHERE ref='".$_SESSION['lastpaymentID']."'");
              $tourdetail = "
              <br><p>Reference Number: ".$_SESSION['lastpaymentID']."</p>
              <p>Tour Title: $tourtitle</p>
              <p>Starting Date: $start</p>
              <p>Ending Date: $ending</p>
              <p>Destination: $destination</p>
              <p>Pickup Point: $pickup</p>
              <p>Price: $price_to_pay</p>
              <p>Person Included $persons</p>
              <p>Mode of Payment: ".$_SESSION['MODE']."</p>
              <p>Status: PAID</p>
              ";
              sendTourDetail($_SESSION['lastemail'], $fullname, $_SESSION['lastpaymentID'], $tourdetail);
            }

            $insert = $conn -> query($sql);

            if($insert){
              $ordStatus = 'success';
              $statusMsg = 'Your Payment has been Successful!';  
            }

            $message = "
            <p>Transaction Date: $today</p>
            <p>Transaction ID: $transactionID</p>
            <p>Transaction Type: ".$_SESSION['MODE']."</p>
            <p>Tour Reference Number: ".$_SESSION['lastpaymentID']."</p>
            <p>Client Email: ".$_SESSION['lastemail']."</p>
            <p>Paid Amount: ".$_SESSION['lastprice']."</p>
            ";

            sendReceipt($_SESSION['lastemail'], $fullname, $message);
          }else{
            $statusMsg = "Transaction has been failed!";
          }
        }else{
          $statusMsg = "Unable to fetch the transaction details! $api_error"; 
        }

        $ordStatus = 'success';
      }else{
        $statusMsg = "Transaction has been failed! $api_error"; 
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="assets/jomer-seal.png" type="image/x-icon">
  <title>JomerVentures - Official Receipt</title>
  <link rel="stylesheet" href="css/base.css">
</head>
<body>
  <style>
    main {
      display: flex;
      flex-direction: column;
      width: inherit;
      height: inherit;
      padding-top: 5rem;
      align-items: center;
    }

    .receipt {
      display: flex;
      flex-direction: column;
      align-items: center;
      width: 30%;
      gap: 2rem;
    }

    .receipt-details {
      display: flex;
      width: 100%;
      flex-direction: row;
    }
  </style>

  <main>
    <div class="receipt">
      <h4 class="is-size-4">Thank you for paying!</h4>
      <div class="alert alert-success" role="alert">
        A copy of receipt was sent to your email.
      </div>
      <div class="receipt-details">
        <div class="col-6">
          <p>Payment Date:</p>
          <p>Transaction ID:</p>
          <p>Mode of Payment:</p>
          <p>Tour Reference Number:</p>
          <p>Client Email:</p>
          <p>Paid Amount</p>
        </div>
        <div class="col">
          <p><?php echo $today; ?></p>
          <p><?php echo $transactionID; ?></p>
          <p><?php echo $_SESSION['MODE']; ?></p>
          <p><?php echo $_SESSION['lastpaymentID']; ?></p>
          <p><?php echo $_SESSION['lastemail']; ?></p>
          <p><?php echo $_SESSION['lastprice']; ?></p>
        </div>
      </div>
      <a href='index.html' class="button">Back to Jomer Ventures</a>
    </div>
  </main>
</body>
</html>

<?php 
  unset($_SESSION['MODE']);
  unset($_SESSION['type']);
  unset($_SESSION['lastpaymentID']);
  unset($_SESSION['lastprice']);
  unset($_SESSION['lastemail']);
?>