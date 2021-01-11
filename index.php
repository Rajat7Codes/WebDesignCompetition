<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <title>Login & Register</title>
    <style>
        
    </style>
</head>

<body>
    <div class="container col-3">
        <ul class="nav nav-tabs text-right">
            <li class="nav-item">
                <a href="#signin" class="nav-link bg-light text-dark" data-toggle="tab">LogIn</a>
            </li>
            <li class="nav-item">
                <a href="#signup" class="nav-link bg-light text-dark" data-toggle="tab">SignUp</a>
            </li>

        </ul>
        <div class="tab-content border border-info">
            <div class="tab-pane fade show active" id="signin">
                <div class="row justify-content-center">
                    <div class="col card">
                        <h3 class="font-italic mt-2 text-center card-title">User Login</h3>
                        <div class="card-body">
                            <form action="user/login_User.php" method="post">
                                <div class="form-group">
                                    <label for="email">E-mail :</label>
                                    <input id="email" class="form-control" type="text" name="mail">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password :</label>
                                    <input id="password" class="form-control" type="password" name="pass">
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-info" type="submit">Login</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="signup">
                <div class="row justify-content-center">
                    <div class="col card">
                        <h3 class="font-italic mt-2 text-center card-title">User Register</h3>
                        <div class="card-body">
                            <form action="user/register_User.php" method="post">
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
                                    <input id="password" class="form-control" type="text" name="pass">
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-info" type="submit">Login</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.min.js"></script>
</body>

</html>