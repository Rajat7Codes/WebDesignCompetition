<?php

include('./connect-db.php');
$id = $_POST['id'];

$name = $_POST['name'];
$mail = $_POST['mail'];
$pass = $_POST['pass'];
$encryptedPass = password_hash( $pass, PASSWORD_DEFAULT);
$msg = "";
$insc = "UPDATE admin SET
    name = '$name',
    mail = '$mail',
    password = '$encryptedPass'
    WHERE id = '$id' AND admin_role='ADMIN_MODERATOR'";
if(mysqli_query($db, $insc)){
    $msg = 'Moderator Changes Successfully <br> Email:'.$mail.' <br> Password: '.$pass;

}else{
    $msg = 'Error Occured Deleted';

}
echo "<script>window.alert('$msg');window.location='../super/moderator.php';</script>";
echo "<script></script>";


?>