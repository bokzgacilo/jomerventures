<?php 
  include('connection.php');

  $sql = "SELECT * FROM my_post";
  $result = $conn -> query($sql);
  $counter = 1;
  while($row = $result -> fetch_array()){
    if($counter == 1){
      echo "
      <div id='".$row['id']."' onclick='changeBanner(this.id)' class='is-active tour'>
        <img src='../admin/POST/".$row['photo']."'>
        <div class='tour-detail'>
          <h4 class='is-size-5'>".$row['promo_name']."</h4>
          <p>".$row['description']."</p>
          <button id='".$row['id']."' onclick='openTourDetail(this.id)' class='mobile-tour-selector is-small button w-100'>Details</button>
        </div>
      </div>
      ";
    }else {
      echo "
      <div id='".$row['id']."' onclick='changeBanner(this.id)' class='tour'>
        <img src='../admin/POST/".$row['photo']."'>
        <div class='tour-detail'>
          <h4 class='is-size-5'>".$row['promo_name']."</h4>
          <p>".$row['description']."</p>
          <button id='".$row['id']."' onclick='openTourDetail(this.id)' class='mobile-tour-selector is-small button w-100'>Details</button>
        </div>
      </div>
      ";
    }
    $counter++;
  }

  $conn -> close();
?>