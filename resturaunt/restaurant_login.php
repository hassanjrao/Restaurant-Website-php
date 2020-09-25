<?php
session_start();
include('class/database.php');
class login extends database
{
    protected $link;
    public function loginFunction()
    {
        if (isset($_POST['login'])) {
            $username = $_POST['name'];
            $password = $_POST['password'];

            $sqlFind = "select * from restaurant_tbl where name_en = '$username' ";
            $resFind = mysqli_query($this->link, $sqlFind);
            if (mysqli_num_rows($resFind) > 0) {
                $row = mysqli_fetch_assoc($resFind);
                $pass = $row['password'];
                if (password_verify($password, $pass) == true) {
                    $_SESSION['Rname'] = $username;
                    $_SESSION['rest_id'] = $row["id"];
                    header('location:index.php');
                    return $resFind;
                } else {
                    $msg = "wrong password";

                    return $msg;
                }
            } else {
                $msg = "Please register";
                return $msg;
            }
        }

        # code...
    }
}
$obj = new login;
$objLogin = $obj->loginFunction();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Resturaunt Panel - Login </title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>


<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back To Your Restaurant!</h1>
                                    </div>
                                    <?php if (strcmp($objLogin, 'wrong password') == 0) { ?>
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>Wrong Password!</strong>
                                    </div>
                                    <?php } ?>
                                    <?php if (strcmp($objLogin, 'Please register') == 0) { ?>
                                    <div class="alert alert-warning alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>Please register from owner!</strong>
                                    </div>
                                    <?php } ?>
                                    <form class="user" action="" method="post">
                                        <div class="form-group">
                                            <input name="name" type="text" class="form-control form-control-user"
                                                value="" id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Restaurant Name">
                                        </div>
                                        <div class="form-group">
                                            <input name="password" type="password"
                                                class="form-control form-control-user" id="exampleInputPassword"
                                                placeholder="Password">
                                        </div>

                                        <input type="submit" name="login" class="btn btn-primary btn-user btn-block"
                                            value="login">

                                        <hr>
                                        <a href="index.php" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.php" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a>
                                    </form>
                                    <hr>

                                    <!-- <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>