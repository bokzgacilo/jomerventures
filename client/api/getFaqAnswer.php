<?php
  include('connection.php');

  $faqID = $_GET['faqID'];

  $sql = "SELECT * FROM faq WHERE id='$faqID'";
  $result = $conn -> query($sql);

  while($row = $result -> fetch_array()){
    echo $row['answer'];
  }

  $conn -> close();
?>