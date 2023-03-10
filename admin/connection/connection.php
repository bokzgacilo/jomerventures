<?php
  // include('../../client/api/connection.php');
  
	// // //for MySQLi OOP
	// // $conn = new mysqli(
  // //   "localhost", 
  // //   "u750852472_jomer_admin", 
  // //   "Capstone2023!", 
  // //   "u750852472_jomerventures"
  // // );
	
  // // if($conn -> connect_error){
	// //   die("Connection failed: " . $conn->connect_error);
	// // }
?>

<?php
  date_default_timezone_set('Asia/Manila');

  $conn = new mysqli(
    "localhost", 
    "root", 
    "", 
    "jomerdatabase"
  );
?>