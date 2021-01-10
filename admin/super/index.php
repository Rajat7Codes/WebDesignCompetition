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
    <title>Admin</title>
    <style>
        .cod {
            height: 150px;
            border-radius: 10px;

        }
       
    </style>
</head>

<body>
    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="bg-light border" id="sidebar-wrapper">
            <div class="sidebar-heading pb-5 font-italic text-center">
                <img style="width:100px;" src="../assets/images/NGClogo.png" alt="">
                <span>NextGenCoder</span>
            </div>
            <div class="list-group list-group-flush">
                <a href="./" class="list-group-item list-group-item-action bg-light">Dashboard</a>
                <a class="nav-link collapsed list-group-item list-group-item-action bg-light" href="#submenu1sub1"
                    data-toggle="collapse" data-target="#submenu1sub1">Users <span
                        class="float-right dropdown-toggle"></span></a>
                <div class="collapse small" id="submenu1sub1" aria-expanded="false">
                    <ul class="flex-column nav">
                        <li class="nav-item">
                            <a class="nav-link list-group-item list-group-item-action bg-light text-center"
                                style="border: none;" href="./all_users.php"> View Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link list-group-item list-group-item-action bg-light text-center"
                                style="border: none;" href="./requested_users.php">Request List</a>
                        </li>

                    </ul>
                </div>
               




            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <div id="page-content-wrapper" style="width:100%">

            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <button class="btn btn-light" id="menu-toggle">
                    <i class="fa fa-bars fa-2x" aria-hidden="true"></i>
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
                                <i class="ml-2 fa fa-user-circle fa-2x" aria-hidden="true"></i>

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

            <div class="container p-3">
                <div class="row justify-content-center text-light text-center font-italic">
                    <?php 
                            $user_reg = mysqli_query($db ,"SELECT * FROM users WHERE request=1");
                            $user_all = mysqli_num_rows($user_reg);
                            $user_re = mysqli_query($db ,"SELECT * FROM users WHERE request=0");
                            $user_co = mysqli_num_rows($user_re);
                            $user_de = mysqli_query($db ,"SELECT * FROM users WHERE request=2");
                            $user_decline = mysqli_num_rows($user_de);
                    ?>
                    <div class="col-sm-3 cod m-4 bg-success border border-success">
                        <div class="fa fa-users fa-5x "></div>
                         <br>
                            <span>ACCEPTED <br><?php echo $user_all; ?></span>
                    </div>
                    <div class="col-sm-3 cod m-4 bg-info border-info">
                        <div class="fa fa-envelope fa-5x">
                            
                        </div>
                         <br>
                            <span>PENDING <br><?php echo $user_co; ?></span>
                    </div>
                    <div class="col-sm-3 cod m-4 bg-danger border-danger">
                        <div class="fa fa-ban fa-5x">
                            
                        </div><br>
                        <span>DECLINE<br><?php echo $user_decline; ?></span>
                    </div>

                </div>
            </div>
            <div class="container">
                <div class="table-responsive">
                    <table class="table row-border table-light" id="users_row">
                        <thead class="thead-dark font-italic">
                            <tr>
                                <th>id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                           
                        <tbody>
                            <?php
                                $user_info = "SELECT * FROM users";
                                $user_result = mysqli_query($db, $user_info);
                                while($user_row = mysqli_fetch_assoc($user_result)){
                            ?>
                            <tr>
                                <td><?php echo $user_row['id']; ?></td>
                                <td><?php echo $user_row['name']; ?></td>
                                <td><?php echo $user_row['mail']; ?></td>
                                <td>
                                    <?php if($user_row['request'] == 0): ?>
                                        <span class="badge badge-pill badge-warning">pending</span>
                                    <?php elseif($user_row['request'] == 1): ?>
                                        <span class="badge badge-pill badge-success">accepted</span>
                                    <?php elseif($user_row['request'] == 2): ?>
                                        <span class="badge badge-pill badge-danger">rejected</span>
                                    <?php endif; ?>

                    
                                
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>

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

</html>
<?php 
}else{
        
}
?>