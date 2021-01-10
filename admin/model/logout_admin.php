<?php 
session_start();
    $_SESSION['LOGIN_ADMIN'] = null;
    unset( $_SESSION['LOGIN_ADMIN']);
    
    if(session_destroy()) {
       header("Location: ../index.php");
    }
             
?>