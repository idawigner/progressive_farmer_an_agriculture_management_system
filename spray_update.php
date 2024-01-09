<?php
// Include database connection
include '../progressive_farmer/db_conn.php';

// Get form data using POST method
$id = $_POST['id'];
$date = $_POST['date'];
$medicine = $_POST['medicine'];
$quantity = $_POST['quantity'];
$details = isset($_POST['details']) ? $_POST['details'] : null;
$status = $_POST['status'];
$plotId = mysqli_real_escape_string($conn, $_POST['plotId']); // Get plot_id from the form data

// SQL query to update data in the 'spray' table
$sql = "UPDATE spray SET date = '$date', medicine = '$medicine', quantity = '$quantity', details = '$details', status = '$status' WHERE id = $id AND plot_id = $plotId";

// Check if the query is successful
if (mysqli_query($conn, $sql)) {
    // Return success status and message
    $response = array('status' => 'success', 'message' => 'Spray record updated successfully.');
} else {
    // Return error status and message
    $response = array('status' => 'error', 'message' => 'Error updating spray record: ' . mysqli_error($conn));
}

// Close the database connection
mysqli_close($conn);

// Return JSON response
echo json_encode($response);
