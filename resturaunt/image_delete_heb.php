<?php
session_start();
if (!isset($_SESSION['Rname'])) {
    header('location:restaurant_login.php');
}
include('class/database.php');
class DelImage extends database
{
    protected $link;
    public function deleteItem()
    {
        $id=$_GET["id"];
        $sql = "DELETE from rest_images where id='$id'";
        $res = mysqli_query($this->link, $sql);
        if ($res) {
            $msg="success_del";
            header("location: images_heb.php?msg=$msg");
            return true;
        } else {
            $msg="fail_del";
            header("location: images_heb.php?msg=$msg");
            return false;
        }
    }
   
}
$obj = new DelImage;
$obj->deleteItem();
