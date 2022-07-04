<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( isset( $_GET['delete'] ) )
{
  
  $query = 'DELETE FROM about
    WHERE id = '.$_GET['delete'].'
    LIMIT 1';
  mysqli_query( $connect, $query );
    
  set_message( 'content has been deleted' );
  
  header( 'Location: about.php' );
  die();
  
}

include( 'includes/header.php' );

$query = 'SELECT * FROM about';
$result = mysqli_query( $connect, $query );
?>

<h2>Manage About Content</h2>

<div>
  <!-- loop through the about content -->
  <?php while( $row = mysqli_fetch_assoc( $result ) ) : ?>
    <div>
      <h3><?php echo $row['title']; ?></h3>
      <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['title']; ?>" />
      <p><?php echo $row['content']; ?></p>
      <a href="about_edit.php?id=<?php echo $row['id']; ?>">Edit</a>
      <a href="about.php?delete=<?php echo $row['id']; ?>">Delete</a>
    </div>
  <?php endwhile; ?>
</div>

<p><a href="about_add.php"><i class="fas fa-plus-square"></i> Add About Content</a></p>


<?php

include( 'includes/footer.php' );

?>