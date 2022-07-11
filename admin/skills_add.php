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
<form action="skills_add.php" method="post" enctype="multipart/form-data">
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
    <input type="submit" name="submit" value="Add New Skill" />
  </div>
</form>

<p><a href="skills.php"><i class="fas fa-arrow-circle-left"></i> Return to Skills</a></p>


<?php

include( 'includes/footer.php' );

?>