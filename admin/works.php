<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( isset( $_GET['delete'] ) )
{
  
  $query = 'DELETE FROM works
    WHERE id = '.$_GET['delete'].'
    LIMIT 1';
  mysqli_query( $connect, $query );
    
  set_message( 'Experience has been deleted' );
  
  header( 'Location: works.php' );
  die();
  
}

include( 'includes/header.php' );

$query = 'SELECT *
  FROM works
  ORDER BY end_date DESC';
$result = mysqli_query( $connect, $query );

?>

<h2>Manage Work Experience</h2>

<h2 class="title">Manage Work Experience</h2>


<div class="objects-container">

  <!-- use while loop to get each row data from the selected table -->
  <?php while ($record = mysqli_fetch_assoc($result)) : ?>

    <div class="object-item">


      <?php if ($record['id']) : ?>

        <img src="image.php?type=work&id=<?php echo $record['id']; ?>&width=250&height=250">

      <?php endif; ?>

      <?php if ($record['company_name']) : ?>

        <h2 class="object-title"><?= $record['company_name'] ?></h2>

      <?php endif; ?>

      <?php if ($record['title']) : ?>

        <h2 class="secondary-title"><?= $record['title'] ?></h2>

      <?php endif; ?>


      <div id="object-edit">

        <ul class="edit__list">
          <li class="edit__link"><a href="works_photo.php?id=<?php echo $record['id']; ?>">Photo</i></a>
          </li>
          <li class="edit__link"><a href="works_edit.php?id=<?php echo $record['id']; ?>">Edit</i></a>
          </li>
          <li class="delete__link"><a href="works.php?delete=<?php echo $record['id']; ?>" onclick="javascript:confirm('Are you sure you want to delete this work?');">Delete</i></a></li>
        </ul>
      </div>


    </div>

  <?php endwhile; ?>

</div>

<div class="add">
  <a href="works_add.php"><i class="fas fa-plus-square"></i> New Experience +</a>
</div>


<?php

include( 'includes/footer.php' );

?>