<?php
  session_start();
  include('connection.php');
  
  $email = $_GET['email'];
  $ref = $_GET['reference_number'];
  
  $sql = "SELECT * FROM proceed_to_pay WHERE email='$email' AND ref='$ref'";
  $result = $conn -> query($sql);

  if($result -> num_rows == 0){
    echo "
    <div class='w-100'>
      <h4 class='mb-2'>No Booked Tour.</h4>
      <p class='mb-2'>Please check your reference number.</p>
      <button onclick='resetManageBooking()' class='button w-100'>Search Again</button>
    </div>";
  }else {
    while($row = $result -> fetch_array()){
      $getTour = $conn -> query("SELECT * FROM promos WHERE id='".$row['promo_id']."'");
      $tour_title = '';

      while($rr = $getTour -> fetch_array()){
        $tour_title = $rr['name'];
      }

      if($row['mode'] == 'GCASH'){
        echo "
        <div class='w-100'>
          <h4 class='is-size-6 mb-2'>Reference Number</h4>
          <input type='text' value='".$row['ref']."' class='is-small input mb-4' disabled>
          <h4 class='is-size-6 mb-2'>Tour Title</h4>
          <input type='text' value='$tour_title' class='is-small input mb-4' disabled>
          <h4 class='is-size-6 mb-2'>Pickup Point</h4>
          <input type='text' value='".$row['pickup']."' class='is-small input mb-4' disabled>
          <h4 class='is-size-6 mb-2'>Price</h4>
          <input type='text' value='".$row['price_to_pay']."' class='is-small input mb-4' disabled>
          <h4 class='is-size-6 mb-2'>Mode of Payment</h4>
          <input type='text' value='".$row['mode']."' class='is-small input mb-4' disabled>
          <h4 class='is-size-6 mb-2'>Status</h4>
          <input type='text' value='".$row['status']."' class='is-small input mb-2' disabled>";
          
          if( $row['status'] == 'UNPAID'){
            echo "
            <h4 class='is-size-6 mb-2'>Balance</h4>
            <input type='number' name='balance' value='".$row['balance']."' class='is-small input mb-4' readonly>
            <button type='submit' name='submit' id='".$row['ref']."' onclick='settlePayment(this.id)' class='button is-link w-100 mb-2'>Settle Payment</button>";
          }

          if($row['status'] == 'Processing Payment'){
            echo "
            <h4 class='is-size-6 mb-2'>Balance</h4>
            <input type='text' value='".$row['balance']."' class='is-small input mb-4' disabled>
            <button class='button is-link w-100 mb-2' disabled>Processing Payment</button>";
          }

          if($row['status'] == 'Waiting for Payment' ){
            echo "
            <h4 class='is-size-6 mb-2'>Balance</h4>
            <input type='text' value='".$row['balance']."' class='is-small input mb-4' disabled>
            <button type='' id='".$row['mode']."' onclick='settlePayment(this.id)' class='button is-link w-100 mb-2' disabled>Waiting Payment Process</button>";
          }

          if($row['status'] == 'Paid'){
            echo "<button class='button is-success w-100 mb-2' disabled>Paid</button>";
          }
        echo "</div>";
      }
      
      if($row['mode'] == 'PAYPAL'){
        $_SESSION['MODE'] = 'PAYPAL';
        $_SESSION['lastpaymentID'] = $row['ref'];
        $_SESSION['lastemail'] = $email;

        include('paypal-config.php');

        echo "
          <h4 class='is-size-6 mb-2'>Tour Title</h4>
          <input type='text' name='tour_title' value='$tour_title' class='is-small input mb-4' readonly>
          <h4 class='is-size-6 mb-2'>Pickup Point</h4>
          <input type='text' name='pickup_point' value='".$row['pickup']."' class='is-small input mb-4' readonly>
          <h4 class='is-size-6 mb-2'>Price</h4>
          <input type='text' name='price_to_pay' value='".$row['price_to_pay']."' class='is-small input mb-4' readonly>
          <h4 class='is-size-6 mb-2'>Mode of Payment</h4>
          <input type='text' name='payment_mode' value='".$row['mode']."' class='is-small input mb-4' readonly>
          <h4 class='is-size-6 mb-2'>Status</h4>
          <input type='text' value='".$row['status']."' class='is-small input mb-2' readonly>
        ";

        if($row['status'] == 'UNPAID' || $row['status'] == 'Waiting for Payment'){
          $_SESSION['lastprice'] = $row['balance'];
          echo "
          <form action='".PAYPAL_URL."' method='post'>
            <input type='hidden' name='business' value='".PAYPAL_ID."'>
            <h4 class='is-size-6 mb-2'>Reference Number</h4>
            <input type='text' name='item_name' value='".$row['ref']."' class='is-small input mb-4' readonly>
            <h4 class='is-size-6 mb-2'>Balance</h4>
            <input type='number' name='amount' value='".$row['balance']."' class='is-small input mb-4' readonly>
            <input type='hidden' name='currency_code' value='".PAYPAL_CURRENCY."'>
            <input type='hidden' name='cmd' value='_xclick'>
            <input type='hidden' name='return' value='".PAYPAL_RETURN_URL."'>
            <input type='hidden' name='cancel_return' value='".PAYPAL_CANCEL_URL."'>
            <input type='submit' name='submit' class='button is-link w-100 mb-2' value='Settle Payment'>
          </form>";

          $_SESSION['type'] = 'Booking';
        }

        if($row['status'] == 'Waiting for Reservation Fee'){
          $_SESSION['lastprice'] = 500;
          echo "
          <form action='".PAYPAL_URL."' method='post'>
            <input type='hidden' name='business' value='".PAYPAL_ID."'>
            <h4 class='is-size-6 mb-2'>Reference Number</h4>
            <input type='text' name='item_name' value='".$row['ref']."' class='is-small input mb-4' readonly>
            <h4 class='is-size-6 mb-2'>Reservation Fee</h4>
            <input type='number' name='amount' value='500' class='is-small input mb-4' readonly>
            <input type='hidden' name='currency_code' value='".PAYPAL_CURRENCY."'>
            <input type='hidden' name='cmd' value='_xclick'>
            <input type='hidden' name='return' value='".PAYPAL_RETURN_URL."'>
            <input type='hidden' name='cancel_return' value='".PAYPAL_CANCEL_URL."'>
            <input type='submit' name='submit' class='button is-link w-100 mb-2' value='Settle Reservation Fee'>
          </form>";

          $_SESSION['type'] = 'Reservation';
        }

        if($row['status'] == 'Paid'){
          echo "<button class='button is-success w-100 mb-2' disabled>Paid</button>";
        }
      }
      if($row['mode'] == 'CARD'){
      
        echo "
          <script src='js/stripe-pay.js'></script>
        ";

        $_SESSION['MODE'] = 'CARD';
        $_SESSION['lastpaymentID'] = $row['ref'];
        $_SESSION['lastprice'] = $row['price_to_pay'];
        $_SESSION['lastemail'] = $email;

        echo "
          <h4 class='is-size-6 mb-2'>Tour Title</h4>
          <input type='text' id='card_item_name' name='tour_title' value='$tour_title' class='is-small input mb-4' readonly>
          <h4 class='is-size-6 mb-2'>Pickup Point</h4>
          <input type='text' name='pickup_point' value='".$row['pickup']."' class='is-small input mb-4' readonly>
          <h4 class='is-size-6 mb-2'>Price</h4>
          <input type='text' name='price_to_pay' value='".$row['price_to_pay']."' class='is-small input mb-4' readonly>
          <h4 class='is-size-6 mb-2'>Booking Date</h4>
          <input type='text' value='".$row['booking_date']."' class='is-small input mb-4' readonly>
          <h4 class='is-size-6 mb-2'>Mode of Payment</h4>
          <input type='text' name='payment_mode' value='".$row['mode']."' class='is-small input mb-4' readonly>
          <h4 class='is-size-6 mb-2'>Status</h4>
          <input type='text' value='".$row['status']."' class='is-small input mb-2' readonly>
        ";

        if($row['status'] == 'Waiting for Payment' || $row['status'] == 'UNPAID'){
          $_SESSION['type'] = 'Booking';
          $_SESSION['lastprice'] = $row['balance'];

          echo "
          <div>
            <h4 class='is-size-6 mb-2'>Reference Number</h4>
            <input type='text' id='card_item_number' name='item_name' value='".$row['ref']."' class='is-small input mb-4' readonly>
            <h4 class='is-size-6 mb-2'>Balance</h4>
            <input type='number' id='card_item_amount' name='amount' value='".$row['balance']."' class='is-small input mb-4' readonly>
            <input onclick='settlePaymentCard()' class='button is-link w-100 mb-2' value='Settle Payment'>
          </div>";
        }

        if($row['status'] == 'Waiting for Reservation Fee' ){
          $_SESSION['type'] = 'Reservation';

          $_SESSION['lastprice'] = 500;
          echo "
          <div>
            <h4 class='is-size-6 mb-2'>Reference Number</h4>
            <input type='text' id='card_item_number' name='item_name' value='".$row['ref']."' class='is-small input mb-4' readonly>
            <h4 class='is-size-6 mb-2'>Balance</h4>
            <input type='number' id='card_item_amount' name='amount' value='500' class='is-small input mb-4' readonly>
            <input onclick='settlePaymentCard()' class='button is-link w-100 mb-2' value='Settle Reservation Fee'>
          </div>";
        }

        if($row['status'] == 'Paid'){
          echo "<button class='button is-success w-100 mb-2' disabled>Paid</button>";
        }
      }

      echo"
      <button id='".$row['ref']."' onclick='updateTravelDate(this.id)' class='button w-100 mb-2'>Update Travel Date</button>
      <button id='".$row['ref']."' onclick='updatePickupPoint(this.id)' class='button w-100 mb-2'>Update Pickup Location</button>
      <button id='".$row['ref']."' onclick='updateGuestDetails(this.id)' class='button w-100 mb-2'>Update Guest Details</button>
      <button id='".$row['ref']."' onclick='cancelTour(this.id)' class='button is-danger w-100 mb-2'>Cancel Tour</button>
  ";
    }
  }

  $conn -> close();
?>