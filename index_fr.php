<?php
session_start();
include('class/database.php');
class restaurant extends database
{
    public $link;


    public function restaurantFunction()
    {
        $sql = "SELECT * FROM `restaurant_tbl` order by id desc LIMIT 6";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
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

    public function getDiscount()
    {
        $rest = $this->restaurantFunction();

        if ($rest) {
            while ($row = mysqli_fetch_assoc($rest)) {
                $r_id = $row["id"];
                $r_name = $row["name_en"];

                $sql = "select * from $r_name";
                $res = mysqli_query($this->link, $sql);
                if (mysqli_num_rows($res) > 0) {
                    return $res;
                } else {
                    return false;
                }
            }
        }
    }
}
$obj = new restaurant;
$objRestaurant = $obj->restaurantFunction();
$objSpec = $obj->getSpec();
$objCity = $obj->getCities();



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceuil</title>
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
    <?php include('layout/navbar_fr.php'); ?>

    <div class="back_img">
        <div class="container">
            <div class="caption pt-5">
                <h3 class="font-weight-bold">Un moyen plus rapide, plus économe et plus simple de réserver un restaurant en Israel</h3>
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
                    <form method="POST" action="filter_results_fr.php">
                        <div class="row pt-4">
                            <div class="col-md-2">
                                <div class="input-group input-focus bg-light shadow">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text border-0 bg-light "><i class="far fa-clock"></i></span>
                                    </div>

                                    <select name="time" class="form-control border-0 bg-light ">
                                        <option value="" selected disabled class="">Heure</option>

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
                                        <option value="" selected disabled class="">Personne</option>
                                        <option value="1">1 personne</option>
                                        <option value="2">2 personne</option>
                                        <option value="3">3 personne</option>
                                        <option value="4">4 personne</option>
                                        <option value="5">5 personne</option>
                                        <option value="6">6 personne</option>
                                        <option value="7">7 personne</option>
                                        <option value="8">8 personne</option>
                                        <option value="9">9 personne</option>
                                        <option value="10">10 personne</option>
                                        <option value="11">11 personne</option>
                                        <option value="12">12 personne</option>
                                        <option value="13">13 personne</option>
                                        <option value="14">14 personne</option>
                                        <option value="15">15 personne</option>
                                        <option value="16">16 personne</option>
                                        <option value="17">17 personne</option>
                                        <option value="18">18 personne</option>
                                        <option value="19">19 personne</option>
                                        <option value="20">20 personne</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group input-focus bg-light shadow">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text border-0 bg-light "><i class="fas fa-calendar-alt"></i></span>
                                    </div>
                                    <input placeholder="Select a date" name="filter-date" type="text" class="form-control bg-light border-0" id="datepicker">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group input-focus bg-light shadow">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text border-0 bg-light "><i class="fas fa-map-marker-alt"></i></span>
                                    </div>


                                    <select name="location[]" class="form-control border-0 bg-light ">
                                    <option value="" selected disabled>emplacement</option>
                                        <?php
                                        if ($objCity) { ?>
                                            <?php while ($row = mysqli_fetch_assoc($objCity)) {

                                            ?>
                                               
                                                <option value="<?php echo $row["id"] ?>"><?php echo ucwords($row["city_fr"]) ?></option>

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
                            <div class="col-md-7 col-10">
                                <button type="submit" name="submit-search" class="font-weight-bold home_btn p-3 mt-4 shadow btn btn-block">Rechercher</button>
                            </div>
                            <div class="col-md-1 col-2">
                                <button type="button" class="btn home_btn shadow p-3 mt-4 btn-block" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-filter"></i></button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>

    <section>
        <div class="container item_section">
            <!-- <h3 class="text-center"><span class="font-weight-bold">New In</span> Woopyz</h3> -->
            <div class="row">



                <?php if ($objRestaurant) {



                    $day = strtolower(date("D"));


                    while ($row = mysqli_fetch_assoc($objRestaurant)) {

                        $rest_id = $row["id"];

                ?>

                        <div class="col-md-4 wow fadeInUp" data-wow-delay="0.5s">
                            <div class="card mb-3">
                                <a href="restaurant_fr.php?name=<?php echo $row['name_en']; ?>&address=<?php echo $row['address_en']; ?>&id=<?php echo $row['id']; ?>&day=<?php echo $day; ?>" style="text-decoration: none;">
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
                                            <span class="sr-only">Précédent</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleControls<?php echo $row['id']; ?>" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Suivant</span>
                                        </a>
                                    </div>
                                </a>
                                <div class="card-body">
                                    <a href="restaurant_fr.php?name=<?php echo $row['name_en']; ?>&address=<?php echo $row['address_en']; ?>&id=<?php echo $row['id']; ?>&day=<?php echo $day; ?>" style="text-decoration: none;">
                                        <div class="row">

                                            <div class="col-md-6">
                                                <h6 class="card-title m-0 font-weight-bold"><?php echo $row['name_fr']; ?></h6>
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

                                    <small class="text-secondary"><i class="fas fa-map-marker-alt mr-2"></i><?php echo $row['address_fr']; ?>
                                    </small>


                                    <div class="container">
                                        <hr class="font-weight-bold">
                                    </div>
                                    <div class="container text-center">


                                        <div class="owl-carousel owl-theme">

                                            <?php

                                            $r_id = $row["id"];
                                            $r_name = $row["name_en"];




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


                                            ?>


                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>

                    <?php } ?>
                <?php } ?>




            </div>


        </div>
    </section>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong>Filtrer</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="filter_result_spec_fr.php" method="POST">
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
                                                    <?php echo $row["specialty_fr"] ?>
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

                    </div>

                    <div class="modal-footer text-center">

                        <button type="submit" class="mx-auto log_btn btn  text-center font-weight-bold">Appliquer les filtres</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <?php include('layout/footer_fr.php'); ?>


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