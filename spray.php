<!DOCTYPE html>
<html lang="en">

<?php include 'layouts/header.php' ?>

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
                <!-- Your form and input fields for a new spray record go here -->
                <form id="newSprayRecordForm" method="post">
                    <div class="form-group">
                        <label for="sprayDate">Date:</label>
                        <input type="date" class="form-control" id="sprayDate" name="sprayDate" required>
                    </div>
                    <div class="form-group">
                        <label for="medicine">Medicine:</label>
                        <input type="text" class="form-control" id="medicine" name="medicine" required>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount (Bags):</label>
                        <input type="number" class="form-control" id="amount" name="amount" required>
                    </div>
                    <div class="form-group">
                        <label for="cost">Cost (Rs.):</label>
                        <input type="number" class="form-control" id="cost" name="cost" required>
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
    include 'db_conn.php';
    // Retrieve data from the 'spray' table
    $sql = "SELECT * FROM spray";
    $result = mysqli_query($conn, $sql);

    while ($card = mysqli_fetch_assoc($result)) :
        ?>
        <!-- Edit Modal -->
        <!-- Edit Modal -->
        <div class="modal fade edit-modal" id="editModal<?php echo $card['id']; ?>">
        <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Edit Record</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form id="editSprayRecordForm<?php echo $card['id']; ?>" method="post">
                            <div class="form-group">
                                <label for="editSprayDate">Date:</label>
                                <input type="date" class="form-control" id="editSprayDate" name="editSprayDate" value="<?php echo $card['date']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="editMedicine">Medicine:</label>
                                <input type="text" class="form-control" id="editMedicine" name="editMedicine" value="<?php echo $card['medicine']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="editAmount">Amount (Bags):</label>
                                <input type="number" class="form-control" id="editAmount" name="editAmount" value="<?php echo $card['amount']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="editCost">Cost (Rs.):</label>
                                <input type="number" class="form-control" id="editCost" name="editCost" value="<?php echo $card['cost']; ?>" required>
                            </div>
                            <button type="button" class="btn btn-success" onclick="updateSprayRecord(<?php echo $card['id']; ?>, 'editModal<?php echo $card['id']; ?>')">Update</button>
                            <button type="button" class="btn btn-danger" onclick="deleteSprayRecord(<?php echo $card['id']; ?>)">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Edit Modal -->
    <?php endwhile; ?>
</div>
<!-- End Edit Modals Container -->


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
                            <h3 style="color: #9DCD5A;">Spray</h3>
                        </div>
                    </div>
                    <!-- Cards Container -->
                    <div class="row">
                        <?php
                        include 'db_conn.php';
                        // Retrieve data from the 'spray' table
                        $sql = "SELECT * FROM spray";
                        $result = mysqli_query($conn, $sql);
                        ?>
                        <!-- Cards Container -->
                        <div class="row">
<!--                            Displaying cards-->
                            <?php while ($card = mysqli_fetch_assoc($result)) : ?>
                                <div class="card-container col-lg-4 col-md-6 col-sm-12">
                                    <div class="card spray-card">
                                        <div class="card-body task-card-body">
                                            <div class="row">
                                                <div class="col-lg-9 col-md-9 col-sm-9 info-card-content">
                                                    <?php
                                                    // Display card information based on the 'spray' table fields
                                                    echo '<h6 class="date">' . $card['date'] . '</h6>';
                                                    echo '<p><strong>Medicine:</strong> ' . $card['medicine'] . '</p>';
                                                    echo '<p><strong>Amount:</strong> ' . $card['amount'] . '</p>';
                                                    echo '<p><strong>Cost:</strong> Rs. ' . intval($card['cost']) . '</p>';
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
                    </div>

                    <!-- Add New Record Button Container -->
                    <div class="row">
                        <div class="col-12 text-center mt-4">
                            <!-- Adjust modal attributes for the Spray page -->
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
        <?php include 'layouts/Footer.php' ?>

    </div>
</div>


<script>
    // Create Record Function for Spray
    function createSprayRecord() {
        // Validate the form
        if (validateSprayForm('newSprayRecordForm')) {
            // Get form values
            var date = document.getElementById('sprayDate').value;
            var medicine = document.getElementById('medicine').value;
            var amount = document.getElementById('amount').value;
            var cost = document.getElementById('cost').value;

            // Create FormData object
            var formData = new FormData();
            formData.append('date', date);
            formData.append('medicine', medicine);
            formData.append('amount', amount);
            formData.append('cost', cost);

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
            var medicine = document.getElementById(modalId).querySelector('#editMedicine').value;
            var amount = document.getElementById(modalId).querySelector('#editAmount').value;
            var cost = document.getElementById(modalId).querySelector('#editCost').value;

            // Create FormData object
            var formData = new FormData();
            formData.append('id', id);
            formData.append('date', date);
            formData.append('medicine', medicine);
            formData.append('amount', amount);
            formData.append('cost', cost);

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
    // Confirm deletion
    var confirmDelete = confirm("Are you sure you want to delete this record?");
    if (confirmDelete) {
    // Make an AJAX request to handle deletion
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'spray_delete.php', true);
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

    // Validate Form Function for Spray
    function validateSprayForm(formId) {
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

    //Displaying Edit-Modal Above Backdrop in Tab and Mobile
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
