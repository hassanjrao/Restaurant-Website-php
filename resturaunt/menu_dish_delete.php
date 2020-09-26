<?php
session_start();
if ($_SESSION['Rname']) {
} else {
    header('location:restaurant_login.php');
}
include('class/database.php');
class DelMenuItem extends database
{
    protected $link;
    public function deleteItem()
    {
        $id=$_GET["id"];
        $sql = "DELETE from menu_dish_tb where id='$id'";
        $res = mysqli_query($this->link, $sql);
        if ($res) {
            $msg="success_del";
            header("location: menu_dishes.php?msg=$msg");
            return true;
        } else {
            $msg="fail_del";
            header("location: menu_dishes.php?msg=$msg");
            return false;
        }
    }
   
}
$obj = new DelMenuItem;
$obj->deleteItem();
