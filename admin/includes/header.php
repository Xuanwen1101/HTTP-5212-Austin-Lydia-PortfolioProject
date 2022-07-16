<!doctype html>
<html lang="en">
<head>
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
  <!-- content scaling meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Website Admin</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;500;600;700&family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="../css/reset.css" type="text/css" rel="stylesheet">
  <link href="../css/main.css" type="text/css" rel="stylesheet">
  
  <script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>
  
</head>
<body>
  
  <h1 class="hidden">Website Admin</h1>
  
  <?php if(isset($_SESSION['id'])): ?>
      <header class="header">
        <!-- create a back button to go back to the previous page using PHP-->
        <a class="header__back" href="<?php echo $previous_url ?>.php" class="header__back">
          <img src="../assets/icons/chevron-left.svg" alt="">
          Back to <?php echo $previous_url; ?>
        </a>
        <script>
          // if the url is not dashboard.php, then show the back button
          if("<?php echo $url ?>" != "dashboard") {
            document.querySelector('.header__back').style.display = 'block';
          } else {
            document.querySelector('.header__back').style.display = 'none';
          }
        </script>
        <img src="../assets/icons/menu.svg" alt="">
        <nav class="header__nav">
          <ul class="nav__wrapper">
            <li class="nav__item"><a  href="users.php">Switch Accounts</a></li>
            <li class="nav__item"><a href="logout.php">Logout</a></li>
          </ul>
        </nav>
      </header>
  <?php endif; ?>
  
  <hr>
  
  <?php echo get_message(); ?>
  
  <div>
  
