<?php
    session_start();
    if( isset( $_SESSION["LOGIN_ADMIN"])) {
        $login_admin = base64_decode($_SESSION["LOGIN_ADMIN"]);

        include('../model/connect-db.php');

        $admin_query = "SELECT * FROM admin WHERE id=$login_admin";
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
    <link rel="stylesheet" href="https:////cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../assets/sidebar.css">
    <title>Admin</title>
    <style>
        .cod {
            height: 180px;
            border-radius: 10px;

        }
        div.codes {
            overflow-y: scroll;
        }
       
    </style>
</head>
<?php 
    if($admin_row[4] == "ADMIN_SUPER"){
        echo "<script>window.location='../super/index.php'</script>";
    
    }
    else if($admin_row[4] == "ADMIN_MODERATOR"){ ?>
<body>
    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="bg-light border" id="sidebar-wrapper">
            <div class="sidebar-heading pb-5 font-italic text-center">
                <img style="width:100px;" src="../assets/images/NGClogo.png" alt="">
                <span>NextGenCoder</span>
            </div>
            <div class="list-group list-group-flush font-italic">
                <a href="./" class="list-group-item list-group-item-action bg-light"><i class="fas fa-chalkboard-teacher"></i>&nbsp;Dashboard</a>
                

                
               




            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <div id="page-content-wrapper" style="width:100%">

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
            <?php if($show_view == 1): ?>
            <div class="container codes col-10 border border-danger" style="width:100%; height:100vh;">
    
                <?php
                    $id = $_REQUEST['id'];
                    $show_view = "SELECT * FROM codes WHERE user_id=$id";
                    $res_view = mysqli_query($db, $show_view);
                    $row_view = mysqli_fetch_assoc($res_view);
                    $code_id = $row_view['id'];
                    if($row_view){
                    echo "<html>
                            <head><style>".$row_view['css']."</style></head>
                            <body>".$row_view['html'].
                            "<script>".$row_view['js']."</script>
                            
                            
                            </body>
                    
                    
                        </html>";
                    }else{
                        echo "Not Submitted Yet";
                    }

                ?>
            </div>
            <div class="container col-6">
                <div class="card">
               
                    <div class="card-header">
                        Evaluation
                    </div>
                    <div class="card-body">
                        <form action="../model/evaluate.php" method="post">
                            <input type="hidden" name="moderator_id" value="<?php echo $login_admin; ?>">

                            <input type="hidden" name="user_id" value="<?php echo $id; ?>">
                            <input type="hidden" name="code_id" value="<?php echo $code_id; ?>">


                            <div class="form-group row">
                                <label for="ui" class="col-3">UI:</label>
                                <div class="col-9">
                                    <input id="ui" class="form-control" type="number" name="ui">

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ux" class="col-3">UX:</label>
                                <div class="col-9">
                                    <input id="ux" class="form-control" type="number" name="ux">

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="interface" class="col-3">code-clean:</label>
                                <div class="col-9">
                                    <input id="interface" class="form-control" type="number" name="interface">

                                </div>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>

                        </form>
                        
                    </div>
                
             
                    
                </div>
            </div>
            <?php endif; ?>
            <div class="container">
                <div class="table-responsive">
                    <table class="table row-border table-light" id="users_row">
                        <thead class="thead-dark font-italic">
                            <tr>
                                <th>id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Evaluate</th>
                            </tr>
                        </thead>
                           
                        <tbody>
                            <?php
                                

                                $user_info = "SELECT users.*,codes.* FROM users INNER JOIN codes 
                                            ON users.id = codes.user_id";
                                $user_result = mysqli_query($db, $user_info);
                                // if(mysqli_num_row($user_result) > 0){
                                while($user_row = mysqli_fetch_assoc($user_result)){
                            ?>
                            <tr>
                                <td><?php echo $user_row['user_id']; ?></td>
                                <td><?php echo $user_row['name']; ?></td>
                                <td><?php echo $user_row['mail']; ?></td>
                                <td class="text-center">
                                <a class="text-info" href="./index.php?id=<?php echo $user_row['user_id']; ?>"><i class="fas fa-eye"></i></a>


                    
                                
                                </td>
                            </tr>
                            <?php } //} ?>
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
           
        });
    </script>
</body>
<?php } ?>
</html>
<?php 
}else{
        
}
?>