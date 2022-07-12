<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( isset( $_GET['delete'] ) )
{
  
  $query = 'DELETE FROM users
    WHERE id = '.$_GET['delete'].'
    LIMIT 1';
  mysqli_query( $connect, $query );
  
  set_message( 'User has been deleted' );
  
  header( 'Location: users.php' );
  die();
  
}

include( 'includes/header.php' );

$query = 'SELECT *
  FROM users';
$result = mysqli_query( $connect, $query );

?>
<section class="users">
<h2>Manage Users</h2>
  <div class="users__container">
    <?php while( $record = mysqli_fetch_assoc( $result ) ): ?>
      <div class="users__card">
        <div class="users__text">
          <span class="user__id">ID: <?php echo $record['id'] ?></span>
          <h2 class="user__name"><?php echo $record['first'] . ' ' . $record['last'] ?></h2>
          <h3 class="user__email"><?php echo $record['email'] ?></h3>
        </div>
        <div class="user__functions">
          <!-- add users_edit.php -->
          <a href="users_edit.php?id=<?php echo $record['id'] ?>">Edit</a>
          <a href="users.php?delete=<?php echo $record['id'] ?>" class="user__delete">Delete</a>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</section>
<p><a href="users_add.php"><i class="fas fa-plus-square"></i> Add User</a></p>


<?php

include( 'includes/footer.php' );

?>