<?php
session_start();


if (!isset($_SESSION['Rname'])) {
    header('location:restaurant_login.php');
}


include('class/database.php');
class DashBoard extends database
{
    protected $link;
    public function photoFunction()
    {
        $name = $_SESSION['Rname'];
        $sql = "SELECT * FROM `restaurant_feature` where rest_name = '$name' ";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }

    public function count($table)
    {


        $sql = "SELECT * FROM $table";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return mysqli_num_rows($res);
        } else {
            return 0;
        }
    }

    public function countNotes()
    {
        $rest_id = $_SESSION['rest_id'];

        $sql = "SELECT * FROM notes_tb where rest_id='$rest_id'";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return mysqli_num_rows($res);
        } else {
            return 0;
        }
    }

    public function countImages()
    {
        $rest_id = $_SESSION['rest_id'];

        $sql = "SELECT * FROM rest_images where rest_id='$rest_id'";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return mysqli_num_rows($res);
        } else {
            return 0;
        }
    }

    public function countStarters()
    {
        $rest_id = $_SESSION['rest_id'];

        $sql = "SELECT * FROM menu_starter_tb where rest_id='$rest_id'";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return mysqli_num_rows($res);
        } else {
            return 0;
        }
    }

    public function countDishes()
    {
        $rest_id = $_SESSION['rest_id'];

        $sql = "SELECT * FROM menu_dish_tb where rest_id='$rest_id'";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return mysqli_num_rows($res);
        } else {
            return 0;
        }
    }

    public function countDesserts()
    {
        $rest_id = $_SESSION['rest_id'];

        $sql = "SELECT * FROM menu_dessert_tb where rest_id='$rest_id'";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return mysqli_num_rows($res);
        } else {
            return 0;
        }
    }

    public function countReservations()
    {

        $name = $_SESSION['Rname'];

        $sql = "SELECT * FROM reservation_tbl where rest_name='$name' and user_confirm='1'";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return mysqli_num_rows($res);
        } else {
            return 0;
        }
    }
}
$obj = new DashBoard;

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>כללי </title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        img {
            width: 100%;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include('sidebar_heb.php'); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- topbar -->
                <?php include('topbar.php'); ?>
                <!-- End of topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">כללי</h1>




                    <div class="row">

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">
                                            הערות</div>


                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $obj->countNotes(); ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="far fa-clipboard fa-2x text-gray-300"></i>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- ------------ -->


                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">
                                            תמונות</div>


                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $obj->countImages(); ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">

                                            <i class="far fa-images fa-2x text-gray-300"></i>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ---------------------------- -->


                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">
                                            תפריט</div>


                                            <div class="mb-0 font-weight-bold text-gray-800">ראשונות: <?php echo $obj->countStarters(); ?>
                                            </div>
                                            <div class="mb-0 font-weight-bold text-gray-800">עיקריות: <?php echo $obj->countDishes(); ?>
                                            </div>
                                            <div class=" mb-0  font-weight-bold text-gray-800">קינוחים: <?php echo $obj->countDesserts(); ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-bars fa-2x text-gray-300"></i>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- ----------------------------------------------- -->


                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">
                                            הזמנה</div>


                                            <div class="mb-0 font-weight-bold text-gray-800"> <?php echo $obj->countReservations(); ?>
                                            </div>

                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-cart-arrow-down fa-2x text-gray-300"></i>

                                        </div>
                                    </div>
                                </div>
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
                    <a class="btn btn-primary" href="logout.php">Logout</a>
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