<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

// Add new skill content using data from form
if ( isset( $_POST['submit'] ) ) {
  if (!empty( $_POST['title'] ) ) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    // if no icon, set to null
    $query = "INSERT INTO skills 
      ( title, icon, content )
      VALUES
      ( '$title', NULL, '$content' )";
      
    $result = mysqli_query( $connect, $query );
    if ( $result ) {
      set_message( 'Skills have been added' );
      header( 'Location: skills.php' );
    } else {
      echo '<div class="alert alert-danger">Error adding new skill!</div>';
    }
  } else {
    echo '<div class="alert alert-danger">Please fill in the Content field!</div>';
  }
  // Redirect to skills page
  die();
}

include( 'includes/header.php' );

?>

<h2>Add New Skill</h2>

<!-- form for uploading skills. containing title and content -->
<form action="skills_add.php" class="form" method="post" enctype="multipart/form-data">
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
    <input type="submit" class="form__submit" name="submit" value="Add New Skill" />
</form>

<p><a href="skills.php"><i class="fas fa-arrow-circle-left"></i> Return to Skills</a></p>


<?php

include( 'includes/footer.php' );

?>