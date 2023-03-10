<?php 
  include('connection.php');

  $sql = "SELECT * FROM my_post";
  $result = $conn -> query($sql);

  $counter = 1;


  $packageCount = $result -> num_rows;

  echo "<div class='carousel-indicators'>";
  for($i = 0; $i < $packageCount; $i++){
    if($i == 0){
      echo "<button type='button' data-bs-target='#packages-carousel' data-bs-slide-to='$i' class='active' aria-current='true aria-label='Slide $i'></button>";
    }else {
      echo "<button type='button' data-bs-target='#packages-carousel' data-bs-slide-to='$i' aria-current='true aria-label='Slide $i'></button>";
    }
  }
  echo "
  </div>
  <div class='carousel-inner'>";
  while($row = $result -> fetch_array()){
    if($counter == 1){
      echo "
      <div class='carousel-item active'>
        <img src='../admin/POST/".$row['photo']."'>
        <div class='carousel-caption'>
          <div class='package-card'>
            <div class='pc1'>
              <img src='../admin/POST/".$row['photo']."'>
              <h4 class='is-size-4 mb-4 mt-4'>".$row['promo_name']."</h4>
              <p>".$row['description']."</p>
              <button id='".$row['id']."' onclick='openTourDetail(this.id)' class='mt-4 mb-2 button is-outlined is-link w-100'>View Details</button>
            </div>
            <div class='mt-4'>
              <button id='".$row['id']."' onclick='book(this.id)' class='button is-primary w-100 mb-2'>Book</button>
              <button id='".$row['id']."' onclick='reserve(this.id)' class='button is-primary w-100'>Reserve</button>
            </div>
          </div>
        </div>
      </div>";
    }else {
      echo "
      <div class='carousel-item'>
        <img src='../admin/POST/".$row['photo']."'>
        <div class='carousel-caption'>
          <div class='package-card'>
            <div class='pc1'>
              <img src='../admin/POST/".$row['photo']."'>
              <h4 class='is-size-4 mb-4 mt-4'>".$row['promo_name']."</h4>
              <p>".$row['description']."</p>
              <button id='".$row['id']."' onclick='openTourDetail(this.id)' class='mt-4 mb-2 button is-outlined is-link w-100'>View Details</button>
            </div>
            
            <div class='mt-4'>
              <button id='".$row['id']."' onclick='book(this.id)' class='button is-primary mb-2 w-100'>Book</button>
              <button id='".$row['id']."' onclick='reserve(this.id)' class='button is-primary w-100'>Reserve</button>
            </div>
          </div>
        </div>
      </div>";
    }
    echo "
    </>
    <button class='carousel-control-prev' type='button' data-bs-target='#packages-carousel' data-bs-slide='prev'>
      <span class='carousel-control-prev-icon' aria-hidden='true'></span>
      <span class='visually-hidden'>Previous</span>
    </button>
    <button class='carousel-control-next' type='button' data-bs-target='#packages-carousel' data-bs-slide='next'>
      <span class='carousel-control-next-icon' aria-hidden='true'></span>
      <span class='visually-hidden'>Next</span>
    </button>
    ";

    $counter++;
  }

  $conn -> close();
?>