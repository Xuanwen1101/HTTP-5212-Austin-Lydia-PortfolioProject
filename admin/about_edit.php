<?php
  include('includes/database.php');
  include('includes/config.php');
  include('includes/functions.php');

  secure();

  if( !isset( $_GET['id'] ) )
  {
    
    header( 'Location: about.php' );
    die();
  }

  if( isset( $_POST['submit'] ) ) {
    if( !empty( $_POST['content'] ) ) {
      $title = $_POST['title'];
      $image = $_FILES['image'];
      $content = $_POST['content'];

      // set the image type
      $type = $image['type'];
      $type = explode( '/', $type );
      $type = $type[1];

      // if no image, update everything else
      if( $image['size'] == 0 ) {
        $query = "UPDATE about 
        SET title = '$title',
        content = '$content'
        WHERE id = ".$_GET['id']."
        LIMIT 1";
      } else {
        $query = "UPDATE about 
        SET title = '$title',
        image = 'data:image/$type;base64,".base64_encode( file_get_contents( $image['tmp_name'] ) )."',
        content = '$content'
        WHERE id = ".$_GET['id']."
        LIMIT 1";
      }
      
      $result = mysqli_query( $connect, $query );
      if( $result ) {
        set_message( 'About content has been updated' );
        header( 'Location: about.php' );
      } else {
        set_message("Error updating about content!");
      }
    } else {
      set_message("Please fill in the Content field!");
    }
    // Redirect to about page
    die();
  }

  if( isset($_GET['id'] ) ) {
    // Get the about content from the database
    $query = 'SELECT *
      FROM about
      WHERE id = '.$_GET['id'].'
      LIMIT 1';

    $result = mysqli_query( $connect, $query );

    $record = mysqli_fetch_assoc( $result );
  }

  include('includes/header.php');

  ?>

  <h2>Edit About Content</h2>
  <form action="about_edit.php?id=<?php echo $_GET['id']; ?>" method="post" enctype="multipart/form-data">
    <div>
      <label for="title">Title:</label>
      <input type="text" name="title" id="title" value="<?php echo $record['title']; ?>" />
    </div>
    <div>
      <img src="<?php echo $record['image'] ?>" alt="">
      <label for="image">Image:</label>
      <input type="file" name="image" id="image"/>
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