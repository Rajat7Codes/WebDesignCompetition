<?php

include('./connect-db.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $arePostVarsSet = isset( $_POST['name']) && isset( $_POST['mail']) && isset( $_POST['pass']);

    $alert = "";

    if( $arePostVarsSet) {

        $name = $_POST['name'];
        $mail = $_POST['mail'];
        $pass = $_POST['pass'];
        $encryptedPass = password_hash( $pass, PASSWORD_DEFAULT);
        //$count = 0;
        $row_count = mysqli_query($db, "SELECT COUNT(1) FROM moderators");
        //$count = mysqli_num_rows($row_count);
        $total_row = mysqli_fetch_array($row_count);

        $total = $total_row[0]+1;
        echo "Total rows: " . $total;

        $adminCheckQuery = "SELECT id FROM moderators WHERE mail='$mail' LIMIT 1";
        $adminCheckResult = mysqli_query($db, $adminCheckQuery);
        $adminCheckRow = mysqli_fetch_assoc($adminCheckResult);

        if ($adminCheckRow) { 
            $alert = 'Moderator already exist with given mail';
        } else {
            $insertAdminQuery = "INSERT INTO moderators(name, mail, password) VALUES('$name', '$mail', '$encryptedPass')";
            $insertAdminResult = mysqli_query($db, $insertAdminQuery);

            if(! $insertAdminResult) {
                $alert = 'Registration failed contact developers';
                // $log->userLog( 'Login Register', 'Email', 'Email Register', -1, 'User Registeration Failed', 0, "");
                // $alert = trigger_error("there was an error....".$db->error, E_USER_WARNING);
            } else {
                if(mysqli_query($db, "ALTER TABLE codes ADD moderator_$total TinyInt(1) Default(0)")){
                    $alert = 'Column Added Successfully';
                }
                $alert = 'Moderator Registration Successful<br>Email:'.$mail.'<br>Password:'.$pass;   
               
                // $log->userLog( 'Login Register', 'Email', 'Email Register', -1, 'User Registered', 1, "");
            }
        }

    }else {
        $alert = "Problem occured while Adding Moderator reach developers for more information";
        // $log->userLog( 'Login Register', 'Email', 'Email Register', -1, 'Post vars are not set', 0, "");
    }
    echo "<script>window.alert('$alert'); window.location='../super/moderator_add.php';</script>";


}

?>