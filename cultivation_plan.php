<!doctype html>
<html lang="en">
<?php include '../progressive_farmer/layouts/header.php'  ?>
<body>
<div class="wrapper">


    <?php include '../progressive_farmer/layouts/plot_sidebar.php' ?>
    <div class="main-panel">

        <?php include '../progressive_farmer/layouts/menu.php';
        //Get plot_id from URL
        $plot_id = isset($_GET['plot_id']) ? $_GET['plot_id'] : 1; // Default to 1 if plot_id is not provided
        ?>
        <!-- End Navbar -->
        <div class="content">
            <div class="dashboard-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h3 style="color: #9DCD5A; font-weight: bold">Cultivation Plan for Plot#<?php echo $plot_id; ?></h3>
                        </div>
                    </div>

                    <div class="row">
                        <div class="card-container col-lg-3 col-md-6">
                            <a href="sowing.php?plot_id=<?php echo $plot_id; ?>" class="card-link">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <img src = "assets/img/icons/sowing-icon.svg" alt="Sowing Icon"/>
                                        <h5 class="card-title" style="color: #D66708">Sowing</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="card-container col-lg-3 col-md-6">
                            <a href="spray.php?plot_id=<?php echo $plot_id; ?>" class="card-link">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <img src = "assets/img/icons/spray-icon.svg" alt="Spray Icon"/>
                                        <h5 class="card-title" style="color: #E48F60">Spray</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="card-container col-lg-3 col-md-6">
                            <a href="fertilize.php?plot_id=<?php echo $plot_id; ?>" class="card-link">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <img src = "assets/img/icons/fertilize-icon.svg" alt="Fertilize Icon"/>
                                        <h5 class="card-title" style="color: #7D8CC4">Fertilize</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="card-container col-lg-3 col-md-6">
                            <a href="irrigate.php?plot_id=<?php echo $plot_id; ?>" class="card-link">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <img src = "assets/img/icons/irrigate-icon.svg" alt="Irrigate Icon"/>
                                        <h5 class="card-title" style="color: #5166B4">Irrigate</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="card-container col-lg-3 col-md-6">
                            <a href="expense.php?plot_id=<?php echo $plot_id; ?>" class="card-link">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <img src = "assets/img/icons/expense-icon.svg" alt="Expense Icon"/>
                                        <h5 class="card-title" style="color: #F15555">Expense</h5>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="card-container col-lg-3 col-md-6">
                            <a href="labour.php?plot_id=<?php echo $plot_id; ?>" class="card-link">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <img src = "assets/img/icons/labour-icon.svg" alt="Labour Icon"/>
                                        <h5 class="card-title" style="color: #A955E8">Labour</h5>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="card-container col-lg-3 col-md-6">
                            <a href="harvest.php?plot_id=<?php echo $plot_id; ?>" class="card-link">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <img src = "assets/img/icons/harvest-icon.svg" alt="Harvest Icon"/>
                                        <h5 class="card-title" style="color: #22B2BB">Harvest</h5>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Add New Card -->
                        <!--                            <div class="card-container col-lg-3 col-md-6">-->
                        <!--                                <a href="add_new.php" class="card-link">-->
                        <!--                                    <div class="card">-->
                        <!--                                        <div class="card-body text-center">-->
                        <!--                                            <img src = "assets/img/icons/add-new-icon.png" alt="Add New Icon"/>-->
                        <!--                                            <h5 class="card-title" style="color: #9DCD5A">Add New</h5>-->
                        <!--                                        </div>-->
                        <!--                                    </div>-->
                        <!--                                </a>-->
                        <!--                            </div>-->

                    </div>
                </div>
            </div>
        </div>

        <?php include '../progressive_farmer/layouts/Footer.php' ?>

    </div>

</div>

</body>
</html>