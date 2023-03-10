<?php
  include_once('../connection/connection.php');
  $sql = "SELECT * FROM  payments";

  $query = $conn -> query($sql);
  $client = '';
  while($row = $query -> fetch_array()){

    $getName = $conn -> query("SELECT * FROM clients WHERE email='".$row['email']."'");
    $getName = $getName -> fetch_assoc();

    echo 
    "<tr>
      <td>".$row['gcash']."</td>
      <td>".$row['amount']."</td>
      <td>".$row['reference_number']."</td>
      <td>".$row['transaction_date']."</td>
      <td>".$row['type']."</td>
      <td>".$getName['fullname']."</td>
      <td>".$row['email']."</td>
      <td>
        <a id='".$row['gcash']."' onclick='receivePayment(this.id)' class='btn btn-success btn-sm'>Receive</a>
      </td>
    </tr>";
  }
?>