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
                            <h3 style="color: #9DCD5A;">Irrigate</h3>
                        </div>
                    </div>

                    <div class="row">

                        <div class="card-container col-lg-4 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <!-- 1st Column (90% of card) -->
                                        <div class="col-lg-9 info-card-content">
                                            <h6 class="date">January 05, 2024</h6>
                                            <p><strong>Source:</strong> Peter</p>
                                        </div>
                                        <!-- 2nd Column (Edit Icon) -->
                                        <div class="col-lg-3 text-center edit-icon">
                                            <a href="#">
                                                <img src="assets/img/icons/edit-pencil-icon.svg" alt="Edit Icon" class="edit-icon-img">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-container col-lg-4 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <!-- 1st Column (90% of card) -->
                                        <div class="col-lg-9 info-card-content">
                                            <h6 class="date">January 20, 2024</h6>
                                            <p><strong>Source:</strong> Wapda</p>
                                        </div>
                                        <!-- 2nd Column (Edit Icon) -->
                                        <div class="col-lg-3 text-center edit-icon">
                                            <a href="#">
                                                <img src="assets/img/icons/edit-pencil-icon.svg" alt="Edit Icon" class="edit-icon-img">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Button Container -->
                    <div class="row">
                        <div class="col-12 text-center mt-4">
                            <button class="new-record-button" type="button">
                                <img src="assets/img/icons/plus-icon.svg" alt="Plus Icon" class="new-record-button-icon">
                                <span class="new-record-button-text">New Record</span>
                            </button>
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