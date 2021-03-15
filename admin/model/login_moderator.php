<?php 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // include('../model/logging.php');

        // $log = new LoggingModel();

        $arePostVarsSet = isset( $_POST['mail']) && isset( $_POST['pass']);

        if( $arePostVarsSet) {
            include('./connect-db.php');

            $userMail = $_POST['mail'];
            $userPassword = $_POST['pass'];
        
            $userQuery = "SELECT id, password FROM moderators WHERE mail = '$userMail' LIMIT 1";
            $result = mysqli_query($db, $userQuery);
            $userRow = mysqli_fetch_assoc($result);

            // if user exists
            if( $userRow) {
                session_start();

                $decryptedPass = $userRow['password'];
               
              
                if( password_verify( $userPassword, $decryptedPass)){
                    $_SESSION['LOGIN_MODERATOR'] = base64_encode($userRow["id"]);
                    $alertMsg = "Login Successfull";
                    $url_forward = "../moderator/index.php";
                    // $log->userLog( 'Login Register', 'Email', 'Email Login', -1, 'Login Successfull', 1, "");
                }else{
                    $alertMsg = "Your login or password is invalid";
                    $url_forward = "../index.php";
                }
                
            } else {
                $alertMsg = "Moderator Not Exist";
                $url_forward = "../index.php";
                // $log->userLog( 'Login Register', 'Email', 'Email Login', -1, 'User not registered', 0, "User not found");
            }
            
        } else {
            $alertMsg = "Problem occured while login reach developers for more information";
            // $log->userLog( 'Login Register', 'Email', 'Email Login', -1, 'Sent data are not allowed', 0, "Post Vars are not set");
        }
        echo "<script> window.alert('$alertMsg'); window.location = './$url_forward'; </script>";
    }

?>