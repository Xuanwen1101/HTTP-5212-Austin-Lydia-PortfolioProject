<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( isset( $_GET['delete'] ) )
{
  
  $query = 'DELETE FROM educations
    WHERE id = '.$_GET['delete'].'
    LIMIT 1';
  mysqli_query( $connect, $query );
    
  set_message( 'Education has been deleted' );
  
  header( 'Location: educations.php' );
  die();
  
}

include( 'includes/header.php' );

$query = 'SELECT *
  FROM educations
  ORDER BY end_date DESC';
$result = mysqli_query( $connect, $query );

?>

<h2>Manage Educations</h2>

<table>
  <tr>
    <th></th>
    <th align="center">ID</th>
    <th align="left">School</th>
    <th align="left">Major</th>
    <th align="center">Degree</th>
    <th align="center">Date</th>
    <th></th>
    <th></th>
    <th></th>
  </tr>
  <?php while( $record = mysqli_fetch_assoc( $result ) ): ?>
    <tr>
      <td align="center">
        <img src="image.php?type=education&id=<?php echo $record['id']; ?>&width=300&height=300&format=inside">
      </td>
      <td align="center"><?php echo $record['id']; ?></td>
      <td align="left">
        <?php echo htmlentities( $record['school'] ); ?>
        <br>
        <small><?php echo $record['school_url']; ?></small>
      </td>
      <td align="left">
        <?php echo htmlentities( $record['major'] ); ?>
        <br>
        <small><?php echo $record['major_url']; ?></small>
      </td>
      <td align="center"><?php echo $record['degree']; ?></td>
      <td align="center" style="white-space: nowrap;">
        <p>Start Date: <?php echo htmlentities( $record['start_date'] ); ?></p>
        <p>End Date: <?php echo htmlentities( $record['end_date'] ); ?></p>
      </td>
      <td align="center"><a href="educations_photo.php?id=<?php echo $record['id']; ?>">Photo</i></a></td>
      <td align="center"><a href="educations_edit.php?id=<?php echo $record['id']; ?>">Edit</i></a></td>
      <td align="center">
        <a href="educations.php?delete=<?php echo $record['id']; ?>" onclick="javascript:confirm('Are you sure you want to delete this education?');">Delete</i></a>
      </td>
    </tr>
  <?php endwhile; ?>
</table>

<p><a href="educations_add.php"><i class="fas fa-plus-square"></i> Add Education</a></p>


<?php

include( 'includes/footer.php' );

?>