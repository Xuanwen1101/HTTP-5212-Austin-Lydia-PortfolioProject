<!-- include database.php and functions.php -->
<?php
  include( 'includes/database.php' );
  include( 'includes/config.php' );

  // get the form data
  $email = $_POST['email'];
  $name = $_POST['name'];
  $message = $_POST['message'];


  // log the email
  echo $email;
  
    $record = mysqli_fetch_assoc( $result );
    
    // send an email to the email inserted in the form
    $to = $email;
    $subject = 'Test Email';
    $message = $name . '<br> Your message: ' . $message;
    $headers = 'From: ' . $record['email'];

    $headers .= "MIME-Version: 1.0\n";
    $headers .= "Content-type: text/html; charset=us-ascii\n"; 

    mail( $to, $subject, $message, $headers );