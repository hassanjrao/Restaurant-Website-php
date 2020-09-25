<?php
session_start();
include('class/database.php');
class myReserve extends database
{
    protected $link;
    public function myReservationFunction()
    {
        $email = $_SESSION['email'];
        $sql = "select * from reservation_tbl where email = '$email' AND user_confirm = 1";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
    public function myCountReservationFunction()
    {
        $num = 1;
        $email = $_SESSION['email'];
        $sql = "select count(id) as total from reservation_tbl where email = '$email' AND user_confirm = $num";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
    public function showProfile()
    {
        $email = $_SESSION['email'];
        $sql = "select * from user_tbl where email = '$email' ";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
}
$obj = new myReserve;
$objConfirm = $obj->myReservationFunction();
$objShow = $obj->showProfile();
$rowInfo = mysqli_fetch_assoc($objShow);
$objReserve = $obj->myCountReservationFunction();
$rowCount = mysqli_fetch_assoc($objReserve);



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservations</title>
    <?php include('layout/style.php'); ?>
    <style>
    .profileImage {
        height: 200px;
        width: 200px;
        object-fit: cover;
        border-radius: 50%;
        margin: 10px auto;
        cursor: pointer;

    }



    .upload_btn {
        background-color: #EEA11D;
        color: #481639;
        transition: 0.7s;
    }

    .upload_btn:hover {
        background-color: #481639;
        color: #EEA11D;
    }

    body {
        font-family: 'Lato', sans-serif;
    }
    </style>

</head>

<body class="bg-light">
    <?php include('layout/navbar.php'); ?>


    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <h3 class="float-left font-weight-bold" style="color: #481639">Dashboard</h3>
                    <a href="profile.php" class="font-weight-normal  text-dark pt-5 d-block mt-5"
                        style="text-decoration: none;">Profile</a>
                    <hr>
                    <a href="resetpass.php" class=" font-weight-normal text-dark  d-block"
                        style="text-decoration: none;">Reset
                        Password</a>
                    <hr>
                    <a href="myreservation.php" class=" font-weight-normal text-dark  d-block"
                        style="text-decoration: none;">My
                        Reservation <?php if ($objReserve) { ?>
                        <span class="badge badge-dark ml-2"><?php echo $rowCount['total']; ?></span>
                        <?php } else { ?>
                        <span class="badge badge-dark ml-2">0</span>
                        <?php } ?></a>
                    <hr>
                    <a href="logout.php" class="mb-5 font-weight-normal text-dark  d-block"
                        style="text-decoration: none;">Logout</a>
                </div>
                <div class="col-md-10">
                    <h3 class="float-right d-block font-weight-bold" style="color: #481639"><span
                            class="text-secondary font-weight-light">Welcome |</span>
                        <?php echo $rowInfo['fname'] ?>
                        <?php echo $rowInfo['lname']; ?></h3>

                    <div class="account bg-white mt-5 p-5 rounded">
                        <h4 class="font-weight-bold" style="color: #481639">Reservation Details</h4>
                        <div class="row mt-4">
                            <div class="col-md-4 col-4">
                                <p class="font-weight-bold">Restaurant Name</p>
                            </div>
                            <div class="col-md-4 col-4">
                                <p class="font-weight-bold">Code</p>
                            </div>
                            <div class="col-md-4 col-4">
                                <p class="font-weight-bold">Status</p>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <?php if ($objConfirm) { ?>
                            <?php while ($row = mysqli_fetch_assoc($objConfirm)) { ?>
                            <div class="col-md-4 col-4 mt-2">
                                <p><?php echo $row['rest_name']; ?></p>
                            </div>

                            <div class="col-md-4 col-4 mt-2">
                                <p><?php echo $row['code']; ?></p>

                            </div>
                            <div class="col-md-4 col-4 mt-2">
                                <?php if ($row['rest_confirm'] == 0) { ?>

                                <span class="badge badge-pill badge-warning">In Progress</span>

                                <?php } ?>
                                <?php if ($row['rest_confirm'] == 1) { ?>

                                <span class="badge badge-pill badge-success">Accepted</span>

                                <?php } ?>
                                <?php if ($row['rest_confirm'] == 2) { ?>

                                <span class="badge badge-pill badge-success">Canceled</span>

                                <?php } ?>

                            </div>


                            <?php } ?>
                            <?php } else { ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <p>No Reservation</p>
                                </div>
                            </div>

                            <?php } ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <?php include('layout/footer.php'); ?>


    <?php include('layout/script.php') ?>
</body>

</html>