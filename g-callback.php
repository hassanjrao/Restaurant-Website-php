<?php



require_once "config.php";
session_start();
include('class/database.php');


if (isset($_SESSION["access_token"])) {
    $google_client->setAccessToken($_SESSION["access_token"]);
} elseif (isset($_GET["code"])) {
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
    $_SESSION["access_token"] = $token;
} else {
    header("location: signInUp.php");
    exit();
}

$oAuth = new Google_Service_Oauth2($google_client);

$userData = $oAuth->userinfo_v2_me->get();


$client_id = $userData["id"];
$fname = $userData["givenName"];
$lname = $userData["familyName"];
$email = $userData["email"];
$img = $userData["picture"];



$_SESSION["id"] = $client_id;
$_SESSION["email"] = $email;
$_SESSION["img"] = $img;



$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "woopyzz";



// Create connection
$conn = new mysqli($hostname, $username, $password,$dbname);

$sql = "select * from user_tbl where email = '$email'";
$res = mysqli_query($conn, $sql);
if (mysqli_num_rows($res) > 0) {
    $resl = mysqli_fetch_assoc($res);
    $_SESSION["email"] = $resl["email"];
    header("location: profile.php");
    exit();
} else {
    $sql2 = "INSERT INTO `user_tbl` (`id`, `client_id` ,`fname`, `lname`, `email`, `phone`, `password`, `created`) VALUES (NULL, $client_id ,'$fname', '$lname', '$email', NULL, NULL, CURRENT_TIMESTAMP)";
    $res2 = mysqli_query($conn, $sql2);
    if ($res2) {
        $sql3 = "INSERT INTO `user_info` (`id`, `email`, `phone`, `country`, `state`, `city`, `image`, `created`, `updated`) VALUES (NULL, '$email', NULL, NULL, NULL, NULL, '$img', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
        mysqli_query($conn, $sql3);
        header('location:profile.php');
    } else {
    }
}


header("location: profile.php");
