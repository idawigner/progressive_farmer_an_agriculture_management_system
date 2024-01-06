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
                <h3 class="modal-title">Add New Expense</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Form and input fields for a new expense record go here -->
                <form id="newExpenseRecordForm" method="post">
                    <div class="form-group">
                        <label for="expenseDate">Date:</label>
                        <input type="date" class="form-control" id="expenseDate" name="expenseDate" required>
                    </div>
                    <div class="form-group">
                        <label for="expenseType">Type:</label>
                        <input type="text" class="form-control" id="expenseType" name="expenseType" placeholder="e.g. Fertilizer, Utility Bill" required>
                    </div>
                    <div class="form-group">
                        <label for="expenseCost">Cost (in Rs.):</label>
                        <input type="number" class="form-control" id="expenseCost" name="expenseCost" required>
                    </div>

                    <button type="button" class="btn btn-primary" onclick="createExpenseRecord()">Save</button>
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
    // Retrieve data from the 'expense' table
    $sql = "SELECT * FROM expense";
    $result = mysqli_query($conn, $sql);

    // Fetch data once
    while ($card = mysqli_fetch_assoc($result)) :
        ?>
        <!-- Edit Modal -->
        <div class="modal fade edit-modal" id="editModal<?php echo $card['id']; ?>">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Edit Expense</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form id="editExpenseRecordForm<?php echo $card['id']; ?>" method="post">
                            <div class="form-group">
                                <label for="editExpenseDate">Date:</label>
                                <input type="date" class="form-control" id="editExpenseDate" name="editExpenseDate" value="<?php echo $card['date']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="editExpenseType">Type:</label>
                                <input type="text" class="form-control" id="editExpenseType" name="editExpenseType" value="<?php echo $card['type']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="editExpenseCost">Cost (in Rs.):</label>
                                <input type="number" class="form-control" id="editExpenseCost" name="editExpenseCost" value="<?php echo $card['cost']; ?>" required>
                            </div>

                            <button type="button" class="btn btn-success" onclick="updateExpenseRecord(<?php echo $card['id']; ?>, 'editModal<?php echo $card['id']; ?>')">Update</button>
                            <button type="button" class="btn btn-danger" onclick="deleteExpenseRecord(<?php echo $card['id']; ?>)">Delete</button>
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
                            <h3 style="color: #9DCD5A;">Expense</h3>
                        </div>
                    </div>
                    <!-- Cards Container -->
                    <div class="row">
                        <!-- Displaying cards -->
                        <?php while ($card = mysqli_fetch_assoc($result)) : ?>
                            <div class="card-container col-lg-4 col-md-6 col-sm-12">
                                <div class="card expense-card">
                                    <div class="card-body task-card-body">
                                        <div class="row">
                                            <div class="col-lg-9 col-md-9 col-sm-9 info-card-content">
                                                <?php
                                                // Display other card information
                                                echo '<h6 class="date">' . $card['date'] . '</h6>';
                                                echo '<p><strong>Type:</strong> ' . $card['type'] . '</p>';
                                                echo '<p><strong>Cost:</strong> Rs. ' . number_format($card['cost'], 0) . '</p>';
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
                            <!-- Adjust modal attributes for the Expense page -->
                            <button class="new-record-button" type="button" data-toggle="modal" data-target="#myModal">
                                <img src="assets/img/icons/plus-icon.svg" alt="Plus Icon" class="new-record-button-icon">
                                <span class="new-record-button-text">New Expense</span>
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
    // Create Record Function for Expense
    function createExpenseRecord() {
        // Validate the form
        if (validateExpenseForm('newExpenseRecordForm')) {
            // Get form values
            var date = document.getElementById('expenseDate').value;
            var type = document.getElementById('expenseType').value;
            var cost = document.getElementById('expenseCost').value;

            // Create FormData object
            var formData = new FormData();
            formData.append('date', date);
            formData.append('type', type);
            formData.append('cost', cost);

            // Make an AJAX request to handle form submission
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'expense_create.php', true);
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

    // Update Record Function for Expense
    function updateExpenseRecord(id, modalId) {
        // Validate the form
        var formId = 'editExpenseRecordForm' + id;
        if (validateExpenseForm(formId)) {
            // Get form values using the dynamic formId
            var date = document.getElementById(modalId).querySelector('#editExpenseDate').value;
            var type = document.getElementById(modalId).querySelector('#editExpenseType').value;
            var cost = document.getElementById(modalId).querySelector('#editExpenseCost').value;

            // Create FormData object
            var formData = new FormData();
            formData.append('id', id);
            formData.append('date', date);
            formData.append('type', type);
            formData.append('cost', cost);

            // Make an AJAX request to handle form submission
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'expense_update.php', true);
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

    // Delete Record Function for Expense
    function deleteExpenseRecord(id) {
        var confirmDelete = confirm('Are you sure you want to delete this record?');
        if (confirmDelete) {
            // Make an AJAX request to handle record deletion
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'expense_delete.php', true);
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

    // Form Validation Function for Expense
    function validateExpenseForm(formId) {
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

</body>
</html>
