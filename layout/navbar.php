<div>
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">

            <?php

            if (isset($_GET["permission"]) && $_GET["permission"] == "true") {


                $lat = $_GET["lat"];
                $lon = $_GET["lon"];
            ?>
                <a class="navbar-brand font-weight-bold" style="font-family: 'Lato', sans-serif; color: #481639" href="<?php echo "index.php?permission=true&lat=" . $lat . "&lon=" . $lon ?>"><img src="images/logo.png" alt=""></a>

            <?php
            } else {
            ?>
                <a class="navbar-brand font-weight-bold" style="font-family: 'Lato', sans-serif; color: #481639" href="index.php"><img src="images/logo.png" alt=""></a>

            <?php
            }
            ?>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">

                    <li class="ml-4 nav-item back_nav p-1">

                        <?php

                        if (isset($_SESSION["access_token"]) || isset($_SESSION["facebook_access_token"]) || isset($_SESSION["email"])) {


                        ?>

                            <a class="nav-link font-weight-bold" href="profile.php"><i class="far fa-user mr-2"></i>Profile</a>

                        <?php
                        } else {

                        ?>
                            <a class="nav-link font-weight-bold" href="signInUp.php"><i class="far fa-user mr-2"></i>Connection</a>

                        <?php
                        }

                        ?>

                    </li>

                    <li class="ml-4 nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Language
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                            <?php
                            if (isset($_GET["permission"]) && $_GET["permission"] == "true") {

                                $lat = $_GET["lat"];
                                $lon = $_GET["lon"];

                            ?>

                                <a class="dropdown-item" href="<?php echo "index.php?lan=en&permission=true&lat=$lat&lon=$lon" ?>">English</a>
                                <a class=" dropdown-item" href="<?php echo "index.php?lan=heb&permission=true&lat=$lat&lon=$lon" ?>">Hebrew</a>
                                <a class=" dropdown-item" href="<?php echo "index.php?lan=fr&permission=true&lat=$lat&lon=$lon" ?>">French</a>

                            <?php
                            } else {
                            ?>

                                <a class=" dropdown-item" href="index.php?lan=en">English</a>
                                <a class="dropdown-item" href="index.php?lan=heb">Hebrew</a>
                                <a class="dropdown-item" href="index.php?lan=fr">French</a>

                            <?php
                            }
                            ?>
                        </div>
                    </li>


                </ul>

            </div>
        </div>
    </nav>
</div>