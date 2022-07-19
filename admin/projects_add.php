<?php

include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

if (isset($_POST['title'])) {

  if ($_POST['title'] and $_POST['content']) {

    $query = 'INSERT INTO projects (
        title,
        content,
        date,
        type,
        url
      ) VALUES (
         "' . mysqli_real_escape_string($connect, $_POST['title']) . '",
         "' . mysqli_real_escape_string($connect, $_POST['content']) . '",
         "' . mysqli_real_escape_string($connect, $_POST['date']) . '",
         "' . mysqli_real_escape_string($connect, $_POST['type']) . '",
         "' . mysqli_real_escape_string($connect, $_POST['url']) . '"
      )';
    mysqli_query($connect, $query);

    set_message('Project has been added');
  }

  header('Location: projects.php');
  die();
}

include('includes/header.php');

?>

<h2 class="title">Add Project</h2>

<div class="objects-container">
  <form method="post" class="form">
    <div class="form__field">
      <label class="form__label" for="title">Title:</label>
      <input class="form__input" type="text" name="title" id="title">
    </div>
    <div class="form__field">
      <label class="form__label" for="url">URL:</label>
      <input class="form__input" type="text" name="url" id="url">
    </div>
    <div class="form__field">
      <label class="form__label" for="date">Date:</label>
      <input class="form__input" type="date" name="date" id="date">
    </div>

    <div class="form__field">
      <label class="form__label" for="type">Type:</label>
      <select class="form__select" name="type" id="type">
        <?php
        $values = array('Website', 'Graphic Design');
        foreach ($values as $key => $value) {
          echo '<option value="' . $value . '"';
          echo '>' . $value . '</option>';
        }
        ?>
      </select>
    </div>
    <div class="form__field">
      <label class="form__label" for="content">Content:</label>
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
    <input class="form__button" type="submit" value="Add Project">
  </form>
</div>

<div class="object__link">
  <a href="projects.php"><i class="fas fa-arrow-circle-left"></i> Return to Project List</a>
</div>


<?php

include('includes/footer.php');

?>