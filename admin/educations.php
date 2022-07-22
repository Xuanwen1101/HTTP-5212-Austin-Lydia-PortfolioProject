<?php

include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

if (isset($_GET['delete'])) {

  $query = 'DELETE FROM educations
    WHERE id = ' . $_GET['delete'] . '
    LIMIT 1';
  mysqli_query($connect, $query);

  set_message('Education has been deleted');

  header('Location: educations.php');
  die();
}

include('includes/header.php');

$query = 'SELECT *
  FROM educations
  ORDER BY end_date DESC';
$result = mysqli_query($connect, $query);

?>

<h2 class="title">Manage Educations</h2>


<div class="objects-container">

  <!-- loop through the educations content -->
  <?php while ($record = mysqli_fetch_assoc($result)) : ?>

    <div class="object-item">


      <?php if ($record['id']) : ?>

        <img src="image.php?type=education&id=<?php echo $record['id']; ?>&width=250&height=250" alt="Image for the education <?php echo $record['title']?>">

      <?php endif; ?>

      <?php if ($record['school']) : ?>

        <h3 class="object-title"><?= $record['school'] ?></h3>

      <?php endif; ?>

      <?php if ($record['degree']) : ?>

        <h4 class="secondary-title"><?= $record['degree'] ?></h4>

      <?php endif; ?>


      <div id="object-edit">

        <ul class="edit__list">
          <li class="edit__link"><a href="educations_photo.php?id=<?php echo $record['id']; ?>">Photo</i></a>
          </li>
          <li class="edit__link"><a href="educations_edit.php?id=<?php echo $record['id']; ?>">Edit</i></a>
          </li>
          <li class="delete__link"><a href="educations.php?delete=<?php echo $record['id']; ?>" onclick="javascript:confirm('Are you sure you want to delete this education?');">Delete</i></a></li>
        </ul>
      </div>


    </div>

  <?php endwhile; ?>

</div>

<div class="object__link">
  <a href="educations_add.php"><i class="fas fa-plus-square"></i> New Education +</a>
</div>



<?php

include('includes/footer.php');

?>