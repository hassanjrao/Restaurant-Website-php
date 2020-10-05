<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("location: login.php");
}
include('class/database.php');
class restaurant extends database
{
    protected $link;
    
    public function createRestaurant()
    {
        if (isset($_POST['name_en'])) {
            $name_en = addslashes(str_replace(" ", "_", $_POST['name_en']));
            $name_heb = addslashes(str_replace(" ", "_", $_POST['name_heb']));
            $name_fr = addslashes(str_replace(" ", "_", $_POST['name_fr']));

            $address_en = addslashes($_POST['address_en']);
            $address_heb = addslashes($_POST['address_heb']);
            $address_fr = addslashes($_POST['address_fr']);

            $cities = serialize($_POST["cities"]);

            $lat=$_POST["lat"];
            $lon=$_POST["lon"];

            $email = addslashes($_POST['email']);
            $password = addslashes($_POST['password']);
            $payment = $name_en . "_payment";
            $phone = $_POST['phone'];
            $image = "placeholder-16-9.jpg";
            $gallery1 = "placeholder-16-9.jpg";
            $gallery2 = "placeholder-16-9.jpg";
            $gallery3 = "placeholder-16-9.jpg";

            $pass = password_hash($password, PASSWORD_DEFAULT);

            $sqlFind = "select * from restaurant_tbl where name_en = '$name_en' ";
            $resFind = mysqli_query($this->link, $sqlFind);
            if (mysqli_num_rows($resFind) > 0) {
                $msg = "fail_add";
                echo $msg;
            } else {
                $sql = "INSERT INTO `restaurant_tbl` (`name_en`, `name_heb`, `name_fr`, `phone`, `address_en`, `address_heb`, `address_fr`,`lat`,`lon`, `cities` , `email`, `password`, `created`, `updated`) VALUES ( '$name_en', '$name_heb', '$name_fr', '$phone', '$address_en', '$address_heb', '$address_fr', '$lat','$lon' ,'$cities', '$email', '$pass', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
                $res = mysqli_query($this->link, $sql);
                if ($res) {
                    $sql2 = "CREATE TABLE $name_en (
                        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                        name VARCHAR(30) NOT NULL,
                        time VARCHAR(30) NOT NULL,
                        sun VARCHAR(50),
                        mon VARCHAR(50),
                        tue VARCHAR(50),
                        wed VARCHAR(50),
                        thu VARCHAR(50),
                        fri VARCHAR(50),
                        sat VARCHAR(50),
                        psun VARCHAR(50),
                        pmon VARCHAR(50),
                        ptue VARCHAR(50),
                        pwed VARCHAR(50),
                        pthu VARCHAR(50),
                        pfri VARCHAR(50),
                        psat VARCHAR(50),
                        lsun VARCHAR(50),
                        lmon VARCHAR(50),
                        ltue VARCHAR(50),
                        lwed VARCHAR(50),
                        lthu VARCHAR(50),
                        lfri VARCHAR(50),
                        lsat VARCHAR(50),
                        created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                        )";
                    $res2 = mysqli_query($this->link, $sql2);

                


                    $sqlPay = "CREATE TABLE $payment (
                        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                        name VARCHAR(30) NOT NULL,
                        month VARCHAR(30) NOT NULL,
                        client INT(11),
                        amount INT(11),
                        status VARCHAR(30),
                        
                        created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                        )";

                    $resPay = mysqli_query($this->link, $sqlPay);
                    if ($res2) {
                        $sql3 = "INSERT INTO `$name_en` (`id`, `name`, `time`, `sun`, `mon`, `tue`, `wed`, `thu`, `fri`, `sat`,`psun`, `pmon`, `ptue`, `pwed`, `pthu`, `pfri`, `psat`,`lsun`, `lmon`, `ltue`, `lwed`, `lthu`, `lfri`, `lsat`, `created`) VALUES (NULL, '$name_en', '09:00-10:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL, NULL, NULL, NULL, NULL, CURRENT_TIMESTAMP),(NULL, '$name_en', '10:00-11:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL ,CURRENT_TIMESTAMP),(NULL, '$name_en', '11:00-12:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL ,CURRENT_TIMESTAMP),(NULL, '$name_en', '12:00-13:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL,CURRENT_TIMESTAMP),(NULL, '$name_en', '13:00-14:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL,CURRENT_TIMESTAMP),(NULL, '$name_en', '14:00-15:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL,CURRENT_TIMESTAMP),(NULL, '$name_en', '15:00-16:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL ,CURRENT_TIMESTAMP),(NULL, '$name_en', '16:00-17:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL ,CURRENT_TIMESTAMP),(NULL, '$name_en', '17:00-18:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL ,CURRENT_TIMESTAMP),(NULL, '$name_en', '18:00-19:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL ,CURRENT_TIMESTAMP),(NULL, '$name_en', '19:00-20:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL ,CURRENT_TIMESTAMP),(NULL, '$name_en', '20:00-21:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL ,CURRENT_TIMESTAMP),(NULL, '$name_en', '21:00-22:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL ,CURRENT_TIMESTAMP),(NULL, '$name_en', '22:00-23:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL ,CURRENT_TIMESTAMP)";
                        $res3 = mysqli_query($this->link, $sql3);
                        $sqlPay2 = "INSERT INTO `$payment` (`id`, `name`, `month`, `client`, `amount`, `status`, `created`) VALUES (NULL, '$name_en', 'January', NULL, NULL, NULL, CURRENT_TIMESTAMP),(NULL, '$name_en', 'February', NULL, NULL, NULL, CURRENT_TIMESTAMP), (NULL, '$name_en', 'March', NULL, NULL, NULL, CURRENT_TIMESTAMP),(NULL, '$name_en', 'April', NULL, NULL, NULL, CURRENT_TIMESTAMP),(NULL, '$name_en', 'May', NULL, NULL, NULL, CURRENT_TIMESTAMP),(NULL, '$name_en', 'Jun', NULL, NULL, NULL, CURRENT_TIMESTAMP),(NULL, '$name_en', 'July', NULL, NULL, NULL, CURRENT_TIMESTAMP),(NULL, '$name_en', 'August', NULL, NULL, NULL, CURRENT_TIMESTAMP),(NULL, '$name_en', 'September', NULL, NULL, NULL, CURRENT_TIMESTAMP),(NULL, '$name_en', 'October', NULL, NULL, NULL, CURRENT_TIMESTAMP),(NULL, '$name_en', 'November', NULL, NULL, NULL, CURRENT_TIMESTAMP),(NULL, '$name_en', 'December', NULL, NULL, NULL, CURRENT_TIMESTAMP)";


                        $resPay2 = mysqli_query($this->link, $sqlPay2);

                       

                        if ($resPay2) {
                            echo "success_add";
                            return true;
                        }
                        echo "success_add";

                        return true;
                    }
                } else {
                  
                    echo "fail_add";
                    return true;
                }
            }
        }
        # code...
    }

   
}
$obj = new restaurant;
$objCreate = $obj->createRestaurant();

?>