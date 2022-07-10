<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

// Add new blog content using data from form
if ( isset( $_POST['submit'] ) ) {
  if (!empty( $_POST['content'] ) ) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $query = "INSERT INTO blog 
      ( title, photo, content )
      VALUES
      ( '$title', NULL, '$content' )";
      
    $result = mysqli_query( $connect, $query );
    if ( $result ) {
      set_message( 'blog content has been added' );
      header( 'Location: blog.php' );
    } else {
      echo '<div class="alert alert-danger">Error adding blog content!</div>';
    }
  } else {
    echo '<div class="alert alert-danger">Please fill in the Content field!</div>';
  }
  // Redirect to blog page
  die();
}

include( 'includes/header.php' );

?>

<h2>Add blog Content</h2>

<!-- form for uploading blog content. containing title and content -->
<form action="blog_add.php" method="post" enctype="multipart/form-data">
  <div>
    <label for="title">Title:</label>
    <input type="text" name="title" id="title" />
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
    <input type="submit" name="submit" value="Add blog Content" />
  </div>
</form>

<p><a href="blog.php"><i class="fas fa-arrow-circle-left"></i> Return to blog Content</a></p>


<?php

include( 'includes/footer.php' );

?>