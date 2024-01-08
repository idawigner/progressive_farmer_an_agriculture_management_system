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
                <h3 class="modal-title">Add New Labour Record</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Form and input fields for a new labour record go here -->
                <form id="newLabourRecordForm" method="post">
                    <div class="form-group">
                        <label for="labourName">Name:</label>
                        <input type="text" class="form-control" id="labourName" name="labourName" placeholder="Ali Khan" required>
                    </div>
                    <div class="form-group">
                        <label for="labourDesignation">Designation:</label>
                        <input type="text" class="form-control" id="labourDesignation" name="labourDesignation" placeholder="Driver" required>
                    </div>
                    <div class="form-group">
                        <label for="labourDetails">Details:</label>
                        <textarea class="form-control" id="labourDetails" name="labourDetails" placeholder="Optional"></textarea>
                    </div>

                    <button type="button" class="btn btn-primary" onclick="createLabourRecord()">Save</button>
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
    // Retrieve data from the 'labour' table
    $sql = "SELECT * FROM labour";
    $result = mysqli_query($conn, $sql);

    // Fetch data once
    while ($card = mysqli_fetch_assoc($result)) :
        ?>
        <!-- Edit Modal -->
        <div class="modal fade edit-modal" id="editModal<?php echo $card['id']; ?>">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Edit Labour Record</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form id="editLabourRecordForm<?php echo $card['id']; ?>" method="post">
                            <div class="form-group">
                                <label for="editLabourName">Name:</label>
                                <input type="text" class="form-control" id="editLabourName" name="editLabourName" value="<?php echo $card['name']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="editLabourDesignation">Designation:</label>
                                <input type="text" class="form-control" id="editLabourDesignation" name="editLabourDesignation" value="<?php echo $card['designation']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="editLabourDetails">Details:</label>
                                <textarea class="form-control" id="editLabourDetails" name="editLabourDetails"><?php echo $card['details']; ?></textarea>
                            </div>

                            <button type="button" class="btn btn-success" onclick="updateLabourRecord(<?php echo $card['id']; ?>, 'editModal<?php echo $card['id']; ?>')">Update</button>
                            <button type="button" class="btn btn-danger" onclick="deleteLabourRecord(<?php echo $card['id']; ?>)">Delete</button>
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
                            <h3 style="color: #9DCD5A;">Labour Records</h3>
                        </div>
                    </div>
                    <!-- Cards Container -->
                    <div class="row">
                        <!-- Displaying cards -->
                        <?php while ($card = mysqli_fetch_assoc($result)) : ?>
                            <div class="card-container col-lg-4 col-md-6 col-sm-12">
                                <div class="card labour-card">
                                    <div class="card-body task-card-body">
                                        <div class="row">
                                            <div class="col-lg-9 col-md-9 col-sm-9 info-card-content scrollable-info-card-content-labour">
                                                <?php
                                                // Display card information
                                                echo '<p><strong>Name:</strong> ' . $card['name'] . '</p>';
                                                echo '<p><strong>Designation:</strong> ' . $card['designation'] . '</p>';
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
                            <!-- Adjust modal attributes for the Labour page -->
                            <button class="new-record-button" type="button" data-toggle="modal" data-target="#myModal">
                                <img src="assets/img/icons/plus-icon.svg" alt="Plus Icon" class="new-record-button-icon">
                                <span class="new-record-button-text">New Labour Record</span>
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
    // Create Record Function for Labour
    function createLabourRecord() {
        // Validate the form
        if (validateLabourForm('newLabourRecordForm')) {
            // Get form values
            var name = document.getElementById('labourName').value;
            var designation = document.getElementById('labourDesignation').value;
            var details = document.getElementById('labourDetails').value;

            // Create FormData object
            var formData = new FormData();
            formData.append('name', name);
            formData.append('designation', designation);
            formData.append('details', details);

            // Make an AJAX request to handle form submission
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'labour_create.php', true);
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

    // Update Record Function for Labour
    function updateLabourRecord(id, modalId) {
        // Validate the form
        var formId = 'editLabourRecordForm' + id;
        if (validateLabourForm(formId)) {
            // Get form values using the dynamic formId
            var name = document.getElementById(modalId).querySelector('#editLabourName').value;
            var designation = document.getElementById(modalId).querySelector('#editLabourDesignation').value;
            var details = document.getElementById(modalId).querySelector('#editLabourDetails').value;

            // Create FormData object
            var formData = new FormData();
            formData.append('id', id);
            formData.append('name', name);
            formData.append('designation', designation);
            formData.append('details', details);

            // Make an AJAX request to handle form submission
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'labour_update.php', true);
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

    // Delete Record Function for Labour
    function deleteLabourRecord(id) {
        var confirmDelete = confirm('Are you sure you want to delete this record?');
        if (confirmDelete) {
            // Make an AJAX request to handle record deletion
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'labour_delete.php', true);
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

    // Form Validation Function for Labour
    function validateLabourForm(formId) {
        var isValid = true;
        var formElements = document.getElementById(formId).elements;

        // Check if the form is the new record form (not an edit modal)
        var isNewRecordForm = formElements[0].name === 'labourName';

        for (var i = 0; i < formElements.length; i++) {
            // Check if any field except Details is empty in new record
            if (isNewRecordForm && formElements[i].type !== 'button' && formElements[i].name !== 'labourDetails' && formElements[i].value.trim() === '') {
                isValid = false;
                alert('Please fill in all fields.');
                break;
            }

            // Check if any required field except company name is empty in edit mode
            if (!isNewRecordForm && formElements[i].type !== 'button' && formElements[i].name !== 'editLabourDetails' && formElements[i].value.trim() === '') {
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
