<!doctype html>
<html>
<head>
  
  <meta charset="UTF-8">
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
  <!-- content scaling meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Website Admin</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;500;600;700&family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="/css/reset.css" type="text/css" rel="stylesheet">
  <link href="/css/main.css" type="text/css" rel="stylesheet">
  
  <script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>
  
</head>
<body>
  
  <h1>Website Admin</h1>
  
  <?php if(isset($_SESSION['id'])): ?>

    <p>
      <a href="dashboard.php">Dashboard</a> | 
      <a href="logout.php">Logout</a>
    </p>
  
  <?php endif; ?>
  
  <hr>
  
  <?php echo get_message(); ?>
  
  <div>
  
