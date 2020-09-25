
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation</title>
    <?php include('layout/style.php'); ?>

</head>

<body class="bg-light">
    <?php include('layout/navbar.php'); ?>

    <?php include('layout/hero_section.php'); ?>

    <form action="" method="post">
        <section>
            <div class="container text-center bg-white pr-4 pl-4 log_section pb-5 reserve_section">
                <h4 class="text-center pt-5 font-weight-bold">Thanks for your reservation! <br><br> Your Reservation has been confirmed. </h4><br>
                <a href="index.php" class="btn btn-success text-light">Back to Homepage</a>
            </div>

        </section>
    </form>

    <?php include('layout/footer.php'); ?>


    <?php include('layout/script.php') ?>
</body>

</html>