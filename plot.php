<!doctype html>
<html lang="en">
<?php include 'layouts/header.php'  ?>
<body>
<div class="wrapper">


    <?php include 'layouts/plot_sidebar.php' ?>
    <div class="main-panel">

        <?php include 'layouts/menu.php' ?>
        <!-- End Navbar -->
        <div class="content">
            <div class="dashboard-area">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12 text-center">
                            <h3 style="color: #9DCD5A;">Plot#1, Gondlanwala</h3>
                        </div>
                    </div>

                    <div class="row">

                        <div class="card-container col-lg-3 col-md-6">
                            <a href="cultivation_plan.php" class="card-link">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <img src = "assets/img/icons/cultivation-plan-icon.svg" alt="Cultivation Plan Icon"/>
                                        <h5 class="card-title" style="color: #D66708">Cultivation Plan</h5>
                                    </div>
                                </div>
                            </a>
                        </div>


                        <div class="card-container col-lg-3 col-md-6">
                            <a href="spray.php" class="card-link">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <img src = "assets/img/icons/spray-icon.svg" alt="Spray Icon"/>
                                        <h5 class="card-title" style="color: #E48F60">Spray</h5>
                                    </div>
                                </div>
                            </a>
                        </div>


                        <div class="card-container col-lg-3 col-md-6">
                            <a href="fertilize.php" class="card-link">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <img src = "assets/img/icons/fertilize-icon.svg" alt="Fertilize Icon"/>
                                        <h5 class="card-title" style="color: #7D8CC4">Fertilize</h5>
                                    </div>
                                </div>
                            </a>
                        </div>


                        <div class="card-container col-lg-3 col-md-6">
                            <a href="irrigate.php" class="card-link">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <img src = "assets/img/icons/irrigate-icon.svg" alt="Irrigate Icon"/>
                                        <h5 class="card-title" style="color: #5166B4">Irrigate</h5>
                                    </div>
                                </div>
                            </a>
                        </div>


                        <div class="card-container col-lg-3 col-md-6">
                            <a href="expense.php" class="card-link">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <img src = "assets/img/icons/expense-icon.svg" alt="Expense Icon"/>
                                        <h5 class="card-title" style="color: #F15555">Expense</h5>
                                    </div>
                                </div>
                            </a>
                        </div>


                        <div class="card-container col-lg-3 col-md-6">
                            <a href="labour.php" class="card-link">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <img src = "assets/img/icons/labour-icon.svg" alt="Labour Icon"/>
                                        <h5 class="card-title" style="color: #A955E8">Labour</h5>
                                    </div>
                                </div>
                            </a>
                        </div>


                        <div class="card-container col-lg-3 col-md-6">
                            <a href="harvest.php" class="card-link">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <img src = "assets/img/icons/harvest-icon.svg" alt="Harvest Icon"/>
                                        <h5 class="card-title" style="color: #22B2BB">Harvest</h5>
                                    </div>
                                </div>
                            </a>
                        </div>


                        <!-- Add New Card -->
                        <div class="card-container col-lg-3 col-md-6">
                            <a href="add_new.php" class="card-link">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <img src = "assets/img/icons/add-new-icon.png" alt="Add New Icon"/>
                                        <h5 class="card-title" style="color: #9DCD5A">Add New</h5>
                                    </div>
                                </div>
                            </a>
                        </div>



                    </div>
                </div>
            </div>
        </div>

        <?php include 'layouts/Footer.php' ?>

    </div>

</div>

</body>
</html>