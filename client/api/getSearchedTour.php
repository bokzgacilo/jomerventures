<?php
  include('connection.php');

  $month = $_GET['tour_month'];
  $destination = $_GET['tour_destination'];

  $sql = "SELECT * FROM my_post WHERE destination_province LIKE '%$destination%' OR destination_city LIKE '%$destination%'";
  $result = $conn -> query($sql);

  if($result -> num_rows == 0){
    echo "<h5>No results found</h5>";
  }else {
    while($row = $result -> fetch_array()){
      echo "
        <div class='searched'>
          <p>".$row['promo_name']."</p>
          <button id='".$row['id']."' onclick='openTourDetail(this.id)' class='button is-link is-small'>View Event Details</button>
        </div>
      ";
    }
  }

  $conn -> close();
?>