<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

// Add new about content using data from form
if ( isset( $_POST['submit'] ) ) {
  if (!empty( $_POST['content'] ) ) {
    $title = $_POST['title'];
    $image = $_FILES['image'];
    $content = $_POST['content'];

    // set the image type
    $type = $image['type'];
    $type = explode( '/', $type );
    $type = $type[1];

    // if no image, set to null
    if ( $image['size'] == 0 ) {
      $query = "INSERT INTO about 
      ( title, image, content )
      VALUES
      ( '$title', NULL, '$content' )";
    } else {
      $query = "INSERT INTO about 
      ( title, image, content )
      VALUES
      ( '$title', 'data:image/$type;base64,".base64_encode( file_get_contents( $image['tmp_name'] ) )."', '$content' )";
    }
      
    $result = mysqli_query( $connect, $query );
    if ( $result ) {
      set_message( 'About content has been added' );
      header( 'Location: about.php' );
    } else {
      echo '<div class="alert alert-danger">Error adding about content!</div>';
    }
  } else {
    echo '<div class="alert alert-danger">Please fill in the Content field!</div>';
  }
  // Redirect to about page
  die();
}

include( 'includes/header.php' );

?>

<h2>Add About Content</h2>

<!-- form for uploading about content. containing title and content -->
<form action="about_add.php" method="post" enctype="multipart/form-data">
  <div>
    <label for="title">Title:</label>
    <input type="text" name="title" id="title" />
  </div>
  <div>
    <label for="image">Image:</label>
    <input type="file" name="image" id="image" />
  </div>
  <div>
    <label for="content">Content:</label>
    <textarea name="content" id="content" rows="10" cols="50"></textarea>
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
    <input type="submit" name="submit" value="Add About Content" />
  </div>
</form>

<p><a href="about.php"><i class="fas fa-arrow-circle-left"></i> Return to About Content</a></p>


<?php

include( 'includes/footer.php' );

?>