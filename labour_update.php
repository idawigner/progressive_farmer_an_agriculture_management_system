<?php
// Include database connection
include '../progressive_farmer/db_conn.php';

// Get form data using POST method
$id = $_POST['id'];
$name = $_POST['name'];
$designation = $_POST['designation'];
$details = $_POST['details'];

// SQL query to update data in the 'labour' table
$sql = "UPDATE labour SET name = '$name', designation = '$designation', details = '$details' WHERE id = '$id'";

// Check if the query is successful
if (mysqli_query($conn, $sql)) {
    // Return success status and message
    $response = array('status' => 'success', 'message' => 'Labour record updated successfully.');
} else {
    // Return error status and message
    $response = array('status' => 'error', 'message' => 'Error updating labour record: ' . mysqli_error($conn));
}

// Close the database connection
mysqli_close($conn);

// Return JSON response
echo json_encode($response);
