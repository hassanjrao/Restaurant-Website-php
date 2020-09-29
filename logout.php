<?php

session_start();

if ($_SESSION["lan"] == "heb") {

    include('config.php');

    

    session_destroy();

    //redirect page to index.php
    header('location:index_heb.php');
    exit();
} else if ($_SESSION["lan"] == "fr") {

    include('config.php');

    

    session_destroy();

    //redirect page to index.php
    header('location:index_fr.php');
    exit();
}
else if ($_SESSION["lan"] == "en") {

    include('config.php');

    

    session_destroy();

    //redirect page to index.php
    header('location:index.php');
    exit();
}
else {

    include('config.php');

    

    session_destroy();

    //redirect page to index.php
    header('location:index.php');
    exit();
}
