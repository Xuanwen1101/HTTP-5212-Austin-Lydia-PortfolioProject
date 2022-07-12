<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( isset( $_GET['delete'] ) )
{
  
  $query = 'DELETE FROM blog
    WHERE id = '.$_GET['delete'].'
    LIMIT 1';
  mysqli_query( $connect, $query );
    
  set_message( 'content has been deleted' );
  
  header( 'Location: blog.php' );
  die();
  
}

include( 'includes/header.php' );

$query = 'SELECT * FROM blog';
$result = mysqli_query( $connect, $query );
?>

<h2>Manage blog Content</h2>

<div>
  <!-- loop through the blog content -->
  <?php while( $row = mysqli_fetch_assoc( $result ) ) : ?>
    <div>
      <h3><?php echo $row['title']; ?></h3>
      <img src="<?php echo $row['photo']; ?>" alt="<?php echo $row['title']; ?>" />
      <p><?php echo $row['content']; ?></p>
      <div>
        <a href="blog_photo.php?id=<?php echo $row['id']; ?>">Photo</a>
        <a href="blog_edit.php?id=<?php echo $row['id']; ?>">Edit</a>
        <a href="blog.php?delete=<?php echo $row['id']; ?>">Delete</a>
      </div>
    </div>
  <?php endwhile; ?>
</div>

<p><a href="blog_add.php"><i class="fas fa-plus-square"></i> Add blog Content</a></p>


<?php

include( 'includes/footer.php' );

?>