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

  if( isset( $_POST['submit'] ) ) {
    if( !empty( $_POST['content'] ) ) {
      $title = $_POST['title'];
      $content = $_POST['content'];

      $query = "UPDATE blog 
        SET title = '$title',
        content = '$content'
        WHERE id = ".$_GET['id']."
        LIMIT 1";
      
      $result = mysqli_query( $connect, $query );
      if( $result ) {
        set_message( 'blog content has been updated' );
        header( 'Location: blog.php' );
      } else {
        set_message("Error updating blog content!");
      }
    } else {
      set_message("Please fill in the Content field!");
    }
    // Redirect to blog page
    die();
  }

  if( isset($_GET['id'] ) ) {
    // Get the blog content from the database
    $query = 'SELECT *
      FROM blog
      WHERE id = '.$_GET['id'].'
      LIMIT 1';

    $result = mysqli_query( $connect, $query );

    $record = mysqli_fetch_assoc( $result );
  }

  include('includes/header.php');

  ?>

  <h2>Edit blog Content</h2>
  <form action="blog_edit.php?id=<?php echo $_GET['id']; ?>" method="post" enctype="multipart/form-data">
    <div>
      <label for="title">Title:</label>
      <input type="text" name="title" id="title" value="<?php echo $record['title']; ?>" />
    </div>
    <div>
      <img src="<?php echo $record['photo'] ?>" alt="">
      <label for="photo">photo:</label>
      <input type="file" name="photo" id="photo"/>
    </div>
    <div>
      <label for="content">Content:</label>
      <textarea name="content" id="content" cols="30" rows="10"><?php echo $record['content']; ?></textarea>
      <script>
        ClassicEditor
        .create( document.querySelector( '#content' ) )
        .then( editor => {
            console.log( editor );
        } )
        .catch( error => {
            console.error( error );
        } );
      </script>
    </div>
    <div>
      <input type="submit" name="submit" value="Update" />
    </div>
  </form>
  <?php
  include('includes/footer.php');
  ?>