<?php
include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

if( !isset( $_GET['id'] ) )
{
  
  header( 'Location: blog.php' );
  die();
  
}

if( isset( $_POST['title'] ) )
{
  
  if( $_POST['title'] and $_POST['content'] )
  {
    
    $query = 'UPDATE blogs SET
      title = "'.mysqli_real_escape_string( $connect, $_POST['title'] ).'",
      content = "'.mysqli_real_escape_string( $connect, $_POST['content'] ).'"
      WHERE id = '.$_GET['id'].'
      LIMIT 1';
    mysqli_query( $connect, $query );
    
    set_message( 'blog has been updated' );
    
  }

  header( 'Location: blog.php' );
  die();
  
}


if( isset( $_GET['id'] ) )
{
  
  $query = 'SELECT *
    FROM blogs
    WHERE id = '.$_GET['id'].'
    LIMIT 1';
  $result = mysqli_query( $connect, $query );
  
  if( !mysqli_num_rows( $result ) )
  {
    
    header( 'Location: blog.php' );
    die();
    
  }
  
  $record = mysqli_fetch_assoc( $result );
  
}
include('includes/header.php');

?>

<h2 class="title">Edit blog Content</h2>
<div class="objects-container">
  <form action="blog_edit.php?id=<?php echo $_GET['id']; ?>" method="post" enctype="multipart/form-data" class="form">
    <div class="form__field">
      <label for="title" class="form__label">Title:</label>
      <input type="text" class="form__input" name="title" id="title" value="<?php echo $record['title']; ?>" />
    </div>
    <div class="form__field">
      <label for="content" class="form__label">Content:</label>
      <textarea name="content" class="form__textarea" id="content" cols="30" rows="10"><?php echo $record['content']; ?></textarea>
      <script>
        ClassicEditor
          .create(document.querySelector('#content'))
          .then(editor => {
            console.log(editor);
          })
          .catch(error => {
            console.error(error);
          });
      </script>
    </div>
    <input type="submit" class="form__button" name="submit" value="Update" />
  </form>
</div>

<div class="object__link">
  <a href="blog.php"><i class="fas fa-arrow-circle-left"></i> Return to blog Content</a>
</div>

<?php
include('includes/footer.php');
?>