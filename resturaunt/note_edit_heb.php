<?php
session_start();
if (!isset($_SESSION['Rname'])) {
    header('location:restaurant_login.php');
}

include('class/database.php');
class NoteEdit extends database
{
    protected $link;
    public function getNote()
    {


        $id = $_GET['id'];

        $sql = "select * from notes_tb where id = '$id' ";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }

    public function updateNote()
    {

        if (isset($_POST['submit'])) {

            $id = $_GET['id'];

            $note = $_POST['note'];
            $day = $_POST["day"];

            $rest_id = $_SESSION['rest_id'];

            $sqlFind = "select * from notes_tb where day = '$day' and rest_id='$rest_id' ";
            $resFind = mysqli_query($this->link, $sqlFind);
            if (mysqli_num_rows($resFind) > 0) {
                $msg = "taken";
                header("location: notes_heb.php?msg=$msg");
                return true;
            } else {


                $sql = "UPDATE notes_tb SET note_heb='$note', day='$day', updated=CURRENT_TIMESTAMP where id='$id'";
                $res = mysqli_query($this->link, $sql);



                if ($res) {
                    $msg = "success_upd";
                    header("location: notes_heb.php?msg=$msg");
                    return true;
                } else {
                    $msg = "fail_upd";
                    header("location: notes_heb.php?msg=$msg");
                    return false;
                }
            }
        }
    }
}
$obj = new NoteEdit;
$objNote = $obj->getNote();
$objNoteUpdate = $obj->updateNote();

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>לַעֲרוֹך הערה</title>

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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">לַעֲרוֹך הערה</h1>

                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-lg-12">

                            <!-- ------Menu English Starts -->
                            <div class="card shadow mb-4">

                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">לַעֲרוֹך הערה</h6>
                                </div>
                                <div class="card-body">





                                    <form action="" method="post">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">הערה מידע
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body bg-light">
                                                <?php

                                                $row = mysqli_fetch_assoc($objNote);

                                                if ($row['day'] == "sun") {
                                                    $day = "ראשון";
                                                } else if ($row['day'] == "mon") {
                                                    $day = "שני";
                                                } else if ($row['day'] == "tue") {
                                                    $day = "שלישי";
                                                } else if ($row['day'] == "wed") {
                                                    $day = "רביעי";
                                                } else if ($row['day'] == "thu") {
                                                    $day = "חמישי";
                                                } else if ($row['day'] == "fri") {
                                                    $day = "שישי";
                                                } else if ($row['day'] == "sat") {
                                                    $day = "שבת";
                                                }


                                                ?>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input type="text" required name="note" value="<?php echo $row["note_heb"] ?>" class="form-control" placeholder="הערה">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <select required name="day" class="form-control">
                                                            <option value="<?php echo $row['day'] ?>" selected><?php echo $day ?></option>
                                                            <option></option>
                                                            <option value="sun">ראשון</option>
                                                            <option value="mon">שני</option>
                                                            <option value="tue">שלישי</option>
                                                            <option value="wed">רביעי</option>
                                                            <option value="thu">חמישי</option>
                                                            <option value="fri">שישי</option>
                                                            <option value="sat">שבת</option>
                                                        </select>
                                                    </div>

                                                </div>




                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">סגירה</button>
                                                <button type="submit" name="submit" class="btn btn-primary">שמירה</button>
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