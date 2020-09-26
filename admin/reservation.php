<?php
session_start();
include('class/database.php');
class reservation extends database
{
    public $link;
    public function reservationFunction()
    {
        $name = $_GET['name'];
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

    public function getDate()
    {
        $rest_name = $_GET["name"];
        $sql = "SELECT * FROM reservation_tbl  where rest_name='$rest_name' AND user_confirm=1 order by id desc";
        $res = mysqli_query($this->link, $sql);

        $i = 0;
        $dateArr = [];

        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {

                $dateArr[$i++] = $row["date"];
            }

            return array_unique($dateArr);
        } else {
            return false;
        }
    }

    public function getDiscount($t, $rest_name)
    {
        $time = explode("-", $t);

        $start_time = $time[0];
        $s_t = explode(":", $start_time);

        $st = $s_t[0];


        if ($st == "9") {
            $time = "09:00-10:00";
        } else if ($st == "10") {
            $time = "10:00-11:00";
        } else if ($st == "11") {
            $time = "11:00-12:00";
        } else if ($st == "12") {
            $time = "12:00-13:00";
        } else if ($st == "13") {
            $time = "13:00-14:00";
        } else if ($st == "14") {
            $time = "14:00-15:00";
        } else if ($st == "15") {
            $time = "15:00-16:00";
        } else if ($st == "16") {
            $time = "16:00-17:00";
        } else if ($st == "17") {
            $time = "17:00-18:00";
        } else if ($st == "18") {
            $time = "18:00-19:00";
        } else if ($st == "19") {
            $time = "19:00-20:00";
        } else if ($st == "20") {
            $time = "20:00-21:00";
        } else if ($st == "21") {
            $time = "21:00-22:00";
        } else if ($st == "22") {
            $time = "22:00-23:00";
        }


        $sql = "SELECT * FROM $rest_name  where time='$time'";
        $res = mysqli_query($this->link, $sql);



        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
    }
}
$obj = new reservation;
$objLink = $obj->link;
$objReservation = $obj->reservationFunction();
$objDate = $obj->getDate();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - Reservation </title>

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


                <!-- topbar -->
                <?php include('topbar.php'); ?>
                <!-- End of topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h4 text-gray-900 mb-4 mt-5 font-weight-bold">Reservation List</h1>
                    <?php



                    if ($objDate) {
                        if (count($objDate) > 0) {

                            foreach ($objDate as $ind => $date) {

                    ?>

                                <div class="accordion shadow" id="accordionExample">
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link" style="text-decoration: none;" type="button" data-toggle="collapse" data-target="#collapseOne<?php echo $ind ?>" aria-expanded="true" aria-controls="collapseOne">
                                                    <strong>Date:</strong> <?php echo $date ?>

                                                </button>
                                            </h2>
                                        </div>

                                        <div id="collapseOne<?php echo $ind ?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">

                                            <?php

                                            $rest_name = $_GET["name"];
                                            $sql = "SELECT *
                                                FROM user_tbl
                                                INNER JOIN reservation_tbl
                                                ON user_tbl.email = reservation_tbl.email where reservation_tbl.rest_name = '$rest_name' AND reservation_tbl.date = '$date' AND reservation_tbl.user_confirm = 1 order by reservation_tbl.id desc;";
                                            $res = mysqli_query($objLink, $sql);


                                            if (mysqli_num_rows($res) > 0) {
                                                while ($row = mysqli_fetch_assoc($res)) {



                                            ?>

                                                    <div class="card-body">
                                                        <div class="row">

                                                            <div class="col-md-12">

                                                                <h1 class="h6 text-secondary mb-4 font-weight-bold">Restaurant Name:- <span class="h6 text-gray-900 mb-4 font-weight-bold"><?php echo ucwords($row["rest_name"]); ?></span>
                                                                </h1>

                                                            </div>
                                                            <br><br>
                                                            <div class="col-md-4">
                                                                <h1 class="h6 text-secondary mb-4 font-weight-bold">Client Name:-
                                                                </h1>
                                                                <h1 class="h6 text-gray-900 mb-4 font-weight-bold">
                                                                    <?php echo $row['fname']; ?>
                                                                    <?php echo $row['lname']; ?>
                                                                </h1>
                                                                <h1 class="h6 text-secondary mb-4 font-weight-bold">Code:-
                                                                </h1>
                                                                <h1 class="h6 text-gray-900 mb-4 font-weight-bold">
                                                                    <?php echo $row['code']; ?>
                                                                </h1>




                                                                <?php if ($row['confirm_people'] == NULL) {

                                                                ?>
                                                                    <h1 class="h6 text-secondary mb-4 font-weight-bold">Confirmed Person:-
                                                                    </h1>
                                                                    <h1 class="h6 text-gray-900 mb-4 font-weight-bold">
                                                                        <?php echo $row['people']; ?>
                                                                    </h1>

                                                                <?php
                                                                } else {
                                                                ?>

                                                                    <h1 class="h6 text-secondary mb-4 font-weight-bold">Confirmed Person:-
                                                                    </h1>
                                                                    <h1 class="h6 text-gray-900 mb-4 font-weight-bold">
                                                                        <?php echo $row['confirm_people']; ?>
                                                                    </h1>

                                                                <?php

                                                                }
                                                                ?>

                                                                <!-- <h1 class="h6 text-gray-900 mb-4 font-weight-bold">
                                                               </h1> -->

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

                                                                <h1 class="h6 text-secondary mb-2 font-weight-bold">Hour:-
                                                                </h1>
                                                                <h1 class="h6 text-gray-900 mb-4 font-weight-bold">
                                                                    <?php echo $row['time']; ?>
                                                                </h1>

                                                                <br>

                                                                <h1 class="h6 text-secondary mb-2 font-weight-bold">Discount
                                                                </h1>

                                                                <?php
                                                                $time = $row["time"];
                                                                $date = $row["date"];
                                                                $day = strtolower(date('D', strtotime("$date")));

                                                                $newObj = new reservation;

                                                                $objDiscount = $newObj->getDiscount($time, $row["rest_name"]);

                                                                if ($objDiscount) {

                                                                    $result = mysqli_fetch_assoc($objDiscount);

                                                                ?>
                                                                    <button class="btn p-5 btn-lg btn-danger btn-default btn-circle font-weight-bold"><?php echo $result["$day"] != NULL ? $result["$day"] : "0"; ?>%</button>

                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <button class="btn p-5 btn-lg btn-danger btn-default btn-circle font-weight-bold">0%</button>

                                                                <?php
                                                                }



                                                                ?>
                                                            </div>




                                                        </div>

                                                    </div>

                                                    <hr>

                                            <?php
                                                }
                                            }

                                            ?>

                                        </div>

                                    </div>

                                </div>



                        <?php }
                        }
                    } else { ?>
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


</body>

</html>