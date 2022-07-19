<?php
  include('includes/database.php');
  include('includes/config.php');
  include('includes/functions.php');

  secure();

  if( !isset( $_GET['id'] ) )
  {
    
    header( 'Location: skills.php' );
    die();
  }

  if( isset( $_POST['submit'] ) ) {
    if( !empty( $_POST['content'] ) ) {
      $title = $_POST['title'];
      $photo = $_FILES['photo'];
      $content = $_POST['content'];

      // set the photo type
      $type = $photo['type'];
      $type = explode( '/', $type );
      $type = $type[1];

      // if no photo, update everything else
      if( $photo['size'] == 0 ) {
        $query = "UPDATE skills 
        SET title = '$title',
        content = '$content'
        WHERE id = ".$_GET['id']."
        LIMIT 1";
      } else {
        $query = "UPDATE skills 
        SET title = '$title',
        photo = 'data:photo/$type;base64,".base64_encode( file_get_contents( $photo['tmp_name'] ) )."',
        content = '$content'
        WHERE id = ".$_GET['id']."
        LIMIT 1";
      }
      
      $result = mysqli_query( $connect, $query );
      if( $result ) {
        set_message( 'skills content has been updated' );
        header( 'Location: skills.php' );
      } else {
        set_message("Error updating skills content!");
      }
    } else {
      set_message("Please fill in the Content field!");
    }
    // Redirect to skills page
    die();
  }

  if( isset($_GET['id'] ) ) {
    // Get the skills content from the database
    $query = 'SELECT *
      FROM skills
      WHERE id = '.$_GET['id'].'
      LIMIT 1';

    $result = mysqli_query( $connect, $query );

    $record = mysqli_fetch_assoc( $result );
  }

  include('includes/header.php');

  ?>

  <h2 class="title">Edit skills Content</h2>
  <div class="objects-container">
    <form action="skills_edit.php?id=<?php echo $_GET['id']; ?>" method="post" enctype="multipart/form-data" class="form">
      <div class="form__field">
        <label for="title" class="form__label">Title:</label>
        <input type="text" class="form__input" name="title" id="title" value="<?php echo $record['title']; ?>" />
      </div>
      <div>
        <label for="content" class="form__label">Content:</label>
        <textarea name="content" class="form__textarea" id="content" cols="30" rows="10"><?php echo $record['content']; ?></textarea>
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
        <input type="submit" class="form__button" name="submit" value="Update" />
    </form>
  </div>

<div class="object__link">
  <a href="skills.php"><i class="fas fa-arrow-circle-left"></i> Return to Skills List </a>
</div>

  <?php
  include('includes/footer.php');
  ?>