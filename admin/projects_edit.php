<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( !isset( $_GET['id'] ) )
{
  
  header( 'Location: projects.php' );
  die();
  
}

if( isset( $_POST['title'] ) )
{
  
  if( $_POST['title'] and $_POST['content'] )
  {
    
    $query = 'UPDATE projects SET
      title = "'.mysqli_real_escape_string( $connect, $_POST['title'] ).'",
      content = "'.mysqli_real_escape_string( $connect, $_POST['content'] ).'",
      date = "'.mysqli_real_escape_string( $connect, $_POST['date'] ).'",
      type = "'.mysqli_real_escape_string( $connect, $_POST['type'] ).'",
      url = "'.mysqli_real_escape_string( $connect, $_POST['url'] ).'"
      WHERE id = '.$_GET['id'].'
      LIMIT 1';
    mysqli_query( $connect, $query );
    
    set_message( 'Project has been updated' );
    
  }

  header( 'Location: projects.php' );
  die();
  
}


if( isset( $_GET['id'] ) )
{
  
  $query = 'SELECT *
    FROM projects
    WHERE id = '.$_GET['id'].'
    LIMIT 1';
  $result = mysqli_query( $connect, $query );
  
  if( !mysqli_num_rows( $result ) )
  {
    
    header( 'Location: projects.php' );
    die();
    
  }
  
  $record = mysqli_fetch_assoc( $result );
  
}

include( 'includes/header.php' );

?>

<h2 class="title">Edit Project</h2>

<div class="objects-container">
<form method="post" class="form">
  <div class="form__field">
    <label class="form__label" for="title">Title:</label>
    <input class="form__input" type="text" name="title" id="title" value="<?php echo htmlentities( $record['title'] ); ?>">
  </div>
  <div class="form__field">
    <label class="form__label" for="url">URL:</label>
    <input class="form__input" type="text" name="url" id="url" value="<?php echo htmlentities( $record['url'] ); ?>">
  </div>
  <div class="form__field">
    <label class="form__label" for="date">Date:</label>
    <input class="form__input" type="date" name="date" id="date" value="<?php echo htmlentities( $record['date'] ); ?>">
  </div>
  <div class="form__field">
    <label class="form__label" for="type">Type:</label>
    <select class="form__select" name="type" id="type">
      <?php
      $values = array( 'Website', 'Graphic Design' );
      foreach( $values as $key => $value )
      {
        echo '<option value="'.$value.'"';
        if( $value == $record['type'] ) echo ' selected="selected"';
        echo '>'.$value.'</option>';
      }
      ?>
    </select>
  </div>
  <div class="form__field">
    <label class="form__label" for="content">Content:</label>
    <textarea class="form__textarea" type="text" name="content" id="content" rows="5"><?php echo htmlentities( $record['content'] ); ?></textarea>
    <script>
    ClassicEditor
      .create( document.querySelector( '#content' ) )
      .then( editor => {
          console.log( editor );
      } )
      .catch( error => {
          console.error( error );
      } );
    </script>
  </div>
  <input class="form__button" type="submit" value="Edit Project">
</form>
</div>

<div class="object__link">
  <a href="projects.php"><i class="fas fa-arrow-circle-left"></i> Return to Project List</a>
</div>


<?php

include( 'includes/footer.php' );

?>