<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("location: login.php");
}
include('class/database.php');
class Join extends database
{
    protected $link;
    public function getJoin()
    {

        $sql = "SELECT * from join_tb";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
    public function createJoin()
    {
        if (isset($_POST['submit_en'])) {
            $join = $_POST['join_en'];


            $results = $this->getJoin();

            if ($results) {
                $id = "1";
                $sql = "UPDATE join_tb SET join_en='$join',created=CURRENT_TIMESTAMP where id='$id'";
                $res = mysqli_query($this->link, $sql);

                if ($res) {
                    $msg = "success_upd";
                    header("location: join.php?msg=success_upd");
                    return true;
                } else {
                    $msg = "fail_upd";
                    header("location: join.php?msg=fail_upd");
                    return false;
                }
            } else {

                $sql = "INSERT INTO join_tb (`join_en`, `created`) VALUES ('$join', CURRENT_TIMESTAMP)";
                $res = mysqli_query($this->link, $sql);

                if ($res) {
                    $msg = "success_add";
                    header("location: join.php?msg=$msg");
                    return true;
                } else {
                    $msg = "fail_add";
                    header("location: join.php?msg=$msg");
                    return false;
                }
            }
        }
        else  if (isset($_POST['submit_heb'])) {
            $join = $_POST['join_heb'];


            $results = $this->getJoin();

            if ($results) {
                $id = "1";
                $sql = "UPDATE join_tb SET join_heb='$join',created=CURRENT_TIMESTAMP where id='$id'";
                $res = mysqli_query($this->link, $sql);

                if ($res) {
                    $msg = "success_upd";
                    header("location: join.php?msg=success_upd");
                    return true;
                } else {
                    $msg = "fail_upd";
                    header("location: join.php?msg=fail_upd");
                    return false;
                }
            } else {

                $sql = "INSERT INTO join_tb (`join_heb`, `created`) VALUES ('$join', CURRENT_TIMESTAMP)";
                $res = mysqli_query($this->link, $sql);

                if ($res) {
                    $msg = "success_add";
                    header("location: join.php?msg=$msg");
                    return true;
                } else {
                    $msg = "fail_add";
                    header("location: join.php?msg=$msg");
                    return false;
                }
            }
        }

        else  if (isset($_POST['submit_fr'])) {
            $join = $_POST['join_fr'];


            $results = $this->getJoin();

            if ($results) {
                $id = "1";
                $sql = "UPDATE join_tb SET join_fr='$join',created=CURRENT_TIMESTAMP where id='$id'";
                $res = mysqli_query($this->link, $sql);

                if ($res) {
                    $msg = "success_upd";
                    header("location: join.php?msg=success_upd");
                    return true;
                } else {
                    $msg = "fail_upd";
                    header("location: join.php?msg=fail_upd");
                    return false;
                }
            } else {

                $sql = "INSERT INTO join_tb (`join_fr`, `created`) VALUES ('$join', CURRENT_TIMESTAMP)";
                $res = mysqli_query($this->link, $sql);

                if ($res) {
                    $msg = "success_add";
                    header("location: join.php?msg=$msg");
                    return true;
                } else {
                    $msg = "fail_add";
                    header("location: join.php?msg=$msg");
                    return false;
                }
            }
        }
    }
    # code...
}

$obj = new Join;
$objJoin = $obj->getJoin();
$objJoinHeb = $obj->getJoin();
$objJoinFr = $obj->getJoin();
$objCreate = $obj->createJoin();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - Join us</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <script src="https://cdn.tiny.cloud/1/rikps930c10cl6vxmoq7viyjr9bhgzs8ukeyn4y0080ytyf6/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

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
                    <h1 class="h3 mb-2 text-gray-800">Join us</h1>


                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">

                        <div class="card-body">



                            <?php
                            if (isset($_GET["msg"])) {
                                if (strcmp($_GET["msg"], 'success_add') == 0) { ?>
                                    <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>Successfully Added!</strong>
                                    </div>


                            <?php
                                }
                            } ?>

                            <?php
                            if (isset($_GET["msg"])) {
                                if (strcmp($_GET["msg"], 'fail_add') == 0) { ?>
                                    <div class="alert alert-warning alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>Addition Failed!</strong>
                                    </div>


                            <?php
                                }
                            } ?>


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


                            <h3>Join English</h3>
                            <form method="POST" action="">

                                <?php
                                if ($objJoin) {

                                    $row = mysqli_fetch_assoc($objJoin);
                                    $join = $row["join_en"];

                                ?>

                                    <textarea rows="17" cols="50" placeholder="Enter text" name="join_en"><?php echo $join ?></textarea>

                                <?php
                                } else {

                                ?>
                                    <textarea rows="17" cols="50" placeholder="Enter text" name="join_en"></textarea>
                                <?php

                                }

                                ?>


                                <br><br>
                                <button type="submit" name="submit_en" class="btn btn-primary">Submit</button>

                            </form>
                            <hr>
                            <br>

                            <h3>Join Hebrew</h3>
                            <form method="POST" action="">

                                <?php
                                if ($objJoinHeb) {

                                    $row = mysqli_fetch_assoc($objJoinHeb);
                                    $join = $row["join_heb"];

                                ?>

                                    <textarea rows="17" cols="50" placeholder="Enter text" name="join_heb"><?php echo $join ?></textarea>

                                <?php
                                } else {

                                ?>
                                    <textarea rows="17" cols="50" placeholder="Enter text" name="join_heb"></textarea>
                                <?php

                                }

                                ?>


                                <br><br>
                                <button type="submit" name="submit_heb" class="btn btn-primary">Submit</button>

                            </form>
                            <hr>
                            <br>
                            <h3>Join French</h3>
                            <form method="POST" action="">

                                <?php
                                if ($objJoinFr) {

                                    $row = mysqli_fetch_assoc($objJoinFr);
                                    $join = $row["join_fr"];

                                ?>

                                    <textarea rows="17" cols="50" placeholder="Enter text" name="join_fr"><?php echo $join ?></textarea>

                                <?php
                                } else {

                                ?>
                                    <textarea rows="17" cols="50" placeholder="Enter text" name="join_fr"></textarea>
                                <?php

                                }

                                ?>


                                <br><br>
                                <button type="submit" name="submit_fr" class="btn btn-primary">Submit</button>

                            </form>


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

    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            toolbar_mode: 'floating',
        });
    </script>

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