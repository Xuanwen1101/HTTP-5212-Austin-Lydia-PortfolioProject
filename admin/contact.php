<!-- include database.php and functions.php -->
<?php
  include( 'includes/database.php' );
  include( 'includes/config.php' );

  // get the form data
  $email = $_POST['email'];
  $name = $_POST['name'];
  $message = $_POST['message'];

  // insert the data into the database
  $sql = "INSERT INTO messages (email, name, message) VALUES ('$email', '$name', '$message')";

  if (mysqli_query($connect, $sql)) {
    echo "Message sent successfully!";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($connect);
  }
?>