<?php
session_start();
include('class/database.php');
if (!isset($_POST["submit-search"])) {
    header("location: index.php");
}

class FilterRestaurant extends database
{
    public $link;





    public function getRestaurants()
    {
        if (isset($_GET["permission"]) && $_GET["permission"] == "true") {


            $lat = $_GET["lat"];
            $long = $_GET["lon"];


            $sql = "SELECT * , (3956 * 2 * ASIN(SQRT( POWER(SIN(( $lat - lat) *  pi()/180 / 2), 2) +COS( $lat * pi()/180) * COS(lat * pi()/180) * POWER(SIN(( $long - lon) * pi()/180 / 2), 2) ))) as distance  
             from restaurant_tbl
             having  distance <= 20
             order by distance";
            $res = mysqli_query($this->link, $sql);

            if (mysqli_num_rows($res) > 0) {
                return $res;
            } else {
                return false;
            }
        } else {

            $sql = "SELECT * FROM `restaurant_tbl`";
            $res = mysqli_query($this->link, $sql);
            if (mysqli_num_rows($res) > 0) {
                return $res;
            } else {
                return false;
            }
            # code...
        }
    }

    public function filterRestaurants()
    {
        $restaurants = $this->getRestaurants();
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
    public function getCities()
    {
        $sql = "select * from cities_tb";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }

    public function getCity()
    {
        if (isset($_POST["location"]) && $_POST["location"] != "") {
            $city_id = $_POST["location"];
            // $sql = "select * from cities_tb where id=$city_id";
            // $res = mysqli_query($this->link, $sql);
            // if (mysqli_num_rows($res) > 0) {
            //     return $res;
            // } else {
            //     return false;
            // }
        } else {
            return false;
        }
        # code...
    }

    public function getImages($rest_id)
    {


        $sql = "select * from rest_images where rest_id='$rest_id'";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
}
$obj = new FilterRestaurant;
$objRestaurant = $obj->getRestaurants();

$objSpec = $obj->getSpec();
$objCity = $obj->getCities();
if (isset($_POST["location"]) && $_POST["location"] != "") {
    // $objC = $obj->getCity();

    // $city = mysqli_fetch_assoc($objC);
} else {
    $city = Null;
}


$date = isset($_POST["filter-date"]) == true ? $_POST["filter-date"] : NULL;
$people = isset($_POST["people"]) == true ? $_POST["people"] : NULL;
$time = isset($_POST["time"]) == true ? $_POST["time"] : NULL;
$day =  isset($date) == true ? strtolower(date('D', strtotime("$date"))) : NULL;
$location = isset($_POST["location"]) == true ? $_POST["location"] : NULL;


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filter Results</title>
    <?php include('layout/style.php'); ?>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <style>
        .big-checkbox {
            width: 20px;
            height: 20px;
        }

        .big-checkbox:checked {
            background-color: #EEA11D !important;
        }

        .checkbox-round {
            width: 1.3em;
            height: 1.3em;
            background-color: white;
            border-radius: 50%;
            vertical-align: middle;
            border: 1px solid grey;
            -webkit-appearance: none;

            cursor: pointer;
        }

        .checkbox-round:checked {
            background-color: #EEA11D;
        }
    </style>


</head>

<body class="bg-light">
    <?php include('layout/navbar.php'); ?>

    <div class="back_img">
        <div class="container">
            <div class="caption pt-5">
                <h3 class="font-weight-bold">Faster, Cheaper And Easier Way To Book <br>A Restaurant In Israel</h3>
                <!-- <p>Faster, cheaper and easier way to book a restaurant in Israel</p> -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-8">
                            <form action="" method="post">
                                <input type="text" id="username" name="username" class="form-control p-4 border-0 w-100 bg-light shadow" placeholder="Restaurants ou cuisines">
                                <div id="searchSuggestion">

                                </div>
                            </form>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                    <?php if (isset($_GET["permission"]) && $_GET["permission"] == "true") {

                        $lat = $_GET["lat"];
                        $lon = $_GET["lon"];

                    ?>
                        <form action="filter_results.php?permission=true&lat=<?php echo $lat ?>&lon=<?php echo $lon ?>" method="POST">
                        <?php
                    } else {
                        ?>
                            <form action="filter_results.php" method="POST">
                            <?php
                        }
                            ?>
                            <div class="row pt-4">
                                <div class="col-md-2">
                                    <div class="input-group input-focus bg-light shadow">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text border-0 bg-light "><i class="far fa-clock"></i></span>
                                        </div>

                                        <select name="time" class="form-control border-0 bg-light ">

                                            <option value="<?php echo $time == NULL ? "" : "$time" ?>" selected class=""><?php echo $time == NULL ? "Time" : "$time" ?></option>
                                            <option value="<?php echo NULL ?>"></option>
                                            <option value="09:00-09:30">09:00-9:30</option>
                                            <option value="09:30-10:00">09:30-10:00</option>
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
                                            <option value="22:30-23:00">22:30-23:00</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group input-focus bg-light shadow">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text border-0 bg-light "><i class="fas fa-user-friends"></i></span>
                                        </div>
                                        <select name="people" class="form-control border-0 bg-light ">
                                            <option value="<?php echo $people == NULL ? "" : "$people" ?>" selected class=""><?php echo $people == NULL ? "Person" : "$people" ?></option>
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
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group input-focus bg-light shadow">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text border-0 bg-light "><i class="fas fa-calendar-alt"></i></span>
                                        </div>
                                        <input placeholder="Select a date" name="filter-date" value="<?php echo $date == NULL ? "" : "$date" ?>" type="text" class="form-control bg-light border-0" id="datepicker">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group input-focus bg-light shadow">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text border-0 bg-light "><i class="fas fa-map-marker-alt"></i></span>
                                        </div>


                                        <select class="form-control border-0 bg-light " name="location[]">
                                            <option disabled selected>Location</option>
                                            <?php
                                            if ($objCity) { ?>
                                                <?php while ($row = mysqli_fetch_assoc($objCity)) {

                                                ?>

                                                    <option value="<?php echo $row["id"] ?>"><?php echo ucwords($row["city_en"]) ?></option>

                                            <?php
                                                }
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                                <div class="col-md-2"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-8">
                                    <button type="submit" name="submit-search" class="font-weight-bold home_btn p-3 mt-4 shadow btn btn-block">Search</button>
                                </div>

                            </form>
                            <div class="col-md-1 col-2">
                                <button type="button" class="btn home_btn shadow p-3 mt-4 btn-block" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-filter"></i></button>
                            </div>

                            <div class="col-md-1 col-2">
                                <button type="button" onclick="getPermission()" class="btn home_btn shadow p-3 mt-4 btn-block"><i class="fas fa-map-marker-alt"></i></button>
                            </div>

                </div>

            </div>

        </div>

    </div>
    </div>

    <section>
        <div class="container item_section">
            <h3 class="text-center"><span class="font-weight-bold">Filter Results</h3>
            <div class="row">



                <?php
                if ($date != NULL && $time != NULL && $people != NULL) {
                    if ($objRestaurant) {



                        while ($row = mysqli_fetch_assoc($objRestaurant)) {
                            $flag = true;
                            $gret = false;

                            $time_a = explode("-", $time);

                            $start_time = $time_a[0];
                            $s_t = explode(":", $start_time);

                            $st = intval($s_t[0]);



                            $rest_name = $row["name_en"];

                            $rest_id = $row["id"];

                            $sql = "select * from $rest_name";
                            $res = mysqli_query($obj->link, $sql);



                            if (mysqli_num_rows($res) > 0) {
                                while ($row1 = mysqli_fetch_assoc($res)) {


                                    if ($st == 9) {
                                        $tim = "09:00-10:00";
                                    } else if ($st == 10) {
                                        $tim = "10:00-11:00";
                                    } else if ($st == 11) {
                                        $tim = "11:00-12:00";
                                    } else if ($st == 12) {
                                        $tim = "12:00-13:00";
                                    } else if ($st == 13) {
                                        $tim = "13:00-14:00";
                                    } else if ($st == 14) {
                                        $tim = "14:00-15:00";
                                    } else if ($st == 15) {
                                        $tim = "15:00-16:00";
                                    } else if ($st == 16) {
                                        $tim = "16:00-17:00";
                                    } else if ($st == 17) {
                                        $tim = "17:00-18:00";
                                    } else if ($st == 18) {
                                        $tim = "18:00-19:00";
                                    } else if ($st == 19) {
                                        $tim = "19:00-20:00";
                                    } else if ($st == 20) {
                                        $tim = "20:00-21:00";
                                    } else if ($st == 21) {
                                        $tim = "21:00-22:00";
                                    } else if ($st == 22) {
                                        $tim = "22:00-23:00";
                                    } else {
                                        $tim = NULL;
                                    }


                                    if ($tim !== NULL) {
                                        $sql2 = "select * from $rest_name where time='$tim' ";
                                        $res2 = mysqli_query($obj->link, $sql2);




                                        $row2 = mysqli_fetch_assoc($res2);
                                        $time_ee = explode("-", $row2["time"]);

                                        $start_time = $time_ee[0];
                                        $s_t = explode(":", $start_time);

                                        $ste = $s_t[0];

                                        $end_time = $time_ee[1];
                                        $e_t = explode(":", $end_time);

                                        $et = $e_t[0];



                                        if (intval($row2["l" . $day]) >= intval($people)) {



                                            if ($flag == true) {

                                                $measure = NULL;

                                                $flag = false;
                                                $gret = true;
                                                if (isset($_GET["permission"]) && $_GET["permission"] == "true") {

                                                    $rest_id = $row["id"];
                                                    $measure_unit = 'kilometers';
                                                    $measure_state = false;
                                                    $measure = 0;
                                                    $error = '';
                                                    $lat_b = $_GET["lat"];
                                                    $lon_b = $_GET["lon"];
                                                    $lat_a = $row["lat"];
                                                    $lon_a = $row["lon"];
                                                    $delta_lat = $lat_b - $lat_a;
                                                    $delta_lon = $lon_b - $lon_a;
                                                    $earth_radius = 6372.795477598;
                                                    $alpha    = $delta_lat / 2;
                                                    $beta     = $delta_lon / 2;
                                                    $a        = sin(deg2rad($alpha)) * sin(deg2rad($alpha)) + cos(deg2rad($lat_a)) * cos(deg2rad($lat_b)) * sin(deg2rad($beta)) * sin(deg2rad($beta));
                                                    $c        = asin(min(1, sqrt($a)));
                                                    $distance = 2 * $earth_radius * $c;
                                                    $distance = round($distance, 4);
                                                    $measure = $distance;
                                                }

                ?>

                                                <div class="col-md-4 wow fadeInUp" data-wow-delay="0.5s">
                                                    <div class="card mb-3">

                                                        <a href="restaurant.php?name=<?php echo $row['name_en']; ?>&address=<?php echo $row['address_en']; ?>&id=<?php echo $row['id']; ?>&date=<?php echo $date; ?>&people=<?php echo $people; ?>&time=<?php echo $time; ?>" style="text-decoration: none;">
                                                            <div id="carouselExampleControls<?php echo $row['id']; ?>" class="carousel slide" data-ride="carousel">
                                                                <div class="carousel-inner">

                                                                    <?php
                                                                    $objImage = $obj->getImages($rest_id);

                                                                    if ($objImage) {

                                                                        $active = true;
                                                                        while ($row1 = mysqli_fetch_assoc($objImage)) {

                                                                            $src = $row1["image"];


                                                                    ?>

                                                                            <div class="carousel-item <?php echo $active == true ? "active" : "" ?>">
                                                                                <img class="d-block w-100 card-img-top" width="305px" height="230px" src="<?php echo "resturaunt/rest_img/$src" ?>" alt="First slide">
                                                                            </div>
                                                                        <?php
                                                                            $active = false;
                                                                        }
                                                                    } else {


                                                                        ?>
                                                                        <div class="carousel-item active">
                                                                            <img class="d-block w-100 card-img-top" src="images/pizza-3007395_1920.jpg" alt="First slide">
                                                                        </div>
                                                                        <div class="carousel-item">
                                                                            <img class="d-block w-100 card-img-top" src="images/sushi-373588_1920.jpg" alt="Second slide">
                                                                        </div>
                                                                        <div class="carousel-item">
                                                                            <img class="d-block w-100 card-img-top" src="images/platter-2009590_1920.jpg" alt="Third slide">
                                                                        </div>

                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <a class="carousel-control-prev" href="#carouselExampleControls<?php echo $row['id']; ?>" role="button" data-slide="prev">
                                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                    <span class="sr-only">Previous</span>
                                                                </a>
                                                                <a class="carousel-control-next" href="#carouselExampleControls<?php echo $row['id']; ?>" role="button" data-slide="next">
                                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                    <span class="sr-only">Next</span>
                                                                </a>
                                                            </div>
                                                        </a>

                                                        <div class="card-body">
                                                            <a href="restaurant.php?name=<?php echo $row['name_en']; ?>&address=<?php echo $row['address_en']; ?>&id=<?php echo $row['id']; ?>&date=<?php echo $date; ?>" style="text-decoration: none;">
                                                                <div class="row">

                                                                    <div class="col-md-6">
                                                                        <h6 class="card-title m-0 font-weight-bold"><?php echo $row['name_en']; ?></h6>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <i class="fas fa-star" style="color:#EEA11D"></i>
                                                                        <i class="fas fa-star" style="color:#EEA11D"></i>
                                                                        <i class="fas fa-star" style="color:#EEA11D"></i>
                                                                        <i class="fas fa-star" style="color:#EEA11D"></i>
                                                                        <i class="fas fa-star" style="color:#EEA11D"></i>
                                                                    </div>
                                                                </div>
                                                            </a>

                                                            <small class="text-secondary"><i class="fas fa-map-marker-alt mr-2"></i><?php echo $row['address_en']; ?>
                                                            </small>

                                                            <?php if (isset($_GET["permission"]) && $_GET["permission"] == "true") { ?>

                                                                <small class="text-secondary"><i class="ml-5"></i><?php echo $measure . " km" ?>
                                                                </small>
                                                            <?php } ?>

                                                            <div class="container">
                                                                <hr class="font-weight-bold">
                                                            </div>

                                                            <div class="container text-center">


                                                                <div class="owl-carousel owl-theme">
                                                                <?php



                                                            }

                                                                ?>



                                                                <div class="item">
                                                                    <small class="font-weight-bold" style="color: #EEA11D;"><?php echo $row2[$day] == Null ? "0" : $row2[$day] ?>%</small>
                                                                    <small class="d-block" style="color: #481639;"><?php echo "$ste:00" ?></small>
                                                                </div>

                                                                <div class="item">
                                                                    <small class="font-weight-bold" style="color: #EEA11D;"><?php echo $row2[$day] == Null ? "0" : $row2[$day] ?>%</small>
                                                                    <small class="d-block" style="color: #481639;"><?php echo "$ste:30" ?></small>
                                                                </div>




                                                        <?php

                                                    }
                                                    $st++;
                                                }



                                                        ?>

                                                    <?php
                                                }

                                                if ($gret == true) {
                                                    ?>

                                                                </div>
                                                            </div>


                                                        </div>

                                                    </div>
                                                </div>

                                        <?php
                                                }
                                            }


                                        ?>





                                        <?php
                                    }
                                }
                            } else if ($date != NULL && $time == NULL && $people == NULL) {
                                if ($objRestaurant) {



                                    while ($row = mysqli_fetch_assoc($objRestaurant)) {
                                        $flag = true;
                                        $dis = false;
                                        $gret = false;
                                        $rest_id = $row["id"];
                                        $rest_name = $row["name_en"];

                                        $sql = "select * from $rest_name";
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



                                                if ($row1[$day] != NULL && $row1[$day] != "0") {
                                                    $dis = true;
                                                    $flag = true;
                                                    $gret = true;
                                                }
                                            }
                                        }






                                        if ($dis == true) {

                                            $rest_name = $row["name_en"];

                                            $sql = "select * from $rest_name";
                                            $res = mysqli_query($obj->link, $sql);
                                            if (mysqli_num_rows($res) > 0) {

                                                while ($row1 = mysqli_fetch_assoc($res)) {



                                                    $time_ee = explode("-", $row1["time"]);

                                                    $start_time = $time_ee[0];
                                                    $s_t = explode(":", $start_time);

                                                    $st = $s_t[0];

                                                    $end_time = $time_ee[1];
                                                    $e_t = explode(":", $end_time);

                                                    $et = $e_t[0];

                                                    if ($flag == true) {

                                                        $flag = false;

                                                        if (isset($_GET["permission"]) && $_GET["permission"] == "true") {

                                                            $rest_id = $row["id"];
                                                            $measure_unit = 'kilometers';
                                                            $measure_state = false;
                                                            $measure = 0;
                                                            $error = '';
                                                            $lat_b = $_GET["lat"];
                                                            $lon_b = $_GET["lon"];
                                                            $lat_a = $row["lat"];
                                                            $lon_a = $row["lon"];
                                                            $delta_lat = $lat_b - $lat_a;
                                                            $delta_lon = $lon_b - $lon_a;
                                                            $earth_radius = 6372.795477598;
                                                            $alpha    = $delta_lat / 2;
                                                            $beta     = $delta_lon / 2;
                                                            $a        = sin(deg2rad($alpha)) * sin(deg2rad($alpha)) + cos(deg2rad($lat_a)) * cos(deg2rad($lat_b)) * sin(deg2rad($beta)) * sin(deg2rad($beta));
                                                            $c        = asin(min(1, sqrt($a)));
                                                            $distance = 2 * $earth_radius * $c;
                                                            $distance = round($distance, 4);
                                                            $measure = $distance;
                                                        }

                                        ?>

                                                        <div class="col-md-4 wow fadeInUp" data-wow-delay="0.5s">
                                                            <div class="card mb-3">
                                                                <a href="restaurant.php?name=<?php echo $row['name_en']; ?>&address=<?php echo $row['address_en']; ?>&id=<?php echo $row['id']; ?>&date=<?php echo $date; ?>" style="text-decoration: none;">
                                                                    <div id="carouselExampleControls<?php echo $row['id']; ?>" class="carousel slide" data-ride="carousel">
                                                                        <div class="carousel-inner">

                                                                            <?php
                                                                            $objImage = $obj->getImages($rest_id);

                                                                            if ($objImage) {

                                                                                $active = true;
                                                                                while ($row1 = mysqli_fetch_assoc($objImage)) {

                                                                                    $src = $row1["image"];


                                                                            ?>

                                                                                    <div class="carousel-item <?php echo $active == true ? "active" : "" ?>">
                                                                                        <img class="d-block w-100 card-img-top" width="305px" height="230px" src="<?php echo "resturaunt/rest_img/$src" ?>" alt="First slide">
                                                                                    </div>
                                                                                <?php
                                                                                    $active = false;
                                                                                }
                                                                            } else {


                                                                                ?>
                                                                                <div class="carousel-item active">
                                                                                    <img class="d-block w-100 card-img-top" src="images/pizza-3007395_1920.jpg" alt="First slide">
                                                                                </div>
                                                                                <div class="carousel-item">
                                                                                    <img class="d-block w-100 card-img-top" src="images/sushi-373588_1920.jpg" alt="Second slide">
                                                                                </div>
                                                                                <div class="carousel-item">
                                                                                    <img class="d-block w-100 card-img-top" src="images/platter-2009590_1920.jpg" alt="Third slide">
                                                                                </div>

                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                        <a class="carousel-control-prev" href="#carouselExampleControls<?php echo $row['id']; ?>" role="button" data-slide="prev">
                                                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                            <span class="sr-only">Previous</span>
                                                                        </a>
                                                                        <a class="carousel-control-next" href="#carouselExampleControls<?php echo $row['id']; ?>" role="button" data-slide="next">
                                                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                            <span class="sr-only">Next</span>
                                                                        </a>
                                                                    </div>
                                                                </a>
                                                                <div class="card-body">
                                                                    <a href="restaurant.php?name=<?php echo $row['name_en']; ?>&address=<?php echo $row['address_en']; ?>&id=<?php echo $row['id']; ?>&date=<?php echo $date; ?>" style="text-decoration: none;">
                                                                        <div class="row">

                                                                            <div class="col-md-6">
                                                                                <h6 class="card-title m-0 font-weight-bold"><?php echo $row['name_en']; ?></h6>
                                                                            </div>

                                                                            <div class="col-md-6">
                                                                                <i class="fas fa-star" style="color:#EEA11D"></i>
                                                                                <i class="fas fa-star" style="color:#EEA11D"></i>
                                                                                <i class="fas fa-star" style="color:#EEA11D"></i>
                                                                                <i class="fas fa-star" style="color:#EEA11D"></i>
                                                                                <i class="fas fa-star" style="color:#EEA11D"></i>
                                                                            </div>
                                                                        </div>
                                                                    </a>

                                                                    <small class="text-secondary"><i class="fas fa-map-marker-alt mr-2"></i><?php echo $row['address_en']; ?>
                                                                    </small>

                                                                    <?php if (isset($_GET["permission"]) && $_GET["permission"] == "true") { ?>

                                                                        <small class="text-secondary"><i class="ml-5"></i><?php echo $measure . " km" ?>
                                                                        </small>
                                                                    <?php } ?>


                                                                    <div class="container">
                                                                        <hr class="font-weight-bold">
                                                                    </div>
                                                                    <div class="container text-center">


                                                                        <div class="owl-carousel owl-theme">

                                                                        <?php

                                                                    }
                                                                        ?>

                                                                        <div class="item">
                                                                            <small class="font-weight-bold" style="color: #EEA11D;"><?php echo $row1[$day] == Null ? "0" : $row1[$day] ?>%</small>
                                                                            <small class="d-block" style="color: #481639;"><?php echo "$st:00" ?></small>
                                                                        </div>

                                                                        <div class="item">
                                                                            <small class="font-weight-bold" style="color: #EEA11D;"><?php echo $row1[$day] == Null ? "0" : $row1[$day] ?>%</small>
                                                                            <small class="d-block" style="color: #481639;"><?php echo "$st:30" ?></small>
                                                                        </div>



                                                                    <?php
                                                                }
                                                            }

                                                            if ($dis == true) {
                                                                    ?>
                                                                        </div>
                                                                    </div>


                                                                </div>

                                                            </div>
                                                        </div>


                                                <?php
                                                            }
                                                        }


                                                ?>




                                                <?php
                                            }
                                        }
                                    } else if ($time != NULL && $date == NULL && $people == NULL) {


                                        if ($objRestaurant) {





                                            while ($row = mysqli_fetch_assoc($objRestaurant)) {
                                                $flag = true;
                                                $gret = false;

                                                $time_a = explode("-", $time);

                                                $dis = false;

                                                $start_time = $time_a[0];
                                                $s_t = explode(":", $start_time);

                                                $st = intval($s_t[0]);

                                                $day = strtolower(date("D"));

                                                $rest_id = $row["id"];
                                                $rest_name = $row["name_en"];


                                                $sql = "select * from $rest_name ";
                                                $res = mysqli_query($obj->link, $sql);


                                                if (mysqli_num_rows($res) > 0) {
                                                    while ($row1 = mysqli_fetch_assoc($res)) {


                                                        if ($st == 9) {
                                                            $tim = "09:00-10:00";
                                                        } else if ($st == 10) {
                                                            $tim = "10:00-11:00";
                                                        } else if ($st == 11) {
                                                            $tim = "11:00-12:00";
                                                        } else if ($st == 12) {
                                                            $tim = "12:00-13:00";
                                                        } else if ($st == 13) {
                                                            $tim = "13:00-14:00";
                                                        } else if ($st == 14) {
                                                            $tim = "14:00-15:00";
                                                        } else if ($st == 15) {
                                                            $tim = "15:00-16:00";
                                                        } else if ($st == 16) {
                                                            $tim = "16:00-17:00";
                                                        } else if ($st == 17) {
                                                            $tim = "17:00-18:00";
                                                        } else if ($st == 18) {
                                                            $tim = "18:00-19:00";
                                                        } else if ($st == 19) {
                                                            $tim = "19:00-20:00";
                                                        } else if ($st == 20) {
                                                            $tim = "20:00-21:00";
                                                        } else if ($st == 21) {
                                                            $tim = "21:00-22:00";
                                                        } else if ($st == 22) {
                                                            $tim = "22:00-23:00";
                                                        } else {
                                                            $tim = NULL;
                                                        }



                                                        if ($tim !== NULL) {


                                                            $sql2 = "select * from $rest_name where time='$tim' ";
                                                            $res2 = mysqli_query($obj->link, $sql2);



                                                            $row2 = mysqli_fetch_assoc($res2);
                                                            $time_ee = explode("-", $row2["time"]);

                                                            $start_time = $time_ee[0];
                                                            $s_t = explode(":", $start_time);

                                                            $ste = $s_t[0];

                                                            $end_time = $time_ee[1];
                                                            $e_t = explode(":", $end_time);

                                                            $et = $e_t[0];

                                                            $st++;

                                                            if ($row1[$day] != NULL && $row1[$day] != "0") {
                                                                $dis = true;
                                                                $flag = true;
                                                                $gret = true;
                                                            }
                                                        }
                                                    }
                                                }


                                                if ($dis == true) {

                                                    $time_a = explode("-", $time);



                                                    $start_time = $time_a[0];
                                                    $s_t = explode(":", $start_time);

                                                    $st = intval($s_t[0]);

                                                    $day = strtolower(date("D"));


                                                    $rest_name = $row["name_en"];

                                                    $sql = "select * from $rest_name ";
                                                    $res = mysqli_query($obj->link, $sql);


                                                    if (mysqli_num_rows($res) > 0) {

                                                        while ($row1 = mysqli_fetch_assoc($res)) {


                                                            if ($st == 9) {
                                                                $tim = "09:00-10:00";
                                                            } else if ($st == 10) {
                                                                $tim = "10:00-11:00";
                                                            } else if ($st == 11) {
                                                                $tim = "11:00-12:00";
                                                            } else if ($st == 12) {
                                                                $tim = "12:00-13:00";
                                                            } else if ($st == 13) {
                                                                $tim = "13:00-14:00";
                                                            } else if ($st == 14) {
                                                                $tim = "14:00-15:00";
                                                            } else if ($st == 15) {
                                                                $tim = "15:00-16:00";
                                                            } else if ($st == 16) {
                                                                $tim = "16:00-17:00";
                                                            } else if ($st == 17) {
                                                                $tim = "17:00-18:00";
                                                            } else if ($st == 18) {
                                                                $tim = "18:00-19:00";
                                                            } else if ($st == 19) {
                                                                $tim = "19:00-20:00";
                                                            } else if ($st == 20) {
                                                                $tim = "20:00-21:00";
                                                            } else if ($st == 21) {
                                                                $tim = "21:00-22:00";
                                                            } else if ($st == 22) {
                                                                $tim = "22:00-23:00";
                                                            } else {
                                                                $tim = NULL;
                                                            }



                                                            if ($tim !== NULL) {

                                                                $sql2 = "select * from $rest_name where time='$tim' ";
                                                                $res2 = mysqli_query($obj->link, $sql2);



                                                                $row2 = mysqli_fetch_assoc($res2);
                                                                $time_ee = explode("-", $row2["time"]);

                                                                $start_time = $time_ee[0];
                                                                $s_t = explode(":", $start_time);

                                                                $ste = $s_t[0];

                                                                $end_time = $time_ee[1];
                                                                $e_t = explode(":", $end_time);

                                                                $et = $e_t[0];

                                                                if ($flag == true) {

                                                                    $flag = false;

                                                                    if (isset($_GET["permission"]) && $_GET["permission"] == "true") {

                                                                        $rest_id = $row["id"];
                                                                        $measure_unit = 'kilometers';
                                                                        $measure_state = false;
                                                                        $measure = 0;
                                                                        $error = '';
                                                                        $lat_b = $_GET["lat"];
                                                                        $lon_b = $_GET["lon"];
                                                                        $lat_a = $row["lat"];
                                                                        $lon_a = $row["lon"];
                                                                        $delta_lat = $lat_b - $lat_a;
                                                                        $delta_lon = $lon_b - $lon_a;
                                                                        $earth_radius = 6372.795477598;
                                                                        $alpha    = $delta_lat / 2;
                                                                        $beta     = $delta_lon / 2;
                                                                        $a        = sin(deg2rad($alpha)) * sin(deg2rad($alpha)) + cos(deg2rad($lat_a)) * cos(deg2rad($lat_b)) * sin(deg2rad($beta)) * sin(deg2rad($beta));
                                                                        $c        = asin(min(1, sqrt($a)));
                                                                        $distance = 2 * $earth_radius * $c;
                                                                        $distance = round($distance, 4);
                                                                        $measure = $distance;
                                                                    }

                                                ?>

                                                                    <div class="col-md-4 wow fadeInUp" data-wow-delay="0.5s">
                                                                        <div class="card mb-3">
                                                                            <a href="restaurant.php?name=<?php echo $row['name_en']; ?>&address=<?php echo $row['address_en']; ?>&id=<?php echo $row['id']; ?>&time=<?php echo $time; ?>" style="text-decoration: none;">
                                                                                <div id="carouselExampleControls<?php echo $row['id']; ?>" class="carousel slide" data-ride="carousel">
                                                                                    <div class="carousel-inner">

                                                                                        <?php
                                                                                        $objImage = $obj->getImages($rest_id);

                                                                                        if ($objImage) {

                                                                                            $active = true;
                                                                                            while ($row1 = mysqli_fetch_assoc($objImage)) {

                                                                                                $src = $row1["image"];


                                                                                        ?>

                                                                                                <div class="carousel-item <?php echo $active == true ? "active" : "" ?>">
                                                                                                    <img class="d-block w-100 card-img-top" width="305px" height="230px" src="<?php echo "resturaunt/rest_img/$src" ?>" alt="First slide">
                                                                                                </div>
                                                                                            <?php
                                                                                                $active = false;
                                                                                            }
                                                                                        } else {


                                                                                            ?>
                                                                                            <div class="carousel-item active">
                                                                                                <img class="d-block w-100 card-img-top" src="images/pizza-3007395_1920.jpg" alt="First slide">
                                                                                            </div>
                                                                                            <div class="carousel-item">
                                                                                                <img class="d-block w-100 card-img-top" src="images/sushi-373588_1920.jpg" alt="Second slide">
                                                                                            </div>
                                                                                            <div class="carousel-item">
                                                                                                <img class="d-block w-100 card-img-top" src="images/platter-2009590_1920.jpg" alt="Third slide">
                                                                                            </div>

                                                                                        <?php
                                                                                        }
                                                                                        ?>
                                                                                    </div>
                                                                                    <a class="carousel-control-prev" href="#carouselExampleControls<?php echo $row['id']; ?>" role="button" data-slide="prev">
                                                                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                                        <span class="sr-only">Previous</span>
                                                                                    </a>
                                                                                    <a class="carousel-control-next" href="#carouselExampleControls<?php echo $row['id']; ?>" role="button" data-slide="next">
                                                                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                                        <span class="sr-only">Next</span>
                                                                                    </a>
                                                                                </div>
                                                                            </a>
                                                                            <div class="card-body">
                                                                                <a href="restaurant.php?name=<?php echo $row['name_en']; ?>&address=<?php echo $row['address_en']; ?>&id=<?php echo $row['id']; ?>&time=<?php echo $time; ?>" style="text-decoration: none;">
                                                                                    <div class="row">

                                                                                        <div class="col-md-6">
                                                                                            <h6 class="card-title m-0 font-weight-bold"><?php echo $row['name_en']; ?></h6>
                                                                                        </div>

                                                                                        <div class="col-md-6">
                                                                                            <i class="fas fa-star" style="color:#EEA11D"></i>
                                                                                            <i class="fas fa-star" style="color:#EEA11D"></i>
                                                                                            <i class="fas fa-star" style="color:#EEA11D"></i>
                                                                                            <i class="fas fa-star" style="color:#EEA11D"></i>
                                                                                            <i class="fas fa-star" style="color:#EEA11D"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>

                                                                                <small class="text-secondary"><i class="fas fa-map-marker-alt mr-2"></i><?php echo $row['address_en']; ?>
                                                                                </small>

                                                                                <?php if (isset($_GET["permission"]) && $_GET["permission"] == "true") { ?>

                                                                                    <small class="text-secondary"><i class="ml-5"></i><?php echo $measure . " km" ?>
                                                                                    </small>
                                                                                <?php } ?>


                                                                                <div class="container">
                                                                                    <hr class="font-weight-bold">
                                                                                </div>
                                                                                <div class="container text-center">


                                                                                    <div class="owl-carousel owl-theme">


                                                                                    <?php
                                                                                }

                                                                                    ?>
                                                                                    <div class="item">
                                                                                        <small class="font-weight-bold" style="color: #EEA11D;"><?php echo $row2[$day] == Null ? "0" : $row2[$day] ?>%</small>
                                                                                        <small class="d-block" style="color: #481639;"><?php echo "$ste:00" ?></small>
                                                                                    </div>

                                                                                    <div class="item">
                                                                                        <small class="font-weight-bold" style="color: #EEA11D;"><?php echo $row2[$day] == Null ? "0" : $row2[$day] ?>%</small>
                                                                                        <small class="d-block" style="color: #481639;"><?php echo "$ste:30" ?></small>
                                                                                    </div>




                                                                                <?php
                                                                                $st++;
                                                                            }
                                                                        }

                                                                        if ($gret == true) {
                                                                                ?>
                                                                                    </div>
                                                                                </div>

                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                        <?php
                                                                        }
                                                                    }
                                                                }

                                                        ?>




                                                        <?php
                                                    }
                                                }
                                            } else if ($people != NULL && $time == NULL && $date == NULL) {
                                                if ($objRestaurant) {


                                                    $day = strtolower(date("D"));
                                                    while ($row = mysqli_fetch_assoc($objRestaurant)) {
                                                        $flag = true;
                                                        $rest_id = $row["id"];

                                                        $rest_name = $row["name_en"];

                                                        $sql = "select * from $rest_name";
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

                                                                if ($row1["l" . $day] >= $people) {

                                                                    if ($flag == true) {

                                                                        $flag = false;

                                                                        if (isset($_GET["permission"]) && $_GET["permission"] == "true") {

                                                                            $rest_id = $row["id"];
                                                                            $measure_unit = 'kilometers';
                                                                            $measure_state = false;
                                                                            $measure = 0;
                                                                            $error = '';
                                                                            $lat_b = $_GET["lat"];
                                                                            $lon_b = $_GET["lon"];
                                                                            $lat_a = $row["lat"];
                                                                            $lon_a = $row["lon"];
                                                                            $delta_lat = $lat_b - $lat_a;
                                                                            $delta_lon = $lon_b - $lon_a;
                                                                            $earth_radius = 6372.795477598;
                                                                            $alpha    = $delta_lat / 2;
                                                                            $beta     = $delta_lon / 2;
                                                                            $a        = sin(deg2rad($alpha)) * sin(deg2rad($alpha)) + cos(deg2rad($lat_a)) * cos(deg2rad($lat_b)) * sin(deg2rad($beta)) * sin(deg2rad($beta));
                                                                            $c        = asin(min(1, sqrt($a)));
                                                                            $distance = 2 * $earth_radius * $c;
                                                                            $distance = round($distance, 4);
                                                                            $measure = $distance;
                                                                        }

                                                        ?>

                                                                        <div class="col-md-4 wow fadeInUp" data-wow-delay="0.5s">
                                                                            <div class="card mb-3">
                                                                                <a href="restaurant.php?name=<?php echo $row['name_en']; ?>&address=<?php echo $row['address_en']; ?>&id=<?php echo $row['id']; ?>&people=<?php echo $people; ?>" style="text-decoration: none;">
                                                                                    <div id="carouselExampleControls<?php echo $row['id']; ?>" class="carousel slide" data-ride="carousel">
                                                                                        <div class="carousel-inner">

                                                                                            <?php
                                                                                            $objImage = $obj->getImages($rest_id);

                                                                                            if ($objImage) {

                                                                                                $active = true;
                                                                                                while ($row1 = mysqli_fetch_assoc($objImage)) {

                                                                                                    $src = $row1["image"];


                                                                                            ?>

                                                                                                    <div class="carousel-item <?php echo $active == true ? "active" : "" ?>">
                                                                                                        <img class="d-block w-100 card-img-top" width="305px" height="230px" src="<?php echo "resturaunt/rest_img/$src" ?>" alt="First slide">
                                                                                                    </div>
                                                                                                <?php
                                                                                                    $active = false;
                                                                                                }
                                                                                            } else {


                                                                                                ?>
                                                                                                <div class="carousel-item active">
                                                                                                    <img class="d-block w-100 card-img-top" src="images/pizza-3007395_1920.jpg" alt="First slide">
                                                                                                </div>
                                                                                                <div class="carousel-item">
                                                                                                    <img class="d-block w-100 card-img-top" src="images/sushi-373588_1920.jpg" alt="Second slide">
                                                                                                </div>
                                                                                                <div class="carousel-item">
                                                                                                    <img class="d-block w-100 card-img-top" src="images/platter-2009590_1920.jpg" alt="Third slide">
                                                                                                </div>

                                                                                            <?php
                                                                                            }
                                                                                            ?>
                                                                                        </div>
                                                                                        <a class="carousel-control-prev" href="#carouselExampleControls<?php echo $row['id']; ?>" role="button" data-slide="prev">
                                                                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                                            <span class="sr-only">Previous</span>
                                                                                        </a>
                                                                                        <a class="carousel-control-next" href="#carouselExampleControls<?php echo $row['id']; ?>" role="button" data-slide="next">
                                                                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                                            <span class="sr-only">Next</span>
                                                                                        </a>
                                                                                    </div>
                                                                                </a>
                                                                                <div class="card-body">
                                                                                    <a href="restaurant.php?name=<?php echo $row['name_en']; ?>&address=<?php echo $row['address_en']; ?>&id=<?php echo $row['id']; ?>&people=<?php echo $people; ?>" style="text-decoration: none;">
                                                                                        <div class="row">

                                                                                            <div class="col-md-6">
                                                                                                <h6 class="card-title m-0 font-weight-bold"><?php echo $row['name_en']; ?></h6>
                                                                                            </div>

                                                                                            <div class="col-md-6">
                                                                                                <i class="fas fa-star" style="color:#EEA11D"></i>
                                                                                                <i class="fas fa-star" style="color:#EEA11D"></i>
                                                                                                <i class="fas fa-star" style="color:#EEA11D"></i>
                                                                                                <i class="fas fa-star" style="color:#EEA11D"></i>
                                                                                                <i class="fas fa-star" style="color:#EEA11D"></i>
                                                                                            </div>
                                                                                        </div>
                                                                                    </a>

                                                                                    <small class="text-secondary"><i class="fas fa-map-marker-alt mr-2"></i><?php echo $row['address_en']; ?>
                                                                                    </small>

                                                                                    <?php if (isset($_GET["permission"]) && $_GET["permission"] == "true") { ?>

                                                                                        <small class="text-secondary"><i class="ml-5"></i><?php echo $measure . " km" ?>
                                                                                        </small>
                                                                                    <?php } ?>


                                                                                    <div class="container">
                                                                                        <hr class="font-weight-bold">
                                                                                    </div>
                                                                                    <div class="container text-center">


                                                                                        <div class="owl-carousel owl-theme">

                                                                                        <?php
                                                                                    }
                                                                                        ?>


                                                                                        <div class="item">
                                                                                            <small class="font-weight-bold" style="color: #EEA11D;"><?php echo $row1[$day] == Null ? "0" : $row1[$day]  ?>%</small>
                                                                                            <small class="d-block" style="color: #481639;"><?php echo "$st:00" ?></small>
                                                                                        </div>

                                                                                        <div class="item">
                                                                                            <small class="font-weight-bold" style="color: #EEA11D;"><?php echo $row1[$day] == Null ? "0" : $row1[$day] ?>%</small>
                                                                                            <small class="d-block" style="color: #481639;"><?php echo "$st:30" ?></small>
                                                                                        </div>

                                                                                    <?php
                                                                                }


                                                                                    ?>





                                                                            <?php
                                                                        }
                                                                    }


                                                                            ?>


                                                                                        </div>
                                                                                    </div>


                                                                                </div>

                                                                            </div>
                                                                        </div>


                                                                        <?php
                                                                    }
                                                                }
                                                            } else if ($time != NULL && $people != NULL) {


                                                                if ($objRestaurant) {



                                                                    while ($row = mysqli_fetch_assoc($objRestaurant)) {

                                                                        $flag = true;
                                                                        $gret = false;

                                                                        $time_a = explode("-", $time);

                                                                        $start_time = $time_a[0];
                                                                        $s_t = explode(":", $start_time);

                                                                        $st = intval($s_t[0]);

                                                                        $day = strtolower(date("D"));




                                                                        $rest_id = $row["id"];

                                                                        $rest_name = $row["name_en"];

                                                                        $sql = "select * from $rest_name";
                                                                        $res = mysqli_query($obj->link, $sql);


                                                                        if (mysqli_num_rows($res) > 0) {
                                                                            while ($row1 = mysqli_fetch_assoc($res)) {


                                                                                if ($st == 9) {
                                                                                    $tim = "09:00-10:00";
                                                                                } else if ($st == 10) {
                                                                                    $tim = "10:00-11:00";
                                                                                } else if ($st == 11) {
                                                                                    $tim = "11:00-12:00";
                                                                                } else if ($st == 12) {
                                                                                    $tim = "12:00-13:00";
                                                                                } else if ($st == 13) {
                                                                                    $tim = "13:00-14:00";
                                                                                } else if ($st == 14) {
                                                                                    $tim = "14:00-15:00";
                                                                                } else if ($st == 15) {
                                                                                    $tim = "15:00-16:00";
                                                                                } else if ($st == 16) {
                                                                                    $tim = "16:00-17:00";
                                                                                } else if ($st == 17) {
                                                                                    $tim = "17:00-18:00";
                                                                                } else if ($st == 18) {
                                                                                    $tim = "18:00-19:00";
                                                                                } else if ($st == 19) {
                                                                                    $tim = "19:00-20:00";
                                                                                } else if ($st == 20) {
                                                                                    $tim = "20:00-21:00";
                                                                                } else if ($st == 21) {
                                                                                    $tim = "21:00-22:00";
                                                                                } else if ($st == 22) {
                                                                                    $tim = "22:00-23:00";
                                                                                } else {
                                                                                    $tim = NULL;
                                                                                }


                                                                                if ($tim !== NULL) {
                                                                                    $sql2 = "select * from $rest_name where time='$tim' ";
                                                                                    $res2 = mysqli_query($obj->link, $sql2);



                                                                                    $row2 = mysqli_fetch_assoc($res2);
                                                                                    $time_ee = explode("-", $row2["time"]);

                                                                                    $start_time = $time_ee[0];
                                                                                    $s_t = explode(":", $start_time);

                                                                                    $ste = $s_t[0];

                                                                                    $end_time = $time_ee[1];
                                                                                    $e_t = explode(":", $end_time);

                                                                                    $et = $e_t[0];

                                                                                    if (intval($row2["l" . $day]) >= intval($people)) {

                                                                                        if ($flag == true) {

                                                                                            $flag = false;
                                                                                            $gret = true;

                                                                                            if (isset($_GET["permission"]) && $_GET["permission"] == "true") {

                                                                                                $rest_id = $row["id"];
                                                                                                $measure_unit = 'kilometers';
                                                                                                $measure_state = false;
                                                                                                $measure = 0;
                                                                                                $error = '';
                                                                                                $lat_b = $_GET["lat"];
                                                                                                $lon_b = $_GET["lon"];
                                                                                                $lat_a = $row["lat"];
                                                                                                $lon_a = $row["lon"];
                                                                                                $delta_lat = $lat_b - $lat_a;
                                                                                                $delta_lon = $lon_b - $lon_a;
                                                                                                $earth_radius = 6372.795477598;
                                                                                                $alpha    = $delta_lat / 2;
                                                                                                $beta     = $delta_lon / 2;
                                                                                                $a        = sin(deg2rad($alpha)) * sin(deg2rad($alpha)) + cos(deg2rad($lat_a)) * cos(deg2rad($lat_b)) * sin(deg2rad($beta)) * sin(deg2rad($beta));
                                                                                                $c        = asin(min(1, sqrt($a)));
                                                                                                $distance = 2 * $earth_radius * $c;
                                                                                                $distance = round($distance, 4);
                                                                                                $measure = $distance;
                                                                                            }

                                                                        ?>

                                                                                            <div class="col-md-4 wow fadeInUp" data-wow-delay="0.5s">
                                                                                                <div class="card mb-3">
                                                                                                    <a href="restaurant.php?name=<?php echo $row['name_en']; ?>&address=<?php echo $row['address_en']; ?>&id=<?php echo $row['id']; ?>&time=<?php echo $time; ?>&people=<?php echo $people; ?>" style="text-decoration: none;">
                                                                                                        <div id="carouselExampleControls<?php echo $row['id']; ?>" class="carousel slide" data-ride="carousel">
                                                                                                            <div class="carousel-inner">

                                                                                                                <?php
                                                                                                                $objImage = $obj->getImages($rest_id);

                                                                                                                if ($objImage) {

                                                                                                                    $active = true;
                                                                                                                    while ($row1 = mysqli_fetch_assoc($objImage)) {

                                                                                                                        $src = $row1["image"];


                                                                                                                ?>

                                                                                                                        <div class="carousel-item <?php echo $active == true ? "active" : "" ?>">
                                                                                                                            <img class="d-block w-100 card-img-top" width="305px" height="230px" src="<?php echo "resturaunt/rest_img/$src" ?>" alt="First slide">
                                                                                                                        </div>
                                                                                                                    <?php
                                                                                                                        $active = false;
                                                                                                                    }
                                                                                                                } else {


                                                                                                                    ?>
                                                                                                                    <div class="carousel-item active">
                                                                                                                        <img class="d-block w-100 card-img-top" src="images/pizza-3007395_1920.jpg" alt="First slide">
                                                                                                                    </div>
                                                                                                                    <div class="carousel-item">
                                                                                                                        <img class="d-block w-100 card-img-top" src="images/sushi-373588_1920.jpg" alt="Second slide">
                                                                                                                    </div>
                                                                                                                    <div class="carousel-item">
                                                                                                                        <img class="d-block w-100 card-img-top" src="images/platter-2009590_1920.jpg" alt="Third slide">
                                                                                                                    </div>

                                                                                                                <?php
                                                                                                                }
                                                                                                                ?>
                                                                                                            </div>
                                                                                                            <a class="carousel-control-prev" href="#carouselExampleControls<?php echo $row['id']; ?>" role="button" data-slide="prev">
                                                                                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                                                                <span class="sr-only">Previous</span>
                                                                                                            </a>
                                                                                                            <a class="carousel-control-next" href="#carouselExampleControls<?php echo $row['id']; ?>" role="button" data-slide="next">
                                                                                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                                                                <span class="sr-only">Next</span>
                                                                                                            </a>
                                                                                                        </div>
                                                                                                    </a>
                                                                                                    <div class="card-body">
                                                                                                        <a href="restaurant.php?name=<?php echo $row['name_en']; ?>&address=<?php echo $row['address_en']; ?>&id=<?php echo $row['id']; ?>&day=<?php echo $day; ?>" style="text-decoration: none;">
                                                                                                            <div class="row">

                                                                                                                <div class="col-md-6">
                                                                                                                    <h6 class="card-title m-0 font-weight-bold"><?php echo $row['name_en']; ?></h6>
                                                                                                                </div>

                                                                                                                <div class="col-md-6">
                                                                                                                    <i class="fas fa-star" style="color:#EEA11D"></i>
                                                                                                                    <i class="fas fa-star" style="color:#EEA11D"></i>
                                                                                                                    <i class="fas fa-star" style="color:#EEA11D"></i>
                                                                                                                    <i class="fas fa-star" style="color:#EEA11D"></i>
                                                                                                                    <i class="fas fa-star" style="color:#EEA11D"></i>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </a>

                                                                                                        <small class="text-secondary"><i class="fas fa-map-marker-alt mr-2"></i><?php echo $row['address_en']; ?>
                                                                                                        </small>

                                                                                                        <?php if (isset($_GET["permission"]) && $_GET["permission"] == "true") { ?>

                                                                                                            <small class="text-secondary"><i class="ml-5"></i><?php echo $measure . " km" ?>
                                                                                                            </small>
                                                                                                        <?php } ?>

                                                                                                        <div class="container">
                                                                                                            <hr class="font-weight-bold">
                                                                                                        </div>
                                                                                                        <div class="container text-center">


                                                                                                            <div class="owl-carousel owl-theme">




                                                                                                                <div class="item">
                                                                                                                    <small class="font-weight-bold" style="color: #EEA11D;"><?php echo $row2[$day] == Null ? "0" : $row2[$day] ?>%</small>
                                                                                                                    <small class="d-block" style="color: #481639;"><?php echo "$ste:00" ?></small>
                                                                                                                </div>

                                                                                                                <div class="item">
                                                                                                                    <small class="font-weight-bold" style="color: #EEA11D;"><?php echo $row2[$day] == Null ? "0" : $row2[$day] ?>%</small>
                                                                                                                    <small class="d-block" style="color: #481639;"><?php echo "$ste:30" ?></small>
                                                                                                                </div>




                                                                                                    <?php

                                                                                                }
                                                                                                $st++;
                                                                                            }
                                                                                        }
                                                                                    }

                                                                                    if ($gret == true) {


                                                                                                    ?>


                                                                                                            </div>
                                                                                                        </div>


                                                                                                    </div>

                                                                                                </div>
                                                                                            </div>

                                                                                    <?php
                                                                                    }
                                                                                }



                                                                                    ?>




                                                                                    <?php
                                                                                }
                                                                            }
                                                                        }
                                                                        // ------------

                                                                        else if ($time != NULL && $date != NULL) {


                                                                            if ($objRestaurant) {

                                                                                $flag = true;
                                                                                while ($row = mysqli_fetch_assoc($objRestaurant)) {

                                                                                    $time_a = explode("-", $time);

                                                                                    $dis = false;
                                                                                    $gret = false;

                                                                                    $start_time = $time_a[0];
                                                                                    $s_t = explode(":", $start_time);

                                                                                    $st = intval($s_t[0]);



                                                                                    $rest_id = $row["id"];
                                                                                    $rest_name = $row["name_en"];

                                                                                    $sql = "select * from $rest_name ";
                                                                                    $res = mysqli_query($obj->link, $sql);


                                                                                    if (mysqli_num_rows($res) > 0) {
                                                                                        while ($row1 = mysqli_fetch_assoc($res)) {


                                                                                            if ($st == 9) {
                                                                                                $tim = "09:00-10:00";
                                                                                            } else if ($st == 10) {
                                                                                                $tim = "10:00-11:00";
                                                                                            } else if ($st == 11) {
                                                                                                $tim = "11:00-12:00";
                                                                                            } else if ($st == 12) {
                                                                                                $tim = "12:00-13:00";
                                                                                            } else if ($st == 13) {
                                                                                                $tim = "13:00-14:00";
                                                                                            } else if ($st == 14) {
                                                                                                $tim = "14:00-15:00";
                                                                                            } else if ($st == 15) {
                                                                                                $tim = "15:00-16:00";
                                                                                            } else if ($st == 16) {
                                                                                                $tim = "16:00-17:00";
                                                                                            } else if ($st == 17) {
                                                                                                $tim = "17:00-18:00";
                                                                                            } else if ($st == 18) {
                                                                                                $tim = "18:00-19:00";
                                                                                            } else if ($st == 19) {
                                                                                                $tim = "19:00-20:00";
                                                                                            } else if ($st == 20) {
                                                                                                $tim = "20:00-21:00";
                                                                                            } else if ($st == 21) {
                                                                                                $tim = "21:00-22:00";
                                                                                            } else if ($st == 22) {
                                                                                                $tim = "22:00-23:00";
                                                                                            } else {
                                                                                                $tim = NULL;
                                                                                            }



                                                                                            if ($tim !== NULL) {


                                                                                                $sql2 = "select * from $rest_name where time='$tim' ";
                                                                                                $res2 = mysqli_query($obj->link, $sql2);



                                                                                                $row2 = mysqli_fetch_assoc($res2);
                                                                                                $time_ee = explode("-", $row2["time"]);

                                                                                                $start_time = $time_ee[0];
                                                                                                $s_t = explode(":", $start_time);

                                                                                                $ste = $s_t[0];

                                                                                                $end_time = $time_ee[1];
                                                                                                $e_t = explode(":", $end_time);

                                                                                                $et = $e_t[0];

                                                                                                $st++;

                                                                                                if ($row2["l" . $day] != NULL && $row2["l" . $day] != "0") {
                                                                                                    $dis = true;
                                                                                                    $flag = true;
                                                                                                    $gret = true;
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                    }


                                                                                    if ($dis == true) {

                                                                                        $time_a = explode("-", $time);

                                                                                        $dis = false;

                                                                                        $start_time = $time_a[0];
                                                                                        $s_t = explode(":", $start_time);

                                                                                        $st = intval($s_t[0]);




                                                                                        $rest_name = $row["name_en"];

                                                                                        $sql = "select * from $rest_name ";
                                                                                        $res = mysqli_query($obj->link, $sql);


                                                                                        if (mysqli_num_rows($res) > 0) {

                                                                                            while ($row1 = mysqli_fetch_assoc($res)) {


                                                                                                if ($st == 9) {
                                                                                                    $tim = "09:00-10:00";
                                                                                                } else if ($st == 10) {
                                                                                                    $tim = "10:00-11:00";
                                                                                                } else if ($st == 11) {
                                                                                                    $tim = "11:00-12:00";
                                                                                                } else if ($st == 12) {
                                                                                                    $tim = "12:00-13:00";
                                                                                                } else if ($st == 13) {
                                                                                                    $tim = "13:00-14:00";
                                                                                                } else if ($st == 14) {
                                                                                                    $tim = "14:00-15:00";
                                                                                                } else if ($st == 15) {
                                                                                                    $tim = "15:00-16:00";
                                                                                                } else if ($st == 16) {
                                                                                                    $tim = "16:00-17:00";
                                                                                                } else if ($st == 17) {
                                                                                                    $tim = "17:00-18:00";
                                                                                                } else if ($st == 18) {
                                                                                                    $tim = "18:00-19:00";
                                                                                                } else if ($st == 19) {
                                                                                                    $tim = "19:00-20:00";
                                                                                                } else if ($st == 20) {
                                                                                                    $tim = "20:00-21:00";
                                                                                                } else if ($st == 21) {
                                                                                                    $tim = "21:00-22:00";
                                                                                                } else if ($st == 22) {
                                                                                                    $tim = "22:00-23:00";
                                                                                                } else {
                                                                                                    $tim = NULL;
                                                                                                }



                                                                                                if ($tim !== NULL) {

                                                                                                    $sql2 = "select * from $rest_name where time='$tim' ";
                                                                                                    $res2 = mysqli_query($obj->link, $sql2);



                                                                                                    $row2 = mysqli_fetch_assoc($res2);
                                                                                                    $time_ee = explode("-", $row2["time"]);

                                                                                                    $start_time = $time_ee[0];
                                                                                                    $s_t = explode(":", $start_time);

                                                                                                    $ste = $s_t[0];

                                                                                                    $end_time = $time_ee[1];
                                                                                                    $e_t = explode(":", $end_time);

                                                                                                    $et = $e_t[0];

                                                                                                    if ($flag == true) {

                                                                                                        $flag = false;

                                                                                                        if (isset($_GET["permission"]) && $_GET["permission"] == "true") {

                                                                                                            $rest_id = $row["id"];
                                                                                                            $measure_unit = 'kilometers';
                                                                                                            $measure_state = false;
                                                                                                            $measure = 0;
                                                                                                            $error = '';
                                                                                                            $lat_b = $_GET["lat"];
                                                                                                            $lon_b = $_GET["lon"];
                                                                                                            $lat_a = $row["lat"];
                                                                                                            $lon_a = $row["lon"];
                                                                                                            $delta_lat = $lat_b - $lat_a;
                                                                                                            $delta_lon = $lon_b - $lon_a;
                                                                                                            $earth_radius = 6372.795477598;
                                                                                                            $alpha    = $delta_lat / 2;
                                                                                                            $beta     = $delta_lon / 2;
                                                                                                            $a        = sin(deg2rad($alpha)) * sin(deg2rad($alpha)) + cos(deg2rad($lat_a)) * cos(deg2rad($lat_b)) * sin(deg2rad($beta)) * sin(deg2rad($beta));
                                                                                                            $c        = asin(min(1, sqrt($a)));
                                                                                                            $distance = 2 * $earth_radius * $c;
                                                                                                            $distance = round($distance, 4);
                                                                                                            $measure = $distance;
                                                                                                        }

                                                                                    ?>

                                                                                                        <div class="col-md-4 wow fadeInUp" data-wow-delay="0.5s">
                                                                                                            <div class="card mb-3">
                                                                                                                <a href="restaurant.php?name=<?php echo $row['name_en']; ?>&address=<?php echo $row['address_en']; ?>&id=<?php echo $row['id']; ?>&time=<?php echo $time; ?>" style="text-decoration: none;">
                                                                                                                    <div id="carouselExampleControls<?php echo $row['id']; ?>" class="carousel slide" data-ride="carousel">
                                                                                                                        <div class="carousel-inner">

                                                                                                                            <?php
                                                                                                                            $objImage = $obj->getImages($rest_id);

                                                                                                                            if ($objImage) {

                                                                                                                                $active = true;
                                                                                                                                while ($row1 = mysqli_fetch_assoc($objImage)) {

                                                                                                                                    $src = $row1["image"];


                                                                                                                            ?>

                                                                                                                                    <div class="carousel-item <?php echo $active == true ? "active" : "" ?>">
                                                                                                                                        <img class="d-block w-100 card-img-top" width="305px" height="230px" src="<?php echo "resturaunt/rest_img/$src" ?>" alt="First slide">
                                                                                                                                    </div>
                                                                                                                                <?php
                                                                                                                                    $active = false;
                                                                                                                                }
                                                                                                                            } else {


                                                                                                                                ?>
                                                                                                                                <div class="carousel-item active">
                                                                                                                                    <img class="d-block w-100 card-img-top" src="images/pizza-3007395_1920.jpg" alt="First slide">
                                                                                                                                </div>
                                                                                                                                <div class="carousel-item">
                                                                                                                                    <img class="d-block w-100 card-img-top" src="images/sushi-373588_1920.jpg" alt="Second slide">
                                                                                                                                </div>
                                                                                                                                <div class="carousel-item">
                                                                                                                                    <img class="d-block w-100 card-img-top" src="images/platter-2009590_1920.jpg" alt="Third slide">
                                                                                                                                </div>

                                                                                                                            <?php
                                                                                                                            }
                                                                                                                            ?>
                                                                                                                        </div>
                                                                                                                        <a class="carousel-control-prev" href="#carouselExampleControls<?php echo $row['id']; ?>" role="button" data-slide="prev">
                                                                                                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                                                                            <span class="sr-only">Previous</span>
                                                                                                                        </a>
                                                                                                                        <a class="carousel-control-next" href="#carouselExampleControls<?php echo $row['id']; ?>" role="button" data-slide="next">
                                                                                                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                                                                            <span class="sr-only">Next</span>
                                                                                                                        </a>
                                                                                                                    </div>
                                                                                                                </a>
                                                                                                                <div class="card-body">
                                                                                                                    <a href="restaurant.php?name=<?php echo $row['name_en']; ?>&address=<?php echo $row['address_en']; ?>&id=<?php echo $row['id']; ?>&time=<?php echo $time; ?>" style="text-decoration: none;">
                                                                                                                        <div class="row">

                                                                                                                            <div class="col-md-6">
                                                                                                                                <h6 class="card-title m-0 font-weight-bold"><?php echo $row['name_en']; ?></h6>
                                                                                                                            </div>

                                                                                                                            <div class="col-md-6">
                                                                                                                                <i class="fas fa-star" style="color:#EEA11D"></i>
                                                                                                                                <i class="fas fa-star" style="color:#EEA11D"></i>
                                                                                                                                <i class="fas fa-star" style="color:#EEA11D"></i>
                                                                                                                                <i class="fas fa-star" style="color:#EEA11D"></i>
                                                                                                                                <i class="fas fa-star" style="color:#EEA11D"></i>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </a>

                                                                                                                    <small class="text-secondary"><i class="fas fa-map-marker-alt mr-2"></i><?php echo $row['address_en']; ?>
                                                                                                                    </small>

                                                                                                                    <?php if (isset($_GET["permission"]) && $_GET["permission"] == "true") { ?>

                                                                                                                        <small class="text-secondary"><i class="ml-5"></i><?php echo $measure . " km" ?>
                                                                                                                        </small>
                                                                                                                    <?php } ?>


                                                                                                                    <div class="container">
                                                                                                                        <hr class="font-weight-bold">
                                                                                                                    </div>
                                                                                                                    <div class="container text-center">


                                                                                                                        <div class="owl-carousel owl-theme">


                                                                                                                        <?php
                                                                                                                    }

                                                                                                                        ?>
                                                                                                                        <div class="item">
                                                                                                                            <small class="font-weight-bold" style="color: #EEA11D;"><?php echo $row2[$day] == Null ? "0" : $row2[$day] ?>%</small>
                                                                                                                            <small class="d-block" style="color: #481639;"><?php echo "$ste:00" ?></small>
                                                                                                                        </div>

                                                                                                                        <div class="item">
                                                                                                                            <small class="font-weight-bold" style="color: #EEA11D;"><?php echo $row2[$day] == Null ? "0" : $row2[$day] ?>%</small>
                                                                                                                            <small class="d-block" style="color: #481639;"><?php echo "$ste:30" ?></small>
                                                                                                                        </div>




                                                                                                                    <?php
                                                                                                                    $st++;
                                                                                                                }
                                                                                                            }

                                                                                                            if ($gret == true) {

                                                                                                                    ?>
                                                                                                                        </div>
                                                                                                                    </div>

                                                                                                                </div>

                                                                                                            </div>
                                                                                                        </div>

                                                                                            <?php
                                                                                                            }
                                                                                                        }
                                                                                                    }

                                                                                            ?>




                                                                                            <?php
                                                                                        }
                                                                                    }
                                                                                } else if ($people != NULL && $date != NULL) {
                                                                                    if ($objRestaurant) {


                                                                                        while ($row = mysqli_fetch_assoc($objRestaurant)) {

                                                                                            $flag = true;
                                                                                            $gret = false;

                                                                                            $rest_id = $row["id"];

                                                                                            $rest_name = $row["name_en"];

                                                                                            $sql = "select * from $rest_name";
                                                                                            $res = mysqli_query($obj->link, $sql);


                                                                                            if (mysqli_num_rows($res) > 0) {
                                                                                                while ($row1 = mysqli_fetch_assoc($res)) {

                                                                                                    $time_ee = explode("-", $row1["time"]);

                                                                                                    $start_time = $time_ee[0];
                                                                                                    $s_t = explode(":", $start_time);

                                                                                                    $st = $s_t[0];

                                                                                                    $end_time = $time_ee[1];
                                                                                                    $e_t = explode(":", $end_time);

                                                                                                    $et = $e_t[0];

                                                                                                    if ($row1["l" . $day] >= $people) {

                                                                                                        if ($flag == true) {

                                                                                                            $flag = false;
                                                                                                            $gret = true;


                                                                                                            if (isset($_GET["permission"]) && $_GET["permission"] == "true") {

                                                                                                                $rest_id = $row["id"];
                                                                                                                $measure_unit = 'kilometers';
                                                                                                                $measure_state = false;
                                                                                                                $measure = 0;
                                                                                                                $error = '';
                                                                                                                $lat_b = $_GET["lat"];
                                                                                                                $lon_b = $_GET["lon"];
                                                                                                                $lat_a = $row["lat"];
                                                                                                                $lon_a = $row["lon"];
                                                                                                                $delta_lat = $lat_b - $lat_a;
                                                                                                                $delta_lon = $lon_b - $lon_a;
                                                                                                                $earth_radius = 6372.795477598;
                                                                                                                $alpha    = $delta_lat / 2;
                                                                                                                $beta     = $delta_lon / 2;
                                                                                                                $a        = sin(deg2rad($alpha)) * sin(deg2rad($alpha)) + cos(deg2rad($lat_a)) * cos(deg2rad($lat_b)) * sin(deg2rad($beta)) * sin(deg2rad($beta));
                                                                                                                $c        = asin(min(1, sqrt($a)));
                                                                                                                $distance = 2 * $earth_radius * $c;
                                                                                                                $distance = round($distance, 4);
                                                                                                                $measure = $distance;
                                                                                                            }



                                                                                            ?>


                                                                                                            <div class="col-md-4 wow fadeInUp" data-wow-delay="0.5s">
                                                                                                                <div class="card mb-3">
                                                                                                                    <a href="restaurant.php?name=<?php echo $row['name_en']; ?>&address=<?php echo $row['address_en']; ?>&id=<?php echo $row['id']; ?>&people=<?php echo $people; ?>&date=<?php echo $date; ?>" style="text-decoration: none;">
                                                                                                                        <div id="carouselExampleControls<?php echo $row['id']; ?>" class="carousel slide" data-ride="carousel">
                                                                                                                            <div class="carousel-inner">

                                                                                                                                <?php
                                                                                                                                $objImage = $obj->getImages($rest_id);

                                                                                                                                if ($objImage) {

                                                                                                                                    $active = true;
                                                                                                                                    while ($row1 = mysqli_fetch_assoc($objImage)) {

                                                                                                                                        $src = $row1["image"];


                                                                                                                                ?>

                                                                                                                                        <div class="carousel-item <?php echo $active == true ? "active" : "" ?>">
                                                                                                                                            <img class="d-block w-100 card-img-top" width="305px" height="230px" src="<?php echo "resturaunt/rest_img/$src" ?>" alt="First slide">
                                                                                                                                        </div>
                                                                                                                                    <?php
                                                                                                                                        $active = false;
                                                                                                                                    }
                                                                                                                                } else {


                                                                                                                                    ?>
                                                                                                                                    <div class="carousel-item active">
                                                                                                                                        <img class="d-block w-100 card-img-top" src="images/pizza-3007395_1920.jpg" alt="First slide">
                                                                                                                                    </div>
                                                                                                                                    <div class="carousel-item">
                                                                                                                                        <img class="d-block w-100 card-img-top" src="images/sushi-373588_1920.jpg" alt="Second slide">
                                                                                                                                    </div>
                                                                                                                                    <div class="carousel-item">
                                                                                                                                        <img class="d-block w-100 card-img-top" src="images/platter-2009590_1920.jpg" alt="Third slide">
                                                                                                                                    </div>

                                                                                                                                <?php
                                                                                                                                }
                                                                                                                                ?>
                                                                                                                            </div>
                                                                                                                            <a class="carousel-control-prev" href="#carouselExampleControls<?php echo $row['id']; ?>" role="button" data-slide="prev">
                                                                                                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                                                                                <span class="sr-only">Previous</span>
                                                                                                                            </a>
                                                                                                                            <a class="carousel-control-next" href="#carouselExampleControls<?php echo $row['id']; ?>" role="button" data-slide="next">
                                                                                                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                                                                                <span class="sr-only">Next</span>
                                                                                                                            </a>
                                                                                                                        </div>
                                                                                                                    </a>
                                                                                                                    <div class="card-body">
                                                                                                                        <a href="restaurant.php?name=<?php echo $row['name_en']; ?>&address=<?php echo $row['address_en']; ?>&id=<?php echo $row['id']; ?>&people=<?php echo $people; ?>&date=<?php echo $date; ?>" style="text-decoration: none;">
                                                                                                                            <div class="row">

                                                                                                                                <div class="col-md-6">
                                                                                                                                    <h6 class="card-title m-0 font-weight-bold"><?php echo $row['name_en']; ?></h6>
                                                                                                                                </div>

                                                                                                                                <div class="col-md-6">
                                                                                                                                    <i class="fas fa-star" style="color:#EEA11D"></i>
                                                                                                                                    <i class="fas fa-star" style="color:#EEA11D"></i>
                                                                                                                                    <i class="fas fa-star" style="color:#EEA11D"></i>
                                                                                                                                    <i class="fas fa-star" style="color:#EEA11D"></i>
                                                                                                                                    <i class="fas fa-star" style="color:#EEA11D"></i>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </a>

                                                                                                                        <small class="text-secondary"><i class="fas fa-map-marker-alt mr-2"></i><?php echo $row['address_en']; ?>
                                                                                                                        </small>

                                                                                                                        <?php if (isset($_GET["permission"]) && $_GET["permission"] == "true") { ?>

                                                                                                                            <small class="text-secondary"><i class="ml-5"></i><?php echo $measure . " km" ?>
                                                                                                                            </small>
                                                                                                                        <?php } ?>

                                                                                                                        <div class="container">
                                                                                                                            <hr class="font-weight-bold">
                                                                                                                        </div>
                                                                                                                        <div class="container text-center">


                                                                                                                            <div class="owl-carousel owl-theme">
                                                                                                                            <?php
                                                                                                                        } ?>

                                                                                                                            <div class="item">
                                                                                                                                <small class="font-weight-bold" style="color: #EEA11D;"><?php echo $row1[$day] == Null ? "0" : $row1[$day]  ?>%</small>
                                                                                                                                <small class="d-block" style="color: #481639;"><?php echo "$st:00" ?></small>
                                                                                                                            </div>

                                                                                                                            <div class="item">
                                                                                                                                <small class="font-weight-bold" style="color: #EEA11D;"><?php echo $row1[$day] == Null ? "0" : $row1[$day] ?>%</small>
                                                                                                                                <small class="d-block" style="color: #481639;"><?php echo "$st:30" ?></small>
                                                                                                                            </div>

                                                                                                                        <?php
                                                                                                                    }


                                                                                                                        ?>





                                                                                                                    <?php
                                                                                                                }

                                                                                                                if ($gret == true) {
                                                                                                                    ?>

                                                                                                                            </div>
                                                                                                                        </div>


                                                                                                                    </div>

                                                                                                                </div>
                                                                                                            </div>
                                                                                                    <?php
                                                                                                                }
                                                                                                            }



                                                                                                    ?>




                                                                                                    <?php
                                                                                                }
                                                                                            }
                                                                                        } else if ($location != NULL && $date == NULL && $people == NULL && $time == NULL) {
                                                                                            if ($objRestaurant) {

                                                                                                while ($row1 = mysqli_fetch_assoc($objRestaurant)) {
                                                                                                    $flag = false;
                                                                                                    $rest_id = $row1["id"];



                                                                                                    if (is_array(unserialize($row1["cities"]))) {

                                                                                                        foreach ($_POST["location"] as  $sp) {
                                                                                                            if (in_array($sp, unserialize($row1["cities"]))) {
                                                                                                                $flag = true;
                                                                                                                break;
                                                                                                            }
                                                                                                        }
                                                                                                    }

                                                                                                    if ($flag == true) {

                                                                                                        $sql2 = "SELECT * FROM `restaurant_tbl` where id='$rest_id'";
                                                                                                        $res2 = mysqli_query($obj->link, $sql2);


                                                                                                        if (mysqli_num_rows($res2) > 0) {
                                                                                                            while ($row = mysqli_fetch_assoc($res2)) {


                                                                                                                if (isset($_GET["permission"]) && $_GET["permission"] == "true") {

                                                                                                                    $rest_id = $row["id"];
                                                                                                                    $measure_unit = 'kilometers';
                                                                                                                    $measure_state = false;
                                                                                                                    $measure = 0;
                                                                                                                    $error = '';
                                                                                                                    $lat_b = $_GET["lat"];
                                                                                                                    $lon_b = $_GET["lon"];
                                                                                                                    $lat_a = $row["lat"];
                                                                                                                    $lon_a = $row["lon"];
                                                                                                                    $delta_lat = $lat_b - $lat_a;
                                                                                                                    $delta_lon = $lon_b - $lon_a;
                                                                                                                    $earth_radius = 6372.795477598;
                                                                                                                    $alpha    = $delta_lat / 2;
                                                                                                                    $beta     = $delta_lon / 2;
                                                                                                                    $a        = sin(deg2rad($alpha)) * sin(deg2rad($alpha)) + cos(deg2rad($lat_a)) * cos(deg2rad($lat_b)) * sin(deg2rad($beta)) * sin(deg2rad($beta));
                                                                                                                    $c        = asin(min(1, sqrt($a)));
                                                                                                                    $distance = 2 * $earth_radius * $c;
                                                                                                                    $distance = round($distance, 4);
                                                                                                                    $measure = $distance;
                                                                                                                }



                                                                                                    ?>

                                                                                                                <div class="col-md-4 wow fadeInUp" data-wow-delay="0.5s">
                                                                                                                    <div class="card mb-3">
                                                                                                                        <a href="restaurant.php?name=<?php echo $row['name_en']; ?>&address=<?php echo $row['address_en']; ?>&id=<?php echo $row['id']; ?>" style="text-decoration: none;">
                                                                                                                            <div id="carouselExampleControls<?php echo $row['id']; ?>" class="carousel slide" data-ride="carousel">
                                                                                                                                <div class="carousel-inner">

                                                                                                                                    <?php
                                                                                                                                    $objImage = $obj->getImages($rest_id);

                                                                                                                                    if ($objImage) {

                                                                                                                                        $active = true;
                                                                                                                                        while ($row1 = mysqli_fetch_assoc($objImage)) {

                                                                                                                                            $src = $row1["image"];


                                                                                                                                    ?>

                                                                                                                                            <div class="carousel-item <?php echo $active == true ? "active" : "" ?>">
                                                                                                                                                <img class="d-block w-100 card-img-top" width="305px" height="230px" src="<?php echo "resturaunt/rest_img/$src" ?>" alt="First slide">
                                                                                                                                            </div>
                                                                                                                                        <?php
                                                                                                                                            $active = false;
                                                                                                                                        }
                                                                                                                                    } else {


                                                                                                                                        ?>
                                                                                                                                        <div class="carousel-item active">
                                                                                                                                            <img class="d-block w-100 card-img-top" src="images/pizza-3007395_1920.jpg" alt="First slide">
                                                                                                                                        </div>
                                                                                                                                        <div class="carousel-item">
                                                                                                                                            <img class="d-block w-100 card-img-top" src="images/sushi-373588_1920.jpg" alt="Second slide">
                                                                                                                                        </div>
                                                                                                                                        <div class="carousel-item">
                                                                                                                                            <img class="d-block w-100 card-img-top" src="images/platter-2009590_1920.jpg" alt="Third slide">
                                                                                                                                        </div>

                                                                                                                                    <?php
                                                                                                                                    }
                                                                                                                                    ?>
                                                                                                                                </div>
                                                                                                                                <a class="carousel-control-prev" href="#carouselExampleControls<?php echo $row['id']; ?>" role="button" data-slide="prev">
                                                                                                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                                                                                    <span class="sr-only">Previous</span>
                                                                                                                                </a>
                                                                                                                                <a class="carousel-control-next" href="#carouselExampleControls<?php echo $row['id']; ?>" role="button" data-slide="next">
                                                                                                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                                                                                    <span class="sr-only">Next</span>
                                                                                                                                </a>
                                                                                                                            </div>
                                                                                                                        </a>
                                                                                                                        <div class="card-body">
                                                                                                                            <a href="restaurant.php?name=<?php echo $row['name_en']; ?>&address=<?php echo $row['address_en']; ?>&id=<?php echo $row['id']; ?>&day=<?php echo $day; ?>" style="text-decoration: none;">
                                                                                                                                <div class="row">

                                                                                                                                    <div class="col-md-6">
                                                                                                                                        <h6 class="card-title m-0 font-weight-bold"><?php echo $row['name_en']; ?></h6>
                                                                                                                                    </div>

                                                                                                                                    <div class="col-md-6">
                                                                                                                                        <i class="fas fa-star" style="color:#EEA11D"></i>
                                                                                                                                        <i class="fas fa-star" style="color:#EEA11D"></i>
                                                                                                                                        <i class="fas fa-star" style="color:#EEA11D"></i>
                                                                                                                                        <i class="fas fa-star" style="color:#EEA11D"></i>
                                                                                                                                        <i class="fas fa-star" style="color:#EEA11D"></i>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            </a>

                                                                                                                            <small class="text-secondary"><i class="fas fa-map-marker-alt mr-2"></i><?php echo $row['address_en']; ?>
                                                                                                                            </small>

                                                                                                                            <?php if (isset($_GET["permission"]) && $_GET["permission"] == "true") { ?>

                                                                                                                                <small class="text-secondary"><i class="ml-5"></i><?php echo $measure . " km" ?>
                                                                                                                                </small>
                                                                                                                            <?php } ?>


                                                                                                                            <div class="container">
                                                                                                                                <hr class="font-weight-bold">
                                                                                                                            </div>
                                                                                                                            <div class="container text-center">


                                                                                                                                <div class="owl-carousel owl-theme">


                                                                                                                                    <?php

                                                                                                                                    $rest_name = $row["name_en"];

                                                                                                                                    $sql = "select * from $rest_name";
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
                                                                                                                                                <small class="font-weight-bold" style="color: #EEA11D;"><?php echo $row1[$day] == Null ? "0" : $row1[$day]  ?>%</small>
                                                                                                                                                <small class="d-block" style="color: #481639;"><?php echo "$st:00" ?></small>
                                                                                                                                            </div>

                                                                                                                                            <div class="item">
                                                                                                                                                <small class="font-weight-bold" style="color: #EEA11D;"><?php echo $row1[$day] == Null ? "0" : $row1[$day] ?>%</small>
                                                                                                                                                <small class="d-block" style="color: #481639;"><?php echo "$st:30" ?></small>
                                                                                                                                            </div>



                                                                                                                                    <?php
                                                                                                                                        }
                                                                                                                                    }


                                                                                                                                    ?>


                                                                                                                                </div>
                                                                                                                            </div>


                                                                                                                        </div>

                                                                                                                    </div>
                                                                                                                </div>


                                                                                        <?php
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                }
                                                                                            }
                                                                                        }





                                                                                        ?>

            </div>


        </div>
    </section>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong>Filter</strong> By</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php if (isset($_GET["permission"]) && $_GET["permission"] == "true") {

                ?>
                    <form action="filter_result_spec.php?permission=true&lat=<?php echo $lat ?>&lon=<?php echo $lon; ?>" method="POST">
                    <?php
                } else {
                    ?>
                        <form action="filter_result_spec.php" method="POST">
                        <?php
                    }
                        ?>
                        <div class="modal-body">
                            <div class="container">
                                <div class="row">

                                    <div class="col-lg-6">


                                        <?php
                                        if ($objSpec) { ?>
                                            <?php while ($row = mysqli_fetch_assoc($objSpec)) {

                                            ?>



                                                <div class="form-check">
                                                    <input class="form-check-input big-checkbox" type="checkbox" name="specialty[]" value="<?php echo $row["id"] ?>" id="defaultCheck1">
                                                    <label class="form-check-label ml-3" for="defaultCheck1" style="font-size: 19px;">
                                                        <?php echo $row["specialty_en"] ?>
                                                    </label>

                                                </div>

                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <!-- <div class="row">
                        <div class="col-md-6">
                            <h5 class="modal-title" id="exampleModalLabel"><strong>Sort</strong> By</h5>
                            <div class="form-check mt-3">
                                <input class="form-check-input checkbox-round" type="checkbox" value="" id="defaultCheck11">
                                <label class="form-check-label ml-3" for="defaultCheck11" style="font-size: 19px;">
                                    Location
                                </label>

                            </div>
                            <div class="form-check">
                                <input class="form-check-input checkbox-round" type="checkbox" value="" id="defaultCheck12">
                                <label class="form-check-label ml-3" for="defaultCheck12" style="font-size: 19px;">
                                    Rating
                                </label>

                            </div>
                            <div class="form-check">
                                <input class="form-check-input checkbox-round" type="checkbox" value="" id="defaultCheck13">
                                <label class="form-check-label ml-3" for="defaultCheck13" style="font-size: 19px;">
                                    Price
                                </label>

                            </div>
                            <div class="form-check">
                                <input class="form-check-input checkbox-round" type="checkbox" value="" id="defaultCheck14">
                                <label class="form-check-label ml-3" for="defaultCheck14" style="font-size: 19px;">
                                    Discounts
                                </label>

                            </div>
                        </div>
                        <div class="col-md-6"></div>
                    </div> -->
                        </div>

                        <div class="modal-footer text-center">

                            <button type="submit" class="mx-auto log_btn btn  text-center font-weight-bold">Apply
                                Filters</button>
                        </div>
                        </form>
            </div>
        </div>
    </div>



    <?php include('layout/footer.php'); ?>


    <?php include('layout/script.php') ?>
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

        function getPermission() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPos);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showPos(position) {
            if (confirm("Search Nearby Restaurants?")) {

                var lat = position.coords.latitude;
                var lon = position.coords.longitude;

                <?php $_SESSION["permission"] = true; ?>
                location.replace("index.php?permission=true&lat=" + lat + "&lon=" + lon);

            } else {
                <?php $permission = false; ?>

                <?php $_SESSION["permission"] = false; ?>

                location.replace("index.php");
            }
            // x.innerHTML = "Latitude: " + position.coords.latitude +
            //     "<br>Longitude: " + position.coords.longitude;
        }
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

        })
    </script>
    <!-- <script type="text/javascript">
    document.getElementById('username').addEventListener("keyup", function() {
        var query = document.getElementById('username').value;
        if (query.length != 0) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("searchSuggestion").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "getSuggestion.php?data=" + query, true);
            xmlhttp.send();
        } else {
            document.getElementById('searchSuggestion').innerHTML = 'Enter some value';
        }
    });
    </script> -->
</body>

</html>