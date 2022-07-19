<?php

include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

if (!isset($_GET['id'])) {

  header('Location: educations.php');
  die();
}

if (isset($_POST['school'])) {

  if ($_POST['school']) {

    $query = 'UPDATE educations SET
      school = "' . mysqli_real_escape_string($connect, $_POST['school']) . '",
      school_url = "' . mysqli_real_escape_string($connect, $_POST['school_url']) . '",
      major = "' . mysqli_real_escape_string($connect, $_POST['major']) . '",
      major_url = "' . mysqli_real_escape_string($connect, $_POST['major_url']) . '",
      degree = "' . mysqli_real_escape_string($connect, $_POST['degree']) . '",
      start_date = "' . mysqli_real_escape_string($connect, $_POST['start_date']) . '",
      end_date = "' . mysqli_real_escape_string($connect, $_POST['end_date']) . '"
      WHERE id = ' . $_GET['id'] . '
      LIMIT 1';
    mysqli_query($connect, $query);

    set_message('Education has been updated');
  }

  header('Location: educations.php');
  die();
}


if (isset($_GET['id'])) {

  $query = 'SELECT *
    FROM educations
    WHERE id = ' . $_GET['id'] . '
    LIMIT 1';
  $result = mysqli_query($connect, $query);

  if (!mysqli_num_rows($result)) {

    header('Location: educations.php');
    die();
  }

  $record = mysqli_fetch_assoc($result);
}

include('includes/header.php');

?>

<h2 class="title">Edit Education</h2>

<div class="objects-container">
  <form method="post" class="form">

    <div class="form__field">
      <label class="form__label" for="school">School:</label>
      <input class="form__input" type="text" name="school" id="school" value="<?php echo htmlentities($record['school']); ?>">
    </div>
    <div class="form__field">
      <label class="form__label" for="school_url">School URL:</label>
      <input class="form__input" type="text" name="school_url" id="school_url" value="<?php echo htmlentities($record['school_url']); ?>">
    </div>
    <div class="form__field">
      <label class="form__label" for="major">Major:</label>
      <input class="form__input" type="text" name="major" id="major" value="<?php echo htmlentities($record['major']); ?>">
    </div>
    <div class="form__field">
      <label class="form__label" for="major_url">Major URL:</label>
      <input class="form__input" type="text" name="major_url" id="major_url" value="<?php echo htmlentities($record['major_url']); ?>">
    </div>
    <div class="form__field">
      <label class="form__label" for="degree">Degree:</label>
      <input class="form__input" type="text" name="degree" id="degree" value="<?php echo htmlentities($record['degree']); ?>">
    </div>
    <div class="form__field">
      <label class="form__label" for="start_date">Start Date:</label>
      <input class="form__input" type="date" name="start_date" id="start_date" value="<?php echo htmlentities($record['start_date']); ?>">
    </div>
    <div class="form__field">
      <label class="form__label" for="end_date">End Date:</label>
      <input class="form__input" type="date" name="end_date" id="end_date" value="<?php echo htmlentities($record['end_date']); ?>">
    </div>
    <input class="form__button" type="submit" value="Edit Education">
  </form>
</div>

<div class="object__link">
  <a href="educations.php"><i class="fas fa-arrow-circle-left"></i> Return to Education List</a>
</div>


<?php

include('includes/footer.php');

?>