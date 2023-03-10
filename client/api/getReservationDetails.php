<?php
  include('connection.php');

  $id = $_GET['id'];
  $email = $_GET['email'];

  $sql = "SELECT * FROM my_post WHERE id='$id'";
  $result = $conn -> query($sql);
  
  if($email == 'none' || $email == ''){
    while($row = $result -> fetch_array()){
    echo "
      <div class='bok-header'>
        <h4 class='is-size-4'>".$row['promo_name']."</h4>
        </div>
      <div class='bok-body'>
        <form name='reservation".$row['id']."' class='mb-4 w-100'>
          <div class='step1'>
          <h4 class='is-size-6 mb-3'>Email</h4>
          <input type='email' required id='reserve_email' class='input mb-2' placeholder='delacruz.juan@gmail.com'>
          <h4 class='is-size-6 mb-3'>Phone</h4>
          <input type='tel' required id='reserve_phone' class='input mb-2' placeholder='09762220951'>
          <h4 class='is-size-6 mb-3'>Fullname</h4>
          <input type='text' required id='reserve_fullname' class='input mb-2' placeholder='Juan Dela Cruz'>
          <h4 class='is-size-6 mb-3'>Booking Date</h4>
          <input type='date' min='".$row['promo_start']."' max='".$row['promo_end']."' required id='reserve_date' class='input mb-2' placeholder='Juan Dela Cruz'>
          <h4 class='is-size-6 mb-3'>How many persons</h4>
          <div class='select w-100 mb-2'>
            <select id='reserve_persons' required class='w-100'>
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
              <option>6</option>
              <option>7</option>
              <option>8</option>
              <option>9</option>
              <option>10</option>
              <option>11</option>
              <option>12</option>
            </select>
          </div>
          <h4 class='is-size-6 mb-3'>Point of Pickup</h4>
          <div class='select w-100 mb-2'>
            <select id='reserve_pickup_point' required class='w-100'>
              <option>SM MOA</option>
              <option>SM Aura</option>
              <option>Market Market</option>
              <option>PITX</option>
            </select>
          </div>
          <h4 class='is-size-6 mb-3'>Mode of Payment</h4>
          <div class='select w-100 mb-2'>
            <select id='reserve_mode_payment' required class='w-100'>
              <option value='GCASH'>GCash</option>
              <option value='PAYPAL'>Paypal</option>
              <option value='CARD'>CARD</option>
            </select>
          </div>
          <a id='".$row['id']."' onclick='nextStepReserve(this.id)' class='button mb-2 mt-4 is-link w-100'>Proceed to Checkout</a>
          </div>
          <div class='step2'>
          
          </div>
          <button onclick='closeReservation()' class='button w-100'>Cancel</button>
        </form>
      </div>
    ";
    }
  }else {
    $phone = '';
    $fullname = '';

    $getAccountDetails = $conn -> query("SELECT * FROM users WHERE email='$email'");

    while($user = $getAccountDetails -> fetch_array()){
      $phone = $user['phone'];
      $fullname = $user['fullname'];
    }

    while($row = $result -> fetch_array()){
      echo "
        <div class='bok-header'>
          <h4 class='is-size-4'>".$row['name']."</h4>
          </div>
        <div class='bok-body'>
          <form name='reservation".$row['id']."' class='mb-2 w-100'>
            <div class='step1'>
              <h4 class='is-size-6 mb-3'>Email</h4>
              <input type='email' required id='reserve_email' class='input mb-2' value='$email' disabled>
              <h4 class='is-size-6 mb-3'>Phone</h4>
              <input type='number' required id='reserve_phone' class='input mb-2' value='$phone' disabled>
              <h4 class='is-size-6 mb-3'>Fullname</h4>
              <input type='text' required id='reserve_fullname' class='input mb-2' value='$fullname' disabled>
              <h4 class='is-size-6 mb-3'>Booking Date</h4>
              <input type='date' required id='reserve_date' class='input mb-2'>
              <h4 class='is-size-6 mb-3'>How many persons</h4>
              <div class='select w-100 mb-2'>
                <select required id='reserve_persons' class='w-100'>
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                  <option>6</option>
                  <option>7</option>
                  <option>8</option>
                  <option>9</option>
                  <option>10</option>
                  <option>11</option>
                  <option>12</option>
                </select>
              </div>
              <h4 class='is-size-6 mb-3'>Point of Pickup</h4>
              <div class='select w-100 mb-2'>
                <select required id='reserve_pickup_point' class='w-100'>
                  <option>SM MOA</option>
                  <option>SM Aura</option>
                  <option>Market Market</option>
                  <option>PITX</option>
                </select>
              </div>
              <h4 class='is-size-6 mb-3'>Mode of Payment</h4>
              <div class='select w-100 mb-2'>
                <select id='reserve_mode_payment' required class='w-100'>
                  <option value='GCASH'>GCash</option>
                  <option value='PAYPAL'>Paypal</option>
                  <option value='CARD'>CARD</option>
                </select>
              </div>
              <a id='".$row['id']."' onclick='nextStepReserve(this.id)' class='button mb-2 mt-4 is-link w-100'>Proceed to Checkout</a>
            </div>
            <div class='step2'>
              
            </div>
          </form>
          <button onclick='closeReservation()' class='button w-100'>Cancel</button>
        </div>
      
      ";
    }
  }
  

  $conn -> close();
?>