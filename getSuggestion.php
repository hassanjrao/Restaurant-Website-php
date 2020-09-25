<?php
include('class/database.php');
class getSuggestion extends database
{
    // TODO: I will do this later!
    //FIXME: Fix this!
    protected $link;
    public function suggestionFunction()
    {
        $data = $_GET['data'];
        $sql = "Select name from restaurant_tbl where name like '$data%' ";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            if ($res) {
                $row = mysqli_fetch_assoc($res);

                foreach ($row as $result) {
                    $data .=   $result;
                }

                echo $data;
                // return $data;
            } else {
                echo 'No data is found with this keyword';
            }
        }
        # code...
    }
}
$obj = new getSuggestion;
$objSuggest = $obj->suggestionFunction();