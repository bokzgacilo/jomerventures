<?php
  require 'vendor/autoload.php';

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  $email = $_GET['email'];

  sendTemporaryPassword($email);

  function sendTemporaryPassword($target) {

  include('../connection/connection.php');


    $mail = new PHPMailer(true);

    $temporaryPassword = rand(10000000, 999999999);

    $sql = "UPDATE users SET temporary_password='$temporaryPassword' WHERE email='$target'";
    $result = $conn -> query($sql);

    if($result){
      $subject = "Temporary Password for Admin";
      $message = "
        Admin Temporary password is <strong>$temporaryPassword</strong>
      ";
      $mail = new PHPMailer(true);
      
      $mail -> isSMTP();
      $mail -> Host = "smtp.gmail.com";
      $mail -> SMTPAuth = true;
      $mail -> Username = 'jomerventures.emailer@gmail.com';
      $mail -> Password = 'naiynyptdayxjncm';
      $mail -> SMTPSecure = 'ssl';
      $mail -> Port = 465;
  
      $mail -> setFrom('jomerventures.emailer@gmail.com', 'Jomer Ventures');
  
      $mail -> addAddress($target);
  
      $mail -> isHTML(true);
      $mail -> Subject = $subject;
      $mail -> Body = $message;
  
      $mail -> send();

      echo "      
      <div>
        Temporary Password was sent to your email. Please check you inbox.
        <a href='../login.php'>Back to login</a>
      </div>
      ";
    }else {
      echo 'Please try again.';
    }
  }

  // echo $email;

?>
