<?php
include('class/database.php');
class restaurant extends database
{
    protected $link;
    public function restaurantFunction()
    {
        $sqlRest = "select * from restaurant_tbl";
        $resRest = mysqli_query($this->link, $sqlRest);
        if (mysqli_num_rows($resRest) > 0) {
            return $resRest;
        } else {
            return false;
        }
        # code...
    }
    public function createRestaurant()
    {
        if (isset($_POST['submit'])) {
            $name = addslashes($_POST['name']);
            $address = addslashes($_POST['address']);
            $email = addslashes($_POST['email']);
            $password = addslashes($_POST['password']);
            $payment = $name . "_payment";
            $phone = $_POST['phone'];
            $image = "placeholder-16-9.jpg";
            $gallery1 = "placeholder-16-9.jpg";
            $gallery2 = "placeholder-16-9.jpg";
            $gallery3 = "placeholder-16-9.jpg";

            $pass = password_hash($password, PASSWORD_DEFAULT);

            $sqlFind = "select * from restaurant_tbl where name = '$name' ";
            $resFind = mysqli_query($this->link, $sqlFind);
            if (mysqli_num_rows($resFind) > 0) {
                $msg = "taken";
                return $msg;
            } else {
                $sql = "INSERT INTO `restaurant_tbl` (`id`, `name`, `speciality`, `kosher`, `phone`, `address`, `image`, `gallery1`, `gallery2`, `gallery3`, `email`, `password`, `created`, `updated`) VALUES (NULL, '$name', '', '', '$phone', '$address', '$image', '$gallery1', '$gallery2', '$gallery3', '$email', '$pass', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
                $res = mysqli_query($this->link, $sql);
                if ($res) {
                    $sql2 = "CREATE TABLE $name (
                        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                        name VARCHAR(30) NOT NULL,
                        time VARCHAR(30) NOT NULL,
                        sun VARCHAR(50),
                        mon VARCHAR(50),
                        tues VARCHAR(50),
                        wed VARCHAR(50),
                        thur VARCHAR(50),
                        frid VARCHAR(50),
                        sat VARCHAR(50),
                        psun VARCHAR(50),
                        pmon VARCHAR(50),
                        ptues VARCHAR(50),
                        pwed VARCHAR(50),
                        pthur VARCHAR(50),
                        pfrid VARCHAR(50),
                        psat VARCHAR(50),
                        created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                        )";
                    $res2 = mysqli_query($this->link, $sql2);
                    $sqlPay = "CREATE TABLE $payment (
                        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                        name VARCHAR(30) NOT NULL,
                        month VARCHAR(30) NOT NULL,
                        client INT(11),
                        amount INT(11),
                        status VARCHAR(30),
                        
                        created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                        )";

                    $resPay = mysqli_query($this->link, $sqlPay);
                    if ($res2) {
                        $sql3 = "INSERT INTO `$name` (`id`, `name`, `time`, `sun`, `mon`, `tues`, `wed`, `thur`, `frid`, `sat`,`psun`, `pmon`, `ptues`, `pwed`, `pthur`, `pfrid`, `psat`, `created`) VALUES (NULL, '$name', '9:00-10:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL, NULL, NULL, NULL, NULL, CURRENT_TIMESTAMP),(NULL, '$name', '10:00-11:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL, NULL, NULL, NULL, NULL, CURRENT_TIMESTAMP),(NULL, '$name', '11:00-12:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL, NULL, NULL, NULL, NULL, CURRENT_TIMESTAMP),(NULL, '$name', '12:00-13:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL, NULL, NULL, NULL, NULL, CURRENT_TIMESTAMP),(NULL, '$name', '13:00-14:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL, NULL, NULL, NULL, NULL, CURRENT_TIMESTAMP),(NULL, '$name', '14:00-15:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL, NULL, NULL, NULL, NULL, CURRENT_TIMESTAMP),(NULL, '$name', '15:00-16:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL, NULL, NULL, NULL, NULL, CURRENT_TIMESTAMP),(NULL, '$name', '16:00-17:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL, NULL, NULL, NULL, NULL, CURRENT_TIMESTAMP),(NULL, '$name', '17:00-18:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL, NULL, NULL, NULL, NULL, CURRENT_TIMESTAMP),(NULL, '$name', '18:00-19:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL, NULL, NULL, NULL, NULL, CURRENT_TIMESTAMP),(NULL, '$name', '19:00-20:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL, NULL, NULL, NULL, NULL, CURRENT_TIMESTAMP),(NULL, '$name', '20:00-21:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL, NULL, NULL, NULL, NULL, CURRENT_TIMESTAMP),(NULL, '$name', '21:00-22:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL, NULL, NULL, NULL, NULL, CURRENT_TIMESTAMP),(NULL, '$name', '22:00-23:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL, NULL, NULL, NULL, NULL, CURRENT_TIMESTAMP)";
                        $res3 = mysqli_query($this->link, $sql3);
                        $sqlPay2 = "INSERT INTO `$payment` (`id`, `name`, `month`, `client`, `amount`, `status`, `created`) VALUES (NULL, '$name', 'January', NULL, NULL, NULL, CURRENT_TIMESTAMP),(NULL, '$name', 'February', NULL, NULL, NULL, CURRENT_TIMESTAMP), (NULL, '$name', 'March', NULL, NULL, NULL, CURRENT_TIMESTAMP),(NULL, '$name', 'April', NULL, NULL, NULL, CURRENT_TIMESTAMP),(NULL, '$name', 'May', NULL, NULL, NULL, CURRENT_TIMESTAMP),(NULL, '$name', 'Jun', NULL, NULL, NULL, CURRENT_TIMESTAMP),(NULL, '$name', 'July', NULL, NULL, NULL, CURRENT_TIMESTAMP),(NULL, '$name', 'August', NULL, NULL, NULL, CURRENT_TIMESTAMP),(NULL, '$name', 'September', NULL, NULL, NULL, CURRENT_TIMESTAMP),(NULL, '$name', 'October', NULL, NULL, NULL, CURRENT_TIMESTAMP),(NULL, '$name', 'November', NULL, NULL, NULL, CURRENT_TIMESTAMP),(NULL, '$name', 'December', NULL, NULL, NULL, CURRENT_TIMESTAMP)";


                        $resPay2 = mysqli_query($this->link, $sqlPay2);

                        if ($res3) {
                            header('location:tables.php');
                            return $res3;
                        }
                        header('location:tables.php');
                        return $res2;
                    }
                } else {
                    return false;
                }
            }
        }
        # code...
    }
}
$obj = new restaurant;
$objRest = $obj->restaurantFunction();
$objCreate = $obj->createRestaurant();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Tables</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include('sidebar_admin.php'); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>






                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Restaurants List</h1>


                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <button class="btn btn-primary mt-3" data-toggle="modal" data-target="#exampleModal">Create
                                Restaurant</button>
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <form action="" method="post">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Restaurant Information
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body bg-light">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input type="text" name="name" class="border-0 form-control" placeholder="Restaurant Name">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="email" name="email" class="form-control border-0" placeholder="Restaurant Email">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 mt-3">
                                                        <input type="password" name="password" class="form-control border-0" placeholder="Password">
                                                    </div>
                                                    <div class="col-md-6 mt-3">
                                                        <input type="text" name="phone" class="form-control border-0" placeholder="Phone Number">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 mt-3">
                                                        <input type="text" name="address" class="form-control border-0" placeholder="Address">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <?php if (strcmp($objCreate, 'taken') == 0) { ?>
                                <div class="alert alert-warning alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Restaurant Name Is Taken!</strong>
                                </div>


                            <?php } ?>

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Created</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Created</th>


                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php if ($objRest) { ?>
                                            <?php while ($row = mysqli_fetch_assoc($objRest)) { ?>
                                                <tr>
                                                    <td><?php echo $row['id']; ?></td>
                                                    <td><?php echo $row['name']; ?></td>
                                                    <td><?php echo $row['address']; ?></td>
                                                    <td><?php echo $row['created']; ?></td>

                                                </tr>
                                            <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.php">Logout</a>
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

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>