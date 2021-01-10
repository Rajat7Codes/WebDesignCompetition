<?php
    session_start();
    if( isset( $_SESSION["LOGIN_USER"])) {
        $login_user = base64_decode($_SESSION["LOGIN_USER"]);

        include('./model/connect-db.php');
        $user_query = "SELECT * FROM users WHERE id=$login_user";
        $user_result = mysqli_query($db, $user_query);
        while($user_row = mysqli_fetch_assoc($user_result)){
            echo $user_row['name']. " " .$user_row['mail'];

        }
        

    }else{
        echo "2";
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
<link rel="stylesheet" href="assets/css/style.css">
<title>Success</title>
</head>
<body>
<div class="container">
    <a href="./model/logout_User.php"> logout</a>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.min.js"></script>
</body>
</html>