<!DOCTYPE html>
<html lang="en">
<?php include '../progressive_farmer/layouts/header.php'; ?>
<body>
<!-- Insert Modal Container -->
<div class="modal fade" id="addPlotModal" tabindex="-1" role="dialog" aria-labelledby="addPlotModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h3 class="modal-title">Add New Plot</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Form and input fields for a new plot go here -->
                <form id="newPlotForm" method="post">
                    <div class="form-group">
                        <label for="plot_id">Plot Number:</label>
                        <select class="form-control" id="plot_id" name="plot_id" required>
                            <?php
                            include '../progressive_farmer/db_conn.php';
                            $taken_plot_numbers = [];
                            $sql_taken_numbers = "SELECT plot_id FROM plots";
                            $result_taken_numbers = mysqli_query($conn, $sql_taken_numbers);
                            while ($row = mysqli_fetch_assoc($result_taken_numbers)) {
                                $taken_plot_numbers[] = $row['plot_id'];
                            }

                            for ($i = 1; $i <= 10; $i++) {
                                $disabled = in_array($i, $taken_plot_numbers) ? 'disabled' : '';
                                $disabledStyle = $disabled ? 'style="color: #aaa; background-color: #f5f5f5;"' : '';
                                echo "<option value='$i' $disabled $disabledStyle>$i</option>";
                            }

                            mysqli_close($conn);
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="area">Area:</label>
                        <input type="text" class="form-control" id="area" name="area" required>
                    </div>
                    <div class="form-group">
                        <label for="location">Location:</label>
                        <input type="text" class="form-control" id="location" name="location" required>
                    </div>
                    <div class="form-group">
                        <label for="plotStatus">Status:</label>
                        <select class="form-control" id="plotStatus" name="plotStatus" required>
                            <option value="OWNED">OWNED</option>
                            <option value="ON_LEASE">ON LEASE</option>
                        </select>
                    </div>

                    <button type="button" class="btn btn-primary" onclick="createPlot()">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Insert Modal Container -->

<!-- Edit Modals Container -->
<div class="edit-modals-container">
    <?php
    include '../progressive_farmer/db_conn.php';
    // Retrieve data from the 'plots' table
    $sql = "SELECT * FROM plots ORDER BY plot_id";
    $result = mysqli_query($conn, $sql);

    // Fetch data once
    while ($plot = mysqli_fetch_assoc($result)) :
        ?>
        <!-- Edit Modal -->
        <div class="modal fade edit-modal" id="editPlotModal<?php echo $plot['plot_id']; ?>">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Edit Plot</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form id="editPlotForm<?php echo $plot['plot_id']; ?>" method="post">
                            <div class="form-group">
                                <label for="editPlotNumber">Plot Number:</label>
                                <input type="text" class="form-control" id="editPlotNumber" name="editPlotNumber" value="<?php echo $plot['plot_id']; ?>" readonly>

<!--                                For making Plot_id editable-->
<!--                                <select class="form-control" id="editPlotNumber" name="editPlotNumber" required>-->
<!--                                    --><?php
//                                    for ($i = 1; $i <= 10; $i++) {
//                                        $selected = ($plot['plot_id'] == $i) ? 'selected' : '';
//                                        echo "<option value='$i' $selected>$i</option>";
//                                    }
//                                    ?>
<!--                                </select>-->
                            </div>
                            <div class="form-group">
                                <label for="editArea">Area:</label>
                                <input type="text" class="form-control" id="editArea" name="editArea" value="<?php echo $plot['area']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="editLocation">Location:</label>
                                <input type="text" class="form-control" id="editLocation" name="editLocation" value="<?php echo $plot['location']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="editPlotStatus">Status:</label>
                                <select class="form-control" id="editPlotStatus" name="editPlotStatus" required>
                                    <option value="OWNED" <?php echo ($plot['status'] == 'OWNED') ? 'selected' : ''; ?>>OWNED</option>
                                    <option value="ON_LEASE" <?php echo ($plot['status'] == 'ON_LEASE') ? 'selected' : ''; ?>>ON LEASE</option>
                                </select>
                            </div>

                            <button type="button" class="btn btn-success" onclick="updatePlot('<?php echo $plot['plot_id']; ?>', 'editPlotModal<?php echo $plot['plot_id']; ?>')">Update</button>
                            <button type="button" class="btn btn-danger" onclick="deletePlot(<?php echo $plot['plot_id']; ?>)">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Edit Modal -->
    <?php endwhile;

    // Reset the result pointer to the beginning for card display
    mysqli_data_seek($result, 0);
    ?>
</div>
<!-- End Edit Modals Container -->

<div class="wrapper">
    <?php include '../progressive_farmer/layouts/main_sidebar.php'; ?>
    <div class="main-panel">
        <?php include '../progressive_farmer/layouts/menu.php'; ?>
        <!-- End Navbar -->
        <div class="content">
            <div class="dashboard-area">
                <div class="container-fluid">
                    <!-- Page Title -->
                    <div class="row">
                        <div class="col-12 text-center">
                            <h3 style="color: #9DCD5A; font-weight: bold">Plots</h3>
                        </div>
                    </div>
                    <!-- Cards Container -->
                    <div class="row">
                        <!-- Displaying cards -->
                        <?php while ($plot = mysqli_fetch_assoc($result)) : ?>
                            <div class="card-container col-lg-3 col-md-6">
                                <a href="cultivation_plan.php?plot_id=<?php echo $plot['plot_id']; ?>" class="card-link">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <h5 class="card-title" style="color: #9DCD5A; margin-bottom: 20px">Plot # <?php echo $plot['plot_id']; ?></h5>
                                            <p>
                                                <i class="fas fa-landmark"></i> <?php echo $plot['area']; ?>
                                            </p>
                                            <p>
                                                <i class="fas fa-map-marker-alt"></i> <?php echo $plot['location']; ?>
                                            </p>
                                            <?php
                                            // Display status tag with linear gradient background
                                            $ownershipTagColor = ($plot['status'] == 'OWNED') ? 'linear-gradient(to right, #7FD802, #2ACF82)' : 'linear-gradient(to right, #F66464, #FF1547)';
                                            echo '<p class="plot-ownership-tag" style="background: ' . $ownershipTagColor . ';">' . $plot['status'] . '</p>';
                                            ?>
                                            <!-- Plot Edit icon -->
                                            <div class="plot-edit-icon">
                                                <a href="#" data-toggle="modal" data-target="#editPlotModal<?php echo $plot['plot_id']; ?>">
                                                    <img src="assets/img/icons/edit-icon.png" alt="Edit Icon" class="edit-icon-img">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endwhile; ?>
                    </div>

                    <!-- Add New Plot Button Container -->
                    <div class="row">
                        <div class="col-12 text-center mt-4">
                            <button class="new-record-button" type="button" data-toggle="modal" data-target="#addPlotModal">
                                <img src="assets/img/icons/plus-icon.svg" alt="Plus Icon" class="new-record-button-icon">
                                <span class="new-record-button-text">New Plot</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Close the database connection -->
        <?php mysqli_close($conn); ?>

        <!-- Footer -->
        <?php include '../progressive_farmer/layouts/Footer.php'; ?>
    </div>
</div>

<script>
    // Create Record Function for Plots
    function createPlot() {
        try {

        // Validate the form
            if (validatePlotForm('newPlotForm')) {
                // Get form values
                var plot_id = document.getElementById('plot_id').value;
                var area = document.getElementById('area').value;
                var location = document.getElementById('location').value;
                var status = document.getElementById('plotStatus').value;

                // Create FormData object
                var formData = new FormData();
                formData.append('plot_id', plot_id);
                formData.append('area', area);
                formData.append('location', location);
                formData.append('status', status);

                // Make an AJAX request to handle form submission
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'plots_create.php', true);
                xhr.onload = function () {
                    var response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        $('#addPlotModal').modal('hide');
                        window.location.reload();
                    } else {
                        // Error handling
                        alert('Error: ' + response.message);
                    }
                };
                xhr.send(formData);
            }
        } catch (error) {
            // Handle JSON parsing error
            alert('Error parsing JSON response');
        }
    }

    // Update Record Function for Plots
    function updatePlot(id, modalId) {
        try {
            var formId = 'editPlotForm' + id;
            // Validate the form
            if (validatePlotForm(formId)) {
                // Get form values using the dynamic formId
                var plot_id = document.getElementById(modalId).querySelector('#editPlotNumber').value;
                var area = document.getElementById(modalId).querySelector('#editArea').value;
                var location = document.getElementById(modalId).querySelector('#editLocation').value;
                var status = document.getElementById(modalId).querySelector('#editPlotStatus').value;

                // Create FormData object
                var formData = new FormData();
                formData.append('plot_id', plot_id);
                formData.append('area', area);
                formData.append('location', location);
                formData.append('status', status);

                // Make an AJAX request to handle form submission
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'plots_update.php', true);
                xhr.onload = function () {
                    console.log(xhr.responseText);
                    var response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        // Use the original ID here
                        $('#' + modalId).modal('hide');
                        window.location.reload();
                    } else {
                        // Error handling
                        alert('Error: ' + response.message);
                    }
                };
                xhr.send(formData);
            }
        } catch (error) {
            // Handle JSON parsing error
            alert('Error parsing JSON response');
        }
    }

    // Delete Record Function for Plots
    function deletePlot(id) {
        var confirmDelete = confirm('All the data related to this will be permanently deleted. Are you sure you want to delete this plot? ');
        if (confirmDelete) {
            // Make an AJAX request to handle plot deletion
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'plots_delete.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                var response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    location.reload();
                } else {
                    // Error handling
                    alert('Error: ' + response.message);
                }
            };
            xhr.send('plot_id=' + id);
        }
    }

    // Form Validation Function for Plots
    function validatePlotForm(formId) {
        var isValid = true;
        var formElements = document.getElementById(formId).elements;

        for (var i = 0; i < formElements.length; i++) {
            // Check if any field is empty
            if (formElements[i].type !== 'button' && formElements[i].value.trim() === '') {
                isValid = false;
                alert('Please fill in all fields.');
                break;
            }
        }
        return isValid;
    }

</script>

<?php include '../progressive_farmer/layouts/scripts.php'; ?>
</body>
</html>
