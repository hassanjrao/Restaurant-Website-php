<?php

class database
{
    private $hostname = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "woopyzz";

    protected $link;

    public function __construct()
    {
        $this->connection();
        # code...
    }

    public function connection()
    {

        $this->link = mysqli_connect($this->hostname, $this->username, $this->password, $this->dbname);

        if ($this->link) {
            // echo "connected";
        } else {
            echo "not connected";
        }

        # code...
    }
}

$obj = new database;