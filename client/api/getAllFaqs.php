<?php
  include('connection.php');

  $sql = "SELECT * FROM faq";
  $result = $conn -> query($sql);
  echo "
  <div class='accordion accordion-flush' id='accordionFlushExample'>
    
  ";
  while($row = $result -> fetch_array()){
    echo "
      <div class='accordion-item'>
      <h2 class='accordion-header' id='flush-heading".$row['id']."'>
        <button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#flush-collapseheading".$row['id']."' aria-expanded='false' aria-controls='flush-collapseOne'>
          <p>".$row['question']."</p>
        </button>
      </h2>
      <div id='flush-collapseheading".$row['id']."' class='accordion-collapse collapse' aria-labelledby='flush-headingheading".$row['id']."' data-bs-parent='#accordionFlushExample'>
        <div class='accordion-body'>".$row['answer']."</div>
      </div>
    </div>
    ";
  }

  echo "
  </div>
  <a href='https://www.messenger.com/t/100090749350776' class='button is-small is-link'>Contact via Messenger</a>
  ";

  $conn -> close();
?>