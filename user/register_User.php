<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // include('../model/logging.php');

    // $log = new LoggingModel();

    $arePostVarsSet = isset( $_POST['name']) && isset( $_POST['mail']) && isset( $_POST['pass']);
    $alert = "";

    if( $arePostVarsSet) {
        include('./model/connect-db.php');

        // Taking POST form variables
        $name = $_POST['name'];
        $mail = $_POST['mail'];
        $pass = $_POST['pass'];
        $encryptedPass = password_hash( $pass, PASSWORD_DEFAULT);

        // Insert Query, Result, Rows
        $userCheckQuery = "SELECT id FROM users WHERE mail='$mail' LIMIT 1";
        $userCheckResult = mysqli_query($db, $userCheckQuery);
        $userCheckRow = mysqli_fetch_assoc($userCheckResult);

        // if user exists
        if ($userCheckRow) { 
            $alert = 'User already registered with given mail';
            // $log->userLog( 'Login Register', 'Email', 'Email Register', -1, 'User already registered', 0, "");
        } else {
            $insertUserQuery = "INSERT INTO users(name, mail, password) VALUES('$name', '$mail', '$encryptedPass')";
            $insertUserResult = mysqli_query($db, $insertUserQuery);

            if(! $insertUserResult) {
                $alert = 'Registration failed contact developers';
                // $log->userLog( 'Login Register', 'Email', 'Email Register', -1, 'User Registeration Failed', 0, "");
                // $alert = trigger_error("there was an error....".$db->error, E_USER_WARNING);
            } else {
                session_start();
                $GetIdUserQuery = "SELECT id FROM users WHERE mail='$mail' LIMIT 1";
                $GetIdUserResult = mysqli_query($db, $GetIdUserQuery);
                $GetIdUserRow = mysqli_fetch_assoc($GetIdUserResult);

                $_SESSION['LOGIN_USER'] = base64_encode( $GetIdUserRow["id"]);
                $alert = 'Registration Successful';   
                $alert = mysqli_error($db);
                // $log->userLog( 'Login Register', 'Email', 'Email Register', -1, 'User Registered', 1, "");
            }
        }
    } else {
        $alert = "Problem occured while login reach developers for more information";
        // $log->userLog( 'Login Register', 'Email', 'Email Register', -1, 'Post vars are not set', 0, "");
    }
    echo "<script>window.alert('$alert'); window.location='./index.php';</script>";
}

?>