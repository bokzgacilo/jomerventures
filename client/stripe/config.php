<?php 
// Product Details 
// Minimum amount is $0.50 US 
// Test Stripe API configuration 

define('STRIPE_API_KEY', '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');  
define('STRIPE_PUBLISHABLE_KEY', 'pk_live_51HhonjJiyl95iPsrghTj2Pewd7r6nERamhzJB3L7KrhTuyLemQE5EOX7wNR5849HN7eLzmRE6X05xF18elNCOZls00XRWlwDEl'); 

define('STRIPE_SUCCESS_URL', 'http://localhost/stripe/success.php'); 
define('STRIPE_CANCEL_URL', 'http://localhost/stripe/cancel.php'); 

// Database configuration   
define('DB_HOST', 'localhost');  
define('DB_USERNAME', 'root');  
define('DB_PASSWORD', '');  
define('DB_NAME', 'paypage'); 
?>



