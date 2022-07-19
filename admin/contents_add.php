<?php

include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

if (isset($_POST['title'])) {

  if ($_POST['title']) {

    $query = 'INSERT INTO contents (
        title,
        content
      ) VALUES (
         "' . mysqli_real_escape_string($connect, $_POST['title']) . '",
         "' . mysqli_real_escape_string($connect, $_POST['content']) . '"
      )';
    mysqli_query($connect, $query);

    set_message('Content has been added');
  }

  header('Location: contents.php');
  die();
}

include('includes/header.php');

?>

<h2 class="title">Add Content</h2>

<div class="objects-container">
  <form method="post" class="form">
    <div class="form__field">
      <label class="form__label" for="title">Title</label>
      <input class="form__input" type="text" name="title" id="title">
    </div>
    <div class="form__field">
      <label class="form__label" for="content">Content</label>
      <textarea class="form__textarea" type="text" name="content" id="content" rows="10"></textarea>
      <script>
        ClassicEditor
          .create(document.querySelector('#content'))
          .then(editor => {
            console.log(editor);
          })
          .catch(error => {
            console.error(error);
          });
      </script>
    </div>
    <input class="form__button" type="submit" value="Add Content">
  </form>

</div>

<div class="add">
  <a href="contents.php"><i class="fas fa-arrow-circle-left"></i> Return to Text Content List</a>
</div>


<?php

include('includes/footer.php');

?>