<?php
// Include database connection
include '../progressive_farmer/db_conn.php';

// Get form data using POST method
$id = $_POST['id'];
$date = $_POST['date'];
$name = $_POST['name'];
$quantity = $_POST['quantity'];
$companyName = $_POST['companyName'];
$status = $_POST['status'];
$plotId = mysqli_real_escape_string($conn, $_POST['plotId']); // Get plot_id from the form data

// SQL query to update record in the 'fertilize' table
$sql = "UPDATE fertilize SET date='$date', name='$name', quantity='$quantity', company_name='$companyName', status='$status' WHERE id='$id' AND plot_id = '$plotId'";

// Check if the query is successful
if (mysqli_query($conn, $sql)) {
    // Return success status and message
    $response = array('status' => 'success', 'message' => 'Record updated successfully.');
} else {
    // Return error status and message
    $response = array('status' => 'error', 'message' => 'Error updating record: ' . mysqli_error($conn));
}

// Close the database connection
mysqli_close($conn);

// Return JSON response
echo json_encode($response);
