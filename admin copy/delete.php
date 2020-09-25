<?php
include('class/database.php');
class confirm extends database
{
    protected $link;
    public function confirmFunction()
    {
        $id = $_GET['id'];
        $sql = "UPDATE `reservation_tbl` set `rest_confirm` = 2 where id = $id ";
        $res = mysqli_query($this->link, $sql);
        if ($res) {
            header('location:reservation.php');
            return $res;
        } else {
            return false;
        }
        # code...
    }
}
$obj = new confirm;
$objConfirm = $obj->confirmFunction();