<!doctype html>
<html lang="en">
<?php include 'layouts/header.php'  ?>
<body>

<!-- Modal Container -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h3 class="modal-title">Add New Entry</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Form -->
                <form id="newRecordForm" method="post">
                    <div class="form-group">
                        <label for="taskType">Task Type:</label>
                        <select class="form-control" id="taskType" name="taskType" required>
                            <option value="">--Select--</option>
                            <option value="Sowing">Sowing</option>
                            <option value="Spray">Spray</option>
                            <option value="Fertilize">Fertilize</option>
                            <option value="Irrigate">Irrigate</option>
                            <option value="Expense">Expense</option>
                            <option value="Labour">Labour</option>
                            <option value="Harvest">Harvest</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date">Date:</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                    <div class="form-group">
                        <label for="crop">Crop:</label>
                        <input type="text" class="form-control" id="crop" name="crop" required>
                    </div>
                    <div class="form-group">
                        <label for="estExpense">Est. Expense (Rs.):</label>
                        <input type="number" class="form-control" id="estExpense" name="estExpense" required>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="saveRecord()">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Container -->

<div class="wrapper">
    <?php include 'layouts/plot_sidebar.php' ?>
    <div class="main-panel">
        <?php include 'layouts/menu.php' ?>
        <!-- End Navbar -->
        <div class="content">
            <div class="dashboard-area">
                <div class="container-fluid">
                    <!-- Page Title -->
                    <div class="row">
                        <div class="col-12 text-center">
                            <h3 style="color: #9DCD5A;">Cultivation Plan</h3>
                        </div>
                    </div>
                    <!-- Cards Container -->
                    <div class="row">
                        <?php
                        include 'db_conn.php';
                        // Retrieve data from the database
                        $sql = "SELECT * FROM cultivation_plan";
                        $result = mysqli_query($conn, $sql);
                        ?>
                        <!-- Cards Container -->
                        <div class="row">
                            <?php while ($card = mysqli_fetch_assoc($result)) : ?>
                                <div class="card-container col-lg-4 col-md-6 col-sm-12">
                                    <div class="card">
                                        <div class="card-body task-card-body">
                                            <div class="row">
                                                <div class="col-lg-9 col-md-9 col-sm-9 info-card-content">
                                                    <?php
                                                    // Define custom colors based on taskType
                                                    $customColors = array(
                                                        'Sowing' => '#D66708',
                                                        'Spray' => '#E48F60',
                                                        'Fertilize' => '#7D8CC4',
                                                        'Irrigate' => '#5166B4',
                                                        'Expense' => '#F15555',
                                                        'Labour' => '#A955E8',
                                                        'Harvest' => '#22B2BB',
                                                        // Add more custom colors as needed
                                                    );
                                                    // Get taskType from the database
                                                    $taskType = $card['taskType'];
                                                    // Set default color if taskType is not in customColors
                                                    $color = isset($customColors[$taskType]) ? $customColors[$taskType] : '#000000';
                                                    $borderColor = $color;

                                                    echo '<p class="plan-task-tag" style="color: ' . $color . '; border: 2px solid ' . $borderColor . ';">' . $taskType . '</p>';
                                                    ?>
                                                    <h6 class="date"><?php echo $card['date']; ?></h6>
                                                    <p><strong>Crop:</strong> <?php echo $card['crop']; ?></p>
                                                    <p><strong>Est. Expense:</strong> Rs. <?php echo intval($card['estExpense']); ?></p>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-3 text-center edit-icon">
                                                    <a href="#">
                                                        <img src="assets/img/icons/edit-pencil-icon.svg" alt="Edit Icon" class="edit-icon-img">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>

                    <!-- Add New Record Button Container -->
                    <div class="row">
                        <div class="col-12 text-center mt-4">
                            <button class="new-record-button" type="button" data-toggle="modal" data-target="#myModal">
                                <img src="assets/img/icons/plus-icon.svg" alt="Plus Icon" class="new-record-button-icon">
                                <span class="new-record-button-text">New Record</span>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

<!--    Close the database connection -->
        <?php
        mysqli_close($conn);
        ?>

<!--    Footer-->
        <?php include 'layouts/Footer.php' ?>

    </div>
</div>

<script>
    // Save Record Function
    function saveRecord() {
        // Validate the form
        if (validateForm()) {
            // Get form values
            var taskType = document.getElementById('taskType').value;
            var date = document.getElementById('date').value;
            var crop = document.getElementById('crop').value;
            var estExpense = document.getElementById('estExpense').value;

            // Create FormData object
            var formData = new FormData();
            formData.append('taskType', taskType);
            formData.append('date', date);
            formData.append('crop', crop);
            formData.append('estExpense', estExpense);

            // Make an AJAX request to handle form submission
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'cultivation_plan_insert.php', true);
            xhr.onload = function () {
                var response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    $('#myModal').modal('hide');
                    location.reload();
                } else {
                    // Error handling
                    alert('Error: ' + response.message);
                }
            };
            xhr.send(formData);
        }
    }

    // Validate Form Function
    function validateForm() {
        var isValid = true;
        var formElements = document.getElementById('newRecordForm').elements;
        for (var i = 0; i < formElements.length; i++) {
            if (formElements[i].type !== 'button' && formElements[i].value.trim() === '') {
                isValid = false;
                alert('Please fill in all fields.');
                break;
            }
        }
        return isValid;
    }
</script>

</body>
</html>
