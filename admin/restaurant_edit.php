<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("location: login.php");
}

include('class/database.php');
class Restaurant extends database
{
    protected $link;
    public function getRest()
    {

        $id = $_GET['id'];
        $name = $_GET['name'];

        $sql = "select * from restaurant_tbl where id = '$id' ";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }

    public function getCityName($city_id)
    {
        $sql = "select * from cities_tb where id='$city_id'";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
    }

    public function getCityID()
    {
        $sql = "select id from cities_tb";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
    }

    public function getCity()
    {
        $sql = "select * from cities_tb";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
    }

    public function updateRest()
    {

        if (isset($_POST['submit'])) {
            $id = $_GET['id'];
            $name = $_GET['name'];


            $name_en = addslashes($_POST['name_en']);
            $name_heb = addslashes($_POST['name_heb']);
            $name_fr = addslashes($_POST['name_fr']);

            $address_en = addslashes($_POST['address_en']);
            $address_heb = addslashes($_POST['address_heb']);
            $address_fr = addslashes($_POST['address_fr']);


            $email = addslashes($_POST['email']);
            $password = addslashes($_POST['password']);
            $phone = $_POST['phone'];

            $cities=serialize($_POST["cities"]);

            $pass = password_hash($password, PASSWORD_DEFAULT);

            if ($name !== $name_en) {

                $sqlFind = "select * from restaurant_tbl where name_en = '$name_en' ";
                $resFind = mysqli_query($this->link, $sqlFind);
                if (mysqli_num_rows($resFind) > 0) {
                    $msg = "taken";
                    header("location: all_restaurants.php?msg=$msg");
                    return false;
                } else {
                    $sql = "UPDATE restaurant_tbl SET name_en='$name_en', name_heb='$name_heb', name_fr='$name_fr', phone='$phone', address_en='$address_en', address_heb='$address_heb', address_fr='$address_fr', cities='$cities' ,email='$email', password='$pass', updated=CURRENT_TIMESTAMP where id='$id'";
                    $res = mysqli_query($this->link, $sql);

                    if ($res) {
                        $msg = "success";
                        header("location: all_restaurants.php?msg=success");
                        return true;
                    }
                }
            } else {

                $sql = "UPDATE restaurant_tbl SET name_en='$name_en', name_heb='$name_heb', name_fr='$name_fr', phone='$phone', address_en='$address_en', address_heb='$address_heb', address_fr='$address_fr', cities='$cities', email='$email', password='$pass', updated=CURRENT_TIMESTAMP where id='$id'";
                $res = mysqli_query($this->link, $sql);

                if ($res) {
                    $msg = "success";
                    header("location: all_restaurants.php?msg=success");
                    return true;
                }
            }
        }
    }
}
$obj = new Restaurant;
$objRest = $obj->getRest();
$objCity = $obj->getCity();
$objCityID = $obj->getCityID();
$objRestUpdate = $obj->updateRest();

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - Edit Restaurant</title>

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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Edit Restaurant</h1>

                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-lg-12">
                            <?php

                            $row = mysqli_fetch_assoc($objRest)


                            ?>

                            <!-- ------Menu English Starts -->
                            <div class="card shadow mb-4">

                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Edit Restaurant Information</h6>
                                </div>
                                <div class="card-body">

                                    <?php if (strcmp($objRestUpdate, 'taken') == 0) { ?>
                                        <div class="alert alert-warning alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <strong>Restaurant Name Is Already Taken!</strong>
                                        </div>


                                    <?php } ?>



                                    <form action="" method="post">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Restaurant Information
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body bg-light">
                                                <div class="row">

                                                    <div class="col-md-4">
                                                        Restaurant Name English
                                                        <input type="text" required name="name_en" class="border-0 form-control" value="<?php echo $row["name_en"] ?>" placeholder="Restaurant Name English">
                                                    </div>
                                                    <div class="col-md-4">
                                                        Restaurant Name Hebrew
                                                        <input type="text" name="name_heb" class="border-0 form-control" value="<?php echo $row["name_heb"] ?>" placeholder="Restaurant Name Hebrew">
                                                    </div>
                                                    <div class="col-md-4">
                                                        Restaurant Name French
                                                        <input type="text" name="name_fr" class="border-0 form-control" value="<?php echo $row["name_fr"] ?>" placeholder="Restaurant Name French">
                                                    </div>

                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-4 mt-3">
                                                        Email
                                                        <input type="email" required name="email" value="<?php echo $row["email"] ?>" class="form-control border-0" placeholder="Restaurant Email">
                                                    </div>
                                                    <div class="col-md-4 mt-3">
                                                        Password
                                                        <input type="text" required name="password" class="form-control border-0" placeholder="Password">
                                                    </div>

                                                    <div class="col-md-4 mt-3">
                                                        Phone
                                                        <input type="text" required name="phone" value="<?php echo $row["phone"] ?>" class="form-control border-0" placeholder="Phone Number">
                                                    </div>

                                                </div>

                                                <br>
                                                <div class="row">

                                                    <div class="col-md-12 mt-3">
                                                        Address English
                                                        <input type="text" required name="address_en" value="<?php echo $row["address_en"] ?>" class="form-control border-0" placeholder="Address English">
                                                    </div>
                                                    <div class="col-md-12 mt-3">
                                                        Address Hebrew
                                                        <input type="text" name="address_heb" value="<?php echo $row["address_heb"] ?>" class="form-control border-0" placeholder="Address Hebrew">
                                                    </div>
                                                    <div class="col-md-12 mt-3">
                                                        Address French
                                                        <input type="text" name="address_fr" value="<?php echo $row["name_fr"] ?>" class="form-control border-0" placeholder="Address French">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <?php
                                                    if ($objCity) {
                                                        $i = 0;
                                                        $city_arr2 = [];
                                                        while ($city_row = mysqli_fetch_assoc($objCity)) {

                                                            $city_arr2[$i++] = $city_row["id"];
                                                        }
                                                        $city_arr = unserialize($row["cities"]);
                                                       

                                                        if ($city_arr) {

                                                            $remain_cities = array_diff($city_arr2, $city_arr);
                                                        } else {
                                                            $remain_cities = $city_arr2;
                                                        }

                                                      

                                                      
                                                    }

                                                    ?>

                                                    <div class="col-md-6 mt-3">
                                                        <select class="form-control" name="cities[]" multiple required>
                                                            <option slected disabled>Select Cities</option>

                                                            <?php

                                                            $newObj = new Restaurant;

                                                            if ($city_arr) {

                                                                foreach ($city_arr as $city_id) {
                                                                    $row = mysqli_fetch_assoc($newObj->getCityName($city_id));


                                                                    $city = $row["city"]
                                                            ?>
                                                                    <option selected value="<?php echo $city_id ?>"><?php echo ucwords($city) ?></option>

                                                                <?php
                                                                }
                                                            }
                                                            if (!empty($remain_cities)) {

                                                                foreach ($remain_cities as $id) {
                                                                    # code...

                                                                    $row = mysqli_fetch_assoc($newObj->getCityName($id));
                                                                    $city = $row["city"];

                                                                ?>
                                                                    <option value="<?php echo $id ?>"><?php echo ucwords($city) ?></option>

                                                                <?php
                                                                }
                                                            }
                                                            if ($city_arr == false && empty($remain_cities)) {
                                                                ?>
                                                                <option disabled>No City Found</option>
                                                            <?php
                                                            }

                                                            ?>

                                                        </select>
                                                    </div>

                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" name="submit" class="btn btn-primary">Save</button>
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