<?php
include '../progressive_farmer/db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['plot_id'])) {
    $plot_id = mysqli_real_escape_string($conn, $_POST['plot_id']);
    $area = mysqli_real_escape_string($conn, $_POST['area']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $sql = "UPDATE plots SET plot_id = '$plot_id', area = '$area', location = '$location', status = '$status' WHERE plot_id = '$plot_id'";

    // Check if the query is successful
    if (mysqli_query($conn, $sql)) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error updating plot record: ' . mysqli_error($conn)]);
    }
}

// Close the database connection
mysqli_close($conn);
