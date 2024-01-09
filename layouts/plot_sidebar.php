<?php
//Get plot_id from URL
$plot_id = isset($_GET['plot_id']) ? $_GET['plot_id'] : 1; // Default to 1 if plot_id is not provided
?>

<div class="sidebar" data-image="../assets/img/sidebar-5.jpg">
    <div class="sidebar-wrapper">
        <<div class="logo">
            <a href="dashboard.php" class="simple-text">
                Progressive Farmer
            </a>
        </div>

        <ul class="nav">
            <li class="nav-item active">
                <a class="nav-link sidebar-nav-link" href="plots.php">
                    <img src = "assets/img/icons/land-icon.svg" alt="Land Icon"/>
                    <p>Plots</p>
                </a>
            </li>

            <li class="nav-item active">
                <a class="nav-link sidebar-nav-link" href="sowing.php?plot_id=<?php echo $plot_id; ?>">
                    <img src = "assets/img/icons/sowing-icon.svg" alt="Sowing Icon"/>
                    <p>Sowing</p>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link sidebar-nav-link" href="spray.php?plot_id=<?php echo $plot_id; ?>">
                    <img src = "assets/img/icons/spray-icon.svg" alt="Spray Icon"/>
                    <p>Spray</p>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link sidebar-nav-link" href="fertilize.php?plot_id=<?php echo $plot_id; ?>">
                    <img src = "assets/img/icons/fertilize-icon.svg" alt="Fertilize Icon"/>
                    <p>Fertilize</p>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link sidebar-nav-link" href="irrigate.php?plot_id=<?php echo $plot_id; ?>">
                    <img src = "assets/img/icons/irrigate-icon.svg" alt="Irrigate Icon"/>
                    <p>Irrigate</p>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link sidebar-nav-link" href="expense.php?plot_id=<?php echo $plot_id; ?>">
                    <img src = "assets/img/icons/expense-icon.svg" alt="Expense Icon"/>
                    <p>Expense</p>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link sidebar-nav-link" href="labour.php?plot_id=<?php echo $plot_id; ?>">
                    <img src = "assets/img/icons/labour-icon.svg" alt="Labour Icon"/>
                    <p>Labour</p>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link sidebar-nav-link" href="harvest.php?plot_id=<?php echo $plot_id; ?>">
                    <img src = "assets/img/icons/harvest-icon.svg" alt="Harvest Icon"/>
                    <p>Harvest</p>
                </a>
            </li>
<!--            <li class="nav-item active">-->
<!--                <a class="nav-link sidebar-nav-link" href="add_new.php">-->
<!--                    <img src = "assets/img/icons/add-new-icon-white.svg" alt="Add New Icon"/>-->
<!--                    <p>Add New</p>-->
<!--                </a>-->
<!--            </li>-->

        </ul>
    </div>
</div>