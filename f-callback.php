<?php


require_once 'vendor/autoload.php';
session_start();
$fb = new \Facebook\Facebook([
    'app_id'      => '799817377458281',
    'app_secret'     => '6c1be575e7f535374078accab0e1be87',
    'default_graph_version'  => 'v2.0'
]);

session_start();
$helper = $fb->getRedirectLoginHelper();
$permissions = ['email']; // optional
try {
    if (isset($_SESSION['facebook_access_token'])) {
        $accessToken = $_SESSION['facebook_access_token'];
    } else {
        $accessToken = $helper->getAccessToken();
    }
} catch (Facebook\Exceptions\facebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch (Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}
if (isset($accessToken)) {
    if (isset($_SESSION['facebook_access_token'])) {
        $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    } else {
        // getting short-lived access token
        $_SESSION['facebook_access_token'] = (string) $accessToken;
        // OAuth 2.0 client handler
        $oAuth2Client = $fb->getOAuth2Client();
        // Exchanges a short-lived access token for a long-lived one
        $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
        $_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
        // setting default access token to be used in script
        $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    }
    // redirect the user to the profile page if it has "code" GET variable

    // getting basic info about user
    try {
        $profile_request = $fb->get('/me?fields=name,first_name,last_name,email');
        $requestPicture = $fb->get('/me/picture?redirect=false&height=200'); //getting user picture
        $picture = $requestPicture->getGraphUser();
        $profile = $profile_request->getGraphUser();
        $client_id = $profile->getProperty('id');           // To Get Facebook ID
        $fname = $profile->getProperty('first_name');
        $lname = $profile->getProperty('last_name');
        $fbfullname = $profile->getProperty('name');   // To Get Facebook full name
        $email = $profile->getProperty('email');    //  To Get Facebook email
        $img = $picture['url'];
        # save the user nformation in session variable
        $_SESSION['fb_id'] = $fbid;
        $_SESSION['email'] = $email;
        $_SESSION['img'] = $img;



        // Create connection

        $hostname = "localhost";
        $username = "apollo";
        $password = "B9q6q*8r";
        $dbname = "woopyzz";

        $conn = new mysqli($hostname, $username, $password, $dbname);

        $sql = "select * from user_tbl where email = '$email'";
        $res = mysqli_query($conn, $sql);
        if (mysqli_num_rows($res) > 0) {
            $resl = mysqli_fetch_assoc($res);
            $_SESSION["email"] = $resl["email"];
            if (isset($_GET['code'])) {

                if (isset($_SESSION["lan"])) {

                    if ($_SESSION["lan"] == "en") {
                        header('Location: profile.php');
                        exit();
                    } else if ($_SESSION["lan"] == "heb") {
                        header('Location: profile_heb.php');
                        exit();
                    } else if ($_SESSION["lan"] == "fr") {
                        header('Location: profile_fr.php');
                        exit();
                    }
                } else {
                    header('Location: profile.php');
                    exit();
                }
            }
        } else {
            $sql2 = "INSERT INTO `user_tbl` (`id`, `client_id` ,`fname`, `lname`, `email`, `phone`, `password`, `created`) VALUES (NULL, $client_id ,'$fname', '$lname', '$email', NULL, NULL, CURRENT_TIMESTAMP)";
            $res2 = mysqli_query($conn, $sql2);
            if ($res2) {
                $sql3 = "INSERT INTO `user_info` (`id`, `email`, `phone`, `country`, `state`, `city`, `image`, `created`, `updated`) VALUES (NULL, '$email', NULL, NULL, NULL, NULL, '$img', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
                mysqli_query($conn, $sql3);
                if (isset($_GET['code'])) {

                    if (isset($_SESSION["lan"])) {
                        if ($_SESSION["lan"] == "en") {
                            header('Location: profile.php');
                            exit();
                        } else if ($_SESSION["lan"] == "heb") {
                            header('Location: profile_heb.php');
                            exit();
                        } else if ($_SESSION["lan"] == "fr") {
                            header('Location: profile_fr.php');
                            exit();
                        }
                    } else {
                        header('Location: profile.php');
                        exit();
                    }
                }
            } else {
            }
        }
    } catch (Facebook\Exceptions\FacebookResponseException $e) {
        // When Graph returns an error
        echo 'Graph returned an error: ' . $e->getMessage();
        session_destroy();
        // redirecting user back to app login page
        if (isset($_SESSION["lan"])) {

            if ($_SESSION["lan"] == "en") {
                header("Location: signInUp.php");
                exit();
            } else if ($_SESSION["lan"] == "heb") {
                header("Location: signInUp_heb.php");
                exit();
            } else if ($_SESSION["lan"] == "fr") {
                header("Location: signInUp_fr.php");
                exit();
            }
        }
        else{
            header("Location: signInUp.php");
            exit();
        }
       
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
        // When validation fails or other local issues
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }
}
