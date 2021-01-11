<?php 

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if( isset( $_SESSION["LOGIN_USER"])) {

        // Object for sending response as JSON
        $ajaxResponse = json_decode('{ "alertToGive" : null, "isError" : true }', TRUE);
                    
        $areVarsSet = isset( $_POST['htmlCode']) &&  $_POST['cssCode'] && $_POST['jsCode'];

        if ( $areVarsSet) {
            $htmlCode = $_POST['htmlCode'];
            $cssCode = $_POST['cssCode'];
            $jsCode = $_POST['jsCode'];
            $userId = base64_decode( $_SESSION['LOGIN_USER']);

            /******************** CODE SAVE *********************/

            // Checking if code exists
            $codeQuery = "SELECT id FROM codes WHERE user_id=$userId"; 
            $codeRow = mysqli_fetch_assoc( mysqli_query($db,$codeQuery));

            // Creating Query for Saving codes
            $stmt = "";
            if( $codeRow) {
                $stmt = $db->prepare("UPDATE codes SET html = ?, css = ?, js = ? WHERE user_id = ?");
                $stmt->bind_param("ssss", $htmlCode, $cssCode, $jsCode, $userId);
            } else {
                $stmt = $db->prepare("INSERT INTO codes (user_id, html, css, js) VALUES ( ?, ?, ?, ?)");
                $stmt->bind_param("ssss", $userId, $htmlCode, $cssCode, $jsCode);
            }

            

        }
    }
}

?>