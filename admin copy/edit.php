<?php
session_start();
if ($_SESSION['Rname']) {
} else {
    header('location:restaurant_login.php');
}


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">

                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Restaurant Features</h1>
                            </div>
                            <form class="user" method="post" action="" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="">Parking</label>
                                        <select name="parking" class="form-control" id="">
                                            <option value="" disable selected>Choose one</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="">Bar</label>
                                        <select name="bar" class="form-control" id="">
                                            <option value="" disable selected>Choose one</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 mt-4">
                                        <label for="Music">Music</label>
                                        <select name="music" class="form-control" id="">
                                            <option value="" disable selected>Choose one</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 mt-4">
                                        <label for="">Terrace</label>
                                        <select name="terrace" class="form-control" id="">
                                            <option value="terrace" disable selected>Choose one</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mt-4 text-center mx-auto">
                                    <input type="file" name="img[]" class="" multiple>
                                </div>
                                <input type="submit" name="submit" class="btn btn-success btn-block">
                            </form>
                            <a href="restaurant_profile.php" class="btn mt-4 btn-primary">Back</a>
                            <?php
                            $conn = mysqli_connect("localhost", "root", "", "woopyzz");
                            if (isset($_POST['submit'])) {
                                $filename = $_FILES['img']['name'];
                                $tmpname = $_FILES['img']['tmp_name'];
                                $filetype = $_FILES['img']['type'];
                                $Rname = $_SESSION['Rname'];
                                $bar = $_POST['bar'];
                                $music = $_POST['music'];
                                $park = $_POST['parking'];
                                $terrace = $_POST['terrace'];

                                for ($i = 0; $i <= count($tmpname) - 1; $i++) {
                                    $name = addslashes($filename[$i]);
                                    $tmp = addslashes(file_get_contents($tmpname[$i]));
                                    $sql = "INSERT INTO `restaurant_feature` (`id`, `rest_name`, `park`, `bar`, `music`, `terrace`, `name`,`image`) VALUES (NULL, '$Rname', '$park', '$bar', '$music', '$terrace', '$name','$tmp')";
                                    mysqli_query($conn, $sql);
                                }
                            }
                            ?>

                        </div>
                    </div>
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