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

var_dump($date);
var_dump($day);
var_dump($people);
var_dump($location);

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
                    header('location:profile.php');
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
        $sql = "select * from menu_tb  where rest_id = '$rest_id' ";
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
        $sql = "select * from menu_tb  where rest_id = '$rest_id' ";
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
        $sql = "select * from menu_tb  where rest_id = '$rest_id' ";
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
}
$obj = new restaurant;
$objRest = $obj->restaurantFunction();
$objFood = $obj->foodFunction();
$objFood2 = $obj->foodFunction2();
$objFood3 = $obj->foodFunction3();
$objImage = $obj->imageFunction();
$objResvTime = $obj->timeReservFunction();
$objTime = $obj->timeFunction();

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
    <?php include('layout/navbar.php'); ?>

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
                    <!-- <div class="row">
                        <div class="col-md-3 col-3">
                            <h4 class="font-weight-bold" style="color: #EEA11D;">-20%</h4>
                            <h4 class="d-block" style="color: #481639;">10:00</h4>
                        </div>
                        <div class="col-md-3 col-3">
                            <h4 class="font-weight-bold" style="color: #EEA11D;">-20%</h4>
                            <h4 class="d-block" style="color: #481639;">10:00</h4>
                        </div>
                        <div class="col-md-3 col-3">
                            <h4 class="font-weight-bold" style="color: #EEA11D;">-20%</h4>
                            <h4 class="d-block" style="color: #481639;">10:00</h4>
                        </div>
                        <div class="col-md-3 col-3">
                            <h4 class="font-weight-bold" style="color: #EEA11D;">-20%</h4>
                            <h4 class="d-block" style="color: #481639;">10:00</h4>
                        </div>

                    </div> -->
                </div>
                <div class="col-md-2"></div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <h5 class="mt-4 d-block"><strong style="color:#EEA11D">NOTE:</strong> This offer is Valid
                        for
                        starters, dishes and desserts.
                        Drinks
                        not included.</h5>

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
                        <h5><span class="font-weight-bold">Select</span> Details</h5>

                        <div class=" input-group input-focus bg-light mt-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text border-0 bg-light "><i class="fa fa-users fa-2x"></i></span>
                            </div>
                            <select name="person" id="" class="form-control bg-light border-0" required>

                                <option value="<?php echo $people == NULL ? "" : "$people" ?>" selected class=""><?php echo $people == NULL ? "People" : "$people People" ?></option>
                                <option value="<?php echo NULL ?>"></option>


                                <option value="1">1 people</option>
                                <option value="2">2 people</option>
                                <option value="3">3 people</option>
                                <option value="4">4 people</option>
                                <option value="5">5 people</option>
                                <option value="6">6 people</option>
                                <option value="7">7 people</option>
                                <option value="8">8 people</option>
                                <option value="9">9 people</option>
                                <option value="10">10 people</option>
                                <option value="11">11 people</option>
                                <option value="12">12 people</option>
                                <option value="13">13 people</option>
                                <option value="14">14 people</option>
                                <option value="15">15 people</option>
                                <option value="16">16 people</option>
                                <option value="17">17 people</option>
                                <option value="18">18 people</option>
                                <option value="19">19 people</option>
                                <option value="20">20 people</option>
                            </select>

                        </div>
                        <div class="input-group input-focus bg-light mt-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text border-0 bg-light "><i class="far fa-clock fa-2x"></i></span>
                            </div>
                            <select name="time" id="" class="form-control bg-light border-0" required>
                                <option value="" selected disabled class="">Time</option>



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

                                <option value="<?php echo $s_time == NULL ? "" : "$s_time" ?>" selected class=""><?php echo $s_time == NULL ? "Time" : "$s_time" ?></option>
                                <option value="<?php echo NULL ?>"></option>


                                <?php


                                foreach ($leftTime as $time) {
                                ?>

                                    <option value="<?php echo $time ?>"><?php echo $time ?></option>

                                <?php

                                }


                                ?>

                                <!-- <option value="9:00-9:30">9:00-9:30</option>
                                <option value="9:30-10:00">9:30-10:00</option>
                                <option value="10:00-10:30">10:00-10:30</option>
                                <option value="10:30-11:00">10:30-11:00</option>
                                <option value="11:00-11:30">11:00-11:30</option>
                                <option value="11:30-12:00">11:30-12:00</option>
                                <option value="12:00-13:30">12:00-13:30</option>
                                <option value="13:30-14:00">13:30-14:00</option>
                                <option value="14:00-14:30">14:00-14:30</option>
                                <option value="14:30-15:00">14:30-15:00</option>
                                <option value="15:00-15:30">15:00-15:30</option>
                                <option value="15:30-16:00">15:30-16:00</option>
                                <option value="16:00-16:30">16:00-16:30</option>
                                <option value="16:30-17:00">16:30-17:00</option>
                                <option value="17:00-17:30">17:00-17:30</option>
                                <option value="17:30-18:00">17:30-18:00</option>
                                <option value="18:00-18:30">18:00-18:30</option>
                                <option value="18:30-19:00">18:30-19:00</option>
                                <option value="19:00-19:30">19:00-19:30</option>
                                <option value="19:30-20:00">19:30-20:00</option>
                                <option value="20:00-20:30">20:00-20:30</option>
                                <option value="20:30-21:00">20:30-21:00</option>
                                <option value="21:00-21:30">21:00-21:30</option>
                                <option value="21:30-22:00">21:30-22:00</option>
                                <option value="22:00-22:30">22:00-22:30</option>
                                <option value="22:30-23:00">22:30-23:00</option> -->

                            </select>
                            <!-- <input type="text" name="time" placeholder="9:00"
                                class="form-control p-4 border-0 bg-light d-block" required> -->
                        </div>
                        <input type="hidden" name="dayl" value="<?php echo $day ?>">
                        <div class="input-group input-focus bg-light mt-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text border-0 bg-light "><i class="fas fa-calendar-alt fa-2x"></i></span>
                            </div>
                            <input placeholder="Select a date" name="date" type="text" value="<?php echo $date == NULL ? "" : "$date" ?>" class="form-control bg-light border-0" id="datepicker">
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
                                            Review
                                        </a>
                                    </p>
                                </div>
                                <div class="col-md-3 col-3">
                                    <p>
                                        <a style="color: #000; text-decoration:none" class="col-btn" data-toggle="collapse" href="#collapseExample4" role="button" aria-expanded="false" data-parent="#myGroup" aria-controls="collapseExample">
                                            About
                                        </a>
                                    </p>
                                </div>
                            </div>
                            <div class="accordion-group">
                                <div class="collapse in show" id="collapseExample1">
                                    <div class="bg-white border-0 p-5">
                                        <h4 class="font-weight-bold" style="color: #EEA11D;">Starter</h4>

                                        <?php if ($objFood) { ?>
                                            <?php while ($row = mysqli_fetch_assoc($objFood)) { ?>
                                                <p class="mt-3"><strong><?php echo $row['starter_name_en']; ?></strong> </p>
                                                <hr>
                                            <?php } ?>
                                        <?php } ?>


                                        <h4 class="font-weight-bold mt-4" style="color: #EEA11D;">Dishes</h4>
                                        <?php if ($objFood2) { ?>
                                            <?php while ($row = mysqli_fetch_assoc($objFood2)) { ?>
                                                <p class="mt-3"><strong><?php echo $row['dish_name_en']; ?></strong> </p>
                                                <hr>
                                            <?php } ?>
                                        <?php } ?>

                                        <h4 class="font-weight-bold mt-4" style="color: #EEA11D;">Desserts</h4>
                                        <?php if ($objFood3) { ?>
                                            <?php while ($row = mysqli_fetch_assoc($objFood3)) { ?>
                                                <p class="mt-3"><strong><?php echo $row['dessert_name_en']; ?></strong> </p>
                                                <hr>
                                            <?php } ?>
                                        <?php } ?>

                                    </div>
                                </div>
                                <div class="collapse" id="collapseExample2">
                                    <div class="bg-white border-0 p-5">
                                        <div class="container">
                                            <div class="row">

                                                <div class="col-md-4">
                                                    <a href="images/sushi-373588_1920.jpg" class="image-link thumbnail">
                                                        <img src="images/sushi-373588_1920.jpg" alt="">
                                                    </a>

                                                </div>
                                                <div class="col-md-4">
                                                    <a href="images/sushi-373588_1920.jpg" class="image-link thumbnail">
                                                        <img src="images/sushi-373588_1920.jpg" alt="">
                                                    </a>

                                                </div>
                                                <div class="col-md-4">
                                                    <a href="images/sushi-373588_1920.jpg" class="image-link thumbnail">
                                                        <img src="images/sushi-373588_1920.jpg" alt="">
                                                    </a>

                                                </div>


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

                                                    <p class=" text-justify">A quality and relaxing rural country
                                                        pub, run by award winning
                                                        owners, in the beautiful Berkshire village of Peasemore just a
                                                        short drive from the A34 and junctions 13 and 14 of the M4. The
                                                        building and decor are charming and rustic, with elegant modern
                                                        touches. Relax by the cozy log burner perfect for winter
                                                        evenings or enjoy outdoor seating overlooking open country
                                                        fields or in a pretty courtyard filled with flowers in the
                                                        summer months. A daily menu, all freshly prepared in the pub
                                                        kitchen, includes fresh fish, pies, steaks and chef's daily
                                                        specials with main course prices ranging from £11.50 - £19.50.
                                                        As all dishes are prepared in the pub kitchen, they are able to
                                                        cater for most dietary needs, with most sauces, soups and gravy
                                                        all created gluten free. The Fox also offers gluten free bread
                                                        and gluten free Yorkshire puddings on a Sunday.</p>

                                                    <h4 class="mt-4">Address</h4>
                                                    <p>Tokyo, Japan</p>
                                                    <h4 class="mt-4">Environment</h4>
                                                    <p>Music, Bar, Terrace, Parking</p>
                                                    <h4 class="mt-4">Opening Hour</h4>
                                                    <p>9:00 AM</p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="submit" class="w-25 mt-4 log_btn btn btn-lg font-weight-bold">Next</button>
                    </div>

            </form>
        </div>

        </div>
        </div>
    </section>

    <?php include('layout/footer.php'); ?>


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