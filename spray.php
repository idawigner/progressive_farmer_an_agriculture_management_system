<!DOCTYPE html>
<html lang="en">

<?php include '../progressive_farmer/layouts/header.php' ?>

<body>

<!-- Insert Modal Container -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h3 class="modal-title">Add New Spray Record</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Form and input fields for a new spray record go here -->
                <form id="newSprayRecordForm" method="post">
                    <div class="form-group">
                        <label for="sprayDate">Date:</label>
                        <input type="date" class="form-control" id="sprayDate" name="sprayDate" required>
                    </div>
                    <div class="form-group">
                        <label for="sprayMedicine">Medicine:</label>
                        <input type="text" class="form-control" id="sprayMedicine" name="sprayMedicine" required>
                    </div>
                    <div class="form-group">
                        <label for="sprayQuantity">Quantity (in Litres):</label>
                        <input type="text" class="form-control" id="sprayQuantity" name="sprayQuantity" required>
                    </div>
                    <div class="form-group">
                        <label for="sprayDetails">Details:</label>
                        <textarea class="form-control" id="sprayDetails" name="sprayDetails" placeholder="Optional"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="sprayStatus">Status:</label>
                        <select class="form-control" id="sprayStatus" name="sprayStatus" required disabled>
                            <option value="Pending" style="color: grey;" selected>Pending</option>
                            <option value="Done">Done</option>
                        </select>
                    </div>

                    <button type="button" class="btn btn-primary" onclick="createSprayRecord()">Save</button>
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
    // Retrieve data from the 'spray' table
    $sql = "SELECT * FROM spray";
    $result = mysqli_query($conn, $sql);

    // Fetch data once
    while ($card = mysqli_fetch_assoc($result)) :
        ?>
        <!-- Edit Modal -->
        <div class="modal fade edit-modal" id="editModal<?php echo $card['id']; ?>">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Edit Spray Record</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form id="editSprayRecordForm<?php echo $card['id']; ?>" method="post">
                            <div class="form-group">
                                <label for="editSprayDate">Date:</label>
                                <input type="date" class="form-control" id="editSprayDate" name="editSprayDate" value="<?php echo $card['date']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="editSprayMedicine">Medicine:</label>
                                <input type="text" class="form-control" id="editSprayMedicine" name="editSprayMedicine" value="<?php echo $card['medicine']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="editSprayQuantity">Quantity (in Litres):</label>
                                <input type="text" class="form-control" id="editSprayQuantity" name="editSprayQuantity" value="<?php echo $card['quantity']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="editSprayDetails">Details:</label>
                                <textarea class="form-control" id="editSprayDetails" name="editSprayDetails"><?php echo $card['details']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="editSprayStatus">Status:</label>
                                <select class="form-control" id="editSprayStatus" name="editSprayStatus" required>
                                    <option value="Pending" <?php echo ($card['status'] === 'Pending') ? 'selected' : ''; ?>>Pending</option>
                                    <option value="Done" <?php echo ($card['status'] === 'Done') ? 'selected' : ''; ?>>Done</option>
                                </select>
                            </div>

                            <button type="button" class="btn btn-success" onclick="updateSprayRecord(<?php echo $card['id']; ?>, 'editModal<?php echo $card['id']; ?>')">Update</button>
                            <button type="button" class="btn btn-danger" onclick="deleteSprayRecord(<?php echo $card['id']; ?>)">Delete</button>
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
    <?php include '../progressive_farmer/layouts/plot_sidebar.php' ?>
    <div class="main-panel">
        <?php include '../progressive_farmer/layouts/menu.php' ?>
        <!-- End Navbar -->
        <div class="content">
            <div class="dashboard-area">
                <div class="container-fluid">
                    <!-- Page Title -->
                    <div class="row">
                        <div class="col-12 text-center">
                            <h3 style="color: #9DCD5A;">Spray Records</h3>
                        </div>
                    </div>
                    <!-- Cards Container -->
                    <div class="row">
                        <!-- Displaying cards -->
                        <?php while ($card = mysqli_fetch_assoc($result)) : ?>
                            <div class="card-container col-lg-4 col-md-6 col-sm-12">
                                <div class="card spray-card">
                                    <div class="card-body task-card-body">
                                        <div class="row">
                                            <div class="col-lg-9 col-md-9 col-sm-9 info-card-content scrollable-info-card-content-spray">
                                                <?php
                                                // Display status tag with border
                                                $statusColor = ($card['status'] == 'Pending') ? 'red' : '#9DCD5A';
                                                echo '<p class="plan-task-tag" style="color: ' . $statusColor . '; border: 2px solid ' . $statusColor . ';">' . $card['status'] . '</p>';

                                                // Display card information
                                                echo '<h6 class="date">' . $card['date'] . '</h6>';
                                                echo '<p><strong>Medicine:</strong> ' . $card['medicine'] . '</p>';
                                                echo '<p><strong>Quantity:</strong> ' . $card['quantity'] . ' Litres</p>';
                                                // Display details only if not empty
                                                if (!empty($card['details'])) {
                                                    echo '<p><strong>Details:</strong> ' . $card['details'] . '</p>';
                                                }
                                                ?>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 text-center edit-icon">
                                                <a href="#" data-toggle="modal" data-target="#editModal<?php echo $card['id']; ?>">
                                                    <img src="assets/img/icons/edit-icon.png" alt="Edit Icon" class="edit-icon-img">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>

                    <!-- Add New Record Button Container -->
                    <div class="row">
                        <div class="col-12 text-center mt-4">
                            <!-- Adjust modal attributes for the Spray page -->
                            <button class="new-record-button" type="button" data-toggle="modal" data-target="#myModal">
                                <img src="assets/img/icons/plus-icon.svg" alt="Plus Icon" class="new-record-button-icon">
                                <span class="new-record-button-text">New Spray Record</span>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Close the database connection -->
        <?php mysqli_close($conn); ?>

        <!-- Footer -->
        <?php include '../progressive_farmer/layouts/Footer.php' ?>

    </div>
</div>

<script>
    // Create Record Function for Spray
    function createSprayRecord() {
        // Validate the form
        if (validateSprayForm('newSprayRecordForm')) {
            // Get form values
            var date = document.getElementById('sprayDate').value;
            var medicine = document.getElementById('sprayMedicine').value;
            var quantity = document.getElementById('sprayQuantity').value;
            var details = document.getElementById('sprayDetails').value;
            var status = document.getElementById('sprayStatus').value;

            // Create FormData object
            var formData = new FormData();
            formData.append('date', date);
            formData.append('medicine', medicine);
            formData.append('quantity', quantity);
            formData.append('details', details);
            formData.append('status', status);

            // Make an AJAX request to handle form submission
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'spray_create.php', true);
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

    // Update Record Function for Spray
    function updateSprayRecord(id, modalId) {
        // Validate the form
        var formId = 'editSprayRecordForm' + id;
        if (validateSprayForm(formId)) {
            // Get form values using the dynamic formId
            var date = document.getElementById(modalId).querySelector('#editSprayDate').value;
            var medicine = document.getElementById(modalId).querySelector('#editSprayMedicine').value;
            var quantity = document.getElementById(modalId).querySelector('#editSprayQuantity').value;
            var details = document.getElementById(modalId).querySelector('#editSprayDetails').value;
            var status = document.getElementById(modalId).querySelector('#editSprayStatus').value;

            // Create FormData object
            var formData = new FormData();
            formData.append('id', id);
            formData.append('date', date);
            formData.append('medicine', medicine);
            formData.append('quantity', quantity);
            formData.append('details', details);
            formData.append('status', status);

            // Make an AJAX request to handle form submission
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'spray_update.php', true);
            xhr.onload = function () {
                var response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    // Use the original ID here
                    $('#' + modalId).modal('hide');
                    location.reload();
                } else {
                    // Error handling
                    alert('Error: ' + response.message);
                }
            };
            xhr.send(formData);
        }
    }

    // Delete Record Function for Spray
    function deleteSprayRecord(id) {
        var confirmDelete = confirm('Are you sure you want to delete this record?');
        if (confirmDelete) {
            // Make an AJAX request to handle record deletion
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'spray_delete.php', true);
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
            xhr.send('id=' + id);
        }
    }

    // Form Validation Function for Spray
    function validateSprayForm(formId) {
        var isValid = true;
        var formElements = document.getElementById(formId).elements;

        // Check if the form is the new record form (not an edit modal)
        var isNewRecordForm = formElements[0].name === 'sprayDate';
        for (var i = 0; i < formElements.length; i++) {
            // Check if any field except Details is empty in new record
            if (isNewRecordForm && formElements[i].type !== 'button' && formElements[i].name !== 'sprayDetails' && formElements[i].value.trim() === '') {
                isValid = false;
                alert('Please fill in all fields.');
                break;
            }

            // Check if any required field except company name is empty in edit mode
            if (!isNewRecordForm && formElements[i].type !== 'button' && formElements[i].name !== 'editSprayDetails' && formElements[i].value.trim() === '') {
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
