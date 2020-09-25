<?php
session_start();
if ($_SESSION['Rname']) {
} else {
    header('location:restaurant_login.php');
}
// include('class/database.php');
// class menu extends database
// {
//     protected $link;
//     public function menuFunction()
//     {
//         if (isset($_POST['submit'])) {
//             $starter = $_POST['starter'];
//             $dishes = $_POST['dish'];
//             $dessert = $_POST['dessert'];

//             foreach ($starter as $key => $value) {
//                 $sql = "INSERT INTO `restaurant_food` (`id`, `starter`, `dish`, `dessert`, `created`, `updated`) VALUES (NULL, '" . $value . "', '" . $dishes[$key] . "', '" . $dessert[$key] . "', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
//                 $res = mysqli_query($this->link, $sql);
//                 if ($res) {
//                     echo "Added";
//                     return $res;
//                 } else {
//                     return false;
//                 }
//                 # code...
//             }
//         }
//         # code...
//     }
// }
// $obj = new menu;
// $objMenu = $obj->menuFunction();

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
    <script src="vendor/jquery/jquery.min.js"></script>

    <script type="text/javascript">
    $(document).ready(function() {
        var html =
            '<tr><td><input type="text" name="starter[]" class="form-control"></td><td><input type="text" name="dish[]" class="form-control"></td><td><input type="text" name="dessert[]" class="form-control"></td><td><input type="button" class="btn btn-danger" name="remove" id="remove" value="Remove"></td></tr>';
        var max = 10;
        var x = 1;
        $("#add").click(function() {
            if (x <= max) {
                $("#table_field").append(html);
                x++;
            }
        });
        $("#table_field").on('click', '#remove', function() {
            $(this).closest('tr').remove();
            x--;
        })
    })
    </script>

</head>

<body class="bg-light">

    <form action="" method="post">
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
                        <td><input type="button" class="btn btn-primary" name="add" id="add" value="Add More"></td>

                    </tr>

                </tbody>
            </table>
            <div class="text-center">
                <input class="btn btn-success w-25" type="submit" name="submit" value="Save">
            </div>
        </div>
    </form>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>


</body>

</html>