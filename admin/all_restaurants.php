<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("location: login.php");
}
include('class/database.php');
class restaurant extends database
{
    protected $link;
    public function restaurantFunction()
    {
        $sqlRest = "select * from restaurant_tbl";
        $resRest = mysqli_query($this->link, $sqlRest);
        if (mysqli_num_rows($resRest) > 0) {
            return $resRest;
        } else {
            return false;
        }
        # code...
    }
    public function createRestaurant()
    {
        if (isset($_POST['submit'])) {
            $name_en = addslashes(str_replace(" ", "_", $_POST['name_en']));
            $name_heb = addslashes(str_replace(" ", "_", $_POST['name_heb']));
            $name_fr = addslashes(str_replace(" ", "_", $_POST['name_fr']));

            $address_en = addslashes($_POST['address_en']);
            $address_heb = addslashes($_POST['address_heb']);
            $address_fr = addslashes($_POST['address_fr']);

            $cities = serialize($_POST["cities"]);


            $email = addslashes($_POST['email']);
            $password = addslashes($_POST['password']);
            $payment = $name_en . "_payment";
            $phone = $_POST['phone'];
            $image = "placeholder-16-9.jpg";
            $gallery1 = "placeholder-16-9.jpg";
            $gallery2 = "placeholder-16-9.jpg";
            $gallery3 = "placeholder-16-9.jpg";

            $pass = password_hash($password, PASSWORD_DEFAULT);

            $sqlFind = "select * from restaurant_tbl where name_en = '$name_en' ";
            $resFind = mysqli_query($this->link, $sqlFind);
            if (mysqli_num_rows($resFind) > 0) {
                $msg = "taken";
                return $msg;
            } else {
                $sql = "INSERT INTO `restaurant_tbl` (`name_en`, `name_heb`, `name_fr`, `phone`, `address_en`, `address_heb`, `address_fr`, `cities` , `email`, `password`, `created`, `updated`) VALUES ( '$name_en', '$name_heb', '$name_fr', '$phone', '$address_en', '$address_heb', '$address_fr', '$cities', '$email', '$pass', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
                $res = mysqli_query($this->link, $sql);
                if ($res) {
                    $sql2 = "CREATE TABLE $name_en (
                        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                        name VARCHAR(30) NOT NULL,
                        time VARCHAR(30) NOT NULL,
                        sun VARCHAR(50),
                        mon VARCHAR(50),
                        tue VARCHAR(50),
                        wed VARCHAR(50),
                        thu VARCHAR(50),
                        fri VARCHAR(50),
                        sat VARCHAR(50),
                        psun VARCHAR(50),
                        pmon VARCHAR(50),
                        ptue VARCHAR(50),
                        pwed VARCHAR(50),
                        pthu VARCHAR(50),
                        pfri VARCHAR(50),
                        psat VARCHAR(50),
                        lsun VARCHAR(50),
                        lmon VARCHAR(50),
                        ltue VARCHAR(50),
                        lwed VARCHAR(50),
                        lthu VARCHAR(50),
                        lfri VARCHAR(50),
                        lsat VARCHAR(50),
                        created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                        )";
                    $res2 = mysqli_query($this->link, $sql2);

                


                    $sqlPay = "CREATE TABLE $payment (
                        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                        name VARCHAR(30) NOT NULL,
                        month VARCHAR(30) NOT NULL,
                        client INT(11),
                        amount INT(11),
                        status VARCHAR(30),
                        
                        created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                        )";

                    $resPay = mysqli_query($this->link, $sqlPay);
                    if ($res2) {
                        $sql3 = "INSERT INTO `$name_en` (`id`, `name`, `time`, `sun`, `mon`, `tue`, `wed`, `thu`, `fri`, `sat`,`psun`, `pmon`, `ptue`, `pwed`, `pthu`, `pfri`, `psat`,`lsun`, `lmon`, `ltue`, `lwed`, `lthu`, `lfri`, `lsat`, `created`) VALUES (NULL, '$name_en', '09:00-10:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL, NULL, NULL, NULL, NULL, CURRENT_TIMESTAMP),(NULL, '$name_en', '10:00-11:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL ,CURRENT_TIMESTAMP),(NULL, '$name_en', '11:00-12:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL ,CURRENT_TIMESTAMP),(NULL, '$name_en', '12:00-13:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL,CURRENT_TIMESTAMP),(NULL, '$name_en', '13:00-14:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL,CURRENT_TIMESTAMP),(NULL, '$name_en', '14:00-15:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL,CURRENT_TIMESTAMP),(NULL, '$name_en', '15:00-16:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL ,CURRENT_TIMESTAMP),(NULL, '$name_en', '16:00-17:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL ,CURRENT_TIMESTAMP),(NULL, '$name_en', '17:00-18:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL ,CURRENT_TIMESTAMP),(NULL, '$name_en', '18:00-19:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL ,CURRENT_TIMESTAMP),(NULL, '$name_en', '19:00-20:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL ,CURRENT_TIMESTAMP),(NULL, '$name_en', '20:00-21:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL ,CURRENT_TIMESTAMP),(NULL, '$name_en', '21:00-22:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL ,CURRENT_TIMESTAMP),(NULL, '$name_en', '22:00-23:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL ,CURRENT_TIMESTAMP)";
                        $res3 = mysqli_query($this->link, $sql3);
                        $sqlPay2 = "INSERT INTO `$payment` (`id`, `name`, `month`, `client`, `amount`, `status`, `created`) VALUES (NULL, '$name_en', 'January', NULL, NULL, NULL, CURRENT_TIMESTAMP),(NULL, '$name_en', 'February', NULL, NULL, NULL, CURRENT_TIMESTAMP), (NULL, '$name_en', 'March', NULL, NULL, NULL, CURRENT_TIMESTAMP),(NULL, '$name_en', 'April', NULL, NULL, NULL, CURRENT_TIMESTAMP),(NULL, '$name_en', 'May', NULL, NULL, NULL, CURRENT_TIMESTAMP),(NULL, '$name_en', 'Jun', NULL, NULL, NULL, CURRENT_TIMESTAMP),(NULL, '$name_en', 'July', NULL, NULL, NULL, CURRENT_TIMESTAMP),(NULL, '$name_en', 'August', NULL, NULL, NULL, CURRENT_TIMESTAMP),(NULL, '$name_en', 'September', NULL, NULL, NULL, CURRENT_TIMESTAMP),(NULL, '$name_en', 'October', NULL, NULL, NULL, CURRENT_TIMESTAMP),(NULL, '$name_en', 'November', NULL, NULL, NULL, CURRENT_TIMESTAMP),(NULL, '$name_en', 'December', NULL, NULL, NULL, CURRENT_TIMESTAMP)";


                        $resPay2 = mysqli_query($this->link, $sqlPay2);

                       

                        if ($res3) {
                             header('location:all_restaurants.php');
                            return $res3;
                        }
                        header('location:all_restaurants.php');
                        return $res2;
                    }
                } else {
                  
                    return false;
                }
            }
        }
        # code...
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

    public function getCityName($city_id){
        $sql = "select * from cities_tb where id='$city_id'";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
    }
}
$obj = new restaurant;
$objRest = $obj->restaurantFunction();
$objCreate = $obj->createRestaurant();
$objCity = $obj->getCity();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - All Restaurant</title>

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
                    <h1 class="h3 mb-2 text-gray-800">Restaurants List</h1>


                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <button class="btn btn-primary mt-3" data-toggle="modal" data-target="#exampleModal">Create
                                Restaurant</button>
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <form >
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
                                                        <input type="text" required id="name_en" name="name_en" class="border-0 form-control" placeholder="Restaurant Name English">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" name="name_heb" id="name_heb" class="border-0 form-control" placeholder="Restaurant Name Hebrew">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" name="name_fr" id="name_fr" class="border-0 form-control" placeholder="Restaurant Name French">
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4 mt-3">
                                                        <input type="email" required name="email" id="email" class="form-control border-0" placeholder="Restaurant Email">
                                                    </div>
                                                    <div class="col-md-4 mt-3">
                                                        <input type="password" required name="password" id="password" class="form-control border-0" placeholder="Password">
                                                    </div>

                                                    <div class="col-md-4 mt-3">
                                                        <input type="text" required name="phone" id="phone" class="form-control border-0" placeholder="Phone Number">
                                                    </div>

                                                </div>


                                                <div class="row">

                                                    <div class="col-md-12 mt-3">
                                                        <input type="text" required name="address_en" id="address_en" class="form-control border-0" placeholder="Address English">
                                                    </div>
                                                    <div class="col-md-12 mt-3">
                                                        <input type="text" name="address_heb" id="address_heb" class="form-control border-0" placeholder="Address Hebrew">
                                                    </div>
                                                    <div class="col-md-12 mt-3">
                                                        <input type="text" name="address_fr" id="address_fr" class="form-control border-0" placeholder="Address French">
                                                    </div>
                                                </div>

                                                <div class="row">

                                                    <div class="col-md-6 mt-3">
                                                        <select class="form-control" name="cities[]" id="cities" multiple required>
                                                            <option slected disabled>Select Cities</option>

                                                            <?php
                                                            if ($objCity) {

                                                                while ($row = mysqli_fetch_assoc($objCity)) {

                                                            ?>
                                                                    <option value="<?php echo $row["id"] ?>"><?php echo ucwords($row["city_en"]) ?></option>
                                                                <?php
                                                                }
                                                            } else {
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
                                                <button type="button" onclick="sendDataR()" name="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <?php if (strcmp($objCreate, 'taken') == 0) { ?>
                                <div class="alert alert-warning alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Restaurant Name Is Taken!</strong>
                                </div>


                            <?php } ?>


                            <?php
                            if (isset($_GET["msg"])) {
                                if (strcmp($_GET["msg"], 'success') == 0) { ?>
                                    <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>Successfully Updated!</strong>
                                    </div>


                            <?php }
                            } ?>

                            <?php
                            if (isset($_GET["msg"])) {
                                if (strcmp($_GET["msg"], 'success_del') == 0) { ?>
                                    <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>Successfully Deleted!</strong>
                                    </div>


                            <?php }
                            } ?>

                            <?php
                            if (isset($_GET["msg"])) {
                                if (strcmp($_GET["msg"], 'fail_del') == 0) { ?>
                                    <div class="alert alert-warning alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>Deletion Failed!</strong>
                                    </div>


                            <?php }
                            } ?>


                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Cities</th>
                                            <th>Created</th>
                                            <th>Edit/Delete</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Cities</th>
                                            <th>Created</th>
                                            <th>Edit/Delete</th>

                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php if ($objRest) { ?>
                                            <?php while ($row = mysqli_fetch_assoc($objRest)) {

                                                $id = $row['id'];
                                                $name = $row['name_en'];



                                                $city_arr = unserialize($row["cities"]);

                                             

                                            ?>
                                                <tr>
                                                    <td><?php echo $row['id']; ?></td>
                                                    <td><?php echo $row['name_en']; ?></td>
                                                    <td><?php echo $row['address_en']; ?></td>
                                                    <td>
                                                        <?php
                                                        if ($city_arr != NULL) {
                                                            $newObj=new restaurant;
                                                            foreach ($city_arr as $city_id) {

                                                                $city_res=mysqli_fetch_assoc($newObj->getCityName($city_id));

                                                                echo $city_res["city_en"].",";
                                                                
                                                            }
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?php echo $row['created']; ?></td>
                                                    <td><a href="<?php echo "restaurant_edit.php?id=$id&name=$name"; ?>" class="btn btn-primary btn-sm">Edit</a>
                                                        <a href="<?php echo "restaurant_delete.php?id=$id&name=$name"; ?>" class="btn btn-danger btn-sm">Delete</a></td>

                                                </tr>
                                            <?php } ?>
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

    
    <script>
        function sendDataR() {

           var name_en = document.getElementById("name_en").value;
           var name_heb = document.getElementById("name_heb").value;
           var name_fr = document.getElementById("name_fr").value;

           var email = document.getElementById("email").value;
           var password = document.getElementById("password").value;
           var phone = document.getElementById("phone").value;

           var address_en = document.getElementById("address_en").value;
           var address_heb = document.getElementById("address_heb").value;
           var address_fr = document.getElementById("address_fr").value;

            // cities = document.getElementById("cities").value;

            var cities = $('#cities').val();
        


            console.log(name_en);
            console.log(name_heb);
            console.log(name_fr);

            console.log(email);
            console.log(password);
            console.log(phone);

            console.log(address_en);
            console.log(address_heb);
            console.log(address_fr);

            console.log(cities);
          


            $.ajax({

                url: 'https://geocoder.ls.hereapi.com/6.2/geocode.json?apiKey=F8AWLo4qe51rnLMUknCs8HPYGwl7Q7p_5TNVahy0a8s&gen=9&searchtext=' + address_en,

                type: 'GET',

                data: address_en,

                success: function(result) {


                    var longt = result["Response"]["View"][0]["Result"][0]["Location"]["DisplayPosition"]["Longitude"];

                    var latit = result["Response"]["View"][0]["Result"][0]["Location"]["DisplayPosition"]["Latitude"];

                    console.log("lat" + latit);

                    console.log("long" + longt);


                    $.ajax({


                        url: "rest_create.php",

                        type: 'POST',

                        data: {
                            name_en: name_en,
                            name_heb: name_heb,
                            name_fr: name_fr,
                            email:email,
                            password:password,
                            phone: phone,
                            address_en: address_en,
                            address_heb: address_heb,
                            address_fr: address_fr,
                            cities: cities,
                            lat: latit,
                            lon: longt
                        },

                        success: function(status) {

                            console.log(status);

                            if(status=="success_add"){
                                window.location.replace("all_restaurants.php?msg=success_add");
                            }
                            else if(status=="fail_add"){
                                window.location.replace("all_restaurants.php?msg=fail_add");
                            }

                        }

                    });

                }

            });

        }
    </script>

</body>

</html>