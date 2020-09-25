<?php
session_start();
include('class/database.php');
class reservation extends database
{
    protected $link;
    public function reservationFunction()
    {
        $name = $_SESSION['Rname'];
        $sql = "SELECT *
        FROM user_tbl
        INNER JOIN reservation_tbl
        ON user_tbl.email = reservation_tbl.email where reservation_tbl.rest_name = '$name' AND reservation_tbl.user_confirm = 1 order by reservation_tbl.id desc;";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }

        # code...
    }
}
$obj = new reservation;
$objReservation = $obj->reservationFunction();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Blank</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

       <!-- Sidebar -->
       <?php include('sidebar.php'); ?>
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
                    <h1 class="h4 text-gray-900 mb-4 mt-5 font-weight-bold">Reservation List</h1>
                    <?php if ($objReservation) { ?>

                    <?php while ($row = mysqli_fetch_assoc($objReservation)) { ?>

                    <div class="accordion shadow" id="accordionExample">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-link" style="text-decoration: none;" type="button"
                                        data-toggle="collapse" data-target="#collapseOne<?php echo $row['id']; ?>"
                                        aria-expanded="true" aria-controls="collapseOne">
                                        <strong>Date:</strong> <?php echo $row['date']; ?>, <strong>Time:</strong>
                                        <?php echo $row['time']; ?>
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseOne<?php echo $row['id']; ?>" class="collapse" aria-labelledby="headingOne"
                                data-parent="#accordionExample">
                                <form action="">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h1 class="h6 text-secondary mb-4 font-weight-bold">Name:-
                                                </h1>
                                                <h1 class="h6 text-gray-900 mb-4 font-weight-bold">
                                                    <?php echo $row['fname']; ?>
                                                    <?php echo $row['lname']; ?>
                                                </h1>
                                                <h1 class="h6 text-secondary mb-4 font-weight-bold">Code:-
                                                </h1>
                                                <h1 class="h6 text-gray-900 mb-4 font-weight-bold">
                                                    <?php echo $row['code']; ?>
                                                    <h1 class="h6 text-secondary mb-4 font-weight-bold">Person:-
                                                    </h1>
                                                    <h1 class="h6 text-gray-900 mb-4 font-weight-bold">
                                                        <?php echo $row['people']; ?></h1>

                                            </div>
                                            <div class="col-md-4">
                                                <h1 class="h6 text-secondary mb-4 font-weight-bold">Email:-
                                                </h1>
                                                <h1 class="h6 text-gray-900 mb-4 font-weight-bold">
                                                    <?php echo $row['email']; ?>

                                                </h1>
                                                <h1 class="h6 text-secondary mb-4 font-weight-bold">Phone:-
                                                </h1>
                                                <h1 class="h6 text-gray-900 mb-4 font-weight-bold">
                                                    <?php echo $row['phone']; ?></h1>

                                                <h1 class="h6 text-secondary mb-4 font-weight-bold">Created
                                                    Reservation:-
                                                </h1>
                                                <h1 class="h6 text-gray-900 mb-4 font-weight-bold">
                                                    <?php echo $row['created']; ?>
                                                </h1>

                                            </div>
                                            <div class="col-md-4 text-center">
                                                <h1 class="h6 text-secondary mb-5 font-weight-bold">Discount
                                                </h1>
                                                <button
                                                    class="btn p-5 btn-lg btn-danger btn-default btn-circle font-weight-bold">20%</button>
                                            </div>

                                            <?php if ($row['rest_confirm'] == 0) { ?>
                                            <div class="col-md-12">
                                                <a href="confirm.php?id=<?php echo $row['id']; ?>"
                                                    class="btn btn-success">Confirm</a>
                                                <a href="delete.php?id=<?php echo $row['id']; ?>"
                                                    class="btn btn-secondary">Cancel</a>
                                            </div>
                                            <?php } ?>
                                            <?php if ($row['rest_confirm'] == 1) { ?>
                                            <div class="alert alert-success alert-dismissible fadeIn mt-4">
                                                <a href="#" class="close" data-dismiss="alert"
                                                    aria-label="close">&times;</a>
                                                <strong>Confirmed!</strong> This reservation is confirmed!
                                            </div>
                                            <?php } ?>
                                            <?php if ($row['rest_confirm'] == 2) { ?>
                                            <div class="alert alert-danger alert-dismissible fadeIn mt-4">
                                                <a href="#" class="close" data-dismiss="alert"
                                                    aria-label="close">&times;</a>
                                                <strong>Canceled!</strong> This reservation is canceled!
                                            </div>
                                            <?php } ?>
                                        </div>

                                    </div>

                                </form>
                            </div>
                        </div>


                    </div>
                    <?php } ?>

                    <?php } else { ?>
                    <p>No Reservation</p>
                    <?php } ?>


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
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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


</body>

</html>