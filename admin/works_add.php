<?php

include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

if (isset($_POST['title'])) {

  if ($_POST['title']) {

    $query = 'INSERT INTO works (
        title,
        employment_type,
        company_name,
        location,
        description,
        start_date,
        end_date
      ) VALUES (
         "' . mysqli_real_escape_string($connect, $_POST['title']) . '",
         "' . mysqli_real_escape_string($connect, $_POST['employment_type']) . '",
         "' . mysqli_real_escape_string($connect, $_POST['company_name']) . '",
         "' . mysqli_real_escape_string($connect, $_POST['location']) . '",
         "' . mysqli_real_escape_string($connect, $_POST['description']) . '",
         "' . mysqli_real_escape_string($connect, $_POST['start_date']) . '",
         "' . mysqli_real_escape_string($connect, $_POST['end_date']) . '"
      )';
    mysqli_query($connect, $query);

    set_message('Experience has been added');
  }

  header('Location: works.php');
  die();
}

include('includes/header.php');

?>

<h2 class="title">Add Experience</h2>

<div class="objects-container">

  <form method="post">

    <label class="form__label" for="title">Title:</label>
    <input class="form__input" type="text" name="title" id="title">

    <br>

    <label class="form__label" for="employment_type">Employment Type:</label>
    <input class="form__input" type="text" name="employment_type" id="employment_type">

    <br>

    <label class="form__label" for="company_name">Company Name:</label>
    <input class="form__input" type="text" name="company_name" id="company_name">

    <br>

    <label class="form__label" for="location">Location:</label>
    <input class="form__input" type="text" name="location" id="location">

    <br>

    <label class="form__label" for="description">Description:</label>
    <textarea class="form__textarea" type="text" name="description" id="description" rows="10"></textarea>

    <script>
      ClassicEditor
        .create(document.querySelector('#description'))
        .then(editor => {
          console.log(editor);
        })
        .catch(error => {
          console.error(error);
        });
    </script>

    <br>

    <label class="form__label" for="start_date">Start Date:</label>
    <input class="form__input" type="date" name="start_date" id="start_date">

    <br>

    <label class="form__label" for="end_date">End Date:</label>
    <input class="form__input" type="date" name="end_date" id="end_date">

    <br>


    <input class="form__button" type="submit" value="Add Experience">

  </form>
</div>

<div class="add">
  <a href="works.php"><i class="fas fa-arrow-circle-left"></i> Return to Experience List</a>
</div>


<?php

include('includes/footer.php');

?>