<div>
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <div class="container">
                <a class="navbar-brand font-weight-bold" style="font-family: 'Lato', sans-serif; color: #481639" href="index.php"><img src="images/logo.png" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">

                        <li class="ml-4 nav-item back_nav p-1">

                            <?php

                            if (isset($_SESSION["access_token"]) || isset($_SESSION["facebook_access_token"]) || isset($_SESSION["email"])) {


                            ?>

                                <a class="nav-link font-weight-bold" href="profile_heb.php"><i class="far fa-user mr-2"></i>אזור אישי</a>

                            <?php
                            } else {

                            ?>
                                <a class="nav-link font-weight-bold" href="signInUp_heb.php"><i class="far fa-user mr-2"></i>התחברות לאזור אישי</a>

                            <?php
                            }

                            ?>

                        </li>

                        <li class="ml-4 nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Language
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="index.php?lan=en">English</a>
                                <a class="dropdown-item" href="index.php?lan=heb">Hebrew</a>
                                <a class="dropdown-item" href="index.php?lan=fr">French</a>
                            </div>
                        </li>


                    </ul>

                </div>
            </div>
        </nav>

    </div>