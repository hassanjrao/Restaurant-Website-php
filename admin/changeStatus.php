<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("location: login.php");
}
include('class/database.php');
class ChangeStatus extends database
{
    protected $link;
   

    public function updateFunction2()
    {
        if (isset($_POST['status'])) {
           
            $month=$_POST["id"];
            $status = $_POST['status'];
            $name = $_POST["name"];
            $payment = $name . '_payment';

            $sql = "UPDATE $payment SET  `status` = '$status' where `id` = '$month'  ";
            $res = mysqli_query($this->link, $sql);


            if ($res) {
               echo "$res";
                return true;
            } else {
                echo "fail";
                return false;
            }
        }
        # code...
    }
}
$obj = new ChangeStatus;
$objUpdate = $obj->updateFunction2();

?>