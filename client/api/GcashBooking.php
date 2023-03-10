<?php
  include('connection.php');

  $tourID = $_GET['tourID'];

  $sql = "SELECT * FROM promos WHERE id='$tourID'";
  $result = $conn -> query($sql);

  while($row = $result -> fetch_array()){
    $persons = $_GET['persons'];
    $total_amount = $row['price'] * $persons;

    echo "
      <img src='assets/GCash.png' style='width: 400px; height: auto;'>
      <h4 class='is-size-6 mb-3'>Total Amount Paid</h4>
      <input type='number' id='total_amount_paid' class='input mb-2' value='$total_amount' disabled>
      <h4 class='is-size-6 mb-3'>GCash Reference Number</h4>
      <input type='number' required id='gcash_reference_number' value='0' class='input mb-4' placeholder='5008272842387'>
      <button type='submit' onclick='bookGCash(".$row['id'].")' class='button is-link w-100 mb-2'>Submit Payment</button>
    ";
  }

  $conn -> close();
?>