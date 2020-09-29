<?php
session_start();

include('class/database.php');
class TOS extends database
{
    public $link;




    public function getTOS()
    {
        $sql = "select * from termsofuse_tb";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
}
$obj = new TOS;

$objTOS = $obj->getTOS();



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms of use</title>
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
                    <form method="POST" action="filter_results.php">
                        <div class="row pt-4">
                            <div class="col-md-2">
                                <div class="input-group input-focus bg-light shadow">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text border-0 bg-light "><i class="far fa-clock"></i></span>
                                    </div>

                                    <select name="time" class="form-control border-0 bg-light ">
                                        <option value="" selected disabled class="">Time</option>

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
                                        <option value="" selected disabled class="">Person</option>
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
                                    <input placeholder="Select a date" name="filter-date" type="text" class="form-control bg-light border-0" id="datepicker">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group input-focus bg-light shadow">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text border-0 bg-light "><i class="fas fa-map-marker-alt"></i></span>
                                    </div>


                                    <select name="location" class="form-control border-0 bg-light ">

                                        <?php
                                        if ($objCity) { ?>
                                            <?php while ($row = mysqli_fetch_assoc($objCity)) {

                                            ?>
                                                <option value="" selected disabled>Location</option>
                                                <option value="<?php echo $row["id"] ?>"><?php echo ucwords($row["city"]) ?></option>

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
                                <button type="submit" name="submit-search" class="font-weight-bold home_btn p-3 mt-4 shadow btn btn-block">Search</button>
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
            <h3 class="text-center"><span class="font-weight-bold">Terms of use</h3>

            <div class="row">

            <?php if($objTOS){

                $row=mysqli_fetch_assoc($objTOS);

                $tos=$row["termsofuse"];
            } ?>

                <div class="col-lg-12">

                <?php echo $tos ?>
                </div>

            </div>


        </div>
    </section>




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