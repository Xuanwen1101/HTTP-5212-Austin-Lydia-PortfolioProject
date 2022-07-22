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

    $query = "INSERT INTO blogs 
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

<h2 class="title">Add blog Content</h2>

<!-- form for uploading blog content. containing title and content -->
<div class="objects-container">
  <form action="blog_add.php" class="form" method="post" enctype="multipart/form-data">
    <div class="form__field">
      <label for="title" class="form__label">Title:</label>
      <input type="text" name="title" id="title" class="form__input" />
    </div>
    <div class="form__field">
      <label for="content" class="form__label">Content:</label>
      <textarea name="content" id="content" class="form__textarea" rows="10" cols="50"></textarea>
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
      <input type="submit" name="submit" value="Add blog Content" class="form__button"/>
  </form>
</div>

<div class="object__link">
  <a href="blog.php"><i class="fas fa-arrow-circle-left"></i> Return to blog Content</a>
</div>


<?php

include( 'includes/footer.php' );

?>