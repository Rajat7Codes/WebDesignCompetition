<?php
    session_start();
    if( isset( $_SESSION["LOGIN_MODERATOR"])) {
        $login_admin = base64_decode($_SESSION["LOGIN_MODERATOR"]);

        include('../model/connect-db.php');

        $admin_query = "SELECT * FROM moderators WHERE id=$login_admin";
        $admin_result = mysqli_query($db, $admin_query);
        $admin_row = mysqli_fetch_row($admin_result);

        $show_view = 0;
        if(isset($_REQUEST['id'])){
            $show_view = 1;
        }else{
            $show_view = 0;
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/sidebar.css">
    <title>Moderator</title>
    <style>
         
        .snapshot {
            height: 200px;
            object-fit: cover;
            background-size: cover;
        }
        .snapshot-div:hover .snapshot {
            opacity: 0.3;
        }
        .snapshot-div:hover .snapshot-preview {
            visibility: visible;
            opacity: 1;
            position: absolute;
            top: 50%;
        }
        .snapshot-preview {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            /* background: rgba(29, 106, 154, 0.72); */
            visibility: hidden;
            opacity: 0;
        }
    </style>
</head>

<body>
    <div class="d-flex" id="wrapper">

        <div id="page-content-wrapper" style="width:100%">

            <nav class="navbar navbar-expand-lg navbar-light border-bottom border-secondary">
                
                <div class="text-center">
                    <img style="height:50px; width:auto;" src="../assets/images/NGClogo.png" alt="">
                    
                </div>
                <div><h4>NextGenCoder</h4></div>


                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item"><a class="btn btn-outline-dark" href="../model/logout_admin.php">LOGOUT</a></li>
                        
                    </ul>
                </div>
            </nav>
           
            
            <div class="container-fluid bg-light">
            <br>
                <div class="row">
                <?php
                    $user_info = "SELECT * FROM codes 
                                WHERE moderator_$login_admin=0";
                    $user_result = mysqli_query($db, $user_info);
                   
                    while($user_row = mysqli_fetch_assoc($user_result)){
                ?>
                
                        <div class="card col-3 mt-2 mb-2 snapshot-div bg-light" style="border:none;" >
                        <a target="_blank" href="preview.php?code=<?php echo base64_encode($user_row['id']); ?>">
                            <div class="card-body snapshot" style="background-image:url(<?=$user_row['snapshot'] ?>);">
                            
                            </div>
                            <div class="snapshot-preview text-center"><span class=" btn btn-outline-dark">CLICK TO EVALUATE</span> </div>
                        </a>
                            
                        </div>
                        
                    <?php
                    }
                    ?>
                    
                </div>



            </div>
            
        </div>
        <!-- /#page-content-wrapper -->


    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script>
        $("#menu-toggle").click(function (e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
</body>
</html>
<?php 
}else{
        
}
?>