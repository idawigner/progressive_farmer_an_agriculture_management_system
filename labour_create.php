<?php
// Include database connection
include '../progressive_farmer/db_conn.php';

// Get form data using POST method
$name = $_POST['name'];
$designation = $_POST['designation'];
$details = isset($_POST['details']) ? $_POST['details'] : null; // Handle null for empty details

// SQL query to insert data into the 'labour' table
$sql = "INSERT INTO labour (name, designation, details) VALUES ('$name', '$designation', '$details')";

// Check if the query is successful
if (mysqli_query($conn, $sql)) {
    // Return success status and message
    $response = array('status' => 'success', 'message' => 'Labour record added successfully.');
} else {
    // Return error status and message
    $response = array('status' => 'error', 'message' => 'Error adding labour record: ' . mysqli_error($conn));
}

// Close the database connection
mysqli_close($conn);

// Return JSON response
echo json_encode($response);
