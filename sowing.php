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
                <!-- Your form and input fields for a new sowing record go here -->
                <form id="newSowingRecordForm" method="post">
                    <div class="form-group">
                        <label for="sowingDate">Date:</label>
                        <input type="date" class="form-control" id="sowingDate" name="sowingDate" required>
                    </div>
                    <div class="form-group">
                        <label for="seed">Seed:</label>
                        <input type="text" class="form-control" id="seed" name="seed" required>
                    </div>
                    <div class="form-group">
                        <label for="seedCompany">Seed Company:</label>
                        <input type="text" class="form-control" id="seedCompany" name="seedCompany" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select class="form-control" id="status" name="status" required disabled>
                            <option value="Pending" style="color: grey;" selected>Pending</option>
                            <option value="Done">Done</option>
                        </select>
                    </div>

                    <button type="button" class="btn btn-primary" onclick="createSowingRecord()">Save</button>
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
    // Retrieve data from the 'sowing' table
    $sql = "SELECT * FROM sowing";
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
                        <form id="editSowingRecordForm<?php echo $card['id']; ?>" method="post">
                            <div class="form-group">
                                <label for="editSowingDate">Date:</label>
                                <input type="date" class="form-control" id="editSowingDate" name="editSowingDate" value="<?php echo $card['date']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="editSeed">Seed:</label>
                                <input type="text" class="form-control" id="editSeed" name="editSeed" value="<?php echo $card['seed']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="editSeedCompany">Seed Company:</label>
                                <input type="text" class="form-control" id="editSeedCompany" name="editSeedCompany" value="<?php echo $card['seed_company']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="editStatus">Status:</label>
                                <select class="form-control" id="editStatus" name="editStatus" required>
                                    <option value="Pending" <?php echo ($card['status'] === 'Pending') ? 'selected' : ''; ?>>Pending</option>
                                    <option value="Done" <?php echo ($card['status'] === 'Done') ? 'selected' : ''; ?>>Done</option>
                                </select>
                            </div>

                            <button type="button" class="btn btn-success" onclick="updateSowingRecord(<?php echo $card['id']; ?>, 'editModal<?php echo $card['id']; ?>')">Update</button>
                            <button type="button" class="btn btn-danger" onclick="deleteSowingRecord(<?php echo $card['id']; ?>)">Delete</button>
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
                            <h3 style="color: #9DCD5A;">Sowing</h3>
                        </div>
                    </div>
                    <!-- Cards Container -->
                    <div class="row">
                        <!-- Displaying cards -->
                        <?php while ($card = mysqli_fetch_assoc($result)) : ?>
                            <div class="card-container col-lg-4 col-md-6 col-sm-12">
                                <div class="card sowing-card">
                                    <div class="card-body task-card-body">
                                        <div class="row">
                                            <div class="col-lg-9 col-md-9 col-sm-9 info-card-content">
                                                <?php
                                                // Display other card information
                                                echo '<h6 class="date">' . $card['date'] . '</h6>';
                                                echo '<p><strong>Seed:</strong> ' . $card['seed'] . '</p>';
                                                echo '<p><strong>Seed Company:</strong> ' . $card['seed_company'] . '</p>';

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
                            <!-- Adjust modal attributes for the Sowing page -->
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
    // Create Record Function for Sowing
    function createSowingRecord() {
        // Validate the form
        if (validateSowingForm('newSowingRecordForm')) {
            // Get form values
            var date = document.getElementById('sowingDate').value;
            var seed = document.getElementById('seed').value;
            var seedCompany = document.getElementById('seedCompany').value;

            // Create FormData object
            var formData = new FormData();
            formData.append('date', date);
            formData.append('seed', seed);
            formData.append('seedCompany', seedCompany);

            // Make an AJAX request to handle form submission
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'sowing_create.php', true);
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

    // Update Record Function for Sowing
    function updateSowingRecord(id, modalId) {
        // Validate the form
        var formId = 'editSowingRecordForm' + id;
        if (validateSowingForm(formId)) {
            // Get form values using the dynamic formId
            var date = document.getElementById(modalId).querySelector('#editSowingDate').value;
            var seed = document.getElementById(modalId).querySelector('#editSeed').value;
            var seedCompany = document.getElementById(modalId).querySelector('#editSeedCompany').value;
            var status = document.getElementById(modalId).querySelector('#editStatus').value; // Add this line

            // Create FormData object
            var formData = new FormData();
            formData.append('id', id);
            formData.append('date', date);
            formData.append('seed', seed);
            formData.append('seedCompany', seedCompany);
            formData.append('status', status); // Add this line

            // Make an AJAX request to handle form submission
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'sowing_update.php', true);
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

    // Delete Record Function for Sowing
    function deleteSowingRecord(id) {
        // Confirm deletion
        var confirmDelete = confirm("Are you sure you want to delete this record?");
        if (confirmDelete) {
            // Make an AJAX request to handle deletion
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'sowing_delete.php', true);
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

    // Validate Form Function for Sowing
    function validateSowingForm(formId) {
        var isValid = true;
        var formElements = document.getElementById(formId).elements;
        for (var i = 0; i < formElements.length; i++) {
            if (formElements[i].type !== 'button' && formElements[i].value.trim() === '') {
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