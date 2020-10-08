<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("location: login.php");
}

include('class/database.php');
class RestaurantUpd extends database
{
    protected $link;

    public function updateRest()
    {

        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            // $name = $_POST['name'];

            $name = addslashes(str_replace(" ", "_", ($_POST['name'])));

            $name_en = addslashes(str_replace(" ", "_", ($_POST['name_en'])));
            $name_heb = addslashes(str_replace(" ", "_", $_POST['name_heb']));
            $name_fr = addslashes(str_replace(" ", "_", $_POST['name_fr']));

            $address_en = addslashes($_POST['address_en']);
            $address_heb = addslashes($_POST['address_heb']);
            $address_fr = addslashes($_POST['address_fr']);


            $email = addslashes($_POST['email']);
            $password = addslashes($_POST['password']);
            $phone = $_POST['phone'];

            $lat = $_POST["lat"];
            $lon = $_POST["lon"];

            $cities = serialize($_POST["cities"]);

            $pass = password_hash($password, PASSWORD_DEFAULT);

            if ($name !== $name_en) {

                $sqlFind = "select * from restaurant_tbl where name_en = '$name_en' ";
                $resFind = mysqli_query($this->link, $sqlFind);
                if (mysqli_num_rows($resFind) > 0) {
                    $msg = "taken";
                   echo $msg;

                   echo "$name-$name_en";
                    return false;
                } else {
                    $sql = "UPDATE restaurant_tbl SET name_en='$name_en', name_heb='$name_heb', name_fr='$name_fr', phone='$phone', address_en='$address_en', address_heb='$address_heb', address_fr='$address_fr', lat='$lat',lon='$lon' ,cities='$cities' ,email='$email', password='$pass', updated=CURRENT_TIMESTAMP where id='$id'";
                    $res = mysqli_query($this->link, $sql);

                    if ($res) {
                        $msg = "success";
                        // header("location: all_restaurants.php?msg=success");
                        echo $msg;
                        return true;
                    }
                }
            } else {

                $sql = "UPDATE restaurant_tbl SET name_en='$name_en', name_heb='$name_heb', name_fr='$name_fr', phone='$phone', address_en='$address_en', address_heb='$address_heb', address_fr='$address_fr', lat='$lat',lon='$lon' ,cities='$cities', email='$email', password='$pass', updated=CURRENT_TIMESTAMP where id='$id'";
                $res = mysqli_query($this->link, $sql);

                if ($res) {
                    $msg = "success";
                    echo $msg;
                    // header("location: all_restaurants.php?msg=success");
                    return true;
                }
            }
        }
    }
}
$obj = new RestaurantUpd;

$objRestUpdate = $obj->updateRest();
