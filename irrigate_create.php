<?php
// Include database connection
include '../progressive_farmer/db_conn.php';

// Get form data using POST method
$date = $_POST['date'];
$source = isset($_POST['source']) ? $_POST['source'] : null; // Handle null for 'N/A'
$status = $_POST['status'];
$irrigate_time = $_POST['irrigate_time']; // Get irrigate_time
$plotId = mysqli_real_escape_string($conn, $_POST['plotId']); // Get plot_id from the form data

// SQL query to insert data into the 'irrigate' table
$sql = "INSERT INTO irrigate (date, source, status, irrigate_time, plot_id) VALUES ('$date', '$source', '$status', '$irrigate_time', '$plotId')";

// Check if the query is successful
if (mysqli_query($conn, $sql)) {
    // Return success status and message
    $response = array('status' => 'success', 'message' => 'Record added successfully.');
} else {
    // Return error status and message
    $response = array('status' => 'error', 'message' => 'Error adding record: ' . mysqli_error($conn));
}

// Close the database connection
mysqli_close($conn);

// Return JSON response
echo json_encode($response);
