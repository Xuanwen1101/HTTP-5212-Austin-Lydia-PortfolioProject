<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( !isset( $_GET['id'] ) )
{
  
  header( 'Location: users.php' );
  die();
  
}

if( isset( $_POST['first'] ) )
{
  
  if( $_POST['first'] and $_POST['last'] and $_POST['email'] )
  {
    
    $query = 'UPDATE users SET
      first = "'.mysqli_real_escape_string( $connect, $_POST['first'] ).'",
      last = "'.mysqli_real_escape_string( $connect, $_POST['last'] ).'",
      email = "'.mysqli_real_escape_string( $connect, $_POST['email'] ).'",
      active = "'.$_POST['active'].'"
      WHERE id = '.$_GET['id'].'
      LIMIT 1';
    mysqli_query( $connect, $query );
    
    if( $_POST['password'] )
    {
      
      $query = 'UPDATE users SET
        password = "'.md5( $_POST['password'] ).'"
        WHERE id = '.$_GET['id'].'
        LIMIT 1';
      mysqli_query( $connect, $query );
      
    }
    
    set_message( 'User has been updated' );
    
  }

  header( 'Location: users.php' );
  die();
  
}


if( isset( $_GET['id'] ) )
{
  
  $query = 'SELECT *
    FROM users
    WHERE id = '.$_GET['id'].'
    LIMIT 1';
  $result = mysqli_query( $connect, $query );
  
  if( !mysqli_num_rows( $result ) )
  {
    
    header( 'Location: users.php' );
    die();
    
  }
  
  $record = mysqli_fetch_assoc( $result );
  
}

include( 'includes/header.php' );

?>

<h2 class="title">Edit User</h2>

<div class="objects-container">
  <form method="post" class="form">
  
    <div class="form__field">
      <label for="first" class="form__label">First:</label>
      <input type="text" class="form__input" name="first" id="first" value="<?php echo htmlentities( $record['first'] ); ?>">
    </div>
    <div class="form__field">
      <label for="last" class="form__label">Last:</label>
      <input type="text" class="form__input" name="last" id="last" value="<?php echo htmlentities( $record['last'] ); ?>">
    </div>
    <div class="form__field">
      <label for="email" class="form__label">Email:</label>
      <input type="email" class="form__input" name="email" id="email" value="<?php echo htmlentities( $record['email'] ); ?>">
    </div>
    <div class="form__field">
      <label for="password" class="form__label">Password:</label>
      <input type="password" class="form__input" name="password" id="password">
    </div>
    <div class="form__field">
      <label for="active" class="form__label">Active:</label>
      <?php
      $values = array( 'Yes', 'No' );
      echo '<select name="active" class="form__select" id="active">';
      foreach( $values as $key => $value )
      {
        echo '<option value="'.$value.'"';
        if( $value == $record['active'] ) echo ' selected="selected"';
        echo '>'.$value.'</option>';
      }
      echo '</select>';
      ?>
    </div>
    <input type="submit" class="form__button" value="Edit User">
  
  </form>
</div>

<p><a href="users.php"><i class="fas fa-arrow-circle-left"></i> Return to User List</a></p>


<?php

include( 'includes/footer.php' );

?>