<!DOCTYPE html>
<html lang="en">

<?php include 'layouts/header.php' ?>

<body>

<!-- Fertilizer Modal -->
<div class="modal" id="myModalFertilizer">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add Fertilizer Entry</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="newRecordFormFertilizer" method="post">
                    <div class="form-group">
                        <label for="typeFertilizer">Fertilizer Type:</label>
                        <input type="text" class="form-control" id="typeFertilizer" name="typeFertilizer" required>
                    </div>
                    <div class="form-group">
                        <label for="stockQuantityFertilizer">Stock Quantity:</label>
                        <input type="number" class="form-control" id="stockQuantityFertilizer" name="stockQuantityFertilizer" required>
                    </div>
                    <div class="form-group">
                        <label for="costFertilizer">Cost (Rs.):</label>
                        <input type="number" class="form-control" id="costFertilizer" name="costFertilizer" required>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="saveRecord('Fertilizer')">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Spray Modal -->
<div class="modal" id="myModalSpray">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add Spray Entry</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="newRecordFormSpray" method="post">
                    <div class="form-group">
                        <label for="medicineName">Medicine:</label>
                        <input type="text" class="form-control" id="medicineName" name="medicineName" required>
                    </div>
                    <div class="form-group">
                        <label for="stockQuantitySpray">Stock Quantity:</label>
                        <input type="number" class="form-control" id="stockQuantitySpray" name="stockQuantitySpray" required>
                    </div>
                    <div class="form-group">
                        <label for="costSpray">Cost (Rs.):</label>
                        <input type="number" class="form-control" id="costSpray" name="costSpray" required>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="saveRecord('Spray')">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Machinery Modal -->
<div class="modal" id="myModalMachinery">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add Machinery Entry</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="newRecordFormMachinery" method="post">
                    <div class="form-group">
                        <label for="typeMachinery">Machinery Type:</label>
                        <input type="text" class="form-control" id="typeMachinery" name="typeMachinery" required>
                    </div>
                    <div class="form-group">
                        <label for="availableUnitsMachinery">Available Units:</label>
                        <input type="number" class="form-control" id="availableUnitsMachinery" name="availableUnitsMachinery" required>
                    </div>
                    <div class="form-group">
                        <label for="costMachinery">Cost (Rs.):</label>
                        <input type="number" class="form-control" id="costMachinery" name="costMachinery" required>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="saveRecord('Machinery')">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Diesel Modal -->
<div class="modal" id="myModalDiesel">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add Diesel Entry</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="newRecordFormDiesel" method="post">
                    <div class="form-group">
                        <label for="quantityLitersDiesel">Quantity (Liters):</label>
                        <input type="number" class="form-control" id="quantityLitersDiesel" name="quantityLitersDiesel" required>
                    </div>
                    <div class="form-group">
                        <label for="costDiesel">Cost (Rs.):</label>
                        <input type="number" class="form-control" id="costDiesel" name="costDiesel" required>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="saveRecord('Diesel')">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Edit Modals Container -->
<div class="edit-modals-container">
    <?php
    include 'db_conn.php';

    // Function to fetch and display data in edit modals
    function displayEditModal($section, $result)
    {
    while ($row = mysqli_fetch_assoc($result)) :
    ?>
    <!-- Edit Modal -->
    <div class="modal fade edit-modal" id="editModal<?php echo $section . $row['id']; ?>">

        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Edit Record</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="editRecordForm<?php echo $section . $row['id']; ?>" method="post">
                        <?php
                        // Display form fields based on the section
                        switch ($section) {
                            case 'Fertilizer':
                                ?>
                                <div class="form-group">
                                    <label for="editType<?php echo $section; ?>">Fertilizer Type:</label>
                                    <input type="text" class="form-control" id="editType<?php echo $section; ?>" name="editType<?php echo $section; ?>" value="<?php echo $row['fertilizer_type']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="editStockQuantity<?php echo $section; ?>">Stock Quantity:</label>
                                    <input type="number" class="form-control" id="editStockQuantity<?php echo $section; ?>" name="editStockQuantity<?php echo $section; ?>" value="<?php echo $row['stock_quantity']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="editCost<?php echo $section; ?>">Cost (Rs.):</label>
                                    <input type="number" class="form-control" id="editCost<?php echo $section; ?>" name="editCost<?php echo $section; ?>" value="<?php echo $row['cost']; ?>" required>
                                </div>
                                <?php
                                break;

                            case 'Spray':
                                ?>
                                <p>Edit Modal ID: <?php echo $section . $row['id']; ?></p>
                                <p>Edit Form ID: <?php echo 'editRecordForm' . $section . $row['id']; ?></p>
                                <!-- Display form fields for Spray section -->
                                <div class="form-group">
                                    <label for="editMedicineName<?php echo $section; ?>">Medicine:</label>
                                    <input type="text" class="form-control" id="editMedicineName<?php echo $section; ?>" name="editMedicineName<?php echo $section; ?>" value="<?php echo $row['medicine_name']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="editStockQuantity<?php echo $section; ?>">Stock Quantity:</label>
                                    <input type="number" class="form-control" id="editStockQuantity<?php echo $section; ?>" name="editStockQuantity<?php echo $section; ?>" value="<?php echo $row['stock_quantity']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="editCost<?php echo $section; ?>">Cost (Rs.):</label>
                                    <input type="number" class="form-control" id="editCost<?php echo $section; ?>" name="editCost<?php echo $section; ?>" value="<?php echo $row['cost']; ?>" required>
                                </div>
                                <?php
                                break;

                            case 'Machinery':
                                ?>
                                <p>Edit Modal ID: <?php echo $section . $row['id']; ?></p>
                                <p>Edit Form ID: <?php echo 'editRecordForm' . $section . $row['id']; ?></p>

                                <!-- Display form fields for Machinery section -->
                                <div class="form-group">
                                    <label for="editType<?php echo $section; ?>">Machinery Type:</label>
                                    <input type="text" class="form-control" id="editType<?php echo $section; ?>" name="editType<?php echo $section; ?>" value="<?php echo $row['machinery_type']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="editAvailableUnits<?php echo $section; ?>">Available Units:</label>
                                    <input type="number" class="form-control" id="editAvailableUnits<?php echo $section; ?>" name="editAvailableUnits<?php echo $section; ?>" value="<?php echo $row['available_units']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="editCost<?php echo $section; ?>">Cost (Rs.):</label>
                                    <input type="number" class="form-control" id="editCost<?php echo $section; ?>" name="editCost<?php echo $section; ?>" value="<?php echo $row['cost']; ?>" required>
                                </div>
                                <?php
                                break;

                            case 'Diesel':
                                ?>
                                <p>Edit Modal ID: <?php echo $section . $row['id']; ?></p>
                                <p>Edit Form ID: <?php echo 'editRecordForm' . $section . $row['id']; ?></p>
                                <!-- Display form fields for Diesel section -->
                                <div class="form-group">
                                    <label for="editQuantityLiters<?php echo $section; ?>">Quantity (Liters):</label>
                                    <input type="number" class="form-control" id="editQuantityLiters<?php echo $section; ?>" name="editQuantityLiters<?php echo $section; ?>" value="<?php echo $row['quantity_liters']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="editCost<?php echo $section; ?>">Cost (Rs.):</label>
                                    <input type="number" class="form-control" id="editCost<?php echo $section; ?>" name="editCost<?php echo $section; ?>" value="<?php echo $row['cost']; ?>" required>
                                </div>
                                <?php
                                break;
                            default:

                        }
                        ?>
                        <!-- Common buttons for all sections -->
                        <button type="button" class="btn btn-success" onclick="updateRecord('<?php echo $section; ?>', <?php echo $row['id']; ?>)">Update</button>
                        <button type="button" class="btn btn-danger" onclick="deleteRecord('<?php echo $section; ?>', <?php echo $row['id']; ?>)">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Edit Modal -->
    <?php
        endwhile;
    }

    // Retrieve and display data for Fertilizer section
    $sqlFertilizer = "SELECT * FROM inv_fertilizer_stock";
    $resultFertilizer = mysqli_query($conn, $sqlFertilizer);
    $section = 'Fertilizer'; // Define $section for Fertilizer
    displayEditModal($section, $resultFertilizer);

    // Retrieve and display data for Spray section
    $sqlSpray = "SELECT * FROM inv_spray_stock";
    $resultSpray = mysqli_query($conn, $sqlSpray);
    $section = 'Spray'; // Define $section for Spray
    displayEditModal($section, $resultSpray);

    // Retrieve and display data for Machinery section
    $sqlMachinery = "SELECT * FROM inv_machinery_stock";
    $resultMachinery = mysqli_query($conn, $sqlMachinery);
    $section = 'Machinery'; // Define $section for Machinery
    displayEditModal($section, $resultMachinery);

    // Retrieve and display data for Diesel section
    $sqlDiesel = "SELECT * FROM inv_diesel_stock";
    $resultDiesel = mysqli_query($conn, $sqlDiesel);
    $section = 'Diesel'; // Define $section for Diesel
    displayEditModal($section, $resultDiesel);
    ?>
</div>


<div class="wrapper">
    <?php include 'layouts/main_sidebar.php' ?>
    <div class="main-panel">
        <?php include 'layouts/menu.php' ?>
        <div class="content">
            <div class="dashboard-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h3 style="color: #9DCD5A;">Inventory Management</h3>
                        </div>
                    </div>
                    <?php
                        // Include the database connection file
                        include 'db_conn.php';
                    ?>
                    <!-- Fertilizer Section -->
                    <div class="row mt-4">
                        <div class="col-lg-12">
                            <h4>Fertilizer Stock</h4>
                            <table class="table table-bordered" id="FertilizerTable">
                                <thead>
                                <tr>
                                    <th>Fertilizer Type</th>
                                    <th>Stock Quantity</th>
                                    <th>Cost (Rs.)</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                // Fetch and display Fertilizer data from the database
                                $sql = "SELECT * FROM inv_fertilizer_stock";
                                $fertilizerResult = mysqli_query($conn, $sql);

                                // Display Fertilizer data as table rows
                                while ($row = mysqli_fetch_assoc($fertilizerResult)) {
                                    echo '<tr>';
                                    echo '<td>' . $row['fertilizer_type'] . '</td>';
                                    echo '<td>' . $row['stock_quantity'] . '</td>';
                                    echo '<td>' . $row['cost'] . '</td>';
                                    echo '<td>';
                                    echo '<i class="fas fa-edit text-primary mr-2" title="Edit" onclick="openEditModal(\'Fertilizer\', ' . $row['id'] . ')"></i>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                                ?>
                                </tbody>
                            </table>
                            <!-- New Record Button for Fertilizer Section -->
                            <div class="row">
                                <div class="col-12 text-center mt-4">
                                    <button class="new-record-button" type="button" data-toggle="modal" data-target="#myModalFertilizer">
                                        <img src="assets/img/icons/plus-icon.svg" alt="Plus Icon" class="new-record-button-icon">
                                        <span class="new-record-button-text">New Row</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Spray Section -->
                    <div class="row mt-4">
                        <div class="col-lg-12">
                            <h4>Spray and Medicines</h4>
                            <table class="table table-bordered" id="SprayTable">
                                <thead>
                                <tr>
                                    <th>Medicine</th>
                                    <th>Stock Quantity</th>
                                    <th>Cost (Rs.)</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                // Fetch and display Spray data from the database
                                $sql = "SELECT * FROM inv_spray_stock";
                                $sprayResult = mysqli_query($conn, $sql);

                                // Display Spray data as table rows
                                while ($row = mysqli_fetch_assoc($sprayResult)) {
                                    echo '<tr>';
                                    echo '<td>' . $row['medicine_name'] . '</td>';
                                    echo '<td>' . $row['stock_quantity'] . '</td>';
                                    echo '<td>' . $row['cost'] . '</td>';
                                    echo '<td>';
                                    echo '<i class="fas fa-edit text-primary mr-2" title="Edit" onclick="openEditModal(\'Spray\', ' . $row['id'] . ')"></i>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                                ?>
                                </tbody>
                            </table>
                            <!-- New Record Button for Spray Section -->
                            <div class="row">
                                <div class="col-12 text-center mt-4">
                                    <button class="new-record-button" type="button" data-toggle="modal" data-target="#myModalSpray">
                                        <img src="assets/img/icons/plus-icon.svg" alt="Plus Icon" class="new-record-button-icon">
                                        <span class="new-record-button-text">New Row</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Machinery Section -->
                    <div class="row mt-4">
                        <div class="col-lg-12">
                            <h4>Machinery Stock</h4>
                            <table class="table table-bordered" id="MachineryTable">
                                <thead>
                                <tr>
                                    <th>Machinery Type</th>
                                    <th>Available Units</th>
                                    <th>Cost (Rs.)</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                // Fetch and display Machinery data from the database
                                $sql = "SELECT * FROM inv_machinery_stock";
                                $machineryResult = mysqli_query($conn, $sql);

                                // Display Machinery data as table rows
                                while ($row = mysqli_fetch_assoc($machineryResult)) {
                                    echo '<tr>';
                                    echo '<td>' . $row['machinery_type'] . '</td>';
                                    echo '<td>' . $row['available_units'] . '</td>';
                                    echo '<td>' . $row['cost'] . '</td>';
                                    echo '<td>';
                                    echo '<i class="fas fa-edit text-primary mr-2" title="Edit" onclick="openEditModal(\'Machinery\', ' . $row['id'] . ')"></i>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                                ?>
                                </tbody>
                            </table>
                            <!-- New Record Button for Machinery Section -->
                            <div class="row">
                                <div class="col-12 text-center mt-4">
                                    <button class="new-record-button" type="button" data-toggle="modal" data-target="#myModalMachinery">
                                        <img src="assets/img/icons/plus-icon.svg" alt="Plus Icon" class="new-record-button-icon">
                                        <span class="new-record-button-text">New Row</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Diesel Section -->
                    <div class="row mt-4">
                        <div class="col-lg-12">
                            <h4>Diesel Stock</h4>
                            <table class="table table-bordered" id="DieselTable">
                                <thead>
                                <tr>
                                    <th>Quantity (Liters)</th>
                                    <th>Cost (Rs.)</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                // Fetch and display Diesel data from the database
                                $sql = "SELECT * FROM inv_diesel_stock";
                                $dieselResult = mysqli_query($conn, $sql);

                                // Display Diesel data as table rows
                                while ($row = mysqli_fetch_assoc($dieselResult)) {
                                    echo '<tr>';
                                    echo '<td>' . $row['quantity_liters'] . '</td>';
                                    echo '<td>' . $row['cost'] . '</td>';
                                    echo '<td>';
                                    echo '<i class="fas fa-edit text-primary mr-2" title="Edit" onclick="openEditModal(\'Diesel\', ' . $row['id'] . ')"></i>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                                ?>
                                </tbody>
                            </table>
                            <!-- New Record Button for Diesel Section -->
                            <div class="row">
                                <div class="col-12 text-center mt-4">
                                    <button class="new-record-button" type="button" data-toggle="modal" data-target="#myModalDiesel">
                                        <img src="assets/img/icons/plus-icon.svg" alt="Plus Icon" class="new-record-button-icon">
                                        <span class="new-record-button-text">New Row</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Sections as Needed -->

                    // Close the database connection
                    <?php
                    mysqli_close($conn);
                    ?>

                </div>
            </div>
        </div>

        <?php include 'layouts/Footer.php' ?>

    </div>
</div>


<script>
    // Insert Record Function
    function saveRecord(section) {
        // Validate the form
        var formId = 'newRecordForm' + section;
        if (validateForm(formId)) {
            // Get form values
            var formData = new FormData(document.getElementById(formId));

            // Make an AJAX request to handle form submission
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../progressive_farmer/crud/inventory/inv_insert_' + section.toLowerCase() + '_data.php', true);
            xhr.onload = function () {
                handleResponse(xhr, section);
            };

            // Set up error handling for the request
            xhr.onerror = function () {
                console.error('Error: Unable to process the request.');
            };

            xhr.send(formData);
        }
    }

    // Update Record Function
    function updateRecord(section, id) {
        // Validate the form
        var formId = 'editRecordForm' + section + id;
        console.log(formId);
        if (validateForm(formId)) {
            // Get form values
            var formData = new FormData(document.getElementById(formId));

            // Make an AJAX request to handle form submission
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../progressive_farmer/crud/inventory/inv_update_' + section.toLowerCase() + '_data.php', true);
            xhr.onload = function () {
                handleResponse(xhr, section);
            };

            // Set up error handling for the request
            xhr.onerror = function () {
                console.error('Error: Unable to process the request.');
            };

            formData.append('id', id);
            xhr.send(formData);
        }
    }

    // Delete Record Function
    function deleteRecord(section, id) {
        console.log('Deleting record for section:', section, 'and id:', id);

        var confirmation = confirm('Are you sure you want to delete this record?');

        if (confirmation) {
            var formData = new FormData();
            formData.append('id', id);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../progressive_farmer/crud/inventory/inv_delete_' + section.toLowerCase() + '_data.php', true);
            xhr.onload = function () {
                handleResponse(xhr, section);
            };

            xhr.onerror = function () {
                console.error('Error: Unable to process the request.');
            };

            xhr.send(formData);
        }
    }

    // Handle AJAX response
    function handleResponse(xhr, section) {
        console.log(xhr.responseText);  // Log the response text

        try {
            var response = JSON.parse(xhr.responseText);

            if (response.status === 'success') {
                // Close the modal for the current section
                $('#myModal' + section).modal('hide');
                $('#editModal' + section).modal('hide');

                // Add a timeout before reloading the page
                setTimeout(function () {
                    location.reload();
                }, 500);
            } else {
                // Error handling
                alert('Error: ' + response.message);
            }
        } catch (error) {
            // Log any JSON parsing errors
            console.error('JSON parsing error:', error);
        }
    }

    function validateForm(formId) {
        var isValid = true;
        var formElements = document.getElementById(formId).elements;

        for (var i = 0; i < formElements.length; i++) {
            if (formElements[i].type !== 'button' && formElements[i].value.trim() === '') {
                isValid = false;
                // Highlight the specific field that is empty
                formElements[i].style.border = '1px solid red';
            }
        }

        return isValid;
    }

    // JavaScript function to open the respective edit modal
    function openEditModal(section, id) {
        // Close any open modals
        $('.modal').modal('hide');

        // Open the specific edit modal
        $('#editModal' + section + id).modal('show');
    }


</script>



</body>
</html>
