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

<table>
  <tr>
    <th></th>
    <th align="center">ID</th>
    <th align="left">Title</th>
    <th align="left">Description</th>
    <th align="center">Date</th>
    <th></th>
    <th></th>
    <th></th>
  </tr>
  <?php while( $record = mysqli_fetch_assoc( $result ) ): ?>
    <tr>
      <td align="center">
        <img src="image.php?type=work&id=<?php echo $record['id']; ?>&width=300&height=300&format=inside">
      </td>
      <td align="center"><?php echo $record['id']; ?></td>
      <td align="left">
        <?php echo htmlentities( $record['title'] ); ?>
        <br>
        <small><?php echo $record['employment_type']; ?></small>
        <br>
        <small><?php echo $record['company_name']; ?></small>
        <br>
        <small><?php echo $record['location']; ?></small>
      </td>
      <td align="left"><small><?php echo $record['description']; ?></small></td>
      <td align="center" style="white-space: nowrap;">
        <p>Start Date: <?php echo htmlentities( $record['start_date'] ); ?></p>
        <p>End Date: <?php echo htmlentities( $record['end_date'] ); ?></p>
      </td>
      <td align="center"><a href="works_photo.php?id=<?php echo $record['id']; ?>">Photo</i></a></td>
      <td align="center"><a href="works_edit.php?id=<?php echo $record['id']; ?>">Edit</i></a></td>
      <td align="center">
        <a href="works.php?delete=<?php echo $record['id']; ?>" onclick="javascript:confirm('Are you sure you want to delete this experience?');">Delete</i></a>
      </td>
    </tr>
  <?php endwhile; ?>
</table>

<p><a href="works_add.php"><i class="fas fa-plus-square"></i> Add Experience</a></p>


<?php

include( 'includes/footer.php' );

?>