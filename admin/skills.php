<?php

include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

if (isset($_GET['delete'])) {

  $query = 'DELETE FROM skills
    WHERE id = ' . $_GET['delete'] . '
    LIMIT 1';
  mysqli_query($connect, $query);

  set_message('Skill has been deleted');

  header('Location: skills.php');
  die();
}

include('includes/header.php');

$query = 'SELECT * FROM skills';
$result = mysqli_query($connect, $query);
?>

<h2 class="title">Manage Skills Content</h2>

<div class="objects-container">
  <!-- loop through the skills content -->
  <?php while ($record = mysqli_fetch_assoc($result)) : ?>

    <div class="object-item">


      <?php if ($record['id']) : ?>

        <img src="image.php?type=skill&id=<?php echo $record['id']; ?>&width=250&height=250">

      <?php endif; ?>

      <?php if ($record['title']) : ?>

        <h2 class="object-title"><?= $record['title'] ?></h2>

      <?php endif; ?>


      <div id="object-edit">

        <ul class="edit__list">
          <li class="edit__link"><a href="skills_photo.php?id=<?php echo $record['id']; ?>">Photo</i></a>
          </li>
          <li class="edit__link"><a href="skills_edit.php?id=<?php echo $record['id']; ?>">Edit</i></a>
          </li>
          <li class="delete__link"><a href="skills.php?delete=<?php echo $record['id']; ?>" onclick="javascript:confirm('Are you sure you want to delete this skill?');">Delete</i></a></li>
        </ul>
      </div>


    </div>
  <?php endwhile; ?>
</div>

<div class="object__link">
  <a href="skills_add.php"><i class="fas fa-plus-square"></i> New skills +</a>
</div>


<?php

include('includes/footer.php');

?>