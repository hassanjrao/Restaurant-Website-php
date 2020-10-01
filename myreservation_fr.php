<?php
session_start();
include('class/database.php');
class myReserve extends database
{
    protected $link;
    public function myReservationFunction()
    {
        $email = $_SESSION['email'];
        $sql = "select * from reservation_tbl where email = '$email' AND user_confirm = 1";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
    public function myCountReservationFunction()
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
    public function getRest($name)
    {
        # code...
        $sql = "select * from restaurant_tbl where name_en='$name'";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
    }
}
$obj = new myReserve;
$objConfirm = $obj->myReservationFunction();
$objShow = $obj->showProfile();
$rowInfo = mysqli_fetch_assoc($objShow);
$objReserve = $obj->myCountReservationFunction();
$rowCount = mysqli_fetch_assoc($objReserve);



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes reservations</title>
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
    <?php include('layout/navbar_fr.php'); ?>


    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <h3 class="float-left font-weight-bold" style="color: #481639">Tableau de bord </h3>
                    <a href="profile_fr.php" class="font-weight-normal  text-dark pt-5 d-block mt-5" style="text-decoration: none;">Profil</a>
                    <hr>
                    <a href="resetpass_fr.php" class=" font-weight-normal text-dark  d-block" style="text-decoration: none;">Réinitialiser le mot de passe</a>
                    <hr>
                    <a href="myreservation_fr.php" class=" font-weight-normal text-dark  d-block" style="text-decoration: none;">Mes reservations <?php if ($objReserve) { ?>
                            <span class="badge badge-dark ml-2"><?php echo $rowCount['total']; ?></span>
                        <?php } else { ?>
                            <span class="badge badge-dark ml-2">0</span>
                        <?php } ?></a>
                    <hr>
                    <a href="logout.php" class="mb-5 font-weight-normal text-dark  d-block" style="text-decoration: none;">Se déconnecter</a>
                </div>
                <div class="col-md-10">
                    <h3 class="float-right d-block font-weight-bold" style="color: #481639"><span class="text-secondary font-weight-light">Bienvenue |</span>
                        <?php echo $rowInfo['fname'] ?>
                        <?php echo $rowInfo['lname']; ?></h3>

                    <div class="account bg-white mt-5 p-5 rounded">
                        <h4 class="font-weight-bold" style="color: #481639">Détails de la réservation</h4>
                        <div class="row mt-4">
                            <div class="col-md-4 col-4">
                                <p class="font-weight-bold">Nom du restaurant</p>
                            </div>
                            <div class="col-md-4 col-4">
                                <p class="font-weight-bold">Code</p>
                            </div>
                            <div class="col-md-4 col-4">
                                <p class="font-weight-bold">Statut</p>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <?php if ($objConfirm) { ?>
                                <?php while ($row = mysqli_fetch_assoc($objConfirm)) {

                                    $rest_name = $row["rest_name"];

                                    if ($obj->getRest($rest_name)) {
                                        $rest_row = mysqli_fetch_assoc($obj->getRest($rest_name));
                                    }


                                    $name = $rest_row["name_fr"]

                                ?>
                                    <div class="col-md-4 col-4 mt-2">
                                        <p><?php echo $name; ?></p>
                                    </div>

                                    <div class="col-md-4 col-4 mt-2">
                                        <p><?php echo $row['code']; ?></p>

                                    </div>
                                    <div class="col-md-4 col-4 mt-2">
                                        <?php if ($row['rest_confirm'] == 0) { ?>

                                            <span class="badge badge-pill badge-warning">En cours</span>

                                        <?php } ?>
                                        <?php if ($row['rest_confirm'] == 1) { ?>

                                            <span class="badge badge-pill badge-success">Accepté</span>

                                        <?php } ?>
                                        <?php if ($row['rest_confirm'] == 2) { ?>

                                            <span class="badge badge-pill badge-success">Annulé</span>

                                        <?php } ?>

                                    </div>


                                <?php } ?>
                            <?php } else { ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>Pas de réservation</p>
                                    </div>
                                </div>

                            <?php } ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <?php include('layout/footer_fr.php'); ?>


    <?php include('layout/script.php') ?>
</body>

</html>