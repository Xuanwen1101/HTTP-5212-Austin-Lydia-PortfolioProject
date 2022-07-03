<!-- include database.php and functions.php -->
<?php
  include( 'includes/database.php' );
  include( 'includes/config.php' );

  // get the form data
  $email = $_POST['email'];
  $name = $_POST['name'];
  $message = $_POST['message'];


  ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    $from = "emailtest@YOURDOMAIN";
    $to = "austin.caron1@gmail.com";
    $subject = "PHP Mail Test script";
    $message = "This is a test to check the PHP Mail functionality";
    $headers = "From:" . $from;
    mail($to,$subject,$message, $headers);
    echo "Test email sent";