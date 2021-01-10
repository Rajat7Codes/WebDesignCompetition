<?php

    class LoggingModel {
        public function userLog( $section, $subSection, $action, $associateId, $description, $result, $problem) {
            include('../model/connect-db.php');

            $userId = -1;
            if( isset($_SESSION["LOGIN_USER"]))
                $userId = base64_decode( $_SESSION["LOGIN_USER"]);

            $addLogQuery = "INSERT INTO user_logs ( user_id, section, sub_section, action,";
            $addLogQuery = $addLogQuery."associate_id, description, result, problem) ";
            $addLogQuery = $addLogQuery."VALUES( $userId, '$section', '$subSection', '$action',";
            $addLogQuery = $addLogQuery."$associateId, '$description', $result, '$problem')";

            mysqli_query($db, $addLogQuery);
            return true;
        }
    }
    
?>