<?php
session_start();
if(!isset( $_SESSION['name'])){
    header("location: login.php");
}
include('class/database.php');
class ServiceEdit extends database
{
    protected $link;
    public function getService()
    {


        $id = $_GET['id'];

        $sql = "select * from services_tb where id = '$id' ";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }

    public function updateService()
    {

        if (isset($_POST['submit'])) {
            $id = $_GET['id'];

            $service_en = strtolower($_POST['service_en']);
            $service_heb = strtolower($_POST['service_heb']);
            $service_fr = strtolower($_POST['service_fr']);



            $sql = "UPDATE services_tb SET service_en='$service_en', service_heb='$service_heb', service_fr='$service_fr' , updated=CURRENT_TIMESTAMP where id='$id'";
            $res = mysqli_query($this->link, $sql);


            if ($res) {
                $msg = "success_upd";
                header("location: services.php?msg=$msg");
                return true;
            } else {
                $msg = "fail_upd";
                header("location: services.php?msg=$msg");
                return false;
            }
        }
    }
}
$obj = new ServiceEdit;
$objService = $obj->getService();
$objUpdateService = $obj->updateService();

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Restaurant - Edit Service</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Edit Service</h1>

                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-lg-12">
                            <?php

                            $row = mysqli_fetch_assoc($objService)


                            ?>

                            <!-- ------Menu English Starts -->
                            <div class="card shadow mb-4">

                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Edit Service Information</h6>
                                </div>
                                <div class="card-body">

                                    <?php if (strcmp($objUpdateService, 'taken') == 0) { ?>
                                        <div class="alert alert-warning alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <strong>Restaurant Name Is Already Taken!</strong>
                                        </div>


                                    <?php } ?>



                                    <form action="" method="post">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Service Information
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body bg-light">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        Service Name English
                                                        <input type="text" required name="service_en" value="<?php echo $row["service_en"] ?>" class="border-0 form-control" placeholder="Service Name English">
                                                    </div>
                                                    <div class="col-md-4">
                                                        Service Name Hebrew
                                                        <input type="text" name="service_heb" value="<?php echo $row["service_heb"] ?>" class="border-0 form-control" placeholder="Service Name Hebrew">
                                                    </div>
                                                    <div class="col-md-4">
                                                        Service Name French
                                                        <input type="text" name="service_fr" value="<?php echo $row["service_fr"] ?>" class="border-0 form-control" placeholder="Service Name French">
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

                            <!-- Menu English Ends -->












                        </div>

                    </div>

                    <!-- Content Row -->



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
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>