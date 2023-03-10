<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sendReceipt($email, $fullname, $details){
  $mail = new PHPMailer(true);

  $subject = "Payment Receipt";
  $message = "
    Good Day <strong>$fullname</strong>. <br><br>
    Thanks for paying with Jomer Ventures. <br><br>
    Below is the detail of your payment receipt. <br><br>
    $details
    <br><br>
    If you have a concern or inquiries, don't be shy to contact Jomer Ventures. <br><br>
    Thank you. <br>
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

  $mail -> addAddress($email);

  $mail -> isHTML(true);
  $mail -> Subject = $subject;
  $mail -> Body = $message;

  $mail -> send();
}

function sendTourDetail($email, $fullname, $reference_number, $details){
  $mail = new PHPMailer(true);

  $subject = "Tour Details";
  $message = "
    Good Day $fullname. <br><br>
    This is to notify you that your tour with a reference number of <strong>$reference_number</strong> was paid.<br>
    Below is the detail of your tour. <br>
    $details
    <br><br>
    If you have a concern or inquiries, don't be shy to contact Jomer Ventures. <br><br>
    Thank you. <br>
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

  $mail -> addAddress($email);

  $mail -> isHTML(true);
  $mail -> Subject = $subject;
  $mail -> Body = $message;

  $mail -> send();
}
