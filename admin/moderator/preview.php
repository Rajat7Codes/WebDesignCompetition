<?php
    session_start();
    if( isset( $_SESSION["LOGIN_MODERATOR"])) {
        $login_admin = base64_decode($_SESSION["LOGIN_MODERATOR"]);

        include('../model/connect-db.php');
        if(isset($_REQUEST["code"])){
            $code_id = base64_decode($_REQUEST["code"]);
            
        }
        else{
            echo "<script>window.close();</script>";
        }

        
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/design.css">


    <title>Preview</title>

</head>

<body onload="compile();">
    <div id="blur">

        <!-- Content -->
        <?php
            $code_info = "SELECT * FROM codes 
            WHERE id=$code_id";
            $code_result = mysqli_query($db, $code_info);
            
         while($code_row = mysqli_fetch_assoc($code_result)){
         

        ?>

        <div class="container-fluid px-5 pb-4">
            <div class="row m-0">
                <div class="col-sm-5 p-0 border">
                    <div class="editor-title border">
                        <p id="html-title"> HTML </p>
                    </div>
                    <div id="html" class="editors" placeholder="HTML">
                        <script>
                            document.getElementById("html").innerText = `<?php echo $code_row['html']; ?>`
                        </script>
                    </div>
                    <div class="editor-title border">
                        <p><span id="css-title"> CSS </span> <span id="js-title"> JS </span></p>

                    </div>
                    <div class="css-div" id="cssDiv">
                        <div id="css" class="editors" placeholder="CSS">
                        <script>
                            document.getElementById("css").innerText = `<?php echo $code_row['css']; ?>`
                        </script>
                        </div>
                    </div>
                    <div class="js-div" id="jsDiv">

                        <div id="js" class="editors" placeholder="JavaScript">
                        <script>
                            document.getElementById("js").innerText = `<?php echo $code_row['js']; ?>`
                        </script>
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-7 p-0 border" id="add-col">
                    <div class="fullscreen p-1"><img style="width:20px;" src="../assets/images/expand.svg" alt=""></div>
                    
                    <div class="fullscreen1 p-1"><img style="width:20px;" src="../assets/images/compress.svg" alt=""></div>
                    <iframe id="output">
                        
                    </iframe>
                </div>
            </div>
        </div>
    </div>

    <div id="output1"></div>
    <?php } ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.min.js"></script>
    <script src="../../assets/src-noconflict/ace.js"></script>
    <script src="../assets/app.js"></script>
    <script src="../assets/design.js"></script>

    <script>
        $(".fullscreen").click(function () {

            $("#add-col").addClass("col-md-12");
            $(".col-sm-5").hide("slide", {
                direction: "left"
            }, 50);
            $(".fullscreen1").show();
            $(".fullscreen").hide();
        });

        $(".fullscreen1").click(function () {
            $(".fullscreen").show();
            $(".fullscreen1").hide();
            $(".col-sm-5").show("slide", {
                direction: "left"
            }, 400);
            $("#add-col").removeClass("col-md-12");
        });





        $("#js-title").click(function () {
            $(".js-div").show();
            $(".css-div").hide();
            $("#js-title").css('background', '#27A444');
            $("#css-title").css('background', 'rgb(275, 275, 275)');
        });


        $("#css-title").click(function () {
            $(".css-div").show();
            $(".js-div").hide();
            $("#js-title").css('background', 'rgb(275, 275, 275)');
            $("#css-title").css('background', '#27A444');
        });
    </script>

</body>
<?php } ?>

</html>