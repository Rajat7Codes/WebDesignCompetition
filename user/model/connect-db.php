<?php 
    $database = include('config.php');

    $db = mysqli_connect( $database['servername'], $database['username'], $database['password'], $database['dbname']);
?>