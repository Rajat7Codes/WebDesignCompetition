<?php 
session_start();
    $_SESSION['LOGIN_USER'] = null;
    unset( $_SESSION['LOGIN_USER']);
    
    if(session_destroy()) {
       header("Location: ../index.php");
    }
             
?>