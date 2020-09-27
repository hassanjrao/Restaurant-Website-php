<?php
session_start();
if(!isset( $_SESSION['name'])){
    header("location: login.php");
}
include('class/database.php');
class menu extends database
{
    protected $link;
    public function getMenu()
    {

        $id = $_GET['id'];

        $sql = "select * from menu_tb where rest_id = '$id' ";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }


    public function saveFunction()
    {
        if (isset($_POST['submit'])) {
            $rest_id = $_SESSION['rest_id'];

            $starter = $_POST['starter_name'];
            $s_price = $_POST["starter_price"];
            $dish = $_POST['dish_name'];
            $d_price = $_POST["dish_price"];
            $dessert = $_POST['dessert_name'];
            $ds_price = $_POST["dessert_price"];

            $sql = "INSERT INTO `menu` (`starter_name`, `starter_price`, `dish_name`, `dish_price`, `dessert_name`, `dessert_price`,`rest_id`) VALUES ('$starter', '$s_price', '$dish', '$d_price', '$dessert', '$ds_price', '$rest_id')";
            $res = mysqli_query($this->link, $sql);

            header("location: menu.php");
        }
        # code...
    }
}
$obj = new menu;
$objMenu = $obj->getmenu();
$objCreate = $obj->saveFunction();

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

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Menu </h1>


                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">


                        <div class="card-body">



                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Starter</th>
                                            <th>Starter Price</th>
                                            <th>Dish</th>
                                            <th>Dish Price</th>
                                            <th>Dessert</th>
                                            <th>Dessert Price</th>
                                            <th>Add Translation</th>


                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Starter</th>
                                            <th>Starter Price</th>
                                            <th>Dish</th>
                                            <th>Dish Price</th>
                                            <th>Dessert</th>
                                            <th>Dessert Price</th>
                                            <th>Add Translation</th>


                                        </tr>
                                    </tfoot>

                                    <tbody>

                                        <?php
                                        $a = 1;
                                        if ($objMenu) { ?>
                                            <?php while ($row = mysqli_fetch_assoc($objMenu)) { ?>
                                                <tr>
                                                    <td><?php echo $a++ ?></td>

                                                    <?php
                                                    if ($row['starter_name_en'] != NULL) {
                                                    ?>
                                                        <td><?php echo $row['starter_name_en']; ?></td>
                                                        <td><?php echo $row['starter_price']; ?></td>
                                                        <td><?php echo $row['dish_name_en']; ?></td>
                                                        <td><?php echo $row['dish_price']; ?></td>
                                                        <td><?php echo $row['dessert_name_en']; ?></td>
                                                        <td><?php echo $row['dessert_price']; ?></td>
                                                        <td><a href="translation.php?<?php
                                                                                        $id = $row["id"];
                                                                                        $rest_id = $_GET["id"];
                                                                                        echo "id=$id&rest_id=$rest_id" ?>" class="btn btn-success btn-sm">

                                                                <span class="text">Add Translation</span>
                                                            </a></td>
                                                    <?php
                                                    } else if ($row['starter_name_heb'] != NULL) {
                                                    ?>
                                                        <td><?php echo $row['starter_name_heb']; ?></td>
                                                        <td><?php echo $row['starter_price']; ?></td>
                                                        <td><?php echo $row['dish_name_heb']; ?></td>
                                                        <td><?php echo $row['dish_price']; ?></td>
                                                        <td><?php echo $row['dessert_name_heb']; ?></td>
                                                        <td><?php echo $row['dessert_price']; ?></td>
                                                        <td><a href="translation.php?<?php
                                                                                        $id = $row["id"];
                                                                                        $rest_id = $_GET["id"];
                                                                                        echo "id=$id&rest_id=$rest_id" ?>" class="btn btn-success btn-sm">

                                                                <span class="text">Add Translation</span>
                                                            </a></td>
                                                    <?php
                                                    }
                                                    ?>



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

</body>

</html>