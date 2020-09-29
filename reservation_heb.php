<?php
session_start();
error_reporting(0);
include('class/database.php');

class reservation extends database
{
    protected $link;
    public function confirmFunction()
    {
        if (isset($_POST['confirm'])) {
            $code = $_SESSION['code'];
            $confirm = 1;
            $sql = "update `reservation_tbl` SET `user_confirm` = $confirm where code = '$code' ";
            $res = mysqli_query($this->link, $sql);




            if ($res) {



                $sql2 = "SELECT * from `reservation_tbl` where code = '$code' ";
                $res2 = mysqli_query($this->link, $sql2);

                $resl = mysqli_fetch_assoc($res2);

                $email = $resl["email"];
                $rest_name = $resl["rest_name"];

                $res_date = $resl["date"];
                $res_time = $resl["time"];
                $res_people = $resl["people"];



                // ---------------------------------------------------------------
                $day = $_SESSION["day"];
                $people = intval($_SESSION["people"]);
                $time = explode("-", $_SESSION["time"]);



                $start_time = $time[0];
                $s_t = explode(":", $start_time);

                $st = $s_t[0];


                if ($st == "9") {
                    $time = "09:00-10:00";
                } else if ($st == "10") {
                    $time = "10:00-11:00";
                } else if ($st == "11") {
                    $time = "11:00-12:00";
                } else if ($st == "12") {
                    $time = "12:00-13:00";
                } else if ($st == "13") {
                    $time = "13:00-14:00";
                } else if ($st == "14") {
                    $time = "14:00-15:00";
                } else if ($st == "15") {
                    $time = "15:00-16:00";
                } else if ($st == "16") {
                    $time = "16:00-17:00";
                } else if ($st == "17") {
                    $time = "17:00-18:00";
                } else if ($st == "18") {
                    $time = "18:00-19:00";
                } else if ($st == "19") {
                    $time = "19:00-20:00";
                } else if ($st == "20") {
                    $time = "20:00-21:00";
                } else if ($st == "21") {
                    $time = "21:00-22:00";
                } else if ($st == "22") {
                    $time = "22:00-23:00";
                }


                $sql0 = "SELECT * from $rest_name where time='$time' ";
                $res0 = mysqli_query($this->link, $sql0);
                $resl0 = mysqli_fetch_assoc($res0);
                $total = intval($resl0[$day]);

                $total_left = $total - $people;

                $sqlU = "update $rest_name SET $day = $total_left where time = '$time' ";
                $resU = mysqli_query($this->link, $sqlU);

                // -----------------------------------------------------------------------------

                $sql_u = "SELECT * from `user_tbl` where email = '$email' ";
                $res_u = mysqli_query($this->link, $sql_u);
                $resl_u = mysqli_fetch_assoc($res_u);


                $fname = $resl_u["fname"];
                $lname = $resl_u["lname"];

                $discount=$resl0[$day];


                $sql_res = "SELECT * from `restaurant_tbl` where name_en = '$rest_name' ";
                $res_res = mysqli_query($this->link, $sql_res);
                $resl_res = mysqli_fetch_assoc($res_res);


                $address_heb = $resl_res["address_heb"];


                $to = $email;
                $subject = "Reservation Confirm";
                $txt = "$fname $lname שלום

                : ההזמנה שלך אושרה
                
                $res_date : יום
                $res_time : שעה
                $address_heb : כתובת
                $res_people : אנשים
                % $discount : הנחה של
                $code : מספר הזמנה
                
                תודה על ההזמנה, מקווים שתהנו.
                
                
                
                !חשוב לדעת
                
                עיכוב של יותר מ- 15 דקות יכול לגרום לביטול ההזמנה
                במקרה של אי הגעה, נודה על ביטול ההזמנה על מנת לסייע לאורחים נוספים
                במקרה של שינוי מועד הגעה, מסעדה, כמות מוזמנים ניתן לבטל את ההזמנה ולבצע הזמנה חדשה.
                
                
                יש לכם שאלה? הצעת ייעול?
                אתם מוזמנים ליצור איתנו קשר, נשמח לשמוע.
                contact@woopyzz.com
                צוות WOOPYZZ                
                ";
                $from = "contact@woopyzz.com";

                $headers = "From: $from" . "\r\n" . "Reply-To: $from" . "\r\n" . "X-Mailer: PHP/" . phpversion();

                if (mail($to, $subject, $txt, $headers)) {


                    $sql3 = "SELECT email from `restaurant_tbl` where name_en = '$rest_name' ";
                    $res3 = mysqli_query($this->link, $sql3);
                    $resl3 = mysqli_fetch_assoc($res3);
                    $rest_email = $resl3["email"];


                    // ---------

                    $sql4 = "SELECT fname,lname from `user_tbl` where email = '$email' ";
                    $res4 = mysqli_query($this->link, $sql4);
                    $resl4 = mysqli_fetch_assoc($res4);
                    $fname = ucwords($resl4["fname"]);
                    $lname = ucwords($resl4["lname"]);




                    $to = $rest_email;
                    $subject = "You got a new Reservation";
                    $txt = "

                    שלום,

                    קיבלת הזמנה:
                    $res_date : יום
                    $res_time : שעה
                    $res_people : אנשים
                    % $discount : הנחה של
                    $code : מספר הזמנה
                    
                    צוות WOOPYZ
                    ";
                    $from = "contact@woopyzz.com";

                    $headers = "From: $from" . "\r\n" . "Reply-To: $from" . "\r\n" . "X-Mailer: PHP/" . phpversion();

                    if (mail($to, $subject, $txt, $headers)) {

                        unset($_SESSION["code"]);
                        header('location:thankyou_heb.php');
                        return $res;
                    }
                } else {
                    echo "Email not sent";
                }

                // ----------


            } else {
                return false;
            }
        }
        # code...
    }
    public function cancelFunction()
    {
        if (isset($_POST['cancel'])) {
            $code = $_SESSION['code'];
            $sql = "DELETE FROM `reservation_tbl` WHERE `reservation_tbl`.`code` = $code";
            $res = mysqli_query($this->link, $sql);
            if ($res) {
                $msg = "Deleted";
                unset($_SESSION['code']);
                header("location: index.php");
            } else {
                $msg = "Not Deleted";
                return $msg;
            }
        }
        # code...
    }
    public function featureFunction()
    {
        $name = $_SESSION['rname'];
        $sql = "select * from restaurant_feature where rest_name = '$name' LIMIT 1";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }

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
}
$obj = new reservation;
$objConfirm = $obj->confirmFunction();
$objCancel = $obj->cancelFunction();
$objFeature = $obj->featureFunction();
$show = mysqli_fetch_assoc($objFeature);

$objContact = $obj->contactFunction();
$objInfo = $obj->infoFunction();

$rowCont = mysqli_fetch_assoc($objContact);
$rowInfo = mysqli_fetch_assoc($objInfo);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation</title>
    <?php include('layout/style.php'); ?>

</head>

<body class="bg-light">
    <?php include('layout/navbar.php'); ?>

    <?php include('layout/hero_section.php'); ?>

    <form action="" method="post">
        <section>
            <div class="container bg-white pr-4 pl-4 log_section pb-5 reserve_section">
                <h5 class=" text-center pt-5 font-weight-bold"><?php echo "תודה על ההזמנה! " . ucfirst($rowCont["fname"]) . " " . ucfirst($rowCont["lname"]) . " ל " . $_SESSION["people"] . " סועדים עַל " . $_SESSION["date"];  ?></h5>

                <div class="container">
                    <div class="row pt-5">
                        <div class="col-md-4">
                            <h4 class="font-weight-bold"><?php echo $_SESSION['rname']; ?></h4>
                            <small class="d-block mb-4 text-secondary"><span><i class="fas fa-map-marker-alt mr-2"></i></span><?php echo $_SESSION['address']; ?></small>
                            <i class="fas fa-star fa-2x star"></i>
                            <i class="fas fa-star fa-2x"></i>
                            <i class="fas fa-star fa-2x"></i>
                            <i class="fas fa-star fa-2x"></i>
                            <i class="fas fa-star fa-2x"></i>
                            <p class="mt-3">Bar | <span class="font-weight-bold"><?php echo $show['bar']; ?></span></p>
                            <p class="mt-3">Music | <span class="font-weight-bold"><?php echo $show['music']; ?></span>
                            </p>
                            <p class="mt-3">Parking | <span class="font-weight-bold"><?php echo $show['park']; ?></span>
                            </p>
                            <p class="mt-3">Terrace | <span class="font-weight-bold"><?php echo $show['terrace']; ?></span></p>
                        </div>
                        <div class="col-md-4 mx-auto">
                            <?php if ($objCancel) { ?>
                                <?php if (strcmp($objCancel, 'Deleted') == 0) { ?>
                                    <div class="alert alert-danger alert-dismissible fade show">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>Reservation is removed!</strong>
                                    </div>
                                <?php } ?>
                                <?php if (strcmp($objCancel, 'Deleted') == 1) { ?>
                                    <div class="alert alert-warning alert-dismissible fade show">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>Already Removed!</strong>
                                    </div>
                                <?php } ?>

                            <?php } ?>
                            <img src="images/google-maps.jpg" alt="">
                        </div>
                        <div class="col-md-4 p-5 bg-light">
                            <h4 class="font-weight-bold text-center">קוד הזמנה</h4>
                            <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>">
                            <?php if (isset($_SESSION['code'])) { ?>
                                <input type="text" name="code" class="form-control border-0 bg-white mt-5" placeholder="Enter Code" value="<?php echo $_SESSION['code']; ?>" readonly>
                            <?php } else { ?>
                                <input type="text" name="code" class="form-control border-0 bg-white mt-5" placeholder="קוד הזמנה" value="" readonly required>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container reserve_section_btn">
                <div class="row">
                    <div class="col-md-6 pt-3">
                        <button type="submit" name="cancel" class="btn btn-block btn-lg font-weight-bold">בטל הזמנה</button>

                    </div>
                    <div class="col-md-6 pt-3">
                        <button type="submit" name="confirm" class="btn color_btn btn-block btn-lg font-weight-bold">אשר הזמנה</button>
                    </div>
                </div>
            </div>
        </section>
    </form>

    <?php include('layout/footer.php'); ?>


    <?php include('layout/script.php') ?>
</body>

</html>