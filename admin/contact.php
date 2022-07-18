<!-- include database.php and functions.php -->
<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  require 'includes/PHPMailer-master/src/PHPMailer.php';
  require 'includes/PHPMailer-master/src/Exception.php';
  require 'includes/PHPMailer-master/src/SMTP.php';

  include( 'includes/database.php' );

  // get the form data
  $email = $_POST['email'];
  $name = $_POST['name'];
  $message = $_POST['message'];

  // if the form has content insert into database, else display error message
  if(!empty($email) && !empty($name) && !empty($message)) {
    $sql = "INSERT INTO contact (email, name, message) VALUES ('$email', '$name', '$message')";
    $result = mysqli_query($conn, $sql);

    // email variables
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'austin.caron1@gmail.com';
    $mail->Password = 'dqanfwyztrlbkfjs';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->setFrom($email, $name);
    $mail->addAddress($email, $name);
    $mail->isHTML(true);
    $mail->Subject = $name . ' has sent you a message';
    $mail->Body    = $message;
    $mail->AltBody = $message;
    $mail->send();

    header('Location: ../contact.php');
  }
  else {
    echo 'Please fill in all fields';
    // delayed return to ../contact.php
    header( "Refresh:5; url=../contact.php", true, 303);
  }
?>