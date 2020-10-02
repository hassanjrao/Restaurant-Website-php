<?php

session_start();
if (!isset($_SESSION['name'])) {
    header("location: login.php");
}
include('class/database.php');
class CityCreate extends database
{
    protected $link;
  
    public function createCity()
    {
        if (isset($_POST['city_en'])) {
            $city_en = strtolower($_POST['city_en']);
            $city_heb = strtolower($_POST['city_heb']);
            $city_fr = strtolower($_POST['city_fr']);
            $lat=$_POST["lat"];
            $lon=$_POST["lon"];

            $sql = "INSERT INTO cities_tb (`city_en`,`city_heb`,`city_fr`,`lat`,`lon`, `created`) VALUES ('$city_en','$city_heb','$city_fr','$lat','$lon', CURRENT_TIMESTAMP)";
            $res = mysqli_query($this->link, $sql);

            if ($res) {
                $msg = "success_add";
                // header("location: all_cities.php?msg=$msg");
                // return true;

                echo $msg;
            } else {
                $msg = "fail_add";
                // header("location: all_cities.php?msg=$msg");
                // return false;

                echo $msg;
            }
        }
        # code...
    }
}
$obj = new CityCreate;
$objCreate = $obj->createCity();