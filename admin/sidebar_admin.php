<?php
class sidebar extends database
{
    protected $link;
    public function getRestaurants()
    {
        $sqlRest = "select * from restaurant_tbl ORDER BY id DESC";
        $resRest = mysqli_query($this->link, $sqlRest);
        if (mysqli_num_rows($resRest) > 0) {
            return $resRest;
        } else {
            return false;
        }
        # code...
    }
}
$obj = new sidebar;
$objRestS = $obj->getRestaurants();
$objRestS2 = $obj->getRestaurants();

?>
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="restaurant_profile.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin Panel</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="all_restaurants.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Restaurant</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="specialty.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Filter</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="all_cities.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>City</span></a>
    </li>


    <li class="nav-item">
        <a class="nav-link" href="all_clients.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Clients</span></a>
    </li>




    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Menu</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Select Resturaunt:</h6>

                <?php if ($objRestS) { ?>
                    <?php while ($row = mysqli_fetch_assoc($objRestS)) { ?>


                        <a class="collapse-item" href="menu.php?id=<?php echo $row['id']; ?>"><?php echo $row['name_en']; ?></a>

                    <?php } ?>
                <?php } ?>


            </div>
        </div>
    </li>


    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilitie" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Reservation</span>
        </a>
        <div id="collapseUtilitie" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Select Resturaunt:</h6>




                <?php if ($objRestS2) { ?>
                    <?php while ($row = mysqli_fetch_assoc($objRestS2)) { ?>


                        <a class="collapse-item" href="reservation.php?name=<?php echo $row['name_en']; ?>"><?php echo $row['name_en']; ?></a>

                    <?php } ?>
                <?php } ?>


            </div>
        </div>
    </li>


    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pages" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Pages</span>
        </a>
        <div id="pages" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Select Page:</h6>


                <a class="collapse-item" href="aboutus.php">About us</a>
                <a class="collapse-item" href="termsofuse.php">Terms of use</a>


            </div>
        </div>
    </li>


    <li class="nav-item">
        <a class="nav-link" href="logout.php">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Logout</span></a>
    </li>




    <!-- Nav Item - Tables -->


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->