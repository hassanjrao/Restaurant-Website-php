<?php
session_start();
if(!isset( $_SESSION['name'])){
    header("location: login.php");
}
include('class/database.php');
class DelSpecialty extends database
{
    protected $link;
    public function deleteSpecialty()
    {
        $id=$_GET["id"];
        $sql = "DELETE from specialty where id='$id'";
        $res = mysqli_query($this->link, $sql);
        if ($res) {
            $msg="success_del";
            header("location: specialty.php?msg=$msg");
            return true;
        } else {
            $msg="fail_del";
            header("location: specialty.php?msg=$msg");
            return false;
        }
        # code...
    }
   
}
$obj = new DelSpecialty;
$obj->deleteSpecialty();
