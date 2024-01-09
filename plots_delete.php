<?php
include '../progressive_farmer/db_conn.php';

$response = array();  // Initialize an empty array for the response

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['plot_id'])) {
    $plot_id = $_POST['plot_id'];
    $sql = "DELETE FROM plots WHERE plot_id = '$plot_id'";

    // Check if the query is successful
    if (mysqli_query($conn, $sql)) {
        // Return success status and message
        $response['status'] = 'success';
        $response['message'] = 'Plot record deleted successfully.';
    } else {
        // Return error status and message
        $response['status'] = 'error';
        $response['message'] = 'Error deleting plot record: ' . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);

// Echo the JSON response
echo json_encode($response);
