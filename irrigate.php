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
                <h3 class="modal-title">Add New Record</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Form and input fields for a new irrigate record go here -->
                <form id="newIrrigateRecordForm" method="post">
                    <div class="form-group">
                        <label for="irrigateDate">Date:</label>
                        <input type="date" class="form-control" id="irrigateDate" name="irrigateDate" required>
                    </div>
                    <div class="form-group">
                        <label for="irrigateSource">Source:</label>
                        <select class="form-control" id="irrigateSource" name="irrigateSource" required disabled>
                            <option value="N/A" style="color: grey;" selected>N/A</option>
                            <option value="Light">Light</option>
                            <option value="Solar">Solar</option>
                            <option value="Rain">Rain</option>
                            <option value="Diesel">Diesel</option>
                            <option value="Canal Water">Canal Water</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="irrigateTime">Time:</label>
                        <input type="text" class="form-control" id="irrigateTime" name="irrigateTime">
                    </div>
                    <div class="form-group">
                        <label for="irrigateStatus">Status:</label>
                        <select class="form-control" id="irrigateStatus" name="irrigateStatus" required disabled>
                            <option value="Pending" style="color: grey;" selected>Pending</option>
                            <option value="Done">Done</option>
                        </select>
                    </div>

                    <button type="button" class="btn btn-primary" onclick="createIrrigateRecord()">Save</button>
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
    // Retrieve data from the 'irrigate' table
    $sql = "SELECT * FROM irrigate";
    $result = mysqli_query($conn, $sql);

    // Fetch data once
    while ($card = mysqli_fetch_assoc($result)) :
        ?>
        <!-- Edit Modal -->
        <div class="modal fade edit-modal" id="editModal<?php echo $card['id']; ?>">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Edit Record</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form id="editIrrigateRecordForm<?php echo $card['id']; ?>" method="post">
                            <div class="form-group">
                                <label for="editIrrigateDate">Date:</label>
                                <input type="date" class="form-control" id="editIrrigateDate" name="editIrrigateDate" value="<?php echo $card['date']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="editIrrigateSource">Source:</label>
                                <select class="form-control" id="editIrrigateSource" name="editIrrigateSource" required>
                                    <option value="N/A" style="color: grey;" <?php echo ($card['source'] === 'N/A') ? 'selected' : ''; ?>>N/A</option>
                                    <option value="Light" <?php echo ($card['source'] === 'Light') ? 'selected' : ''; ?>>Light</option>
                                    <option value="Solar" <?php echo ($card['source'] === 'Solar') ? 'selected' : ''; ?>>Solar</option>
                                    <option value="Rain" <?php echo ($card['source'] === 'Rain') ? 'selected' : ''; ?>>Rain</option>
                                    <option value="Diesel" <?php echo ($card['source'] === 'Diesel') ? 'selected' : ''; ?>>Diesel</option>
                                    <option value="Canal Water" <?php echo ($card['source'] === 'Canal Water') ? 'selected' : ''; ?>>Canal Water</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="editIrrigateTime">Time:</label>
                                <input type="text" class="form-control" id="editIrrigateTime" name="editIrrigateTime" value="<?php echo $card['irrigate_time']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="editIrrigateStatus">Status:</label>
                                <select class="form-control" id="editIrrigateStatus" name="editIrrigateStatus" required>
                                    <option value="Pending" <?php echo ($card['status'] === 'Pending') ? 'selected' : ''; ?>>Pending</option>
                                    <option value="Done" <?php echo ($card['status'] === 'Done') ? 'selected' : ''; ?>>Done</option>
                                </select>
                            </div>

                            <button type="button" class="btn btn-success" onclick="updateIrrigateRecord(<?php echo $card['id']; ?>, 'editModal<?php echo

                            $card['id']; ?>')">Update</button>
                            <button type="button" class="btn btn-danger" onclick="deleteIrrigateRecord(<?php echo $card['id']; ?>)">Delete</button>
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
                            <h3 style="color: #9DCD5A;">Irrigate</h3>
                        </div>
                    </div>
                    <!-- Cards Container -->
                    <div class="row">
                        <!-- Displaying cards -->
                        <?php while ($card = mysqli_fetch_assoc($result)) : ?>
                            <div class="card-container col-lg-4 col-md-6 col-sm-12">
                                <div class="card irrigate-card">
                                    <div class="card-body task-card-body">
                                        <div class="row">
                                            <div class="col-lg-9 col-md-9 col-sm-9 info-card-content">
                                                <?php
                                                // Display status tag with border
                                                $statusColor = ($card['status'] == 'Pending') ? 'red' : '#9DCD5A';
                                                echo '<p class="plan-task-tag" style="color: ' . $statusColor . '; border: 2px solid ' . $statusColor . ';">' . $card['status'] . '</p>';

                                                // Display other card information
                                                echo '<h6 class="date">' . $card['date'] . '</h6>';
                                                echo '<p><strong>Source:</strong> ' . ($card['source'] ? $card['source'] : 'N/A') . '</p>';
                                                echo '<p><strong>Times:</strong> ' . $card['irrigate_time'] . '</p>';
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
                            <!-- Adjust modal attributes for the Irrigate page -->
                            <button class="new-record-button" type="button" data-toggle="modal" data-target="#myModal">
                                <img src="assets/img/icons/plus-icon.svg" alt="Plus Icon" class="new-record-button-icon">
                                <span class="new-record-button-text">New Record</span>
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
    // Create Record Function for Irrigate
    function createIrrigateRecord() {
        // Validate the form
        if (validateIrrigateForm('newIrrigateRecordForm')) {
            // Get form values
            var date = document.getElementById('irrigateDate').value;
            var source = 'N/A';
            var status = 'Pending';
            var irrigate_time = document.getElementById('irrigateTime').value; // Get irrigate_time

            // Create FormData object
            var formData = new FormData();
            formData.append('date', date);
            formData.append('source', source);
            formData.append('status', status);
            formData.append('irrigate_time', irrigate_time); // Add irrigate_time

            // Make an AJAX request to handle form submission
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'irrigate_create.php', true);
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

    // Update Record Function for Irrigate
    function updateIrrigateRecord(id, modalId) {
        // Validate the form
        var formId = 'editIrrigateRecordForm' + id;
        if (validateIrrigateForm(formId)) {
            // Get form values using the dynamic formId
            var date = document.getElementById(modalId).querySelector('#editIrrigateDate').value;
            var source = document.getElementById(modalId).querySelector('#editIrrigateSource').value;
            var status = document.getElementById(modalId).querySelector('#editIrrigateStatus').value;
            var irrigate_time = document.getElementById(modalId).querySelector('#editIrrigateTime').value; // Get irrigate_time

            // Create FormData object
            var formData = new FormData();
            formData.append('id', id);
            formData.append('date', date);
            formData.append('source', source);
            formData.append('status', status);
            formData.append('irrigate_time', irrigate_time); // Add irrigate_time

            // Make an AJAX request to handle form submission
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'irrigate_update.php', true);
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

    // Delete Record Function for Irrigate
    function deleteIrrigateRecord(id) {
        var confirmDelete = confirm('Are you sure you want to delete this record?');
        if (confirmDelete) {
            // Make an AJAX request to handle record deletion
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'irrigate_delete.php', true);
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

    // Form Validation Function for Irrigate
    function validateIrrigateForm(formId) {
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

        // Additional validation for source field in edit mode
        if (formId.startsWith('editIrrigateRecordForm') && document.getElementById(formId).querySelector('#editIrrigateSource').value.trim() === 'N/A') {
            isValid = false;
            alert('Please select a valid source.');
        }

        return isValid;
    }

</script>

</body>
</html>
