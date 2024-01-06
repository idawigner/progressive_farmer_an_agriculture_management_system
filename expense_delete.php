<?php
// Include database connection
include '../progressive_farmer/db_conn.php';

// Get record ID from POST data
$id = $_POST['id'];

// SQL query to delete data from the 'expense' table
$sql = "DELETE FROM expense WHERE id = '$id'";

// Check if the query is successful
if (mysqli_query($conn, $sql)) {
    // Return success status and message
    $response = array('status' => 'success', 'message' => 'Expense record deleted successfully.');
} else {
    // Return error status and message
    $response = array('status' => 'error', 'message' => 'Error deleting expense record: ' . mysqli_error($conn));
}

// Close the database connection
mysqli_close($conn);

// Return JSON response
echo json_encode($response);
