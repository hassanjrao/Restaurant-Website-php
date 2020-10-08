<?php
session_start();
if (!isset($_SESSION['Rname'])) {
    header('location:restaurant_login.php');
}
include('class/database.php');
class payment extends database
{
    protected $link;
    public function paymentFunction()
    {
        $name = $_SESSION['Rname'];
        $payment = $name . '_payment';
        $sql = "select * from $payment";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
    public function paymentFunction2()
    {
        $name = $_SESSION['Rname'];
        $payment = $name . '_payment';
        $sql = "select * from $payment";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }


    public function updateFunction2()
    {
        if (isset($_POST['update'])) {
            $month = $_POST['month'];
            $client = $_POST['client'];
            $status = "In Progress";
            $amount = $client * 5;
            $name = $_SESSION['Rname'];
            $payment = $name . '_payment';

            $sql = "UPDATE $payment SET client = '$client', amount = '$amount', `status` = '$status' where `id` = '$month'  ";
            $res = mysqli_query($this->link, $sql);

        
            if ($res) {
                header('location:payment.php');
                return $res;
            } else {
                return false;
            }
        }
        # code...
    }
}
$obj = new payment;
$objPayment = $obj->paymentFunction();
$objPayment2 = $obj->paymentFunction2();
$objUpdate = $obj->updateFunction2();

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Resturaunt Panel - Payment </title>

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
                    <h1 class="h3 mb-2 text-gray-800">Payment</h1>

                    <p class="mb-4"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Make Payment
                        </button></p>

                    <form action="" method="post">
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Make Update</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <?php if ($objPayment2) { ?>

                                                    <select name="month" id="months" onchange="getNumOfClients()" class="form-control ">
                                                        <option value="" disabled selected>Select Month</option>
                                                        <?php while ($row2 = mysqli_fetch_assoc($objPayment2)) { ?>
                                                            <option value="<?php echo $row2['id']; ?>">
                                                                <?php echo $row2['month']; ?>
                                                            </option>

                                                        <?php } ?>
                                                    </select>

                                                <?php } ?>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="number" name="client" id="clients" class="form-control" placeholder="Client Number">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" name="update" class="btn btn-success">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Months</th>
                                            <th>Clients Confirmed</th>
                                            <th>Amount</th>
                                            <th>Status</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Months</th>
                                            <th>Clients Confirmed</th>
                                            <th>Amount</th>
                                            <th>Status</th>


                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php if ($objPayment) { ?>
                                            <?php while ($row = mysqli_fetch_assoc($objPayment)) { ?>
                                                <tr>
                                                    <td><?php echo $row['month']; ?></td>
                                                    <td><?php echo $row['client']; ?></td>
                                                    <td><?php echo $row['amount']; ?></td>
                                                    <td>
                                                        <?php if (strcmp($row['status'], 'Done') == 0) { ?>
                                                            <span class="badge badge-pill badge-success"><?php echo $row['status']; ?></span>
                                                        <?php } ?>
                                                        <?php if (strcmp($row['status'], 'Not Done') == 0) { ?>
                                                            <span class="badge badge-pill badge-danger"><?php echo $row['status']; ?></span>
                                                        <?php } ?>
                                                        <?php if (strcmp($row['status'], 'In Progress') == 0) { ?>
                                                            <span class="badge badge-pill badge-warning"><?php echo $row['status']; ?></span>
                                                        <?php } ?>
                                                    </td>

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
        $('#dataTable').dataTable({
            "order": [],
            "columnDefs": [{
                "targets": 'no-sort',
                "orderable": false,
            }],
            "bPaginate": false

        });

        function getNumOfClients() {
            var month = document.getElementById("months").value;
            console.log(month);

            $.ajax({
                type: "POST",
                url: "getTotalClients.php",
                data: {
                    month: month
                },
                success: function(data) {
                    console.log(data);

                     $("#clients").attr("value",data);
                }
            });
        }
    </script>

</body>

</html>