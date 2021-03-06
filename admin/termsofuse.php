<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("location: login.php");
}
include('class/database.php');
class TermsOfUse extends database
{
    protected $link;
    public function getTerms()
    {

        $sql = "SELECT * from termsofuse_tb";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
    public function createAbout()
    {
        if (isset($_POST['submit_en'])) {
            $termsofuse = $_POST['tos_en'];


            $results = $this->getTerms();

            if ($results) {
                $id = "1";
                $sql = "UPDATE termsofuse_tb SET tos_en='$termsofuse',created=CURRENT_TIMESTAMP where id='$id'";
                $res = mysqli_query($this->link, $sql);

                if ($res) {
                    $msg = "success_upd";
                    header("location: termsofuse.php?msg=success_upd");
                    return true;
                } else {
                    $msg = "fail_upd";
                    header("location: termsofuse.php?msg=fail_upd");
                    return false;
                }
            } else {

                $sql = "INSERT INTO termsofuse_tb (`tos_en`, `created`) VALUES ('$termsofuse', CURRENT_TIMESTAMP)";
                $res = mysqli_query($this->link, $sql);

                if ($res) {
                    $msg = "success_add";
                    header("location: termsofuse.php?msg=$msg");
                    return true;
                } else {
                    $msg = "fail_add";
                    header("location: termsofuse.php?msg=$msg");
                    return false;
                }
            }
        }

        if (isset($_POST['submit_heb'])) {
            $termsofuse = $_POST['tos_heb'];


            $results = $this->getTerms();

            if ($results) {
                $id = "1";
                $sql = "UPDATE termsofuse_tb SET tos_heb='$termsofuse',created=CURRENT_TIMESTAMP where id='$id'";
                $res = mysqli_query($this->link, $sql);

                if ($res) {
                    $msg = "success_upd";
                    header("location: termsofuse.php?msg=success_upd");
                    return true;
                } else {
                    $msg = "fail_upd";
                    header("location: termsofuse.php?msg=fail_upd");
                    return false;
                }
            } else {

                $sql = "INSERT INTO termsofuse_tb (`tos_heb`, `created`) VALUES ('$termsofuse', CURRENT_TIMESTAMP)";
                $res = mysqli_query($this->link, $sql);

                if ($res) {
                    $msg = "success_add";
                    header("location: termsofuse.php?msg=$msg");
                    return true;
                } else {
                    $msg = "fail_add";
                    header("location: termsofuse.php?msg=$msg");
                    return false;
                }
            }
        }


        if (isset($_POST['submit_fr'])) {
            $termsofuse = $_POST['tos_fr'];


            $results = $this->getTerms();

            if ($results) {
                $id = "1";
                $sql = "UPDATE termsofuse_tb SET tos_fr='$termsofuse',created=CURRENT_TIMESTAMP where id='$id'";
                $res = mysqli_query($this->link, $sql);

                if ($res) {
                    $msg = "success_upd";
                    header("location: termsofuse.php?msg=success_upd");
                    return true;
                } else {
                    $msg = "fail_upd";
                    header("location: termsofuse.php?msg=fail_upd");
                    return false;
                }
            } else {

                $sql = "INSERT INTO termsofuse_tb (`tos_fr`, `created`) VALUES ('$termsofuse', CURRENT_TIMESTAMP)";
                $res = mysqli_query($this->link, $sql);

                if ($res) {
                    $msg = "success_add";
                    header("location: termsofuse.php?msg=$msg");
                    return true;
                } else {
                    $msg = "fail_add";
                    header("location: termsofuse.php?msg=$msg");
                    return false;
                }
            }
        }
    }
    # code...
}

$obj = new TermsOfUse;
$objTerms = $obj->getTerms();
$objTermHeb = $obj->getTerms();
$objTermFr = $obj->getTerms();
$objCreate = $obj->createAbout();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - Terms of use</title>

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
                    <h1 class="h3 mb-2 text-gray-800">Terms of use</h1>


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


                            <h3>TOS English</h3>

                            <form method="POST" action="">

                                <?php
                                if ($objTerms) {

                                    $row = mysqli_fetch_assoc($objTerms);
                                    $termsofuse = $row["tos_en"];

                                ?>

                                    <textarea rows="17" cols="50" placeholder="Enter text" name="tos_en"><?php echo $termsofuse ?></textarea>

                                <?php
                                } else {

                                ?>
                                    <textarea rows="17" cols="50" placeholder="Enter text" name="tos_en"></textarea>
                                <?php

                                }

                                ?>


                                <br><br>
                                <button type="submit" name="submit_en" class="btn btn-primary">Submit</button>

                            </form>

                            <hr>
                            <br>
                            <h3>TOS Hebrew</h3>
                            <form method="POST" action="">

                                <?php
                                if ($objTermHeb) {

                                    $row = mysqli_fetch_assoc($objTermHeb);
                                    $termsofuse = $row["tos_heb"];

                                ?>

                                    <textarea rows="17" cols="50" placeholder="Enter text" name="tos_heb"><?php echo $termsofuse ?></textarea>

                                <?php
                                } else {

                                ?>
                                    <textarea rows="17" cols="50" placeholder="Enter text" name="tos_heb"></textarea>
                                <?php

                                }

                                ?>


                                <br><br>
                                <button type="submit" name="submit_heb" class="btn btn-primary">Submit</button>

                            </form>

                            <hr>
                            <br>
                            <h3>TOS French</h3>

                            <form method="POST" action="">

                                <?php
                                if ($objTermFr) {

                                    $row = mysqli_fetch_assoc($objTermFr);
                                    $termsofuse = $row["tos_fr"];

                                ?>

                                    <textarea rows="17" cols="50" placeholder="Enter text" name="tos_fr"><?php echo $termsofuse ?></textarea>

                                <?php
                                } else {

                                ?>
                                    <textarea rows="17" cols="50" placeholder="Enter text" name="tos_fr"></textarea>
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