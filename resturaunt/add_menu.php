<?php
session_start();
include('class/database.php');
class menu extends database
{
    protected $link;
    public function menuFunction()
    {
        $name = $_SESSION['Rname'];
        $id = $_SESSION['id'];
        $sql = "select * from restaurant_tbl where name = '$name' ";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
    public function saveFunction()
    {
        if (isset($_POST['submit'])) {
            $rest_id = $_SESSION['rest_id'];

            $starter = $_POST['starter'];
            $s_price = $_POST["s_price"];
            $dish = $_POST['dish'];
            $d_price = $_POST["d_price"];
            $dessert = $_POST['dessert'];
            $ds_price = $_POST["ds_price"];

            $sql = "INSERT INTO `menu` (`starter_name`, `starter_price`, `dish_name`, `dish_price`, `dessert_name`, `dessert_price`,`rest_id`) VALUES ('$starter', '$s_price', '$dish', '$d_price', '$dessert', '$ds_price', '$rest_id')";
            $res = mysqli_query($this->link, $sql);
        }
        # code...
    }
}
 $obj = new menu;
 $obj->saveFunction();
// $row = mysqli_fetch_assoc($objProfile);
?>
<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Resturaunt Panel - Add Menu  </title>

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
                    <h1 class="h3 mb-4 text-gray-800">Add Menu</h1>
                    <div class="container">

                        <div class="card o-hidden border-0 shadow-lg my-5">
                            <div class="card-body p-0">
                                <!-- Nested Row within Card Body -->
                                <div class="row">

                                    <div class="col-lg-12">

                                        <div class="p-5">
                                            <div class="text-center">

                                            </div>
                                            <form class="user" method="post" action="add_menu.php" enctype="multipart/form-data">


                                                <div class="container">
                                                    <hr>
                                                </div>

                                                <section>
                                                    <h1 class="h4 text-gray-900 mb-4 ">Restaurant
                                                        Menu</h1>
                                                    <div class="row">

                                                        <div class="col-md-4">
                                                            <input type="text" name="starter" class="form-control mt-3" placeholder="Starter">
                                                            <input type="number" name="s_price" class="form-control mt-2" placeholder="Price">

                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="text" name="dish" class="form-control mt-3" placeholder="dish">
                                                            <input type="number" name="d_price" class="form-control mt-2" placeholder="Price">

                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="text" name="dessert" class="form-control mt-3" placeholder="Dessert">
                                                            <input type="number" name="ds_price" class="form-control mt-2" placeholder="Price">

                                                        </div>

                                                    </div>
                                                </section>
                                                <!-- <section>
                                                    <h1 class="h4 mt-4 text-gray-900 mb-4 ">Restaurant Image</h1>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <img class="profileImageSq mt-4" onclick="triggerClick1()" id="profileDisplay1" src="rest_img/<?php echo $row['gallery1']; ?>" alt="">
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


                                                </section> -->
                                                <input type="submit" name="submit" value="Add" class="btn mt-4 btn-success w-25">

                                            </form>



                                        </div>
                                    </div>
                                </div>
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


</body>

</html>