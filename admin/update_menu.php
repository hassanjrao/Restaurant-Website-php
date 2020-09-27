<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("location: login.php");
}
include('class/database.php');
class Translation extends database
{
    protected $link;


    public function saveFunctionStarter()
    {
        if (isset($_POST['submit_starter'])) {
            $id = $_POST['menu_id'];

            $rest_id=$_POST["rest_id"];


            $starter_en = $_POST['starter_en'];
            $starter_heb = $_POST['starter_heb'];
            $starter_fr = $_POST['starter_fr'];
            $price = $_POST["price"];





            $sql = "UPDATE menu_starter_tb SET starter_en='$starter_en', starter_heb='$starter_heb',starter_fr='$starter_fr', price='$price', updated=CURRENT_TIMESTAMP where id='$id'";
            $res = mysqli_query($this->link, $sql);


            if ($res) {
                $msg = "success_upd";
                header("location: menu.php?id=$rest_id&cat=1&msg=$msg");
                return true;
            } else {
                $msg = "fail_upd";
                header("location: menu.php?id=$rest_id&cat=1&msg=$msg");
                return false;
            }
        }
        # code...
    }
    public function saveFunctionDish()
    {
        if (isset($_POST['submit_dish'])) {
            $id = $_POST['menu_id'];

            $rest_id=$_POST["rest_id"];

            $dish_en = $_POST['dish_en'];
            $dish_heb = $_POST['dish_heb'];
            $dish_fr = $_POST['dish_fr'];
            $price = $_POST["price"];





            $sql = "UPDATE menu_dish_tb SET dish_en='$dish_en', dish_heb='$dish_heb',dish_fr='$dish_fr', price='$price', updated=CURRENT_TIMESTAMP where id='$id'";
            $res = mysqli_query($this->link, $sql);


            if ($res) {
                $msg = "success_upd";
                header("location: menu.php?id=$rest_id&cat=2&msg=$msg");
                return true;
            } else {
                $msg = "fail_upd";
                header("location: menu.php?id=$rest_id&cat=2&msg=$msg");
                return false;
            }
        }


        # code...
    }
    public function saveFunctionDessert()
    {
        if (isset($_POST['submit_dessert'])) {
            $id = $_POST['menu_id'];

            $rest_id=$_POST["rest_id"];

            $dessert_en = $_POST['dessert_en'];
            $dessert_heb = $_POST['dessert_heb'];
            $dessert_fr = $_POST['dessert_fr'];
            $price = $_POST["price"];





            $sql = "UPDATE menu_dessert_tb SET dessert_en='$dessert_en', dessert_heb='$dessert_heb',dessert_fr='$dessert_fr', price='$price', updated=CURRENT_TIMESTAMP where id='$id'";
            $res = mysqli_query($this->link, $sql);


            if ($res) {
                $msg = "success_upd";
                header("location: menu.php?id=$rest_id&cat=3&msg=$msg");
                return true;
            } else {
                $msg = "fail_upd";
                header("location: menu.php?id=$rest_id&cat=3&msg=$msg");
                return false;
            }
        }



        # code...
    }
}
$obj = new Translation;

$objUpdateStarter = $obj->saveFunctionStarter();
$objUpdateDish = $obj->saveFunctionDish();
$objUpdateDessert = $obj->saveFunctionDessert();
