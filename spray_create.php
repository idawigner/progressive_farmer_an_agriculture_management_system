<?php
// Include database connection
include '../progressive_farmer/db_conn.php';

// Get form data using POST method
$date = $_POST['date'];
$medicine = $_POST['medicine'];
$quantity = $_POST['quantity'];
$details = isset($_POST['details']) ? $_POST['details'] : null;
$status = $_POST['status'];

// SQL query to insert data into the 'spray' table
$sql = "INSERT INTO spray (date, medicine, quantity, details, status) VALUES ('$date', '$medicine', '$quantity', '$details', '$status')";

// Check if the query is successful
if (mysqli_query($conn, $sql)) {
    // Return success status and message
    $response = array('status' => 'success', 'message' => 'Spray record added successfully.');
} else {
    // Return error status and message
    $response = array('status' => 'error', 'message' => 'Error adding spray record: ' . mysqli_error($conn));
}

// Close the database connection
mysqli_close($conn);

// Return JSON response
echo json_encode($response);
