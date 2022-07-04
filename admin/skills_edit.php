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
      $icon = $_FILES['icon'];
      $content = $_POST['content'];

      // set the icon type
      $type = $icon['type'];
      $type = explode( '/', $type );
      $type = $type[1];

      // if no icon, update everything else
      if( $icon['size'] == 0 ) {
        $query = "UPDATE skills 
        SET title = '$title',
        content = '$content'
        WHERE id = ".$_GET['id']."
        LIMIT 1";
      } else {
        $query = "UPDATE skills 
        SET title = '$title',
        icon = 'data:icon/$type;base64,".base64_encode( file_get_contents( $icon['tmp_name'] ) )."',
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

  <h2>Edit skills Content</h2>
  <form action="skills_edit.php?id=<?php echo $_GET['id']; ?>" method="post" enctype="multipart/form-data">
    <div>
      <label for="title">Title:</label>
      <input type="text" name="title" id="title" value="<?php echo $record['title']; ?>" />
    </div>
    <div>
      <img src="<?php echo $record['icon'] ?>" alt="">
      <label for="icon">icon:</label>
      <input type="file" name="icon" id="icon"/>
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