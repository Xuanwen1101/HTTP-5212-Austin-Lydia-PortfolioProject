<?php

include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

if (!isset($_GET['id'])) {

  header('Location: contents.php');
  die();
}

if (isset($_POST['title'])) {

  if ($_POST['title']) {

    $query = 'UPDATE contents SET
      title = "' . mysqli_real_escape_string($connect, $_POST['title']) . '",
      content = "' . mysqli_real_escape_string($connect, $_POST['content']) . '"
      WHERE id = ' . $_GET['id'] . '
      LIMIT 1';
    mysqli_query($connect, $query);

    set_message('Content has been updated');
  }

  header('Location: contents.php');
  die();
}


if (isset($_GET['id'])) {

  $query = 'SELECT *
    FROM contents
    WHERE id = ' . $_GET['id'] . '
    LIMIT 1';
  $result = mysqli_query($connect, $query);

  if (!mysqli_num_rows($result)) {

    header('Location: contents.php');
    die();
  }

  $record = mysqli_fetch_assoc($result);
}

include('includes/header.php');

?>

<h2 class="title">Edit Content</h2>

<div class="objects-container">
  <form method="post">

    <label class="form__label" for="title">Title</label>
    <input class="form__input" type="text" name="title" id="title" value="<?php echo htmlentities($record['title']); ?>">

    <br>

    <label class="form__label" for="content">Content</label>
    <textarea class="form__textarea" type="text" name="content" id="content" rows="5"><?php echo htmlentities($record['content']); ?></textarea>

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


    <input class="form__button" type="submit" value="Edit Content">

  </form>

</div>

<div class="add">
  <a href="contents.php"><i class="fas fa-arrow-circle-left"></i> Return to Text Content List</a>
</div>


<?php

include('includes/footer.php');

?>