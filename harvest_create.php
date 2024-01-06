<?php
include '../progressive_farmer/db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data and sanitize
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);
    $details = mysqli_real_escape_string($conn, $_POST['details']);
    $status = 'Pending';  // Set default status to 'Pending'

    // Insert data into the 'harvest' table
    $sql = "INSERT INTO harvest (date, time, details, status) VALUES ('$date', '$time', '$details', '$status')";

    if (mysqli_query($conn, $sql)) {
        // Success
        echo json_encode(array("status" => "success"));
        exit();
    } else {
        // Error
        echo json_encode(array("status" => "error", "message" => mysqli_error($conn)));
    }

    // Close the database connection
    mysqli_close($conn);
    exit();
}
