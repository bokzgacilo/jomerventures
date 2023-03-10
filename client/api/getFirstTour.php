<?php 
  include('connection.php');

  $sql = "SELECT * FROM my_post ORDER BY id ASC LIMIT 1";
  $result = $conn -> query($sql);

  while($row = $result -> fetch_array()){
    echo $row['photo'];
  }

  $conn -> close();
?>