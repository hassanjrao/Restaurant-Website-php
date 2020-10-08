<div class="sign_up">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <?php
                if ($objImage==true && $objGetRest==true) {

                    $rowImage = mysqli_fetch_assoc($objImage);

                    $restImage = $rowImage["image"];

                    $rowRestInfo = mysqli_fetch_assoc($objGetRest);

                    $restName = $rowRestInfo["name_fr"];
                    $restAdd = $rowRestInfo["address_fr"];
                ?>

                    <img src="./resturaunt/rest_img/<?php echo $restImage ?>" class="w-25 text-center" alt="">

                    <p class="text-light font-weight-bold m-0"><?php echo $restName ?></p>
                    <small class="text-light"><i class="fas fa-map-marker-alt mr-2"></i><?php echo $restAdd ?></small>
                <?php
                } else {
                ?>
                   <img src="images/k2htrr9z4vsxkjbthskk.png" class="w-25 text-center" alt="">
                    <?php if (isset($_SESSION['rname'])) { ?>
                        <p class="text-light font-weight-bold m-0"><?php echo $_SESSION['rname']; ?></p>
                        <small class="text-light"><i class="fas fa-map-marker-alt mr-2"></i><?php echo $_SESSION['address']; ?></small>
                <?php }
                } ?>
                <!-- <img src="images/Attachment_1597994185.png" class="w-50" alt=""> -->
            </div>
            <!-- <div class="col-md-6 col-12">
                <button class="btn btn-lg fav_btn font-weight-bold"><i class="fas fa-heart mr-2 heart"></i>Add to
                    Favorities</button>
            </div> -->
        </div>
    </div>
</div>