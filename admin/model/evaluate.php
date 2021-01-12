<?php
include('./connect-db.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $arePostVarsSet = isset( $_POST['user_id']) && isset( $_POST['moderator_id']) && isset( $_POST['code_id']) && isset( $_POST['ui']) && isset( $_POST['ux']) && isset( $_POST['interface']);

    $alert = "";

    if( $arePostVarsSet) {


        $user_id = $_POST['user_id'];
        $moderator_id = $_POST['moderator_id'];
        $code_id = $_POST['code_id'];
        $ui = $_POST['ui'];
        $ux = $_POST['ux'];
        $interface = $_POST['interface'];

        $points = $ui + $ux + $interface;
        //echo $points;

        $sel_eval = "SELECT id FROM evaluations WHERE user_id=$user_id AND moderator_id=$moderator_id AND code_id=$code_id";
        $res_eval = mysqli_query($db, $sel_eval);
        $row_eval = mysqli_fetch_row($res_eval);
        if($row_eval){
            
            //echo $row_eval[0];
            $row_eval_id = $row_eval[0];
            if($row_eval){
                $update_eval = "UPDATE evaluations SET points = $points WHERE id=$row_eval_id";
                if(mysqli_query($db, $update_eval)){
                    $alert = 'Updated';
                }else{
                    $alert = 'Not Updated';
                }
                
            }
        }else{
            $eval_query = "INSERT INTO evaluations(user_id, moderator_id, code_id, points) VALUES('$user_id', '$moderator_id', '$code_id', '$points')";
            if(mysqli_query($db, $eval_query)){
                $alert = 'Saved';
            }else{
                $alert = 'Not Saved';
                
            }

        }

        echo "<script>window.alert('$alert');window.location='../moderator/index.php';</script>";
    }
}


?>