<?php
session_start();
if (!isset($_SESSION['Rname'])) {
    header('location:restaurant_login.php');
}
include('class/database.php');
class DelNote extends database
{
    protected $link;
    public function deleteNote()
    {
        $id=$_GET["id"];
        $sql = "DELETE from notes_tb where id='$id'";
        $res = mysqli_query($this->link, $sql);
        if ($res) {
            $msg="success_del";
            header("location: notes_heb.php?msg=$msg");
            return true;
        } else {
            $msg="fail_del";
            header("location: notes_heb.php?msg=$msg");
            return false;
        }
    }
   
}
$obj = new DelNote;
$obj->deleteNote();
