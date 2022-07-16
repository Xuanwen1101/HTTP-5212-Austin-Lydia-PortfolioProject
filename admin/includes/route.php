<?php 
  // get the page url and only the last part of it
  $url = $_SERVER['REQUEST_URI'];
  $url = explode('/', $url);
  $url = end($url);

  // get the previous page url and only the last part of it
  $previous_url = $_SERVER['HTTP_REFERER'];
  $previous_url = explode('/', $previous_url);
  $previous_url = end($previous_url);


  // if the previous page url has the word add or edit in it, then change previous_url to dashboard
  if(strpos($previous_url, 'add') !== false || strpos($previous_url, 'edit') !== false || strpos($previous_url, 'delete') !== false || strpos($previous_url, 'photo') !== false) {
    $previous_url = 'dashboard.php';
  }

  // remove the .php from the end of the previous url
  $previous_url = str_replace('.php', '', $previous_url);

  // remove the .php from the end of the url
  $url = str_replace('.php', '', $url);
?>