<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>Contact Page</h1>
  <form action="admin/contact.php" method="POST">
    <div>
      <label for="name">Name:</label>
      <input type="text" name="name" id="name">
    </div>
    <div>
      <label for="email">Email:</label>
      <input type="text" name="email" id="email">
    </div>
    <div>
      <label for="message">Message:</label>
      <textarea name="message" id="message" cols="30" rows="10"></textarea>
    </div>
    <input type="submit" value="Send">
  </form>
</body>
</html>