<?php
session_start();
if (isset($_SESSION["access_token"])) {
    header("location: profile_fr.php");
    exit();
}
if (isset($_SESSION["facebook_access_token"])) {
    header("location: profile_fr.php");
    exit();
}
include('class/database.php');
//Include Configuration File
include('config.php');

$facebook = new \Facebook\Facebook([
    'app_id'      => '799817377458281',
    'app_secret'     => '6c1be575e7f535374078accab0e1be87',
    'default_graph_version'  => 'v2.0'
]);


$loginURL = $google_client->createAuthUrl();
$facebook_helper = $facebook->getRedirectLoginHelper();
$facebook_permissions = ['email']; // Optional permissions

$facebook_login_url = $facebook_helper->getLoginUrl('https://apollo.woopyzz.com/f-callback.php', $facebook_permissions);

class signInUp extends database
{
    protected $link;
    public function signUpFunction()
    {
        if (isset($_POST['signup'])) {
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $pass = $_POST['password'];

            $password = password_hash($pass, PASSWORD_DEFAULT);

            $sql = "select * from user_tbl where email = '$email'";
            $res = mysqli_query($this->link, $sql);
            if (mysqli_num_rows($res) > 0) {
                $msg = "Email taken";
                return $msg;
            } else {
                $sql2 = "INSERT INTO `user_tbl` (`id`, `fname`, `lname`, `email`, `phone`, `password`, `created`) VALUES (NULL, '$fname', '$lname', '$email', '$phone', '$password', CURRENT_TIMESTAMP)";
                $res2 = mysqli_query($this->link, $sql2);
                if ($res2) {
                    $img = "placeholder-16-9.jpg";
                    $sql3 = "INSERT INTO `user_info` (`id`, `email`, `phone`, `country`, `state`, `city`, `image`, `created`, `updated`) VALUES (NULL, '$email', '$phone', NULL, NULL, NULL, '$img', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
                    mysqli_query($this->link, $sql3);
                    $_SESSION['email'] = $email;
                    header('location:profile_fr.php');
                    $msg = "Added";
                    return $msg;
                } else {
                    $msg = "Not Added";
                    return $msg;
                }
            }
        }
        # code...
    }
    public function signInFunction()
    {
        if (isset($_POST['signIn'])) {
            $email = $_POST['emailLogIn'];
            $password = $_POST['passwordLogIn'];

            $sql = "select * from user_tbl where email = '$email' ";
            $res = mysqli_query($this->link, $sql);
            if (mysqli_num_rows($res) > 0) {
                $row = mysqli_fetch_assoc($res);
                $pass = $row['password'];
                if (password_verify($password, $pass) == true) {
                    $_SESSION['email'] = $email;
                    header('location:profile_fr.php');
                    return $res;
                } else {
                    $msg = "Wrong password";
                    return $msg;
                }
            } else {
                $msg = "Invalid Information";
                return $msg;
            }
        }
        # code...
    }
}
$obj = new signInUp;
$objSignUp = $obj->signUpFunction();
$objSignIn = $obj->signInFunction();








?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S’inscire</title>
    <?php include('layout/style.php'); ?>
    <style>
        body {
            font-family: 'Lato', sans-serif;

        }
    </style>

</head>

<body class="bg-light">
    <?php include('layout/navbar_fr.php'); ?>

   
    <section>
        <div class="container bg-white pr-4 pl-4 log_section pb-5">

            <div class="row">
                <div class="col-md-5">
                    <form action="" method="post" data-parsley-validate>

                        <div class="text-center">
                            <h5 class="font-weight-bold pt-5">Se connecter</h5>
                            <!-- <p class="pt-4 pb-4">Already Have An Account?</p> -->
                            <br><br>
                            <?php if ($objSignIn) { ?>
                                <?php if (strcmp($objSignIn, 'Wrong password') == 0) { ?>
                                    <div class="alert alert-danger alert-dismissible fade show">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>mauvais mot de passe!</strong>
                                    </div>
                                <?php } ?>
                                <?php if (strcmp($objSignIn, 'Invalid Information') == 0) { ?>
                                    <div class="alert alert-warning alert-dismissible fade show">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>Inscrivez vous s'il vous plait!</strong>
                                    </div>
                                <?php } ?>

                            <?php } ?>
                        </div>
                        <input type="email" name="emailLogIn" class="form-control p-4  border-0 bg-light" placeholder="Entrez votre adresse mail" required>
                        <input type="password" class="form-control mt-4 p-4 border-0 bg-light" name="passwordLogIn" placeholder="Entrez votre mot de passe" required>
                        <button type="submit" name="signIn" class="btn btn-block font-weight-bold log_btn btn-lg mt-4">SE CONNECTER</button>


                        <a href="<?php echo $facebook_login_url ?>" class="btn btn-block btn-primary font-weight-bold btn-lg mt-4">Se connecter avec Facebook</a>


                        <a href="<?php echo $loginURL ?>" class="btn btn-block btn-danger font-weight-bold btn-lg mt-4">Se connecter avec Google</a>


                    </form>
                </div>
                <div class="col-md-2 text-center">
                    <div class="vertical_line text-center mx-auto"></div>
                </div>
                <!-- <form action="" method="post"> -->
                <div class="col-md-5">
                    <form action="" method="post" data-parsley-validate>

                        <div class="text-center">
                            <h5 class="font-weight-bold pt-5">S’INSCRIRE</h5>
                            <!-- <p class="pt-4 pb-4">Don't have an Account?</p> -->
                            <?php if ($objSignUp) { ?>
                                <?php if (strcmp($objSignUp, 'Email taken') == 0) { ?>
                                    <div class="alert alert-warning alert-dismissible fade show">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>Cet email est déjà pris!</strong>
                                    </div>
                                <?php } ?>
                                <?php if (strcmp($objSignUp, 'Email taken') == 1) { ?>
                                    <div class="alert alert-warning alert-dismissible fade show">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>Information invalide!</strong>
                                    </div>
                                <?php } ?>
                                <?php if (strcmp($objSignUp, 'Added') == 0) { ?>
                                    <div class="alert alert-success alert-dismissible fade show">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>Félicitation!</strong> Le profil est créé!
                                    </div>
                                <?php } ?>

                            <?php } ?>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-4"><input name="fname" type="text" class="form-control p-4 border-0 bg-light" placeholder="Prénom" required></div>
                            <div class="col-md-6 mt-4"><input name="lname" type="text" class="form-control p-4 border-0 bg-light" placeholder="Nom" required></div>
                        </div>
                        <input type="email" name="email" class="form-control mt-4 p-4 border-0 bg-light" placeholder="Adresse mail" required>
                        <input type="text" name="phone" class="form-control mt-4 p-4 border-0 bg-light" placeholder="Numéro de téléphone" required>
                        <input type="password" name="password" id="passwordField" class="form-control mt-4 p-4 border-0 bg-light" placeholder="Mot de Passe" data-parsley-minlength="6" required>
                        <input data-parsley-equalto="#passwordField" type="password" class="form-control mt-4 p-4 border-0 bg-light" placeholder="Mot de Passe" required>
                        <button name="signup" type="submit" class="btn btn-block font-weight-bold log_btn btn-lg mt-4">S’INSCRIRE
                        </button>
                    </form>
                </div>
                <!-- </form> -->
            </div>

        </div>

    </section>

    <?php include('layout/footer_fr.php'); ?>


    <?php include('layout/script.php') ?>
</body>

</html>