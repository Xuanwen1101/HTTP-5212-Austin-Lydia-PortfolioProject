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

<h2>Add Content</h2>

<form method="post">

  <label for="title">Title:</label>
  <input type="text" name="title" id="title">

  <br>

  <label for="content">Content:</label>
  <textarea type="text" name="content" id="content" rows="10"></textarea>

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

  <br>


  <input type="submit" value="Add Content">

</form>

<p><a href="contents.php"><i class="fas fa-arrow-circle-left"></i> Return to Text Content List</a></p>


<?php

include('includes/footer.php');

?>