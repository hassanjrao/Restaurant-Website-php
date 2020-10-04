<?php
session_start();
if (!isset($_SESSION['Rname'])) {
    header('location:restaurant_login.php');
}
include('class/database.php');
class Notes extends database
{
    protected $link;
    public function getNotes()
    {
        $rest_id = $_SESSION['rest_id'];
        $sql = "select * from notes_tb where rest_id='$rest_id'";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
    public function createNote()
    {
        if (isset($_POST['submit'])) {
            $note = strtolower($_POST['note']);
            $day = $_POST["day"];
            $rest_id = $_SESSION['rest_id'];

            $sqlFind = "select * from notes_tb where day = '$day' and rest_id='$rest_id' ";
            $resFind = mysqli_query($this->link, $sqlFind);
            if (mysqli_num_rows($resFind) > 0) {
                $msg = "taken";
                header("location: notes_heb.php?msg=$msg");
                return true;
            } else {

                $sql = "INSERT INTO notes_tb (`note_heb`, `day`,`rest_id` ,`created`) VALUES ('$note', '$day','$rest_id' ,CURRENT_TIMESTAMP)";
                $res = mysqli_query($this->link, $sql);

                if ($res) {
                    $msg = "success_add";
                    header("location: notes_heb.php?msg=$msg");
                    return true;
                } else {
                    $msg = "fail_add";
                    header("location: notes_heb.php?msg=$msg");
                    return false;
                }
            }
        }
        # code...
    }
}
$obj = new Notes;
$objCity = $obj->getNotes();
$objCreate = $obj->createNote();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>הערות</title>

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
        <?php include('sidebar_heb.php'); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include('topbar.php'); ?>
                <!-- End of Topbar -->



                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">הערות</h1>


                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <button class="btn btn-primary mt-3" data-toggle="modal" data-target="#exampleModal">הוספת הערה</button>
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <form action="" method="post">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">הערה
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body bg-light">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input type="text" required name="note" class="form-control" placeholder="הערה">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <select required name="day" class="form-control">
                                                            <option selected disabled>יום</option>
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
                        </div>
                        <div class="card-body">

                            <?php if (isset($_GET["msg"])) {
                                if (strcmp($_GET["msg"], 'taken') == 0) { ?>
                                    <div class="alert alert-warning alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>Note is already there on this day, Please edit!</strong>
                                    </div>


                            <?php }
                            } ?>


                            <?php
                            if (isset($_GET["msg"])) {
                                if (strcmp($_GET["msg"], 'success_add') == 0) { ?>
                                    <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>הוספה בוצעה</strong>
                                    </div>


                            <?php
                                }
                            } ?>

                            <?php
                            if (isset($_GET["msg"])) {
                                if (strcmp($_GET["msg"], 'fail_add') == 0) { ?>
                                    <div class="alert alert-warning alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>הוספה נכשלה</strong>
                                    </div>


                            <?php
                                }
                            } ?>

                            <?php
                            if (isset($_GET["msg"])) {
                                if (strcmp($_GET["msg"], 'success_upd') == 0) { ?>
                                    <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>עדכון בוצע</strong>
                                    </div>


                            <?php
                                }
                            } ?>

                            <?php
                            if (isset($_GET["msg"])) {
                                if (strcmp($_GET["msg"], 'fail_upd') == 0) { ?>
                                    <div class="alert alert-warning alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>עדכון נכשל</strong>
                                    </div>


                            <?php
                                }
                            } ?>

                            <?php
                            if (isset($_GET["msg"])) {

                                if (strcmp($_GET["msg"], 'success_del') == 0) { ?>
                                    <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>מחיקה בוצעה</strong>
                                    </div>


                            <?php }
                            } ?>

                            <?php
                            if (isset($_GET["msg"])) {
                                if (strcmp($_GET["msg"], 'fail_del') == 0) { ?>
                                    <div class="alert alert-warning alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>מחיקה נכשלה</strong>
                                    </div>


                            <?php }
                            } ?>







                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>מספר</th>
                                            <th>הערה</th>
                                            <th>יום</th>
                                            <th>הוספה/מחיקה</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>מספר</th>
                                            <th>הערה</th>
                                            <th>יום</th>
                                            <th>הוספה/מחיקה</th>

                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php if ($objCity) {
                                            $a = 1;
                                        ?>
                                            <?php while ($row = mysqli_fetch_assoc($objCity)) {

                                                $id = $row['id'];

                                                if($row['day']=="sun"){
                                                    $day="ראשון";
                                                }
                                                else if($row['day']=="mon"){
                                                    $day="שני";
                                                }
                                                else if($row['day']=="tue"){
                                                    $day="שלישי";
                                                }
                                                else if($row['day']=="wed"){
                                                    $day="רביעי";
                                                }
                                                else if($row['day']=="thu"){
                                                    $day="חמישי";
                                                }
                                                else if($row['day']=="fri"){
                                                    $day="שישי";
                                                }
                                                else if($row['day']=="sat"){
                                                    $day="שבת";
                                                }



                                            ?>
                                                <tr>
                                                    <td><?php echo $a++; ?></td>
                                                    <td><?php echo $row['note_heb']==NULL? "Hebrew version is note available, please edit":$row['note_heb'] ?></td>
                                                    <td><?php echo $day; ?></td>

                                                    <td>
                                                        <a href="<?php echo "note_edit_heb.php?id=$id"; ?>" class="btn btn-primary btn-sm">Edit</a>
                                                        <a href="<?php echo "note_delete_heb.php?id=$id"; ?>" class="btn btn-danger btn-sm">Delete</a>
                                                    </td>

                                                </tr>
                                            <?php
                                            } ?>
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
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>