<?php
include('class/database.php');
class Pract extends database
{
    protected $link;
    public function getNearestCities()
    {
       
        $lat = "3.107685";
        $long = "101.7624521";

        $sql = "SELECT * , (3956 * 2 * ASIN(SQRT( POWER(SIN(( $lat - lat) *  pi()/180 / 2), 2) +COS( $lat * pi()/180) * COS(lat * pi()/180) * POWER(SIN(( $long - Lan) * pi()/180 / 2), 2) ))) as distance  
        from cities_tb 
        having  distance <= 10 
        order by distance";
        $res = mysqli_query($this->link, $sql);
        


        while ($row = mysqli_fetch_assoc($res)) {
            echo $row['city_en']."<br>";
        }
    }
}

$obj=new Pract;

