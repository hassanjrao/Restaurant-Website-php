<?php
session_start();

if (!isset($_SESSION["email"])) {
    header("location: signInUp.php");
}

include('class/database.php');

class profile extends database
{
    protected $link;
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
    public function myReservationFunction()
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
    public function showProfileInfo()
    {
        $email = $_SESSION['email'];
        $sql = "select * from user_info where email = '$email' ";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
    public function insertProfileInfo()
    {
        if (isset($_POST['upload'])) {
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $city = $_POST['city'];
            $state = $_POST['state'];
            $country = $_POST['country'];
            $img = time() . '_' . $_FILES['image']['name'];
            $target = 'user_img/' . $img;

            if ($_FILES['image']['name'] == '') {
                $sql = "UPDATE `user_info` SET `phone`= '$phone',`country`='$country',`state`='$state',`city`='$city', `updated` = CURRENT_TIMESTAMP WHERE email = '$email'";
            } else {
                $sql = "UPDATE `user_info` SET `phone`= '$phone',`country`='$country',`state`='$state',`city`='$city', `image` = '$img', `updated` = CURRENT_TIMESTAMP WHERE email = '$email'";
            }


            $res = mysqli_query($this->link, $sql);
            if ($res) {
                move_uploaded_file($_FILES['image']['tmp_name'], $target);
                header('location:profile.php');
                return $res;
            } else {
                echo "Not added";
                return false;
            }
        }
        # code...
    }
    public function contactFunction()
    {
        if (isset($_POST['contact'])) {
            $email = $_SESSION['email'];
            $code = $_SESSION['code'];
            $sql = "UPDATE `reservation_tbl` SET `email`='$email',`updated`=CURRENT_TIMESTAMP WHERE code = $code ";
            $res = mysqli_query($this->link, $sql);
            if ($res) {
                header('location:reservation.php?email=' . $email);
            }
        }
        # code...
    }
}
$obj = new profile;
$objShow = $obj->showProfile();
$objShowInfo = $obj->showProfileInfo();
$objContact = $obj->contactFunction();
$objInsertInfo = $obj->insertProfileInfo();
$row = mysqli_fetch_assoc($objShow);
$_SESSION['email'] = $row['email'];
$rowInfo = mysqli_fetch_assoc($objShowInfo);
$objReserve = $obj->myReservationFunction();
$rowCount = mysqli_fetch_assoc($objReserve);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
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
                    <a href="profile.php" class="active font-weight-bold text-dark pt-5 d-block mt-5" style="text-decoration: none;">Profile</a>
                    <hr>
                    <a href="resetpass.php" class=" font-weight-normal text-dark  d-block" style="text-decoration: none;">Reset
                        Password</a>
                    <hr>
                    <a href="myreservation.php" class=" font-weight-normal text-dark  d-block" style="text-decoration: none;">My
                        Reservation <?php if ($objReserve) { ?>
                            <span class="badge badge-dark ml-2"><?php echo $rowCount['total']; ?></span>
                        <?php } else { ?>
                            <span class="badge badge-dark ml-2">0</span>
                        <?php } ?></a>
                    <hr>
                    <a href="logout.php" class="mb-5 font-weight-normal text-dark  d-block" style="text-decoration: none;">Logout</a>
                </div>
                <div class="col-md-10">
                    <h3 class="float-right d-block font-weight-bold" style="color: #481639"><span class="text-secondary font-weight-light">Welcome |</span>
                        <?php echo $row['fname'] ?>
                        <?php echo $row['lname']; ?></h3>

                    <div class="account bg-white mt-5 p-5 rounded">
                        <h4 class="font-weight-bold" style="color: #481639">Account Details</h4>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row mt-4">
                                <div class="col-md-7">
                                    <label for="fullname" class="font-weight-bold">Full Name</label>
                                    <input type="text" id="fullname" name="fullname" value="<?php echo $row['fname']; ?> <?php echo $row['lname']; ?>" class="form-control border-0 bg-light" readonly>
                                    <label for="email" class="font-weight-bold mt-4">Email</label>
                                    <input type="email" id="email" value="<?php echo $row['email']; ?>" name="email" class="form-control border-0 bg-light" readonly>
                                    <label for="phone" class="font-weight-bold mt-4">Phone Number</label>
                                    <input type="text" id="phone" value="<?php echo $rowInfo['phone']; ?>" name="phone" class="form-control border-0 bg-light">

                                </div>

                                <?php
                                if (isset($_SESSION['img']) || isset($rowInfo["client_id"])) {

                                ?>

                                    <div class="col-md-5 text-center">

                                        <img class="profileImage" onclick="triggerClick()" id="profileDisplay" src="<?php echo $rowInfo['image']; ?>" alt="">
                                        <input type="file" accept="image/*" name="image" id="profileImage" onchange="displayImage(this)" style="display: none;">
                                        <p class="lead">Tap to upload image</p>
                                    </div>

                                <?php
                                } else {


                                ?>

                                    <div class="col-md-5 text-center">

                                        <img class="profileImage" onclick="triggerClick()" id="profileDisplay" src="user_img/<?php echo $rowInfo['image']; ?>" alt="">
                                        <input type="file" accept="image/*" name="image" id="profileImage" onchange="displayImage(this)" style="display: none;">
                                        <p class="lead">Tap to upload image</p>
                                    </div>

                                <?php
                                }
                                ?>

                                <div class="col-md-12">
                                    <label for="country" class="font-weight-bold mt-4">Country</label>
                                    <input type="text" id="country" value="<?php echo $rowInfo['country']; ?>" name="country" class="form-control border-0 bg-light">
                                </div>
                                <div class="col-md-6">
                                    <label for="state" class="font-weight-bold mt-4">State</label>
                                    <input type="text" id="state" value="<?php echo $rowInfo['state']; ?>" name="state" class="form-control border-0 bg-light">
                                </div>
                                <div class="col-md-6">
                                    <label for="city" class="font-weight-bold mt-4">City</label>
                                    <input type="text" id="city" value="<?php echo $rowInfo['city']; ?>" name="city" class="form-control border-0 bg-light">
                                </div>
                            </div>
                            <button class="btn font-weight-bold upload_btn btn-lg mt-5" type="submit" name="upload">Confirm</button>

                        </form>
                    </div>
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <?php if (isset($_SESSION['code'])) { ?>
                            <button type="submit" name="contact" class="w-25 mt-4 log_btn btn btn-lg font-weight-bold">Next</button>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php include('layout/footer.php'); ?>


    <?php include('layout/script.php') ?>
</body>

</html>