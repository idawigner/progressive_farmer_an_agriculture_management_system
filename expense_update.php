<?php
// Include database connection
include '../progressive_farmer/db_conn.php';

// Get form data using POST method
$id = $_POST['id'];
$date = $_POST['date'];
$type = $_POST['type'];
$cost = $_POST['cost'];

// SQL query to update data in the 'expense' table
$sql = "UPDATE expense SET date = '$date', type = '$type', cost = '$cost' WHERE id = '$id'";

// Check if the query is successful
if (mysqli_query($conn, $sql)) {
    // Return success status and message
    $response = array('status' => 'success', 'message' => 'Expense record updated successfully.');
} else {
    // Return error status and message
    $response = array('status' => 'error', 'message' => 'Error updating expense record: ' . mysqli_error($conn));
}

// Close the database connection
mysqli_close($conn);

// Return JSON response
echo json_encode($response);
