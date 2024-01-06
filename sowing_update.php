<?php
include '../progressive_farmer/db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data and sanitize
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $seed = mysqli_real_escape_string($conn, $_POST['seed']);
    $seedCompany = mysqli_real_escape_string($conn, $_POST['seedCompany']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    // Update data in the 'sowing' table
    $sql = "UPDATE sowing SET date='$date', seed='$seed', seed_company='$seedCompany', status='$status' WHERE id = $id";

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
