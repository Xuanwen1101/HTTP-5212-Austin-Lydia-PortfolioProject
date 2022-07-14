<?php
$root = dirname( __DIR__ );
include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

include( 'includes/header.php' );

?>

<section id="dashboard">
  <h2 class="dashboard__user">Hello, <?php 
    // get the logged in user first name based on the session email
    $user = $_SESSION['email'];
    $sql = "SELECT first FROM users WHERE email = '$user'";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);
    echo $row['first'];
  ?>!</h2>
  <ul class="dashboard__container">
    <li class="dashboard__link">
      <a href="projects.php">  
      <img src="../assets/icons/projects.svg" alt="Project Page Icon">
        Your Projects
      </a>
    </li>
    <li class="dashboard__link">
      <a href="educations.php">  
        <img src="../assets/icons/education.svg" alt="Project Page Icon">
        Your Educations
      </a>
    </li>
    <li class="dashboard__link">
      <a href="skills.php">  
        <img src="../assets/icons/skills.svg" alt="Project Page Icon">
        Your Skills
      </a>
    </li>
    <li class="dashboard__link">
      <a href="works.php">  
        <img src="../assets/icons/experience.svg" alt="Project Page Icon">
        Your Experience
      </a>
    </li>
    <li class="dashboard__link">
      <a href="works.php">
        <img src="../assets/icons/mail.svg" alt="Project Page Icon">
        Your Emails
      </a>
    </li>
    <li class="dashboard__link">
      <a href="contents.php">  
        <img src="../assets/icons/extra.svg" alt="Project Page Icon">
        Your Extras
      </a>
    </li>
    <li class="dashboard__link">
      <a href="blog.php">  
        <img src="../assets/icons/blog.svg" alt="Project Page Icon">
        Your Blog
      </a>
    </li>
    <li class="dashboard__link">
      <a href="users.php">  
        <img src="../assets/icons/users.svg" alt="Project Page Icon">
        Your Accounts
      </a>
    </li>
  </ul>
</section>

<?php

include( 'includes/footer.php' );

?>
