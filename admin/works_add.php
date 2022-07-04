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

<h2>Add Experience</h2>

<form method="post">

  <label for="title">Title:</label>
  <input type="text" name="title" id="title">

  <br>

  <label for="employment_type">Employment Type:</label>
  <input type="text" name="employment_type" id="employment_type">
    
  <br>
  
  <label for="company_name">Company Name:</label>
  <input type="text" name="company_name" id="company_name">
  
  <br>

  <label for="location">Location:</label>
  <input type="text" name="location" id="location">
    
  <br>

  <label for="description">Description:</label>
  <textarea type="text" name="description" id="description" rows="10"></textarea>

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

  <label for="start_date">Start Date:</label>
  <input type="date" name="start_date" id="start_date">
  
  <br>

  <label for="end_date">End Date:</label>
  <input type="date" name="end_date" id="end_date">
  
  <br>


  <input type="submit" value="Add Experience">

</form>

<p><a href="works.php"><i class="fas fa-arrow-circle-left"></i> Return to Experience List</a></p>


<?php

include('includes/footer.php');

?>