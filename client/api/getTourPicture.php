<?php
  include('connection.php');
  $id = $_GET['id'];
  $result = $conn -> query("SELECT * FROM my_post WHERE id='$id'");
  $photoURL = '';
  while($row = $result -> fetch_array()){
    $photoURL = $row['photo'];
  }
  echo $photoURL;
  $conn -> close();
?>