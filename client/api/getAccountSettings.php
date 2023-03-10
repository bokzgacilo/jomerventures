<?php
  include('connection.php');
  $email = $_GET['email'];
  $sql = "SELECT * FROM users WHERE email='$email'";
  $result = $conn -> query($sql);
  while($row = $result -> fetch_array()){
    echo "
      <h4 class='is-size-6 mb-3'>Fullname</h4>
      <input disabled type='text' class='input mb-4' value='".$row['fullname']."'>  
      <h4 class='is-size-6 mb-3'>Email</h4>
      <input disabled type='email' class='input mb-4' value='".$row['email']."'>
      <h4 class='is-size-6 mb-3'>Password</h4>
      <input required type='text' id='new_password' class='input mb-4' value='".$row['password']."'>
      <h4 class='is-size-6 mb-3'>Contact Number</h4>
      <input required type='number' id='new_phone' class='input mb-4' value='".$row['phone']."'>
      <button type='submit' class='button is-primary w-100 mt-4'>Update</button>
    ";
  }
  $conn -> close();
?>