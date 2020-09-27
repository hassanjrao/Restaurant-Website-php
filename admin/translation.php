<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("location: login.php");
}

include('class/database.php');
class Translation extends database
{
    protected $link;
    public function getMenu()
    {

        $id = $_GET['id'];

        $sql = "select * from menu_starter_tb where id = '$id' ";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
    public function getDishMenu()
    {

        $id = $_GET['id'];

        $sql = "select * from menu_dish_tb where id = '$id' ";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
    public function getDessertMenu()
    {

        $id = $_GET['id'];

        $sql = "select * from menu_dessert_tb where id = '$id' ";
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
$objMenu = $obj->getMenu();
$objDishMenu = $obj->getDishMenu();
$objDessertMenu = $obj->getDessertMenu();

$categ = $_GET["cat"];

$rest_id=$_GET["rest_id"];


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

                    <?php

                    if ($categ == 1) {
                    ?>
                        <!-- Content Row -->
                        <div class="row">

                            <div class="col-lg-12">
                                <?php

                                $row = mysqli_fetch_assoc($objMenu)


                                ?>


                                <div class="card shadow mb-4">

                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Starter</h6>
                                    </div>


                                    <div class="card-body">

                                        <form method="POST" action="update_menu.php">
                                            <input type="hidden" name="menu_id" value="<?php echo $row['id']; ?>">
                                            <input type="hidden" name="rest_id" value="<?php echo $rest_id; ?>">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    Starter Name English
                                                    <input type="text" name="starter_en" value="<?php echo $row['starter_en'] == NULL ? "" : $row['starter_en']; ?>" class=" form-control" placeholder="Starter English" required>
                                                </div>

                                                <div class="col-md-6">
                                                    Starter Name Hebrew
                                                    <input type="text" name="starter_heb" value="<?php echo $row['starter_heb'] == NULL ? "" : $row['starter_heb']; ?>" class=" form-control" placeholder="Starter Heb" required>
                                                </div>

                                            </div>
                                            <br>
                                            <div class="row">

                                                <div class="col-md-6">
                                                    Starter Name French
                                                    <input type="text" name="starter_fr" value="<?php echo $row['starter_fr'] == NULL ? "" : $row['starter_fr']; ?>" class=" form-control" placeholder="Starter French" required>
                                                </div>
                                                <div class="col-md-6">
                                                    Starter Price
                                                    <input type="number" readonly name="price" value="<?php echo $row['price']; ?>" class="form-control " placeholder="Price" required>
                                                </div>
                                            </div>
                                            <br>

                                            <br>

                                            <button name="submit_starter" type="submit" class="btn btn-sm btn-primary">Submit</button>

                                        </form>

                                    </div>
                                </div>


                            </div>

                        </div>

                        <!-- Content Row -->
                    <?php
                    } else  if ($categ == 2) {
                    ?>
                        <!-- Content Row -->
                        <div class="row">

                            <div class="col-lg-12">
                                <?php

                                $row = mysqli_fetch_assoc($objDishMenu)


                                ?>



                                <div class="card shadow mb-4">

                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Dish</h6>
                                    </div>


                                    <div class="card-body">

                                        <form method="POST" action="update_menu.php">
                                            <input type="hidden" name="menu_id" value="<?php echo $row['id']; ?>">
                                            <input type="hidden" name="rest_id" value="<?php echo $rest_id; ?>">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    Dish Name English
                                                    <input type="text" name="dish_en" value="<?php echo $row['dish_en'] == NULL ? "" : $row['dish_en']; ?>" class=" form-control" placeholder="Dish English" required>
                                                </div>

                                                <div class="col-md-6">
                                                    Dish Name Hebrew
                                                    <input type="text" name="dish_heb" value="<?php echo $row['dish_heb'] == NULL ? "" : $row['dish_heb']; ?>" class=" form-control" placeholder="Dish Hebrew" required>
                                                </div>

                                            </div>
                                            <br>
                                            <div class="row">

                                                <div class="col-md-6">
                                                    Dish Name French
                                                    <input type="text" name="dish_fr" value="<?php echo $row['dish_fr'] == NULL ? "" : $row['dish_fr']; ?>" class=" form-control" placeholder="Dish French" required>
                                                </div>
                                                <div class="col-md-6">
                                                    Dish Price
                                                    <input type="number" readonly name="price" value="<?php echo $row['price']; ?>" class="form-control " placeholder="Price" required>
                                                </div>
                                            </div>
                                            <br>

                                            <br>

                                            <button name="submit_dish" type="submit" class="btn btn-sm btn-primary">Submit</button>

                                        </form>

                                    </div>
                                </div>



                            </div>

                        </div>

                        <!-- Content Row -->
                    <?php
                    } else  if ($categ == 3) {
                    ?>
                        <!-- Content Row -->
                        <div class="row">

                            <div class="col-lg-12">
                                <?php

                                $row = mysqli_fetch_assoc($objDessertMenu)


                                ?>


                                <div class="card shadow mb-4">

                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Dessert</h6>
                                    </div>

                                   
                                    <div class="card-body">

                                        <form method="POST" action="update_menu.php">
                                            <input type="hidden" name="menu_id" value="<?php echo $row['id']; ?>">
                                            <input type="hidden" name="rest_id" value="<?php echo $rest_id; ?>">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    Dessert Name English
                                                    <input type="text" name="dessert_en" value="<?php echo $row['dessert_en'] == NULL ? "" : $row['dessert_en']; ?>" class=" form-control" placeholder="Dessert English" required>
                                                </div>

                                                <div class="col-md-6">
                                                    Dessert Name Hebrew
                                                    <input type="text" name="dessert_heb" value="<?php echo $row['dessert_heb'] == NULL ? "" : $row['dessert_heb']; ?>" class=" form-control" placeholder="Dessert Hebrew" required>
                                                </div>

                                            </div>
                                            <br>
                                            <div class="row">

                                                <div class="col-md-6">
                                                    Dessert Name French
                                                    <input type="text" name="dessert_fr" value="<?php echo $row['dessert_fr'] == NULL ? "" : $row['dessert_fr']; ?>" class=" form-control" placeholder="Dessert French" required>
                                                </div>
                                                <div class="col-md-6">
                                                    Dessert Price
                                                    <input type="number" readonly name="price" value="<?php echo $row['price']; ?>" class="form-control " placeholder="Price" required>
                                                </div>
                                            </div>
                                            <br>

                                            <br>

                                            <button name="submit_dessert" type="submit" class="btn btn-sm btn-primary">Submit</button>

                                        </form>

                                    </div>
                                </div>

                            </div>

                        </div>

                        <!-- Content Row -->
                    <?php
                    }
                    ?>





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