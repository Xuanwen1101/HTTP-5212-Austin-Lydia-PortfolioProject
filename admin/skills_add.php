<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );


// Add new skill content using data from form
secure();

if (isset($_POST['title'])) {

  if ($_POST['title']) {

    $query = 'INSERT INTO skills (
        title,
        content
      ) VALUES (
         "' . mysqli_real_escape_string($connect, $_POST['title']) . '",
         "' . mysqli_real_escape_string($connect, $_POST['content']) . '"
      )';
    mysqli_query($connect, $query);

    set_message('Skills has been added');
  }

  header('Location: skills.php');
  die();
}

include( 'includes/header.php' );

?>

<h2 class="title">Add New Skill</h2>

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
    <input type="submit" class="form__button" name="submit" value="Add New Skill" />
</form>

<div class="object__link">
  <a href="skills.php"><i class="fas fa-arrow-circle-left"></i> Return to Skills List </a>
</div>


<?php

include( 'includes/footer.php' );

?>