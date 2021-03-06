<?php
    session_start();
    if( isset( $_SESSION["LOGIN_ADMIN"])) {
        $login_admin = base64_decode($_SESSION["LOGIN_ADMIN"]);

        include('../model/connect-db.php');

        $admin_query = "SELECT * FROM admin WHERE id=$login_admin";
        $admin_result = mysqli_query($db, $admin_query);
        $admin_row = mysqli_fetch_row($admin_result);
        
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
    <link rel="stylesheet" href="https:////cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../assets/sidebar.css">
    <title>Moderator</title>
</head>
<?php if($admin_row[4] == "ADMIN_SUPER"): ?>

<body>



    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="bg-light border-right" id="sidebar-wrapper">
        <div class="sidebar-heading pb-5 font-italic text-center">
                <img style="width:100px;" src="../assets/images/NGClogo.png" alt="">
                <span>NextGenCoder</span>
            </div>
            <div class="list-group list-group-flush font-italic">
                <a href="./" class="list-group-item list-group-item-action bg-light"><i class="fas fa-chalkboard-teacher"></i>&nbsp;Dashboard</a>
                <a class="nav-link collapsed list-group-item list-group-item-action bg-light" href="#submenu1sub1"
                    data-toggle="collapse" data-target="#submenu1sub1"><i class="fas fa-users"></i>&nbsp;Users <span
                        class="float-right dropdown-toggle"></span></a>
                <div class="collapse small" id="submenu1sub1" aria-expanded="false">
                    <ul class="flex-column nav">
                        <li class="nav-item">
                            <a class="nav-link list-group-item list-group-item-action bg-light text-center"
                                style="border: none;" href="./"><i class="fas fa-eye"></i>&nbsp; View Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link list-group-item list-group-item-action bg-light text-center"
                                style="border: none;" href="./requested_users.php"><i class="fas fa-user-clock"></i>&nbsp;Request List</a>
                        </li>

                    </ul>
                </div>

                <a class="nav-link collapsed list-group-item list-group-item-action bg-light" href="#submenu1sub2"
                    data-toggle="collapse" data-target="#submenu1sub2"><i class="fas fa-tasks"></i>&nbsp;Moderator <span
                        class="float-right dropdown-toggle"></span></a>
                <div class="collapse small" id="submenu1sub2" aria-expanded="false">
                    <ul class="flex-column nav">
                        <li class="nav-item">
                            <a class="nav-link list-group-item list-group-item-action bg-light text-center"
                                style="border: none;" href="./moderator_add.php"><i class="fas fa-user-plus"></i>&nbsp;Add Moderator</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link list-group-item list-group-item-action bg-light text-center"
                                style="border: none;" href="./moderator.php"><i class="fas fa-users-cog"></i>&nbsp;&nbsp;&nbsp;&nbsp;Moderators</a>
                        </li>

                    </ul>
                </div>
                <a href="./results.php" class="list-group-item list-group-item-action bg-light"><i class="fas fa-code"></i>&nbsp;Results</a>

               


            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <div id="page-content-wrapper">

        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <button class="btn btn-light" id="menu-toggle">
                    <i class="fa fa-bars fa-lg" aria-hidden="true"></i>
                </button>

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                
                        <li class="nav-item dropdown">
                            <a class="nav-link font-italic" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ml-2 fa fa-user-circle fa-lg" aria-hidden="true"></i>

                            </a>
                            <div class="dropdown-menu dropdown-menu-right"style="width:250px;" aria-labelledby="navbarDropdown">
                                <span class="ml-5 p-2 font-italic"><?php echo $admin_row[1]; ?></span>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Profile</a>
                                <a class="dropdown-item" href="../model/logout_admin.php">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container-fluid">
                <div class="tab-pane mt-2" id="signup">
                    <div class="row justify-content-center">
                        <div class="col-6">
                        <div class="card">

                            <div class="card-header bg-dark text-light">
                                <h3 class="font-italic mt-2 text-center card-title">ADD MODERATOR</h3>

                            </div>


                            <div class="card-body">
                                <form action="../model/add_moderator.php" method="post">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input id="name" class="form-control" type="text" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">E-mail :</label>
                                        <input id="email" class="form-control" type="text" name="mail">
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password :</label>
                                        <input id="password" class="form-control" type="password" name="pass">
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-lg btn-info" type="submit">ADD</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                        </div>
                    </div>
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
        $(document).ready(function () {
            $('#users_row').DataTable();
            dom: 'frtip'
        });
    </script>
</body>
<?php endif; ?>

</html>
<?php 
}else{
        
}
?>