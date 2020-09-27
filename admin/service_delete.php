<?php
session_start();
if(!isset( $_SESSION['name'])){
    header("location: login.php");
}
include('class/database.php');
class DelService extends database
{
    protected $link;
    public function deleteService()
    {
        $id=$_GET["id"];
        $sql = "DELETE from services_tb where id='$id'";
        $res = mysqli_query($this->link, $sql);
        if ($res) {
            $msg="success_del";
            header("location: services.php?msg=$msg");
            return true;
        } else {
            $msg="fail_del";
            header("location: services.php?msg=$msg");
            return false;
        }
    }
   
}
$obj = new DelService;
$obj->deleteService();
