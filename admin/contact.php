<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("location: login.php");
}
include('class/database.php');
class Contact extends database
{
    protected $link;
    public function getContact()
    {

        $sql = "SELECT * from contact_tb";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
    public function createContact()
    {
        if (isset($_POST['submit_en'])) {
            $contact = $_POST['contact_en'];


            $results = $this->getContact();

            if ($results) {
                $id = "1";
                $sql = "UPDATE contact_tb SET contact_en='$contact',created=CURRENT_TIMESTAMP where id='$id'";
                $res = mysqli_query($this->link, $sql);

                if ($res) {
                    $msg = "success_upd";
                    header("location: contact.php?msg=success_upd");
                    return true;
                } else {
                    $msg = "fail_upd";
                    header("location: contact.php?msg=fail_upd");
                    return false;
                }
            } else {

                $sql = "INSERT INTO contact_tb (`contact_en`, `created`) VALUES ('$contact', CURRENT_TIMESTAMP)";
                $res = mysqli_query($this->link, $sql);

                if ($res) {
                    $msg = "success_add";
                    header("location: contact.php?msg=$msg");
                    return true;
                } else {
                    $msg = "fail_add";
                    header("location: contact.php?msg=$msg");
                    return false;
                }
            }
        }
        else  if (isset($_POST['submit_heb'])) {
            $contact = $_POST['contact_heb'];


            $results = $this->getContact();

            if ($results) {
                $id = "1";
                $sql = "UPDATE contact_tb SET contact_heb='$contact',created=CURRENT_TIMESTAMP where id='$id'";
                $res = mysqli_query($this->link, $sql);

                if ($res) {
                    $msg = "success_upd";
                    header("location: contact.php?msg=success_upd");
                    return true;
                } else {
                    $msg = "fail_upd";
                    header("location: contact.php?msg=fail_upd");
                    return false;
                }
            } else {

                $sql = "INSERT INTO contact_tb (`contact_heb`, `created`) VALUES ('$contact', CURRENT_TIMESTAMP)";
                $res = mysqli_query($this->link, $sql);

                if ($res) {
                    $msg = "success_add";
                    header("location: contact.php?msg=$msg");
                    return true;
                } else {
                    $msg = "fail_add";
                    header("location: contact.php?msg=$msg");
                    return false;
                }
            }
        }

        else  if (isset($_POST['submit_fr'])) {
            $contact = $_POST['contact_fr'];


            $results = $this->getContact();

            if ($results) {
                $id = "1";
                $sql = "UPDATE contact_tb SET contact_fr='$contact',created=CURRENT_TIMESTAMP where id='$id'";
                $res = mysqli_query($this->link, $sql);

                if ($res) {
                    $msg = "success_upd";
                    header("location: contact.php?msg=success_upd");
                    return true;
                } else {
                    $msg = "fail_upd";
                    header("location: contact.php?msg=fail_upd");
                    return false;
                }
            } else {

                $sql = "INSERT INTO contact_tb (`contact_fr`, `created`) VALUES ('$contact', CURRENT_TIMESTAMP)";
                $res = mysqli_query($this->link, $sql);

                if ($res) {
                    $msg = "success_add";
                    header("location: contact.php?msg=$msg");
                    return true;
                } else {
                    $msg = "fail_add";
                    header("location: contact.php?msg=$msg");
                    return false;
                }
            }
        }
    }
    # code...
}

$obj = new Contact;
$objContact = $obj->getContact();
$objContactHeb = $obj->getContact();
$objContactFr = $obj->getContact();
$objCreate = $obj->createContact();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - contact us</title>

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
                    <h1 class="h3 mb-2 text-gray-800">Contact us</h1>


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


                            <h3>Contact English</h3>
                            <form method="POST" action="">

                                <?php
                                if ($objContact) {

                                    $row = mysqli_fetch_assoc($objContact);
                                    $contact = $row["contact_en"];

                                ?>

                                    <textarea rows="17" cols="50" placeholder="Enter text" name="contact_en"><?php echo $contact ?></textarea>

                                <?php
                                } else {

                                ?>
                                    <textarea rows="17" cols="50" placeholder="Enter text" name="contact_en"></textarea>
                                <?php

                                }

                                ?>


                                <br><br>
                                <button type="submit" name="submit_en" class="btn btn-primary">Submit</button>

                            </form>
                            <hr>
                            <br>

                            <h3>Contact Hebrew</h3>
                            <form method="POST" action="">

                                <?php
                                if ($objContactHeb) {

                                    $row = mysqli_fetch_assoc($objContactHeb);
                                    $contact = $row["contact_heb"];

                                ?>

                                    <textarea rows="17" cols="50" placeholder="Enter text" name="contact_heb"><?php echo $contact ?></textarea>

                                <?php
                                } else {

                                ?>
                                    <textarea rows="17" cols="50" placeholder="Enter text" name="contact_heb"></textarea>
                                <?php

                                }

                                ?>


                                <br><br>
                                <button type="submit" name="submit_heb" class="btn btn-primary">Submit</button>

                            </form>
                            <hr>
                            <br>
                            <h3>Contact French</h3>
                            <form method="POST" action="">

                                <?php
                                if ($objContactFr) {

                                    $row = mysqli_fetch_assoc($objContactFr);
                                    $contact = $row["contact_fr"];

                                ?>

                                    <textarea rows="17" cols="50" placeholder="Enter text" name="contact_fr"><?php echo $contact ?></textarea>

                                <?php
                                } else {

                                ?>
                                    <textarea rows="17" cols="50" placeholder="Enter text" name="contact_fr"></textarea>
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