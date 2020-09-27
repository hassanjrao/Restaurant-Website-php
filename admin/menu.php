<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("location: login.php");
}
include('class/database.php');
class menu extends database
{
    protected $link;
    public function getStarters()
    {

        $id = $_GET['id'];

        $sql = "select * from menu_starter_tb where rest_id = '$id' ";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }

    public function getDishes()
    {

        $id = $_GET['id'];

        $sql = "select * from menu_dish_tb where rest_id = '$id' ";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }

    public function getDesserts()
    {

        $id = $_GET['id'];

        $sql = "select * from menu_dessert_tb where rest_id = '$id' ";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
}
$obj = new menu;
$objMenu = $obj->getStarters();
$objDishMenu = $obj->getDishes();
$objDessertMenu = $obj->getDesserts();
$rest1_id = $_GET['id'];

$categ = $_GET["cat"];
// $row = mysqli_fetch_assoc($objProfile);


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - Menu</title>

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

                <!-- Page Heading -->
                <h1 class="h3 mb-2 ml-5 text-gray-800">Menu </h1>

                <br>
                <select id="change-dish" onchange="changeDish()" class="form-control w-25 ml-5">
                    <option selected disbled>Select Item</option>
                    <option value="1">Starters</option>
                    <option value="2">Dish</option>
                    <option value="3">Desserts</option>
                </select>
                <br>

                <?php
                if ($_GET["cat"] == 1) {

                ?>
                    <!-- Begin Page Content -->
                    <div class="container-fluid">


                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">



                            <?php
                            if (isset($_GET["msg"])) {
                                if (strcmp($_GET["msg"], 'success_upd') == 0) { ?>
                                    <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>Successfully Updated!</strong>
                                    </div>


                            <?php
                                }
                            } ?>

                            <?php
                            if (isset($_GET["msg"])) {
                                if (strcmp($_GET["msg"], 'fail_upd') == 0) { ?>
                                    <div class="alert alert-warning alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>Update Failed!</strong>
                                    </div>


                            <?php
                                }
                            } ?>

                            <div class="card-body">



                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Starter English</th>
                                                <th>Starter Hebrew</th>
                                                <th>Starter French</th>
                                                <th>Price</th>
                                                <th>Created</th>
                                                <th>Updated</th>
                                                <th>Edit</th>


                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Starter English</th>
                                                <th>Starter Hebrew</th>
                                                <th>Starter French</th>
                                                <th>Created</th>
                                                <th>Updated</th>
                                                <th>Price</th>

                                                <th>Edit</th>


                                            </tr>
                                        </tfoot>

                                        <tbody>

                                            <?php
                                            $a = 1;
                                            if ($objMenu) { ?>
                                                <?php while ($row = mysqli_fetch_assoc($objMenu)) { ?>
                                                    <tr>
                                                        <td><?php echo $a++ ?></td>


                                                        <td><?php echo $row['starter_en']; ?></td>
                                                        <td><?php echo $row['starter_heb']; ?></td>
                                                        <td><?php echo $row['starter_fr']; ?></td>
                                                        <td><?php echo $row['price']; ?></td>
                                                        <td><?php echo $row['created']; ?></td>
                                                        <td><?php echo $row['updated']; ?></td>


                                                        <td><a href="translation.php?<?php
                                                                                        $id = $row["id"];
                                                                                        $rest_id = $_GET["id"];
                                                                                        echo "id=$id&rest_id=$rest_id&cat=$categ" ?>" class="btn btn-success btn-sm">

                                                                <span class="text">Edit</span>
                                                            </a></td>

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

                <?php
                }
                ?>

                <?php
                if ($_GET["cat"] == 2) {

                ?>
                    <!-- Begin Page Content -->
                    <div class="container-fluid">


                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">


                            <?php
                            if (isset($_GET["msg"])) {
                                if (strcmp($_GET["msg"], 'success_upd') == 0) { ?>
                                    <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>Successfully Updated!</strong>
                                    </div>


                            <?php
                                }
                            } ?>

                            <?php
                            if (isset($_GET["msg"])) {
                                if (strcmp($_GET["msg"], 'fail_upd') == 0) { ?>
                                    <div class="alert alert-warning alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>Update Failed!</strong>
                                    </div>


                            <?php
                                }
                            } ?>

                            <div class="card-body">



                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Dish English</th>
                                                <th>Dish Hebrew</th>
                                                <th>Dish French</th>
                                                <th>Price</th>
                                                <th>Created</th>
                                                <th>Updated</th>
                                                <th>Edit</th>


                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Dish English</th>
                                                <th>Dish Hebrew</th>
                                                <th>Dish French</th>
                                                <th>Created</th>
                                                <th>Updated</th>
                                                <th>Price</th>

                                                <th>Edit</th>


                                            </tr>
                                        </tfoot>

                                        <tbody>

                                            <?php
                                            $a = 1;

                                            if ($objDishMenu) { ?>
                                                <?php while ($row = mysqli_fetch_assoc($objDishMenu)) { ?>
                                                    <tr>
                                                        <td><?php echo $a++ ?></td>


                                                        <td><?php echo $row['dish_en']; ?></td>
                                                        <td><?php echo $row['dish_heb']; ?></td>
                                                        <td><?php echo $row['dish_fr']; ?></td>
                                                        <td><?php echo $row['price']; ?></td>
                                                        <td><?php echo $row['created']; ?></td>
                                                        <td><?php echo $row['updated']; ?></td>


                                                        <td><a href="translation.php?<?php
                                                                                        $id = $row["id"];
                                                                                        $rest_id = $_GET["id"];
                                                                                        echo "id=$id&rest_id=$rest_id&cat=$categ" ?>" class="btn btn-success btn-sm">

                                                                <span class="text">Edit</span>
                                                            </a></td>

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

                <?php
                }
                ?>

                <?php
                if ($_GET["cat"] == 3) {

                ?>
                    <!-- Begin Page Content -->
                    <div class="container-fluid">


                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">

                            <?php
                            if (isset($_GET["msg"])) {
                                if (strcmp($_GET["msg"], 'success_upd') == 0) { ?>
                                    <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>Successfully Updated!</strong>
                                    </div>


                            <?php
                                }
                            } ?>

                            <?php
                            if (isset($_GET["msg"])) {
                                if (strcmp($_GET["msg"], 'fail_upd') == 0) { ?>
                                    <div class="alert alert-warning alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>Update Failed!</strong>
                                    </div>


                            <?php
                                }
                            } ?>

                            <div class="card-body">



                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Dessert English</th>
                                                <th>Dessert Hebrew</th>
                                                <th>Dessert French</th>
                                                <th>Price</th>
                                                <th>Created</th>
                                                <th>Updated</th>
                                                <th>Edit</th>


                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Dessert English</th>
                                                <th>Dessert Hebrew</th>
                                                <th>Dessert French</th>
                                                <th>Created</th>
                                                <th>Updated</th>
                                                <th>Price</th>

                                                <th>Edit</th>


                                            </tr>
                                        </tfoot>

                                        <tbody>

                                            <?php
                                            $a = 1;
                                            if ($objDessertMenu) { ?>
                                                <?php while ($row = mysqli_fetch_assoc($objDessertMenu)) { ?>
                                                    <tr>
                                                        <td><?php echo $a++ ?></td>


                                                        <td><?php echo $row['dessert_en']; ?></td>
                                                        <td><?php echo $row['dessert_heb']; ?></td>
                                                        <td><?php echo $row['dessert_fr']; ?></td>
                                                        <td><?php echo $row['price']; ?></td>
                                                        <td><?php echo $row['created']; ?></td>
                                                        <td><?php echo $row['updated']; ?></td>


                                                        <td><a href="translation.php?<?php
                                                                                        $id = $row["id"];
                                                                                        $rest_id = $_GET["id"];
                                                                                        echo "id=$id&rest_id=$rest_id&cat=$categ" ?>" class="btn btn-success btn-sm">

                                                                <span class="text">Edit</span>
                                                            </a></td>

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

                <?php
                }
                ?>

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
    <!-- <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    </div> -->

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

    <script>
        function changeDish() {
            var cat = document.getElementById("change-dish").value;
            location.replace("<?php echo "menu.php?id=$rest1_id&cat=" ?>" + cat);
        }
    </script>

</body>

</html>