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
                <!-- Form and input fields for a new fertilize record go here -->
                <form id="newFertilizeRecordForm" method="post">
                    <div class="form-group">
                        <label for="fertilizeDate">Date:</label>
                        <input type="date" class="form-control" id="fertilizeDate" name="fertilizeDate" required>
                    </div>
                    <div class="form-group">
                        <label for="fertilizeName">Name:</label>
                        <input type="text" class="form-control" id="fertilizeName" name="fertilizeName" required>
                    </div>
                    <div class="form-group">
                        <label for="fertilizeQuantity">Quantity (in Bags):</label>
                        <input type="text" class="form-control" id="fertilizeQuantity" name="fertilizeQuantity" required>
                    </div>
                    <div class="form-group">
                        <label for="fertilizeCompanyName">Company Name:</label>
                        <input type="text" class="form-control" id="fertilizeCompanyName" name="fertilizeCompanyName">
                    </div>
                    <div class="form-group">
                        <label for="fertilizeStatus">Status:</label>
                        <select class="form-control" id="fertilizeStatus" name="fertilizeStatus" required disabled>
                            <option value="Pending" style="color: grey;" selected>Pending</option>
                            <option value="Done">Done</option>
                        </select>
                    </div>

                    <button type="button" class="btn btn-primary" onclick="createFertilizeRecord()">Save</button>
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
    // Retrieve data from the 'fertilize' table
    $sql = "SELECT * FROM fertilize";
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
                        <form id="editFertilizeRecordForm<?php echo $card['id']; ?>" method="post">
                            <div class="form-group">
                                <label for="editFertilizeDate">Date:</label>
                                <input type="date" class="form-control" id="editFertilizeDate" name="editFertilizeDate" value="<?php echo $card['date']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="editFertilizeName">Name:</label>
                                <input type="text" class="form-control" id="editFertilizeName" name="editFertilizeName" value="<?php echo $card['name']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="editFertilizeQuantity">Quantity (in Bags):</label>
                                <input type="text" class="form-control" id="editFertilizeQuantity" name="editFertilizeQuantity" value="<?php echo $card['quantity']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="editFertilizeCompanyName">Company Name:</label>
                                <input type="text" class="form-control" id="editFertilizeCompanyName" name="editFertilizeCompanyName" value="<?php echo $card['company_name']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="editFertilizeStatus">Status:</label>
                                <select class="form-control" id="editFertilizeStatus" name="editFertilizeStatus" required>
                                    <option value="Pending" <?php echo ($card['status'] === 'Pending') ? 'selected' : ''; ?>>Pending</option>
                                    <option value="Done" <?php echo ($card['status'] === 'Done') ? 'selected' : ''; ?>>Done</option>
                                </select>
                            </div>
                            <!-- Add your code above this line -->

                            <button type="button" class="btn btn-success" onclick="updateFertilizeRecord(<?php echo $card['id']; ?>, 'editModal<?php echo $card['id']; ?>')">Update</button>
                            <button type="button" class="btn btn-danger" onclick="deleteFertilizeRecord(<?php echo $card['id']; ?>)">Delete</button>
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
                            <h3 style="color: #9DCD5A;">Fertilize</h3>
                        </div>
                    </div>
                    <!-- Cards Container -->
                    <div class="row">
                        <!-- Displaying cards -->
                        <?php while ($card = mysqli_fetch_assoc($result)) : ?>
                            <div class="card-container col-lg-4 col-md-6 col-sm-12">
                                <div class="card fertilize-card">
                                    <div class="card-body task-card-body">
                                        <div class="row">
                                            <div class="col-lg-9 col-md-9 col-sm-9 info-card-content">
                                                <?php
                                                // Display status tag with border
                                                $statusColor = ($card['status'] == 'Pending') ? 'red' : '#9DCD5A';
                                                echo '<p class="plan-task-tag" style="color: ' . $statusColor . '; border: 2px solid ' . $statusColor . ';">' . $card['status'] . '</p>';

                                                // Display other card information
                                                echo '<h6 class="date">' . $card['date'] . '</h6>';
                                                echo '<p><strong>Name:</strong> ' . $card['name'] . '</p>';
                                                echo '<p><strong>Quantity:</strong> ' . $card['quantity'] . ' Bags</p>';
                                                echo '<p><strong>Company Name:</strong> ' . ($card['company_name'] ? $card['company_name'] : 'N/A') . '</p>';
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
                            <!-- Adjust modal attributes for the Fertilize page -->
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
    // Create Record Function for Fertilize
    function createFertilizeRecord() {
        // Validate the form
        if (validateFertilizeForm('newFertilizeRecordForm')) {
            // Get form values
            var date = document.getElementById('fertilizeDate').value;
            var name = document.getElementById('fertilizeName').value;
            var quantity = document.getElementById('fertilizeQuantity').value;
            var companyName = document.getElementById('fertilizeCompanyName').value;
            var status = 'Pending';  // Set default status to 'Pending'

            // Create FormData object
            var formData = new FormData();
            formData.append('date', date);
            formData.append('name', name);
            formData.append('quantity', quantity);
            formData.append('companyName', companyName);
            formData.append('status', status);

            // Make an AJAX request to handle form submission
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'fertilize_create.php', true);
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

    // Update Record Function for Fertilize
    function updateFertilizeRecord(id, modalId) {
        // Validate the form
        var formId = 'editFertilizeRecordForm' + id;
        if (validateFertilizeForm(formId)) {
            // Get form values using the dynamic formId
            var date = document.getElementById(modalId).querySelector('#editFertilizeDate').value;
            var name = document.getElementById(modalId).querySelector('#editFertilizeName').value;
            var quantity = document.getElementById(modalId).querySelector('#editFertilizeQuantity').value;
            var companyName = document.getElementById(modalId).querySelector('#editFertilizeCompanyName').value;
            var status = document.getElementById(modalId).querySelector('#editFertilizeStatus').value;

            // Create FormData object
            var formData = new FormData();
            formData.append('id', id);
            formData.append('date', date);
            formData.append('name', name);
            formData.append('quantity', quantity);
            formData.append('companyName', companyName);
            formData.append('status', status);

            // Make an AJAX request to handle form submission
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'fertilize_update.php', true);
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

    // Delete Record Function for Fertilize
    function deleteFertilizeRecord(id) {
        var confirmDelete = confirm('Are you sure you want to delete this record?');
        if (confirmDelete) {
            // Make an AJAX request to handle record deletion
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'fertilize_delete.php', true);
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

    // Form Validation Function for Fertilize
    function validateFertilizeForm(formId) {
        var isValid = true;
        var formElements = document.getElementById(formId).elements;

        // Check if the form is the new record form (not an edit modal)
        var isNewRecordForm = formElements[0].name === 'fertilizeDate';

        for (var i = 0; i < formElements.length; i++) {
            // Check if any field except company name is empty in new record
            if (isNewRecordForm && formElements[i].type !== 'button' && formElements[i].name !== 'fertilizeCompanyName' && formElements[i].value.trim() === '') {
                isValid = false;
                alert('Please fill in all fields.');
                break;
            }

            // Check if any required field except company name is empty in edit mode
            if (!isNewRecordForm && formElements[i].type !== 'button' && formElements[i].name !== 'editFertilizeCompanyName' && formElements[i].value.trim() === '') {
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
