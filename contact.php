<?php
session_start();
if ($_SESSION['email']) {
} else {
    header('location:signInUp.php');
}

include('class/database.php');
class contact extends database
{
    protected $link;
    public function contactFunction()
    {
        $email = $_GET['email'];
        $sql = "select * from user_tbl where email = '$email' ";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
    public function infoFunction()
    {
        $email = $_GET['email'];
        $sql = "select * from user_info where email = '$email' ";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
    public function reserveFunction()
    {
        if (isset($_POST['reserve'])) {
            $email = $_GET['email'];
            header('location:reservation.php?email=' . $email);
        }
        # code...
    }
}
$obj = new contact;
$objContact = $obj->contactFunction();
$objInfo = $obj->infoFunction();
$objReserve = $obj->reserveFunction();
$row = mysqli_fetch_assoc($objContact);
$rowInfo = mysqli_fetch_assoc($objInfo);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include('layout/style.php'); ?>

</head>

<body class="bg-light">
    <?php include('layout/navbar.php'); ?>

    <?php include('layout/hero_section.php'); ?>

    <section>
        <div class="container bg-white p-5 contact_section">
            <div class="row">
                <div class="col-md-6">
                    <p class="text-secondary">Name</p>
                    <h4 class="font-weight-bold mt-3"><?php echo $row['fname']; ?> <?php echo $row['lname']; ?></h4>
                    <hr>
                    <p class="mt-3 text-secondary">Phone Number</p>
                    <h4 class="font-weight-bold mt-3"><?php echo $rowInfo['phone']; ?></h4>
                    <hr>
                    <p class="mt-3 text-secondary">Email</p>
                    <h4 class="font-weight-bold mt-3"><?php echo $row['email']; ?></h4>
                    <hr>
                </div>
                <div class="col-md-6">
                    <img src="images/sushi-373588_1920.jpg" alt="">
                </div>
            </div>
        </div>
        <form action="" method="post">
            <div class="container">
                <button type="submit" name="reserve" class="w-25 mt-4 log_btn btn btn-lg font-weight-bold">Next</button>

            </div>
        </form>
    </section>

    <?php include('layout/footer.php'); ?>


    <?php include('layout/script.php') ?>
</body>

</html>