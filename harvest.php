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
                <!-- Form and input fields for a new harvest record go here -->
                <form id="newHarvestRecordForm" method="post">
                    <div class="form-group">
                        <label for="harvestDate">Date:</label>
                        <input type="date" class="form-control" id="harvestDate" name="harvestDate" required>
                    </div>
                    <div class="form-group">
                        <label for="harvestTime">Time:</label>
                        <input type="text" class="form-control" id="harvestTime" name="harvestTime">
                    </div>
                    <div class="form-group">
                        <label for="harvestDetails">Details:</label>
                        <textarea class="form-control" id="harvestDetails" name="harvestDetails" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="harvestStatus">Status:</label>
                        <select class="form-control" id="harvestStatus" name="harvestStatus" required disabled>
                            <option value="Pending" style="color: grey;" selected>Pending</option>
                            <option value="Done">Done</option>
                        </select>
                    </div>

                    <button type="button" class="btn btn-primary" onclick="createHarvestRecord()">Save</button>
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
    // Retrieve data from the 'harvest' table
    $sql = "SELECT * FROM harvest";
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
                        <form id="editHarvestRecordForm<?php echo $card['id']; ?>" method="post">
                            <div class="form-group">
                                <label for="editHarvestDate">Date:</label>
                                <input type="date" class="form-control" id="editHarvestDate" name="editHarvestDate" value="<?php echo $card['date']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="editHarvestTime">Time:</label>
                                <input type="text" class="form-control" id="editHarvestTime" name="editHarvestTime" value="<?php echo $card['time']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="editHarvestDetails">Details:</label>
                                <textarea class="form-control" id="editHarvestDetails" name="editHarvestDetails" rows="3" required><?php echo $card['details']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="editHarvestStatus">Status:</label>
                                <select class="form-control" id="editHarvestStatus" name="editHarvestStatus" required>
                                    <option value="Pending" <?php echo ($card['status'] === 'Pending') ? 'selected' : ''; ?>>Pending</option>
                                    <option value="Done" <?php echo ($card['status'] === 'Done') ? 'selected' : ''; ?>>Done</option>
                                </select>
                            </div>

                            <button type="button" class="btn btn-success" onclick="updateHarvestRecord(<?php echo $card['id']; ?>, 'editModal<?php echo $card['id']; ?>')">Update</button>
                            <button type="button" class="btn btn-danger" onclick="deleteHarvestRecord(<?php echo $card['id']; ?>)">Delete</button>
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
                            <h3 style="color: #9DCD5A;">Harvest</h3>
                        </div>
                    </div>
                    <!-- Cards Container -->
                    <div class="row">
                        <!-- Displaying cards -->
                        <?php while ($card = mysqli_fetch_assoc($result)) : ?>
                            <div class="card-container col-lg-4 col-md-6 col-sm-12">
                                <div class="card harvest-card">
                                    <div class="card-body task-card-body">
                                        <div class="row">
                                            <div class="col-lg-9 col-md-9 col-sm-9 info-card-content scrollable-info-card-content-harvest">
                                                <?php
                                                // Display other card information
                                                echo '<h6 class="date">' . $card['date'] . '</h6>';
                                                echo '<p><strong>Time:</strong> ' . $card['time'] . '</p>';
                                                echo '<p><strong>Details:</strong> ' . $card['details'] . '</p>';

                                                // Display status tag with border
                                                $statusColor = ($card['status'] == 'Pending') ? 'red' : '#9DCD5A';
                                                echo '<p class="plan-task-tag" style="color: ' . $statusColor . '; border: 2px solid ' . $statusColor . ';">' . $card['status'] . '</p>';
                                                ?>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 text-center edit-icon">
                                                <a href="#" data-toggle="modal" data-target="#editModal<?php echo $card['id']; ?>">
                                                    <img src="assets/img/icons/edit-pencil-icon.svg" alt="Edit Icon" class="edit-icon-img">
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
                            <!-- Adjust modal attributes for the Harvest page -->
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
    // Create Record Function for Harvest
    function createHarvestRecord() {
        // Validate the form
        if (validateHarvestForm('newHarvestRecordForm')) {
            // Get form values
            var date = document.getElementById('harvestDate').value;
            var time = document.getElementById('harvestTime').value;
            var details = document.getElementById('harvestDetails').value;

            // Create FormData object
            var formData = new FormData();
            formData.append('date', date);
            formData.append('time', time);
            formData.append('details', details);

            // Make an AJAX request to handle form submission
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'harvest_create.php', true);
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

    // Update Record Function for Harvest
    function updateHarvestRecord(id, modalId) {
        // Validate the form
        var formId = 'editHarvestRecordForm' + id;
        if (validateHarvestForm(formId)) {
            // Get form values using the dynamic formId
            var date = document.getElementById(modalId).querySelector('#editHarvestDate').value;
            var time = document.getElementById(modalId).querySelector('#editHarvestTime').value;
            var details = document.getElementById(modalId).querySelector('#editHarvestDetails').value;
            var status = document.getElementById(modalId).querySelector('#editHarvestStatus').value; // Add this line

            // Create FormData object
            var formData = new FormData();
            formData.append('id', id);
            formData.append('date', date);
            formData.append('time', time);
            formData.append('details', details);
            formData.append('status', status); // Add this line

            // Make an AJAX request to handle form submission
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'harvest_update.php', true);
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

    // Delete Record Function for Harvest
    function deleteHarvestRecord(id) {
        // Confirm deletion
        var confirmDelete = confirm("Are you sure you want to delete this record?");
        if (confirmDelete) {
            // Make an AJAX request to handle deletion
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'harvest_delete.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
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

    // Form Validation Function for Harvest
    function validateHarvestForm(formId) {
        var isValid = true;
        var formElements = document.getElementById(formId).elements;

        // Check if the form is the new record form (not an edit modal)
        var isNewRecordForm = formElements[0].name === 'harvestDate';

        for (var i = 0; i < formElements.length; i++) {
            // Check if any field except Details is empty in new record
            if (isNewRecordForm && formElements[i].type !== 'button' && formElements[i].name !== 'harvestDetails' && formElements[i].value.trim() === '') {
                isValid = false;
                alert('Please fill in all fields.');
                break;
            }

            // Check if any required field except company name is empty in edit mode
            if (!isNewRecordForm && formElements[i].type !== 'button' && formElements[i].name !== 'editHarvestDetails' && formElements[i].value.trim() === '') {
                isValid = false;
                alert('Please fill in all fields.');
                break;
            }
        }
        return isValid;
    }


    // Displaying Edit-Modal Above Backdrop in Tab and Mobile
    document.addEventListener('DOMContentLoaded', function () {
        if (window.innerWidth <= 991) {
            // On smaller screens, append the modal to the body
            var modalContainer = document.querySelector('.edit-modals-container');
            var modals = modalContainer.querySelectorAll('.edit-modal');

            modals.forEach(function (modal) {
                document.body.appendChild(modal);
            });
        }
    });

</script>

</body>
</html>
