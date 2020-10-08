<?php
session_start();
if (!isset($_SESSION['Rname'])) {
    header('location:restaurant_login.php');
}
include('class/database.php');
class TotalClients extends database
{
    protected $link;


    public function getTotalClients()
    {


        if (isset($_POST["month"])) {

            $month = $_POST["month"];

           

            $totalClients = 0;

            $name = $_SESSION['Rname'];
            $sql = "select * from reservation_tbl where rest_name='$name' and user_confirm='1'";
            $res = mysqli_query($this->link, $sql);
            if (mysqli_num_rows($res) > 0) {

                while ($row = mysqli_fetch_assoc($res)) {



                    $date_arr = explode("/", $row["date"]);

                    $m = $date_arr[0];

                    if (strval($month) == strval($m) && $row["confirm_people"] != NULL) {
                        $totalClients += intval($row["confirm_people"]);
                    }
                }

                echo $totalClients;
                return true;
            } else {
                echo $totalClients;
                return false;
            }
        }
    }
}


$obj = new TotalClients;

$obj->getTotalClients();
