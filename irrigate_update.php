<?php
// Include database connection
include '../progressive_farmer/db_conn.php';

// Get form data using POST method
$id = $_POST['id'];
$date = $_POST['date'];
$source = isset($_POST['source']) ? $_POST['source'] : null; // Handle null for 'N/A'
$status = $_POST['status'];

// SQL query to update data in the 'irrigate' table
$sql = "UPDATE irrigate SET date='$date', source='$source', status='$status' WHERE id=$id";

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
