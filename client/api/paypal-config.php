<?php 
  define('PAYPAL_ID', 'zyrelllalaguna@gmail.com'); 
  define('PAYPAL_SANDBOX', FALSE); //TRUE or FALSE 

  define('PAYPAL_RETURN_URL', 'http://localhost/jomerventures/client/success.php'); 
  define('PAYPAL_CANCEL_URL', 'http://localhost/jomerventures/client/cancel.php'); 
  define('PAYPAL_CURRENCY', 'PHP'); 

  // Change not required 
  define('PAYPAL_URL', (PAYPAL_SANDBOX == true)?"https://www.sandbox.paypal.com/cgi-bin/webscr"
  :"https://www.paypal.com/cgi-bin/webscr");  
  
?>