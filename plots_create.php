<?php
include '../progressive_farmer/db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $plot_id = mysqli_real_escape_string($conn, $_POST['plot_id']);
    $area = mysqli_real_escape_string($conn, $_POST['area']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $sql = "INSERT INTO plots (plot_id, area, location, status) VALUES ('$plot_id', '$area', '$location', '$status')";

// Check if the query is successful
    if (mysqli_query($conn, $sql)) {
        // Return success status and message
        $response = array('status' => 'success', 'message' => 'Spray record added successfully.');
    } else {
        // Return error status and message
        $response = array('status' => 'error', 'message' => 'Error adding spray record: ' . mysqli_error($conn));
    }
}
// Close the database connection
    mysqli_close($conn);

// Echo the JSON response
echo json_encode($response);