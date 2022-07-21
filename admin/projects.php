<?php

include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

if (isset($_GET['delete'])) {

  $query = 'DELETE FROM projects
    WHERE id = ' . $_GET['delete'] . '
    LIMIT 1';
  mysqli_query($connect, $query);

  set_message('Project has been deleted');

  header('Location: projects.php');
  die();
}

include('includes/header.php');

$query = 'SELECT *
  FROM projects
  ORDER BY date DESC';
$result = mysqli_query($connect, $query);

?>

<h2 class="title">Manage Projects</h2>

<div class="objects-container">

  <!-- loop through the projects content -->
  <?php while ($record = mysqli_fetch_assoc($result)) : ?>

    <div class="object-item">


      <?php if ($record['id']) : ?>

        <img src="image.php?type=project&id=<?php echo $record['id']; ?>&width=250&height=250" alt="Image for the Project <?php echo $record['title']?>">

      <?php endif; ?>

      <?php if ($record['title']) : ?>

        <h2 class="object-title"><?= $record['title'] ?></h2>

      <?php endif; ?>


      <div id="object-edit">

        <ul class="edit__list">
          <li class="edit__link"><a href="projects_photo.php?id=<?php echo $record['id']; ?>">Photo</i></a>
          </li>
          <li class="edit__link"><a href="projects_edit.php?id=<?php echo $record['id']; ?>">Edit</i></a>
          </li>
          <li class="delete__link"><a href="projects.php?delete=<?php echo $record['id']; ?>" onclick="javascript:confirm('Are you sure you want to delete this project?');">Delete</i></a></li>
        </ul>
      </div>


    </div>

  <?php endwhile; ?>

</div>

<div class="object__link">
  <a href="projects_add.php"><i class="fas fa-plus-square"></i> New Project +</a>
</div>



<?php

include('includes/footer.php');

?>