<?php

include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

if (!isset($_GET['id'])) {

  header('Location: works.php');
  die();
}

if (isset($_FILES['photo'])) {

  if (isset($_FILES['photo'])) {

    if ($_FILES['photo']['error'] == 0) {

      switch ($_FILES['photo']['type']) {
        case 'image/png':
          $type = 'png';
          break;
        case 'image/jpg':
        case 'image/jpeg':
          $type = 'jpeg';
          break;
        case 'image/gif':
          $type = 'gif';
          break;
      }

      $query = 'UPDATE works SET
        photo = "data:image/' . $type . ';base64,' . base64_encode(file_get_contents($_FILES['photo']['tmp_name'])) . '"
        WHERE id = ' . $_GET['id'] . '
        LIMIT 1';
      mysqli_query($connect, $query);
    }
  }

  set_message('works photo has been updated');

  header('Location: works.php');
  die();
}


if (isset($_GET['id'])) {

  if (isset($_GET['delete'])) {

    $query = 'UPDATE works SET
      photo = ""
      WHERE id = ' . $_GET['id'] . '
      LIMIT 1';
    $result = mysqli_query($connect, $query);

    set_message('works photo has been deleted');

    header('Location: works.php');
    die();
  }

  $query = 'SELECT *
    FROM works
    WHERE id = ' . $_GET['id'] . '
    LIMIT 1';
  $result = mysqli_query($connect, $query);

  if (!mysqli_num_rows($result)) {

    header('Location: works.php');
    die();
  }

  $record = mysqli_fetch_assoc($result);
}

include('includes/header.php');

include 'includes/wideimage/WideImage.php';

?>

<h2 class="title">Edit Photos</h2>

<!-- <img src="" id="imgPreview" alt=""> -->

<p class="note-text">
  Note: For best results, photos should be approximately 800 x 800 pixels.
</p>

<?php if ($record['photo']) : ?>

  <?php
  // echo $record['photo'];

  $data = base64_decode(explode(',', $record['photo'])[1]);
  // use WideImage to load the image from the data
  $image = WideImage::loadFromString($data);
  // resize the image to a square of 200x200 pixels
  $image = $image->resize(200, 200, 'fill');

  ?>

  <div class="objects-container">
    <img src="data:image/jpg;base64,<?php echo base64_encode($data); ?>" width="200" height="200">
  </div>
  <div class="delete-photo">
    <a href="works_photo.php?id=<?php echo $_GET['id']; ?>&delete"><i class="fas fa-trash-alt"></i> Delete this Photo</a>
  </div>

<?php endif; ?>

<div class="objects-container">
<form method="post" enctype="multipart/form-data" class="form">
  <div class="form__field">
    <label class="form__label" for="photo">Photo:</label>
    <input class="form__input" type="file" name="photo" id="photo">
  </div>
  <input class="form__button" type="submit" value="Save Photo">
</form>
</div>

<div class="add">
  <a href="works.php"><i class="fas fa-arrow-circle-left"></i> Return to works List</a>
</div>


<?php

include('includes/footer.php');

?>

<script>
  let image = document.querySelector("#photo")
  image.onchange = evt => {
    const [file] = image.files;
    if (file) {
      imgPreview.src = URL.createObjectURL(file);
    }
  }
</script>