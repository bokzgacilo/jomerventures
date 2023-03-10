<?php
  include('connection.php');

  $reference_number = $_GET['reference_number'];

  $sql = "SELECT * FROM proceed_to_pay WHERE ref='$reference_number'";
  $result = $conn -> query($sql);

  while($row = $result -> fetch_array()){
    echo "
      <img src='assets/GCash.png' style='width: 400px; height: auto;'>
      <h4 class='is-size-6 mb-3'>Total Amount Paid</h4>
      <input type='number' id='payment_amount' class='input mb-2' value='".$row['balance']."' disabled>
      <h4 class='is-size-6 mb-3'>GCash Reference Number</h4>
      <input type='number' required id='payment_gcash' value='0' class='input mb-4' placeholder='5008272842387'>
      <button type='submit' onclick='pay($reference_number)' class='button is-link w-100 mb-2'>Submit Payment</button>
    ";
  }

  $conn -> close();
?>