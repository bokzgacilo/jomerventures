<?php
  // include('../vendor/autoload.php');
  // include('../vendor/autoload.php');
  // include('connection.php');

  // PayPal Configuration
  define('PAYPAL_EMAIL', 'sb-5pmal25101057@business.example.com'); 
  define('RETURN_URL', 'localhost/eyesee/success.php'); 
  define('CANCEL_URL', 'localhost/eyesee/cancel.php'); 
  define('NOTIFY_URL', 'localhost/eyesee/ipn.php'); 
  define('CURRENCY', 'USD'); 
  define('SANDBOX', TRUE); // TRUE or FALSE 
  define('LOCAL_CERTIFICATE', FALSE); // TRUE or FALSE

  if (SANDBOX === TRUE){
    $paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
  }else{
    $paypal_url = "https://www.paypal.com/cgi-bin/webscr";
  }
  // PayPal IPN Data Validate URL
  define('PAYPAL_URL', $paypal_url);
?>