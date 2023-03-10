<?php
  include('connection.php');

  $email = $_GET['email'];

  $sql = "SELECT * FROM users WHERE email='$email'";
  $result = $conn -> query($sql);

  while($row = $result -> fetch_array()){
    echo "
      <a class='account-action' onclick='openAccountSetting()'>
        <i class='fa-solid fa-gear fa-xl'></i>
        Setting
      </a>
      <a class='account-action' onclick='handleSignOut()'>
        <i class='fa-solid fa-right-from-bracket fa-xl'></i>
        Signout
      </a>
    ";
  }

  $conn -> close();
?>  