<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

function notifyProcessReservationFee($email, $fullname, $referenceNumber){
  $mail = new PHPMailer(true);

  $subject = "A Notification To Process Your Reservation Fee";
  $message = "
    Good Day $fullname!<br><br>
    This is to notify you to process your reservation fee for your travel plan with a reference number of $referenceNumber. <br>
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

function getTemporaryPassword($email, $fullname, $password){
  $mail = new PHPMailer(true);

  $subject = "JomerVentures Registration";
  $message = "
    Good Day $fullname!<br><br>
    This is to notify you that you are registered to JomerVentures. You can use the password below on your first login. Please change it after you successfully signed in. <br>
    Password: <strong>$password</strong><br><br>
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

function sendTempoPass($email, $password){
  $mail = new PHPMailer(true);

  $subject = "Temporary Password Requested";
  $message = "
    This is your temporary password.
    Password: <strong>$password</strong><br><br>
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

function cancelTour($email, $reference_number){
  $mail = new PHPMailer(true);

  $subject = "Cancelled Tour";
  $message = "
    This is to notify you that your tour with a reference number of <strong>$reference_number</strong> was cancelled. <br>
    If you have a concern or inquiries, don't be shy to contact JomerVentures. <br>
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

  $mail -> setFrom('jomerventures.emailer@gmail.com', 'JomerVentures');

  $mail -> addAddress($email);

  $mail -> isHTML(true);
  $mail -> Subject = $subject;
  $mail -> Body = $message;

  $mail -> send();
}

function notifyProcessBookingPayment($email, $fullname, $reference_number){
  $mail = new PHPMailer(true);

  $subject = "Your Payment is Processing";
  $message = "
    Good Day $fullname. <br><br>
    This is to notify you that your tour with a reference number of <strong>$reference_number</strong> is processing its payment. It will take 24-48 hours to process your payment. Please wait.<br>
    If you have a concern or inquiries, don't be shy to contact JomerVentures. 
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

  $mail -> setFrom('jomerventures.emailer@gmail.com', 'JomerVentures');

  $mail -> addAddress($email);

  $mail -> isHTML(true);
  $mail -> Subject = $subject;
  $mail -> Body = $message;

  $mail -> send();
}

function notifyProcessBookingPaymentPayment($email, $fullname, $reference_number){
  $mail = new PHPMailer(true);

  $subject = "Paypal Payment is Waiting";
  $message = "
    Good Day $fullname. <br><br>
    This is to notify you that your tour with a reference number of <strong>$reference_number</strong> is waiting its Paypal payment. Please check your manage bookings.<br>
    If you have a concern or inquiries, don't be shy to contact JomerVentures. 
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

  $mail -> setFrom('jomerventures.emailer@gmail.com', 'JomerVentures');

  $mail -> addAddress($email);

  $mail -> isHTML(true);
  $mail -> Subject = $subject;
  $mail -> Body = $message;

  $mail -> send();
}
