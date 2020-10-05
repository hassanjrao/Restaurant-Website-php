<?php
session_start();


include('class/database.php');
$rest_name = $_GET['name'];
$_SESSION['rname'] = $rest_name;
$rest_add = $_GET['address'];
$_SESSION['address'] = $rest_add;


$date = isset($_GET["date"]) == true ? $_GET["date"] : NULL;
$people = isset($_GET["people"]) == true ? $_GET["people"] : NULL;
$s_time = isset($_GET["time"]) == true ? $_GET["time"] : NULL;
$day =  isset($date) == true ? strtolower(date('D', strtotime("$date"))) : strtolower(date("D"));
$location = isset($_GET["location"]) == true ? $_GET["location"] :  NULL;

// var_dump($date);
// var_dump($day);
// var_dump($people);
// var_dump($location);

class restaurant extends database
{
    public $link;

    public function restaurantFunction()
    {
        if (isset($_POST['submit'])) {

            $people = $_POST['person'];
            $time = $_POST['time'];
            $date = $_POST['date'];
            $user_confirm = 0;
            $rest_confirm = 0;
            $restName = addslashes($_GET['name']);
            $code = mt_rand(100000, 999999);

            $day =  isset($date) == true ? strtolower(date('D', strtotime("$date"))) : NULL;

            $day = "l" . strtolower($day);
            $_SESSION["people"] = $people;
            $_SESSION["day"] = $day;
            $_SESSION["time"] = $time;
            $_SESSION["date"] = $date;
            $_SESSION["discount"] = $date;



            $t = explode("-", $time);
            $start_time = $t[0];
            $s_t = explode(":", $start_time);

            $st = $s_t[0];



            if ($st == "9") {
                $tim = "09:00-10:00";
            } else if ($st == "10") {
                $tim = "10:00-11:00";
            } else if ($st == "11") {
                $tim = "11:00-12:00";
            } else if ($st == "12") {
                $tim = "12:00-13:00";
            } else if ($st == "13") {
                $tim = "13:00-14:00";
            } else if ($st == "14") {
                $tim = "14:00-15:00";
            } else if ($st == "15") {
                $tim = "15:00-16:00";
            } else if ($st == "16") {
                $tim = "16:00-17:00";
            } else if ($st == "17") {
                $tim = "17:00-18:00";
            } else if ($st == "18") {
                $tim = "18:00-19:00";
            } else if ($st == "19") {
                $tim = "19:00-20:00";
            } else if ($st == "20") {
                $tim = "20:00-21:00";
            } else if ($st == "21") {
                $tim = "21:00-22:00";
            } else if ($st == "22") {
                $tim = "22:00-23:00";
            }



            $sql0 = "SELECT $day from $restName where time='$tim' ";
            $res0 = mysqli_query($this->link, $sql0);
            $resl0 = mysqli_fetch_assoc($res0);
            $left = intval($resl0[$day]);

            if (intval($people) <= $left) {

                $sql = "INSERT INTO `reservation_tbl` (`id`, `rest_name`, `people`, `time`, `date`, `code`, `email`, `user_confirm`, `rest_confirm`, `created`, `updated`) VALUES (NULL, '$restName', '$people', '$time', '$date', '$code', NULL, '$user_confirm', '$rest_confirm', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
                $res = mysqli_query($this->link, $sql);
                if ($res) {
                    echo "Added";
                    $_SESSION['code'] = $code;
                    header('location:profile_fr.php');
                    return $res;
                } else {
                    echo "Not added";
                    return false;
                }
            } else {

                $msg = "failed-$left";
                return $msg;
            }
        }
        # code...
    }
    public function foodFunction()
    {
        $name = $_GET['name'];
        $rest_id = $_GET["id"];
        $sql = "select * from menu_starter_tb  where rest_id = '$rest_id' ";


        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
    public function foodFunction2()
    {
        $name = $_GET['name'];
        $rest_id = $_GET["id"];
        $sql = "select * from menu_dish_tb  where rest_id = '$rest_id' ";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
    public function foodFunction3()
    {
        $name = $_GET['name'];
        $rest_id = $_GET["id"];
        $sql = "select * from menu_dessert_tb  where rest_id = '$rest_id' ";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }

    public function getNote()
    {
        $name = $_GET['name'];
        $rest_id = $_GET["id"];

        $date = isset($_GET["date"]) == true ? $_GET["date"] : NULL;

        $day =  isset($date) == true ? strtolower(date('D', strtotime("$date"))) : strtolower(date("D"));


        $sql = "select * from notes_tb  where rest_id = '$rest_id' AND day= '$day' ";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
    public function imageFunction()
    {
        $name = $_GET['name'];
        $sql = "select * from restaurant_feature where rest_name = '$name' ";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
    public function timeReservFunction()
    {
        $name = $_GET['name'];
        $sql = "select time,people from reservation_tbl where rest_name='$name'";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }

    public function TimeFunction()
    {
        $name = $_GET['name'];
        $sql = "select * from $name";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }

    public function getImages()
    {
        $name = $_GET['name'];
        $rest_id = $_GET["id"];
        $sql = "select * from rest_images  where rest_id = '$rest_id' ";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }

    public function getRestaurant()
    {
        $name = $_GET['name'];
        $rest_id = $_GET["id"];
        $sql = "select * from restaurant_tbl  where id = '$rest_id' ";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
}
$obj = new restaurant;
$objRest = $obj->restaurantFunction();
$objFood = $obj->foodFunction();
$objFood2 = $obj->foodFunction2();
$objFood3 = $obj->foodFunction3();
$objImage = $obj->imageFunction();
$objResvTime = $obj->timeReservFunction();
$objTime = $obj->timeFunction();
$objNote = $obj->getNote();
$objImage = $obj->getImages();
$objGetRest = $obj->getRestaurant();



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant</title>
    <?php include('layout/style.php'); ?>
    <style>
        body {
            font-family: 'Lato', sans-serif;

        }
    </style>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <link rel="stylesheet" href="css/viewbox.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

</head>

<body class="bg-light">
    <?php include('layout/navbar_fr.php'); ?>

    <?php include('layout/hero_section.php'); ?>

    <section>
        <div class="container">
            <div class="row text-center">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="owl-carousel owl-theme">

                        <?php

                        $r_name = $_GET['name'];
                        $sql = "select * from $r_name";
                        $res = mysqli_query($obj->link, $sql);
                        if (mysqli_num_rows($res) > 0) {
                            while ($row1 = mysqli_fetch_assoc($res)) {

                                $time = explode("-", $row1["time"]);

                                $start_time = $time[0];
                                $s_t = explode(":", $start_time);

                                $st = $s_t[0];

                                $end_time = $time[1];
                                $e_t = explode(":", $end_time);

                                $et = $e_t[0];


                        ?>

                                <div class="item">
                                    <h4 class="font-weight-bold" style="color: #EEA11D;"><?php echo $row1[$day] == Null ? "0" : $row1[$day] ?>%</h4>
                                    <h4 class="d-block" style="color: #481639;"><?php echo "$st:00" ?></h4>
                                </div>

                                <div class="item">
                                    <h4 class="font-weight-bold" style="color: #EEA11D;"><?php echo $row1[$day] == Null ? "0" : $row1[$day] ?>%</h4>
                                    <h4 class="d-block" style="color: #481639;"><?php echo "$st:30" ?></h4>
                                </div>


                        <?php }
                        } ?>



                    </div>

                </div>
                <div class="col-md-2"></div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <h5 class="mt-4 d-block"><strong style="color:#EEA11D">NOTE:</strong>

                        <?php if ($objNote) {
                            $row = mysqli_fetch_assoc($objNote);

                            echo $row["note_en"];
                        } ?>

                    </h5>

                    <?php if ($objRest) {
                        $rel = explode("-", $objRest);
                        $msg = $rel[0];
                        $p = $rel[1];

                        if (strcmp($msg, 'failed') == 0) { ?>
                            <div class="alert alert-warning alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong><?php echo "Maximum $p people allowed!" ?></strong>
                            </div>
                    <?php }
                    } ?>
                </div>
            </div>
        </div>

        <div class="container">
            <hr>
            <form action="" method="post">
                <div class="row">
                    <div class="col-md-3 mt-2">
                        <h5><span class="font-weight-bold">Details</span></h5>

                        <div class=" input-group input-focus bg-light mt-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text border-0 bg-light "><i class="fa fa-users fa-2x"></i></span>
                            </div>
                            <select name="person" id="" class="form-control bg-light border-0" required>

                                <option value="<?php echo $people == NULL ? "" : "$people" ?>" selected class=""><?php echo $people == NULL ? "Personne" : "$people Personne" ?></option>
                                <option value="<?php echo NULL ?>"></option>


                                <option value="1">1 Personne</option>
                                <option value="2">2 Personne</option>
                                <option value="3">3 Personne</option>
                                <option value="4">4 Personne</option>
                                <option value="5">5 Personne</option>
                                <option value="6">6 Personne</option>
                                <option value="7">7 Personne</option>
                                <option value="8">8 Personne</option>
                                <option value="9">9 Personne</option>
                                <option value="10">10 Personne</option>
                                <option value="11">11 Personne</option>
                                <option value="12">12 Personne</option>
                                <option value="13">13 Personne</option>
                                <option value="14">14 Personne</option>
                                <option value="15">15 Personne</option>
                                <option value="16">16 Personne</option>
                                <option value="17">17 Personne</option>
                                <option value="18">18 Personne</option>
                                <option value="19">19 Personne</option>
                                <option value="20">20 Personne</option>
                            </select>

                        </div>
                        <div class="input-group input-focus bg-light mt-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text border-0 bg-light "><i class="far fa-clock fa-2x"></i></span>
                            </div>
                            <select name="time" id="" class="form-control bg-light border-0" required>
                                <!-- <option value="" selected disabled class="">Heure</option> -->



                                <?php

                                $times = [
                                    "09:00-09:30",
                                    "09:30-10:00",

                                    "10:00-10:30",
                                    "10:30-11:00",

                                    "11:00-11:30",
                                    "11:30-12:00",

                                    "12:00-12:30",
                                    "12:30-13:00",

                                    "13:00-13:30",
                                    "13:30-14:00",

                                    "14:00-14:30",
                                    "14:30-15:00",

                                    "15:00-15:30",
                                    "15:30-16:00",

                                    "16:00-16:30",
                                    "16:30-17:00",

                                    "17:00-17:30",
                                    "17:30-18:00",

                                    "18:00-18:30",
                                    "18:30-19:00",

                                    "19:00-19:30",
                                    "19:30-20:00",

                                    "20:00-20:30",
                                    "20:30-21:00",

                                    "21:00-21:30",
                                    "21:30-22:00",

                                    "22:00-22:30",
                                    "22:30-23:00",
                                ];

                                $excludeTime = [];


                                if ($objTime) {

                                    $i = 0;

                                    // if (isset($day)) {
                                    //     $day = $day;
                                    // } else {
                                    //     $day = strtolower(date("D"));
                                    // }
                                    // var_dump($day);

                                    while ($row = mysqli_fetch_assoc($objTime)) {

                                        $time = explode("-", $row["time"]);

                                        $start_time = $time[0];
                                        $s_t = explode(":", $start_time);

                                        $st = $s_t[0];

                                        $end_time = $time[1];
                                        $e_t = explode(":", $end_time);

                                        $et = $e_t[0];



                                        $total_left = $row["l$day"];



                                        if ($total_left != "") {
                                            $objResvTime = $obj->timeReservFunction();


                                            while ($row1 = mysqli_fetch_assoc($objResvTime)) {

                                                $timeResv = explode("-", $row1["time"]);

                                                $r_start_time = $timeResv[0];
                                                $r_s_t = explode(":", $r_start_time);
                                                $rst = $r_s_t[0];



                                                if ($st == $rst && intval($total_left) <= 0) {

                                                    // $exludeTime=["$start_time-$st:30", "$st:30-$end_time"];
                                                    $excludeTime[$i++] = "$start_time-$st:30";
                                                    $excludeTime[$i++] = "$st:30-$end_time";
                                                }
                                            }
                                        }
                                    }
                                }


                                $leftTime = array_diff($times, $excludeTime);

                                ?>

                                <option value="<?php echo $s_time == NULL ? "" : "$s_time" ?>" selected class=""><?php echo $s_time == NULL ? "Heure" : "$s_time" ?></option>
                                <option value="<?php echo NULL ?>"></option>


                                <?php


                                foreach ($leftTime as $time) {
                                ?>

                                    <option value="<?php echo $time ?>"><?php echo $time ?></option>

                                <?php

                                }


                                ?>

                            </select>

                        </div>
                        <input type="hidden" name="dayl" value="<?php echo $day ?>">
                        <div class="input-group input-focus bg-light mt-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text border-0 bg-light "><i class="fas fa-calendar-alt fa-2x"></i></span>
                            </div>
                            <input placeholder="Date" name="date" type="text" value="<?php echo $date == NULL ? "" : "$date" ?>" class="form-control bg-light border-0" id="datepicker">
                        </div>

                    </div>


                    <div class="col-md-9 mt-2">
                        <div class="container">
                            <div class="row" id="myGroup">
                                <div class="col-md-3 col-3">
                                    <p>
                                        <a style="color: #000; text-decoration:none" class="col-btn" data-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" data-parent="#myGroup" aria-controls="collapseExample">
                                            Menu
                                        </a>
                                    </p>
                                </div>
                                <div class="col-md-3 col-3">
                                    <p>
                                        <a style="color: #000; text-decoration:none" class="col-btn" data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" data-parent="#myGroup" aria-controls="collapseExample">
                                            Photos
                                        </a>
                                    </p>
                                </div>
                                <div class="col-md-3 col-3">
                                    <p>
                                        <a style="color: #000; text-decoration:none" class="col-btn" data-toggle="collapse" href="#collapseExample3" role="button" aria-expanded="false" data-parent="#myGroup" aria-controls="collapseExample">
                                            Commentaires
                                        </a>
                                    </p>
                                </div>
                                <div class="col-md-3 col-3">
                                    <p>
                                        <a style="color: #000; text-decoration:none" class="col-btn" data-toggle="collapse" href="#collapseExample4" role="button" aria-expanded="false" data-parent="#myGroup" aria-controls="collapseExample">
                                            A propos
                                        </a>
                                    </p>
                                </div>
                            </div>
                            <div class="accordion-group">
                                <div class="collapse in show" id="collapseExample1">
                                    <div class="bg-white border-0 p-5">

                                        <div class="row">

                                            <div class="col-lg-6 col-md-6">

                                                <h4 class="font-weight-bold" style="color: #EEA11D;">Entrees </h4>

                                                <?php if ($objFood) { ?>
                                                    <?php while ($row = mysqli_fetch_assoc($objFood)) {

                                                        if ($row['starter_fr'] !== NULL || $row['starter_fr'] != "") {
                                                    ?>
                                                            <p class="mt-3"><strong><?php echo $row['starter_fr']; ?></strong> </p>
                                                            <hr>
                                                <?php }
                                                    }
                                                } ?>


                                            </div>

                                            <div class="col-lg-6 col-md-6">

                                                <h4 class="font-weight-bold" style="color: #EEA11D;">Prix</h4>
                                                <?php
                                                $fObj = new Restaurant;
                                                $fprice = $fObj->foodFunction();
                                                if ($fprice) { ?>
                                                    <?php while ($row = mysqli_fetch_assoc($fprice)) {

                                                        if ($row['starter_fr'] !== NULL || $row['starter_fr'] != "") {
                                                    ?>
                                                            <p class="mt-3"><strong>$ <?php echo $row['price']; ?></strong> </span></p>


                                                            <hr>
                                                <?php }
                                                    }
                                                } ?>


                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-lg-6 col-md-6">


                                                <h4 class="font-weight-bold mt-4" style="color: #EEA11D;">Plats</h4>
                                                <?php if ($objFood2) { ?>
                                                    <?php while ($row = mysqli_fetch_assoc($objFood2)) {
                                                        if ($row['dish_fr'] !== NULL || $row['dish_fr'] != "") { ?>
                                                            <p class="mt-3"><strong><?php echo $row['dish_fr']; ?></strong> </p>
                                                            <hr>
                                                        <?php } ?>
                                                <?php }
                                                } ?>


                                            </div>

                                            <div class="col-lg-6 col-md-6">

                                                <h4 class="font-weight-bold" style="color: #EEA11D;">Prix</h4>
                                                <?php
                                                $fObj = new Restaurant;
                                                $fprice = $fObj->foodFunction2();
                                                if ($fprice) { ?>
                                                    <?php while ($row = mysqli_fetch_assoc($fprice)) {

                                                        if ($row['dish_fr'] !== NULL || $row['dish_fr'] != "") {
                                                    ?>
                                                            <p class="mt-3"><strong>$ <?php echo $row['price']; ?></strong> </span></p>


                                                            <hr>
                                                <?php }
                                                    }
                                                } ?>


                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-lg-6 col-md-6">



                                                <h4 class="font-weight-bold mt-4" style="color: #EEA11D;">Desserts</h4>
                                                <?php if ($objFood3) {
                                                ?>
                                                    <?php while ($row = mysqli_fetch_assoc($objFood3)) {
                                                        if ($row['dessert_fr'] !== NULL || $row['dessert_fr'] != "") { ?>
                                                            <p class="mt-3"><strong><?php echo $row['dessert_fr']; ?></strong> </p>
                                                            <hr>
                                                    <?php }
                                                    } ?>
                                                <?php } ?>


                                            </div>

                                            <div class="col-lg-6 col-md-6">

                                                <h4 class="font-weight-bold" style="color: #EEA11D;">Prix</h4>
                                                <?php
                                                $fObj = new Restaurant;
                                                $fprice = $fObj->foodFunction3();
                                                if ($fprice) { ?>
                                                    <?php while ($row = mysqli_fetch_assoc($fprice)) {

                                                        if ($row['dessert_fr'] !== NULL || $row['dessert_fr'] != "") {
                                                    ?>
                                                            <p class="mt-3"><strong>$ <?php echo $row['price']; ?></strong> </span></p>


                                                            <hr>
                                                <?php }
                                                    }
                                                } ?>


                                            </div>

                                        </div>



                                    </div>
                                </div>
                                <div class="collapse" id="collapseExample2">
                                    <div class="bg-white border-0 p-5">
                                        <div class="container">
                                            <div class="row">

                                                <?php
                                                $obj2 = new restaurant;
                                                if ($obj2->getImages()) {

                                                    $obj2Images = $obj2->getImages();
                                                    while ($row_images = mysqli_fetch_assoc($obj2Images)) {

                                                        $restImg = $row_images["image"];

                                                ?>
                                                        <div class="col-md-4">
                                                            <a href="./resturaunt/rest_img/<?php echo $restImg ?>" class="image-link thumbnail">
                                                                <img width="150px" height="150px" src="./resturaunt/rest_img/<?php echo $restImg ?>" alt="">
                                                            </a>

                                                        </div>
                                                <?php
                                                    }
                                                }


                                                ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="collapse" id="collapseExample3">
                                    <div class="bg-white border-0 p-5">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <h5><strong>Name: </strong>Rafi Mahafid</h5>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <span class="font-weight-bold">5</span> <span><i class="fas fa-star" style="color:#EEA11D"></i></span>
                                                        </div>
                                                    </div>
                                                    <h5 class="mt-3"><span class="font-weight-bold">Review:</span>
                                                        Best
                                                        Food
                                                        Ever!</h5>
                                                    <hr>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <h5><strong>Name: </strong>Hasan Mahadi</h5>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <span class="font-weight-bold">5</span> <span><i class="fas fa-star" style="color:#EEA11D"></i></span>
                                                        </div>
                                                    </div>
                                                    <h5 class="mt-3"><span class="font-weight-bold">Review:</span>
                                                        Taste Awesome!</h5>
                                                    <hr>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="collapse" id="collapseExample4">
                                    <div class="bg-white border-0 p-5">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <?php
                                                    $obj2 = new restaurant;
                                                    $obj2Rest = $obj2->getRestaurant();
                                                    if ($obj2Rest) {



                                                        while ($row_about = mysqli_fetch_assoc($obj2Rest)) {

                                                            $restAbout = $row_about["about_fr"];

                                                    ?>

                                                            <p class=" text-justify"><?php echo $restAbout ?></p>
                                                    <?php
                                                        }
                                                    }


                                                    ?>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="submit" class="w-25 mt-4 log_btn btn btn-lg font-weight-bold">Suivant</button>
                    </div>

            </form>
        </div>

        </div>
        </div>
    </section>

    <?php include('layout/footer_fr.php'); ?>


    <?php include('layout/script.php') ?>

    <script src="js/jquery.viewbox.min.js"></script>

    <script>
        $(function() {
            $('.image-link').viewbox();
        });
    </script>
    <script>
        jQuery('.col-btn').click(function(e) {
            jQuery('.collapse').collapse('hide');
        });
    </script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {
            $("#datepicker").datepicker({
                minDate: 0
            });

        });
    </script>

    <script src="js/owl.carousel.min.js"></script>
    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 30,
            // autoplay: true,
            // autoplayTimeout: 1000,
            nav: true,
            dots: false,
            responsive: {
                0: {
                    items: 4
                },
                600: {
                    items: 4
                },
                1000: {
                    items: 4
                }
            },
            navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>',
                '<i class="fa fa-angle-right" aria-hidden="true"></i>'
            ],
            autoplay: true,
            autoplayTimeout: 1500,
            autoplayHoverPause: true

        });
    </script>


</body>

</html>