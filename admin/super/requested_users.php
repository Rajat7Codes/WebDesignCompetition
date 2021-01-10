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
    <title>REQUESTED USERS</title>
    <style>
        .users_row input {
           
        }
    </style>
</head>

<body>
    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="bg-light border-right border-info" id="sidebar-wrapper">
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
                <a class="nav-link collapsed list-group-item list-group-item-action bg-light" href="#submenu2sub2"
                    data-toggle="collapse" data-target="#submenu2sub2">Insta-Challenges <span
                        class="float-right dropdown-toggle"></span></a>
                <div class="collapse small" id="submenu2sub2" aria-expanded="false">
                    <ul class="flex-column nav">
                        <li class="nav-item">
                            <a class="nav-link list-group-item list-group-item-action bg-light text-center"
                                style="border: none;" href="./"> View Challenges</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link list-group-item list-group-item-action bg-light text-center"
                                style="border: none;" href="./">Add Challenges</a>
                        </li>

                    </ul>
                </div>




            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <div id="page-content-wrapper" style="width:100%">

            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <button class="btn btn-light" style="border: none;" id="menu-toggle">
                    <h4>&#9776;</h4>
                </button>

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">


                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle font-italic" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php echo $admin_row[1]; ?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Profile</a>
                                <a class="dropdown-item" href="#"></a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../model/logout_admin.php">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>



            <div class="container">
                <div class="mt-3">
                    <table class="table row-border table-light" id="users_row">
                        <thead class="thead-dark font-italic">
                            <tr>
                                <th>id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                           
                        <tbody>
                            <?php
                                $user_info = "SELECT * FROM users WHERE request=0";
                                $user_result = mysqli_query($db, $user_info);
                                while($user_row = mysqli_fetch_assoc($user_result)){
                            ?>
                            <tr>
                                <td><?php echo $user_row['id']; ?></td>
                                <td><?php echo $user_row['name']; ?></td>
                                <td><?php echo $user_row['mail']; ?></td>
                                <td>
                                    <a class="btn btn-sm btn-info" href="../model/accept.php?id=<?php echo $user_row['id']; ?>">Accept</a>
                                    <a class="btn btn-sm btn-danger" href="../model/reject.php?id=<?php echo $user_row['id']; ?>">Reject</a> 
 
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>
            </div>
    </div>
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
            
            
        });
    </script>
</body>

</html>
<?php }else{
    
} ?>