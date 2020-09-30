<?php
session_start();
if (!isset($_SESSION['Rname'])) {
    header('location:restaurant_login.php');
}
include('class/database.php');
class profile extends database
{
    protected $link;
    public function profileFunction()
    {
        $rest_id = $_SESSION['rest_id'];
        $sql = "select * from restaurant_tbl where id = '$rest_id' ";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
    public function getSpec()
    {
        $sql = "select * from specialty";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
    public function getServices()
    {
        $sql = "select * from services_tb";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
    public function getBank()
    {
        $rest = $this->profileFunction();
        $resl = mysqli_fetch_assoc($rest);

        $bank_id = $resl["bank_id"];
        $sql = "select * from bank_tb where id='$bank_id'";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
    public function updateFunction()
    {
        if (isset($_POST['submit'])) {

            $name = $_SESSION['Rname'];
            $phone = $_POST['phone'];
            $speciality = serialize($_POST['specialty']);
            $services = serialize($_POST['services']);
            $kosher = $_POST['kosher'];


            if ($kosher == "no") {
                $kosherSpec = NULL;
            } else  if ($kosher == "yes") {
                $kosherSpec = $_POST['kosher-spec'];
            }



            $bank_id = $_POST["bank"];
            $bank = $_POST["bank"];
            $account_number = $_POST["account_number"];
            $agency = $_POST["agency"];
            $b_name = $_POST["b_name"];

            $rest_id = $_SESSION['rest_id'];

            $sql = "select * from bank_tb where rest_id='$rest_id'";
            $res = mysqli_query($this->link, $sql);
            if (mysqli_num_rows($res) > 0) {
                $bank_resl = mysqli_fetch_assoc($res);
                $bank_id = $bank_resl["id"];
                $sql = "UPDATE `bank_tb` SET `bank` = '$bank',`account_number` = '$account_number', `agency` = '$agency', `name` = '$b_name' where rest_id = '$rest_id' ";
                $res = mysqli_query($this->link, $sql);
            } else {
                $sql = "INSERT INTO bank_tb (`bank`, `account_number` ,`agency`,`name`,`rest_id`) VALUES ('$bank', '$account_number','$agency','$name','$rest_id')";
                $res_b = mysqli_query($this->link, $sql);

                if ($res_b) {
                    $bank_id = mysqli_insert_id($this->link);
                }
            }




            $sql = "UPDATE `restaurant_tbl` SET `speciality` = '$speciality',`services` = '$services', `kosher` = '$kosher',`kosher_spec`='$kosherSpec', `phone` = '$phone',`bank_id` = '$bank_id' where name_en = '$name' ";
            $res = mysqli_query($this->link, $sql);
            if ($res) {

                header("location: profile.php");
                return true;
            } else {


                return false;
            }


            if ($res) {
                header("location: profile.php");
                return true;
            } else {
                header("location: profile.php");
                return false;
            }
        }
    }
}
$obj = new profile;
$objProfile = $obj->profileFunction();
$objSpec = $obj->getSpec();
$objService = $obj->getServices();
$objBank = $obj->getBank();
$objUpdate = $obj->updateFunction();
$row = mysqli_fetch_assoc($objProfile);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Resturaunt Panel - Profile </title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        img {
            width: 100%;
        }

        .profileImage {
            height: 250px;
            width: 250px;
            border-radius: 50%;
            object-fit: cover;
            object-position: center;
            cursor: pointer;
        }

        .profileImageSq {
            cursor: pointer;
        }
    </style>




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
                    <h1 class="h3 mb-4 text-gray-800">Profile Page</h1>
                    <div class="container">

                        <div class="card o-hidden border-0 shadow-lg my-5">
                            <div class="card-body p-0">
                                <!-- Nested Row within Card Body -->
                                <div class="row">

                                    <div class="col-lg-12">

                                        <div class="p-5">
                                            <div class="text-center">

                                            </div>
                                            <form class="user" method="post" action="profile.php" enctype="multipart/form-data">

                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <h1 class="h4 text-gray-900 mb-4 mt-3">Restaurant
                                                            Features</h1>
                                                        <h1 class="h6 text-gray-900 mb-4">Name:
                                                            <span class="font-weight-bold"><?php echo $row['name_en']; ?></span>
                                                        </h1>
                                                        <h1 class="h6 text-gray-900 mb-4">Address:
                                                            <span class="font-weight-bold"><?php echo $row['address_en']; ?></span>
                                                        </h1>

                                                    </div>

                                                    <div class="col-md-6">

                                                        <h1 class="h6 text-gray-900 mb-4">Phone:
                                                            <input type="text" placeholder="Phone Number" class="form-control w-50 mt-3" value="<?php echo $row['phone']; ?>" name="phone">

                                                        </h1>


                                                        <h1 id="kosher-container" class="h6 text-gray-900 mb-4">Kosher:

                                                            <?php
                                                            if ($row["kosher"] == "yes") {

                                                                $kosher_spec = $row['kosher_spec'];
                                                            ?>
                                                                <select required onchange="createSpecif()" name="kosher" id="kosher" class="form-control w-50 mt-3">
                                                                    <option selected value="<?php echo $row['kosher']; ?>"><?php echo ucwords($row['kosher']); ?></option>
                                                                    <option disabled></option>
                                                                    <option value="no">No</option>
                                                                    <option value="yes">Yes</option>
                                                                </select>


                                                                <input type="text" class="form-control w-50 mt-3" id="kosher-spec" name="kosher-spec" value="<?php echo $row['kosher_spec']; ?>" placeholder="Kosher specify">
                                                            <?php
                                                            } else if ($row["kosher"] == "no") {
                                                                $kosher_spec = "";
                                                            ?>
                                                                <select required onchange="createSpecif()" name="kosher" id="kosher" class="form-control w-50 mt-3">
                                                                    <option selected value="<?php echo $row['kosher']; ?>"><?php echo ucwords($row['kosher']); ?></option>
                                                                    <option disabled></option>
                                                                    <option value="no">No</option>
                                                                    <option value="yes">Yes</option>
                                                                </select>


                                                            <?php
                                                            } else {
                                                                $kosher_spec = "";
                                                            ?>
                                                                <select required onchange="createSpecif()" name="kosher" id="kosher" class="form-control w-50 mt-3">

                                                                    <option value="no">No</option>
                                                                    <option value="yes">Yes</option>
                                                                </select>


                                                            <?php

                                                            }
                                                            ?>

                                                        </h1>
                                                    </div>

                                                  
                                                </div>

                                                <hr>




                                                <hr>
                                                <section>
                                                    <div class="row">
                                                        <div class="col-lg-6">

                                                            <h1 class="h4 mt-4 text-gray-900 mb-4 ">Services</h1>
                                                            <select name="services[]" class="form-control w-50" multiple required>

                                                                <?php
                                                                if ($objService) {
                                                                    while ($row = mysqli_fetch_assoc($objService)) {

                                                                ?>
                                                                        <option value="<?php echo $row["id"] ?>"><?php echo ucwords($row["service_en"]) ?></option>


                                                                <?php

                                                                    }
                                                                }
                                                                ?>

                                                            </select>

                                                        </div>

                                                        <div class="col-lg-6">


                                                            <h1 class="h4 mt-4 text-gray-900 mb-4 ">Specialty:</h1>
                                                            <select name="specialty[]" class="form-control w-50" multiple required>
                                                                <?php

                                                                if ($objSpec) { ?>
                                                                    <?php while ($row = mysqli_fetch_assoc($objSpec)) {

                                                                    ?>
                                                                        <option value="<?php echo $row["id"] ?>"><?php echo ucwords($row["specialty_en"]) ?></option>
                                                                <?php
                                                                    }
                                                                }

                                                                ?>

                                                            </select>

                                                        </div>

                                                    </div>

                                                </section>

                                                <section>
                                                    <h1 class="h4 mt-4 text-gray-900 mb-4 ">Bank Information</h1>
                                                    <table class="table table-striped table-dark table-hover">
                                                        <?php
                                                        if ($objBank) {
                                                            $bank_info = mysqli_fetch_assoc($objBank);
                                                        }
                                                        ?>

                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Bank</th>
                                                                <td scope="col"><input type="text" class="form-control" name="bank" value="<?php echo ucwords($bank_info["bank"]) ?>"></td>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row">Account Number</th>
                                                                <td scope="col"><input type="text" class="form-control" name="account_number" value="<?php echo ucwords($bank_info["account_number"]) ?>"></td>

                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Agency</th>
                                                                <td scope="col"><input type="text" class="form-control" name="agency" value="<?php echo ucwords($bank_info["agency"]) ?>"></td>

                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Name</th>
                                                                <td scope="col"><input type="text" class="form-control" name="b_name" value="<?php echo ucwords($bank_info["name"]) ?>"></td>

                                                            </tr>
                                                        </tbody>
                                                    </table>


                                                </section>
                                                <input type="submit" name="submit" value="Save" class="btn mt-4 btn-success w-25">

                                            </form>



                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- <h1 class="h3 mb-4 text-gray-800">Menu</h1> -->
                    <!-- <form action="" method="post">
                        <div class="container">
                            <table class="table table-hover" id="table_field">
                                <thead>
                                    <tr>
                                        <th scope="col">Starter</th>
                                        <th scope="col">Dishes</th>
                                        <th scope="col">Desserts</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php
                                    $conn = mysqli_connect("localhost", "root", "", "woopyzz");
                                    if (isset($_POST['submit'])) {
                                        $starter = $_POST['starter'];
                                        $dish = $_POST['dish'];
                                        $dessert = $_POST['dessert'];
                                        $restName = $_SESSION['Rname'];

                                        foreach ($starter as $key => $value) {
                                            $sql2 = "INSERT INTO `restaurant_food` (`id`,`name`,`starter`, `dish`, `dessert`, `created`, `updated`) VALUES (NULL, '$restName', '" . $value . "', '" . $dish[$key] . "', '" . $dessert[$key] . "', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
                                            $res2 = mysqli_query($conn, $sql2);
                                            if ($res2) {
                                                header('location:restaurant_profile.php');
                                            }
                                        }
                                    }

                                    ?>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" name="starter[]" class="form-control"></td>
                                        <td><input type="text" name="dish[]" class="form-control"></td>
                                        <td><input type="text" name="dessert[]" class="form-control"></td>
                                        <td><input type="button" class="btn btn-primary" name="add" id="add"
                                                value="Add More"></td>

                                    </tr>

                                </tbody>
                            </table>
                            <div class="text-center">
                                <input class="btn btn-success w-25" type="submit" name="submit" value="Save">
                            </div>
                        </div>
                    </form> -->


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
                    <a class="btn btn-primary" href="login.html">Logout</a>
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
    <script>
        function createSpecif() {
            var value = document.getElementById("kosher").value;

            var container = document.getElementById("kosher-container");



            if (value == "yes") {
                var value_k = document.getElementById("kosher-spec");

                console.log(value_k);
                if (value_k == null) {



                    var newElem = document.createElement("INPUT");
                    newElem.setAttribute("type", "text");
                    newElem.setAttribute("name", "kosher-spec");
                    newElem.setAttribute("id", "kosher-spec");
                    newElem.setAttribute("value", "<?php echo $kosher_spec ?>");
                    newElem.setAttribute("placeholder", "Kosher specify");
                    newElem.setAttribute("class", "form-control w-50 mt-3");

                    console.log(newElem);

                    container.appendChild(newElem);
                }
            } else if (value == "no") {
                var elem = document.getElementById("kosher-spec");
                elem.remove();
            }
        }

        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
    <script>
        function triggerClick() {
            document.querySelector('#profileImage').click();
        }

        function displayImage(e) {
            if (e.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document
                        .querySelector('#profileDisplay')
                        .setAttribute('src', e.target.result);
                };
                reader.readAsDataURL(e.files[0]);
            }
        }
    </script>
    <script>
        function triggerClick1() {
            document.querySelector('#profileImage1').click();
        }

        function displayImage1(e) {
            if (e.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document
                        .querySelector('#profileDisplay1')
                        .setAttribute('src', e.target.result);
                };
                reader.readAsDataURL(e.files[0]);
            }
        }
    </script>
    <script>
        function triggerClick2() {
            document.querySelector('#profileImage2').click();
        }

        function displayImage2(e) {
            if (e.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document
                        .querySelector('#profileDisplay2')
                        .setAttribute('src', e.target.result);
                };
                reader.readAsDataURL(e.files[0]);
            }
        }
    </script>
    <script>
        function triggerClick3() {
            document.querySelector('#profileImage3').click();
        }

        function displayImage3(e) {
            if (e.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document
                        .querySelector('#profileDisplay3')
                        .setAttribute('src', e.target.result);
                };
                reader.readAsDataURL(e.files[0]);
            }
        }
    </script>


</body>

</html>