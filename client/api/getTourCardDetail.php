<?php
  include('connection.php');

  $id = $_GET['location'];

  $sql = "SELECT * FROM my_post WHERE id='$id'";
  $result = $conn -> query($sql);

  while($row = $result -> fetch_array()){

    echo "
        <div class='tour-card'>
          <h4 class='is-size-3 mb-4'>".$row['promo_name']."</h4>
          <div class='tour-card-description'>
            <p>".$row['description']."</p>
          </div>
          <button id='".$row['id']."' onclick='openTourDetail(this.id)' class='button is-link w-100 mt-4'>View Details</button>
        </div>
    ";
  }

  $conn -> close();
?>