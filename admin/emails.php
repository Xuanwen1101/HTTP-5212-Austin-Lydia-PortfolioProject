<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( isset( $_GET['delete'] ) )
{
  
  $query = 'DELETE FROM emails
    WHERE id = '.$_GET['delete'].'
    LIMIT 1';
  mysqli_query( $connect, $query );
    
  set_message( 'content has been deleted' );
  
  header( 'Location: skills.php' );
  die();
  
}

include( 'includes/header.php' );

$query = 'SELECT * FROM emails';
$result = mysqli_query( $connect, $query );
?>

<section class="contact">
  <h2 class="title">Your Emails</h2>
  <div class="contact__wrapper">
    <!-- loop through the skills content -->
    <?php while( $row = mysqli_fetch_assoc( $result ) ) : ?>
      <div class="contact__card">
        <div class="contact__text">
          <h3><?php echo $row['name']; ?></h3>
          <h3><?php echo $row['email']; ?></h3>
          <p><?php echo $row['message']; ?></p>
        </div>
        <a href="contact.php?delete=<?php echo $row['id']; ?>">Delete</a>
      </div>
    <?php endwhile; ?>
  </div>
</section>


<?php

include( 'includes/footer.php' );

?>