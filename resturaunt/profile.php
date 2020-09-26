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
        $rest_id=$_SESSION['rest_id'];
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
    public function updateFunction()
    {
        if (isset($_POST['submit'])) {
            $name = $_SESSION['Rname'];
            $image = time() . '_' . $_FILES['image']['name'];
            $image1 = time() . '_' . $_FILES['image1']['name'];
            $image2 = time() . '_' . $_FILES['image2']['name'];
            $image3 = time() . '_' . $_FILES['image3']['name'];
            $phone = $_POST['phone'];
            $speciality = serialize($_POST['specialty']);
            $kosher = $_POST['kosher'];
            $target = 'rest_img/' . $image;
            $target1 = 'rest_img/' . $image1;
            $target2 = 'rest_img/' . $image2;
            $target3 = 'rest_img/' . $image3;
            // $terrace = $_POST['terrace'];
            // $bar = $_POST['bar'];
            // $music = $_POST['music'];
            // $parking = $_POST['parking'];

            if ($_FILES['image']['name'] == '' && $_FILES['image1']['name'] == '' && $_FILES['image2']['name'] == '' && $_FILES['image3']['name'] == '') {

               
                $sql = "UPDATE `restaurant_tbl` SET `speciality` = '$speciality', `kosher` = '$kosher', `phone` = '$phone' where name = '$name' ";
          
                 } else {
                $sql = "UPDATE `restaurant_tbl` SET `speciality` = '$speciality', `kosher` = '$kosher', `phone` = '$phone', `image` = '$image', `gallery1` = '$image1', `gallery2` = '$image2', `gallery3` = '$image3' where name = '$name' ";
            }


            $res = mysqli_query($this->link, $sql);

            // $sql2 = "INSERT INTO `restaurant_feature` (`id`, `rest_name`, `park`, `bar`, `music`, `terrace`, `name`) VALUES (NULL, '$name', '$parking', '$bar', '$music', '$terrace', '')";
            // mysqli_query($this->link, $sql2);
            if ($res) {
                move_uploaded_file($_FILES['image']['tmp_name'], $target);
                move_uploaded_file($_FILES['image1']['tmp_name'], $target1);
                move_uploaded_file($_FILES['image2']['tmp_name'], $target2);
                move_uploaded_file($_FILES['image3']['tmp_name'], $target3);
                // header('location:profile.php');

               
                return $res;
            } else {
                return false;
            }
        }
        # code...
    }
}
$obj = new profile;
$objProfile = $obj->profileFunction();
$objSpec = $obj->getSpec();
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

                <!-- topbar -->
                <?php include('topbar.php'); ?>
                <!-- End of topbar -->

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
                                                    <div class="col-md-4 mx-auto">
                                                        <img class="profileImage mt-4" onclick="triggerClick()" id="profileDisplay" src="rest_img/<?php echo $row['image']; ?>" alt="">
                                                        <input type="file" accept="image/*" name="image" id="profileImage" onchange="displayImage(this)" style="display: none;">
                                                        <!-- <p class="lead text-center">Tap to upload image</p> -->
                                                    </div>
                                                    <div class="col-md-8">
                                                        <h1 class="h4 text-gray-900 mb-4 mt-3">Restaurant
                                                            Features</h1>
                                                        <h1 class="h6 text-gray-900 mb-4">Name:
                                                            <span class="font-weight-bold"><?php echo $row['name_en']; ?></span>
                                                        </h1>
                                                        <h1 class="h6 text-gray-900 mb-4">Address:
                                                            <span class="font-weight-bold"><?php echo $row['address_en']; ?></span>
                                                        </h1>
                                                        <input type="text" placeholder="Phone Number" class="form-control w-50" value="<?php echo $row['phone']; ?>" name="phone">
                                                        <br>
                                                        Specialty:
                                                        <select name="specialty[]" class="form-control w-50" multiple required>
                                                            <?php

                                                            if ($objSpec) { ?>
                                                                <?php while ($row = mysqli_fetch_assoc($objSpec)) {

                                                                ?>
                                                                    <option value="<?php echo $row["specialty"] ?>"><?php echo ucwords($row["specialty"]) ?></option>
                                                            <?php
                                                                }
                                                            }

                                                            ?>

                                                        </select>

                                                        <input type="text" placeholder="Kosher" class="form-control w-50 mt-4" value="<?php echo $row['kosher']; ?>" name="kosher">


                                                    </div>
                                                </div>
                                                <div class="container">
                                                    <hr>
                                                </div>


                                                <section>
                                                    <h1 class="h4 mt-4 text-gray-900 mb-4 ">Restaurant Image</h1>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <img class="profileImageSq mt-4" onclick="triggerClick1()" id="profileDisplay1" src="<?php echo "rest_img/".$row['gallery1']; ?>" alt="">
                                                            <input type="file" accept="image/*" name="image1" id="profileImage1" onchange="displayImage1(this)" style="display: none;">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <img class="profileImageSq mt-4" onclick="triggerClick2()" id="profileDisplay2" src="rest_img/<?php echo $row['gallery2']; ?>" alt="">
                                                            <input type="file" accept="image/*" name="image2" id="profileImage2" onchange="displayImage2(this)" style="display: none;">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <img class="profileImageSq mt-4" onclick="triggerClick3()" id="profileDisplay3" src="rest_img/<?php echo $row['gallery3']; ?>" alt="">
                                                            <input type="file" accept="image/*" name="image3" id="profileImage3" onchange="displayImage3(this)" style="display: none;">
                                                        </div>
                                                    </div>
                                                </section>
                                                <section>
                                                    <h1 class="h4 mt-4 text-gray-900 mb-4 ">Services</h1>
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input name="terrace" type="checkbox" class="form-check-input" value="Yes">Terrace
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input name="park" type="checkbox" class="form-check-input" value="Yes">Parking
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input name="bar" type="checkbox" class="form-check-input" value="Yes">Bar
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input name="music" type="checkbox" class="form-check-input" value="Yes">Music
                                                        </label>
                                                    </div>

                                                </section>

                                                <section>
                                                    <h1 class="h4 mt-4 text-gray-900 mb-4 ">Bank Information</h1>
                                                    <table class="table table-striped table-dark table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Bank</th>
                                                                <th scope="col">Jibon</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row">Account Number</th>
                                                                <td>Mark</td>

                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Agency</th>
                                                                <td>Jacob</td>

                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Name</th>
                                                                <td>Larry</td>

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