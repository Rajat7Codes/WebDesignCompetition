<?php 
session_start();
include('user/model/connect-db.php');
if(isset($_SESSION["LOGIN_USER"])) {
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/styles/style.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body onload="compile();">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4 p-0">
                <div class="editor-title">
                    <p id="html-title"> HTML </p>
                </div>
                <div id="html" class="editors" placeholder="HTML"></div>
                <div class="editor-title">
                    <p id="css-title"> CSS </p>
                </div>
                <div id="css" class="editors" placeholder="CSS"></div>
                <div class="editor-title">
                    <p id="js-title"> JS </p>
                </div>
                <div id="js" class="editors" placeholder="JavaScript"></div>
            </div>
            <div class="col-sm-8 p-0">
                <div class="row m-0" id="control-panel">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6 my-auto text-right">
                        <button onclick="saveCode()" id="saveBtn" class="btn btn-primary mx-2">
                            <div id="saveSpinner" style="display: none;" class="spinner-border spinner-border-sm"></div>
                            <span id="saveText" class="m-0"> Save </span>
                        </button>
                        <button onclick="takeshot();" class="btn btn-primary mx-2"> Submit </button>
                        <a href="user/model/logout_User.php" class="btn btn-danger mx-2"> Logout </a>
                    </div>
                </div>
                <iframe id="output"></iframe>
                
                <div id="pic1"></div>
            </div>
        </div>
    </div>
    <script src="http://html2canvas.hertzen.com/dist/html2canvas.js"></script>
    <script>
        function takeshot() { 
            let div = document.getElementById('output'); 
  
            html2canvas(div).then( 
                function (canvas) { 
                    //console.log(canvas);
                    document.getElementById('pic1').appendChild(canvas);
                    
                }); 
                // html2canvas(document.getElementById('output')).then(canvas => {
                //     // document.body.appendChild(canvas)
                //     console.log(canvas);
                //     console.log(canvas.toDataURL('image/jpeg').replace('image/jpeg', 'image/octet-stream'));
                // });
        } 
    </script>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="assets/src-noconflict/ace.js"></script>
<script type="text/javascript" src="app.js"></script>
<script>

        


    function doCapture() {
        //window.scrollTo(0, 0);

        html2canvas(document.getElementById("output")).then(function (canvas) {
            console.log(canvas.toDataURL("image/jpeg", 0.9));

            // Create an AJAX object
            var ajax = new XMLHttpRequest();

            // Setting method, server file name, and asynchronous
            ajax.open("POST", "save-capture.php", true);

            // Setting headers for POST method
            ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            // Sending image data to server
            ajax.send("image=" + canvas.toDataURL("image/jpeg", 0.9));

            // Receiving response from server
            // This function will be called multiple times
            ajax.onreadystatechange = function () {

                // Check when the requested is completed
                if (this.readyState == 4 && this.status == 200) {

                    // Displaying response from server
                    console.log(this.responseText);
                }
            };

        });
    }
</script>


<?php 
        $userId = base64_decode( $_SESSION['LOGIN_USER']);

        $codeQuery = "SELECT * FROM codes WHERE user_id=$userId"; 
        $codeRow = mysqli_fetch_assoc( mysqli_query($db,$codeQuery));


        if($codeRow) { ?>
<script>
    var htmlInput = `<?php echo $codeRow["html"] ?>`;
    var cssInput = `<?php echo $codeRow["css"] ?>`;
    var jsInput = `<?php echo $codeRow["js"] ?>`;

    html.setValue(htmlInput);
    css.setValue(cssInput);
    js.setValue(jsInput);
</script>
<?php   }  
?>

<script>
    function saveCode() {
        var htmlCode = html.session.getValue();
        var cssCode = css.session.getValue();
        var jsCode = js.session.getValue();

        var checkingData = {
            "htmlCode": htmlCode,
            "cssCode": cssCode,
            "jsCode": jsCode
        }

        $.ajax({
            type: "POST",
            url: "save.php",
            data: checkingData,
            beforeSend: function () {
                document.getElementById("saveSpinner").style.display = "inline-block";
                document.getElementById("saveText").innerText = "Saving";
            },
            success: function (msg) {
                console.log(msg);
                try {
                    let runResponse = JSON.parse(msg);

                    if (runResponse["isError"]) {
                        alert(runResponse["alertToGive"]);
                    } else {
                        document.getElementById("output-div").innerText = runResponse["output"];
                    }
                } catch (e) {
                    alert("Code saved successfull");
                } finally {
                    document.getElementById("saveSpinner").style.display = "none";
                    document.getElementById("saveText").innerText = "Save";
                }
            }
        });
    }
</script>

</html>

<?php } else { ?>
Not Authorised
<?php } ?>