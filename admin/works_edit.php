<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( !isset( $_GET['id'] ) )
{
  
  header( 'Location: works.php' );
  die();
  
}

if( isset( $_POST['title'] ) )
{
  
  if( $_POST['title'])
  {
    
    $query = 'UPDATE works SET
      title = "'.mysqli_real_escape_string( $connect, $_POST['title'] ).'",
      description = "'.mysqli_real_escape_string( $connect, $_POST['description'] ).'",
      employment_type = "'.mysqli_real_escape_string( $connect, $_POST['employment_type'] ).'",
      company_name = "'.mysqli_real_escape_string( $connect, $_POST['company_name'] ).'",
      location = "'.mysqli_real_escape_string( $connect, $_POST['location'] ).'",
      start_date = "'.mysqli_real_escape_string( $connect, $_POST['start_date'] ).'",
      end_date = "'.mysqli_real_escape_string( $connect, $_POST['end_date'] ).'"
      WHERE id = '.$_GET['id'].'
      LIMIT 1';
    mysqli_query( $connect, $query );
    
    set_message( 'Experience has been updated' );
    
  }

  header( 'Location: works.php' );
  die();
  
}


if( isset( $_GET['id'] ) )
{
  
  $query = 'SELECT *
    FROM works
    WHERE id = '.$_GET['id'].'
    LIMIT 1';
  $result = mysqli_query( $connect, $query );
  
  if( !mysqli_num_rows( $result ) )
  {
    
    header( 'Location: works.php' );
    die();
    
  }
  
  $record = mysqli_fetch_assoc( $result );
  
}

include( 'includes/header.php' );

?>

<h2>Edit Experience</h2>

<form method="post">
  
  <label for="title">Title:</label>
  <input type="text" name="title" id="title" value="<?php echo htmlentities( $record['title'] ); ?>">
    
  <br>
  
  <label for="description">Description:</label>
  <textarea type="text" name="description" id="description" rows="5"><?php echo htmlentities( $record['description'] ); ?></textarea>
  
  <script>

  ClassicEditor
    .create( document.querySelector( '#description' ) )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );
    
  </script>
  
  <br>
  
  <label for="employment_type">Employment Type:</label>
  <input type="text" name="employment_type" id="employment_type" value="<?php echo htmlentities( $record['employment_type'] ); ?>">
    
  <br>
  
  <label for="company_name">Company Name:</label>
  <input type="text" name="company_name" id="company_name" value="<?php echo htmlentities( $record['company_name'] ); ?>">

  <br>

  <label for="location">Location:</label>
  <input type="text" name="location" id="location" value="<?php echo htmlentities( $record['location'] ); ?>">
  
  <br>
  
  <label for="start_date">Start Date:</label>
  <input type="date" name="start_date" id="start_date" value="<?php echo htmlentities( $record['start_date'] ); ?>">
  
  <br>

  <label for="end_date">End Date:</label>
  <input type="date" name="end_date" id="end_date" value="<?php echo htmlentities( $record['end_date'] ); ?>">
  
  <br>
  
  <input type="submit" value="Edit Experience">
  
</form>

<p><a href="works.php"><i class="fas fa-arrow-circle-left"></i> Return to Experience List</a></p>


<?php

include( 'includes/footer.php' );

?>