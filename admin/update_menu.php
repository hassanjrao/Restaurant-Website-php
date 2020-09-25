<?php
include('class/database.php');
class Translation extends database
{
    protected $link;
    

    public function saveFunctionEnglish()
    {
        if (isset($_POST['submit_en'])) {
            $id = $_POST['menu_id'];

            $starter = $_POST['starter_name'];
            $dish = $_POST['dish_name'];
            $dessert = $_POST['dessert_name'];

           
            $sql = "UPDATE menu_tb SET starter_name_en='$starter', dish_name_en='$dish', dessert_name_en='$dessert' where id='$id'";
            
            $res = mysqli_query($this->link, $sql);

            header("location: translation.php?id=$id");
        }
        # code...
    }
    public function saveFunctionHeb()
    {
        if (isset($_POST['submit_heb'])) {
            $id = $_POST['menu_id'];

            $starter = $_POST['starter_name'];
            $dish = $_POST['dish_name'];
            $dessert = $_POST['dessert_name'];


            $sql = "UPDATE menu_tb SET starter_name_heb='$starter', dish_name_heb='$dish', dessert_name_heb='$dessert' where id='$id'";
            $res = mysqli_query($this->link, $sql);

            header("location: translation.php?id=$id");
        }
        # code...
    }
    public function saveFunctionFrench()
    {
        if (isset($_POST['submit_fr'])) {
            $id = $_POST['menu_id'];

            $starter = $_POST['starter_name'];
            $dish = $_POST['dish_name'];
            $dessert = $_POST['dessert_name'];

            $sql = "UPDATE menu_tb SET starter_name_fr='$starter', dish_name_fr='$dish', dessert_name_fr='$dessert' where id='$id'";
            $res = mysqli_query($this->link, $sql);

            header("location: translation.php?id=$id");
        }
        # code...
    }
}
$obj = new Translation;

$objCreateEng = $obj->saveFunctionEnglish();
$objCreateHeb = $obj->saveFunctionHeb();
$objCreateFrench = $obj->saveFunctionFrench();
