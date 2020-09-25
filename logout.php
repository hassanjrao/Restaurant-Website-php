<?php
// require_once("config.php");
// session_start();
// unset($_SESSION["access_token"]);
// $google_client->revokeToken();
// session_destroy();
// header('location:signInUp.php');

include('config.php');

session_start();
//Reset OAuth access token
// $google_client->revokeToken();

//Destroy entire session data.
session_destroy();

//redirect page to index.php
header('location:index.php');
exit();