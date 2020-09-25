<?php
include('class/database.php');
class DelRestaurant extends database
{
    protected $link;
    public function deleteRest()
    {
        $id=$_GET["id"];
        $sql = "DELETE from restaurant_tbl where id='$id'";
        $res = mysqli_query($this->link, $sql);
        if ($res) {
            $msg="success_del";
            header("location: all_restaurants.php?msg=$msg");
            return true;
        } else {
            $msg="fail_del";
            header("location: all_restaurants.php?msg=$msg");
            return false;
        }
    }
   
}
$obj = new DelRestaurant;
$obj->deleteRest();
