<!doctype html>
<html lang="en">
<?php include '../progressive_farmer/layouts/header.php'  ?>
<body>
<div class="wrapper">


    <?php include '../progressive_farmer/layouts/main_sidebar.php' ?>
    <div class="main-panel">

        <?php include '../progressive_farmer/layouts/menu.php' ?>
        <!-- End Navbar -->
        <div class="content">
            <div class="dashboard-area">
                <div class="container-fluid">
                    <div class="row">

                        <!-- Visit Dairy Website -->
                        <div class="card-container col-lg-3 col-md-6">
                            <a href="https://alrizadairies.com/" class="card-link" target="_blank">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <img src = "assets/img/icons/dairy-icon.svg" alt="Dairy Icon"/>
                                        <h5 class="card-title" style="color: #D66708">Visit Dairy</h5>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Plots Card -->
                        <div class="card-container col-lg-3 col-md-6">
                            <a href="plots.php" class="card-link">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <img src = "assets/img/icons/land-icon.svg" alt="Land Icon"/>
                                        <h5 class="card-title" style="color: #22B2BB">Plots</h5>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Ledger Card -->
                        <div class="card-container col-lg-3 col-md-6">
                            <a href="ledger.php" class="card-link">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <img src = "assets/img/icons/ledger-icon.svg" alt="Ledger Icon"/>
                                        <h5 class="card-title" style="color: #7D8CC4">Ledger</h5>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Inventory Card -->
                        <div class="card-container col-lg-3 col-md-6">
                            <a href="inventory.php" class="card-link">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <img src = "assets/img/icons/inventory-icon.svg" alt="Inventory Icon"/>
                                        <h5 class="card-title" style="color: #5166B4">Inventory</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include '../progressive_farmer/layouts/Footer.php' ?>
    </div>
</div>


</body>
</html>