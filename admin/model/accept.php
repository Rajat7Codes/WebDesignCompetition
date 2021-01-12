<?php

include('./connect-db.php');
$id = $_REQUEST['id'];

$select_query = "SELECT * FROM users WHERE id=$id";
$result_query = mysqli_query($db, $select_query);
$request_query = mysqli_fetch_assoc($result_query);
if($request_query['request'] == 0){

    $insc = "UPDATE users SET request = 1 WHERE id = '$id'";
}
if($request_query['request'] == 1){

    $insc = "UPDATE users SET request = 0 WHERE id = '$id'";
}
if($request_query['request'] == 2){

    $insc = "UPDATE users SET request = 0 WHERE id = '$id'";
}
if(mysqli_query($db, $insc)){
    $msg = "Request Accetpted Successfully";

}else{
    $msg = "Error Occured Deleted";

}
echo "<script>window.alert('.$msg');window.location = '../super/requested_users.php'</script>";


?>