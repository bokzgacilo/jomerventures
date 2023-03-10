<?php
  include('connection.php');

  $id = $_GET['id'];

  $sql = "SELECT * FROM my_post WHERE id='$id'";
  $result = $conn -> query($sql);

  while($row = $result -> fetch_array()){
    echo "
    <div class='bok-header'>
      <h4 class='is-size-4'>".$row['promo_name']."</h4>
      <i onclick='closeModal()' class='fa-solid fa-x'></i>
    </div>
    <div class='bok-body modal-tour-body'>
      <div class='col-6'>
        <h4 class='is-size-5 mb-4'>Tour Details</h4>
        <div class='modal-tour-detail mb-2'>
          <div class='row'>
            <div class='col-5'>
              <p>Province</p>
            </div>
            <div class='col'>
              <p>".$row['destination_province']."</p>
            </div>
          </div>
          <div class='row'>
            <div class='col-5'>
              <p>City</p>
            </div>
            <div class='col'>
              <p>".$row['destination_city']."</p>
            </div>
          </div>
          <div class='row'>
            <div class='col-5'>
              <p>Price per Pax</p>
            </div>
            <div class='col'>
              <p><i class='fa-solid fa-peso-sign'></i> ".$row['promo_price']."</p>
            </div>
          </div>
          <div class='row'>
            <div class='col-5'>
              <p>Minimum Pax</p>
            </div>
            <div class='col'>
              <p>".$row['min_pax']."</p>
            </div>
          </div>
          <div class='row'>
            <div class='col-5'>
              <p>Maximum Pax</p>
            </div>
            <div class='col'>
              <p>".$row['max_pax']."</p>
            </div>
          </div>
          <div class='row'>
            <div class='col-5'>
              <p>Starting Date</p>
            </div>
            <div class='col'>
              <p>".date("F j, Y", strtotime($row['promo_start']))."</p>
            </div>
          </div>
          <div class='row'>
            <div class='col-5'>
              <p>Ending Date</p>
            </div>
            <div class='col'>
              <p>".date("F j, Y", strtotime($row['promo_start']))."</p>
            </div>
          </div>
          
        </div>
        <h4 class='is-size-5 mt-4 mb-4'>Tour Description</h4>
        <div class='modal-tour-detail'>
          <p>".$row['description']."</p>
        </div>
      </div>

      <div class='col-6'>
        <div class='modal-tour-detail'>
          <img src='../admin/POST/".$row['photo']."'>
        </div>
        <button id='".$row['id']."' onclick='book(this.id)' class='button is-primary w-100 mt-4'>Book</button>
        <button id='".$row['id']."' onclick='reserve(this.id)' class='button is-primary w-100 mt-2'>Reserve</button>
      </div>
    </div>
    ";
  }

  $conn -> close();
?>