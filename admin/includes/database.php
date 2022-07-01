<?php

$connect = mysqli_connect( 
    "localhost", 
    "root", 
    "", 
    "db_http-5212-portfolio" 
);

mysqli_set_charset( $connect, 'UTF8' );
