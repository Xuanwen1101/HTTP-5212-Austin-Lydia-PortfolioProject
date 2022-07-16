<?php

function curl_get_contents( $url )
{
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}

function pre( $data )
{
  
  echo '<pre>';
  print_r( $data );
  echo '</pre>';
  
}

function secure()
{
  
  if( !isset( $_SESSION['id'] ) )
  {
    
    header( 'Location: /' );
    die();
    
  }
  
}

function set_message( $message )
{
  
  $_SESSION['message'] = $message;
  
}

function get_message()
{
  
  if( isset( $_SESSION['message'] ) )
  {
    
    echo '<p style="padding: 0 1%;" class="title">
        '.$_SESSION['message'].'
      </p>
      ';
    unset( $_SESSION['message'] );
    
  }
  
}
  // get the page url and only the last part of it
  $url = $_SERVER['REQUEST_URI'];
  $url = explode('/', $url);
  $url = end($url);

  // if there was a previous page, get the url
  if( isset( $_SERVER['HTTP_REFERER'] ) )
  {
    $previous_url = $_SERVER['HTTP_REFERER'];
    $previous_url = explode('/', $previous_url);
    $previous_url = end($previous_url);

    // if the previous page was index.php, route to index.php
    if( $url == 'index.php' )
    {
      // route to the website index page
      header( 'Location: /' );
      die();
    }
    
  }
  else { $previous_url = 'index.php'; }


  // if the previous page url has the word add or edit in it, then change previous_url to dashboard
  if(strpos($previous_url, 'add') !== false || strpos($previous_url, 'edit') !== false || strpos($previous_url, 'delete') !== false || strpos($previous_url, 'photo') !== false) {
    $previous_url = 'dashboard.php';
  }

  // remove the .php from the end of the previous url
  $previous_url = str_replace('.php', '', $previous_url);

  // remove the .php from the end of the url
  $url = str_replace('.php', '', $url);