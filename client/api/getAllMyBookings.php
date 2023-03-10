<?php
  include('connection.php');

  $email = $_GET['email'];

  $sql = "SELECT * FROM proceed_to_pay WHERE email='$email'";
  $result = $conn -> query($sql);
  echo "
  <div class='my-bookings-list w-100'>";

  if($result -> num_rows == 0){
    echo "
      <div class='my-book'>
        No Booking  
      </div>
    ";
  }else {
    while($row = $result -> fetch_array()){
      echo "
        <div class='my-book'>
          <p>Tour Ref: ".$row['ref']."</p>
          <button class='button is-primary is-small' id='".$row['ref']."' onclick='viewBooking(this.id)'>View Booking</button>
        </div>
      ";
    }
  }
  

  echo "</div>";

  $conn -> close();
?>