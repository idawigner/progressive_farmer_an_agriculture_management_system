<?php
// Include database connection
include '../progressive_farmer/db_conn.php';

// Get form data using POST method
$date = $_POST['date'];
$type = $_POST['type'];
$cost = $_POST['cost'];

// SQL query to insert data into the 'expense' table
$sql = "INSERT INTO expense (date, type, cost) VALUES ('$date', '$type', '$cost')";

// Check if the query is successful
if (mysqli_query($conn, $sql)) {
    // Return success status and message
    $response = array('status' => 'success', 'message' => 'Expense record added successfully.');
} else {
    // Return error status and message
    $response = array('status' => 'error', 'message' => 'Error adding expense record: ' . mysqli_error($conn));
}

// Close the database connection
mysqli_close($conn);

// Return JSON response
echo json_encode($response);
