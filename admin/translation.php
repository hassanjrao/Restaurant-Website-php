<?php
session_start();
if ($_SESSION['name']) {
} else {
    header('location:login.php');
}

include('class/database.php');
class Translation extends database
{
    protected $link;
    public function getMenu()
    {

        $id = $_GET['id'];

        $sql = "select * from menu_tb where id = '$id' ";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
}
$obj = new Translation;
$objMenu = $obj->getmenu();


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - Translation</title>

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
                        <h1 class="h3 mb-0 text-gray-800">Add Translation</h1>

                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-lg-12">
                            <?php

                            $row = mysqli_fetch_assoc($objMenu)


                            ?>

                            <!-- ------Menu English Starts -->
                            <div class="card shadow mb-4">

                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Menu English</h6>
                                </div>
                                <div class="card-body">

                                    <form method="POST" action="update_menu.php">
                                        <input type="hidden" name="menu_id" value="<?php echo $row['id']; ?>">
                                        <div class="row">
                                            <div class="col-md-6">
                                                Starter Name
                                                <input type="text" name="starter_name" value="<?php echo $row['starter_name_en'] == NULL ? "" : $row['starter_name_en']; ?>" class=" form-control" placeholder="Starter" required>
                                            </div>
                                            <div class="col-md-6">
                                                Starter Price
                                                <input type="number" readonly name="starter_price" value="<?php echo $row['starter_price']; ?>" class="form-control " placeholder="Starter Price" required>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                Dish Name
                                                <input type="text" name="dish_name" value="<?php echo $row['dish_name_en'] == NULL ? "" : $row['dish_name_en']; ?>" class=" form-control" placeholder="Dish" required>
                                            </div>
                                            <div class="col-md-6">
                                                Starter Price
                                                <input type="number" readonly name="dish_price" value="<?php echo $row['dish_price']; ?>" class="form-control " placeholder="Dish Price" required>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                Dessert Name
                                                <input type="text" name="dessert_name" value="<?php echo $row['dessert_name_en'] == NULL ? "" : $row['dessert_name_en']; ?>" class=" form-control" placeholder="Dessert" required>
                                            </div>
                                            <div class="col-md-6">
                                                Dessert Price
                                                <input type="number" readonly name="dessert_price" value="<?php echo $row['dessert_price']; ?>" class="form-control " placeholder="Dessert Price" required>
                                            </div>
                                        </div>

                                        <br>

                                        <button name="submit_en" type="submit" class="btn btn-sm btn-primary">Submit</button>

                                    </form>

                                </div>
                            </div>

                            <!-- Menu English Ends -->



                            <!-- ------Menu Hebrew Starts -->

                            <div class="card shadow mb-4">

                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Menu Hebrew</h6>
                                </div>
                                <div class="card-body">

                                    <form method="POST" action="update_menu.php">

                                        <input type="hidden" name="menu_id" value="<?php echo $row['id']; ?>">

                                        <div class="row">
                                            <div class="col-md-6">
                                                Starter Name
                                                <input type="text" name="starter_name" value="<?php echo $row['starter_name_heb'] == NULL ? "" : $row['starter_name_heb']; ?>" class=" form-control" placeholder="Starter" required>
                                            </div>
                                            <div class="col-md-6">
                                                Starter Price
                                                <input type="number" readonly name="starter_price" value="<?php echo $row['starter_price']; ?>" class="form-control " placeholder="Starter Price" required>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                Dish Name
                                                <input type="text" name="dish_name" value="<?php echo $row['dish_name_heb'] == NULL ? "" : $row['dish_name_heb']; ?>" class=" form-control" placeholder="Dish" required>
                                            </div>
                                            <div class="col-md-6">
                                                Starter Price
                                                <input type="number" readonly name="dish_price" value="<?php echo $row['dish_price']; ?>" class="form-control " placeholder="Dish Price" required>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                Dessert Name
                                                <input type="text" name="dessert_name" value="<?php echo $row['dessert_name_heb'] == NULL ? "" : $row['dessert_name_heb']; ?>" class=" form-control" placeholder="Dessert" required>
                                            </div>
                                            <div class="col-md-6">
                                                Dessert Price
                                                <input type="number" readonly name="dessert_price" value="<?php echo $row['dessert_price']; ?>" class="form-control " placeholder="Dessert Price" required>
                                            </div>
                                        </div>

                                        <br>
                                        <button name="submit_heb" type="submit" class="btn btn-sm btn-primary">Submit</button>
                                    </form>

                                </div>
                            </div>

                            <!--  ------Menu Hebrew Ends -->




                            <!-- ------Menu French Starts -->

                            <div class="card shadow mb-4">

                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Menu French</h6>
                                </div>
                                <div class="card-body">

                                    <form method="POST" action="update_menu.php">
                                        <input type="hidden" name="menu_id" value="<?php echo $row['id']; ?>">

                                        <div class="row">
                                            <div class="col-md-6">
                                                Starter Name
                                                <input type="text" name="starter_name" value="<?php echo $row['starter_name_fr'] == NULL ? "" : $row['starter_name_fr']; ?>" class=" form-control" placeholder="Starter" required>
                                            </div>
                                            <div class="col-md-6">
                                                Starter Price
                                                <input type="number" readonly name="starter_price" value="<?php echo $row['starter_price']; ?>" class="form-control " placeholder="Starter Price" required>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                Dish Name
                                                <input type="text" name="dish_name" value="<?php echo $row['dish_name_fr'] == NULL ? "" : $row['dish_name_fr']; ?>" class=" form-control" placeholder="Dish" required>
                                            </div>
                                            <div class="col-md-6">
                                                Starter Price
                                                <input type="number" readonly name="dish_price" value="<?php echo $row['dish_price']; ?>" class="form-control " placeholder="Dish Price" required>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                Dessert Name
                                                <input type="text" name="dessert_name" value="<?php echo $row['dessert_name_fr'] == NULL ? "" : $row['dessert_name_fr']; ?>" class=" form-control" placeholder="Dessert" required>
                                            </div>
                                            <div class="col-md-6">
                                                Dessert Price
                                                <input type="number" readonly name="dessert_price" value="<?php echo $row['dessert_price']; ?>" class="form-control " placeholder="Dessert Price" required>
                                            </div>
                                        </div>

                                        <br>
                                        <button name="submit_fr" type="submit" class="btn btn-sm btn-primary">Submit</button>
                                    </form>

                                </div>
                            </div>

                            <!--  ------Menu French Ends -->







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