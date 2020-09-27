<?php
session_start();
if(!isset( $_SESSION['name'])){
    header("location: login.php");
}
include('class/database.php');
class DelCity extends database
{
    protected $link;
    public function deleteCity()
    {
        $id=$_GET["id"];
        $sql = "DELETE from cities_tb where id='$id'";
        $res = mysqli_query($this->link, $sql);
        if ($res) {
            $msg="success_del";
            header("location: all_cities.php?msg=$msg");
            return true;
        } else {
            $msg="fail_del";
            header("location: all_cities.php?msg=$msg");
            return false;
        }
    }
   
}
$obj = new DelCity;
$obj->deleteCity();
