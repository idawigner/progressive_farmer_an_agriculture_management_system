<?php
include '../progressive_farmer/db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data and sanitize
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $seed = mysqli_real_escape_string($conn, $_POST['seed']);
    $seedCompany = mysqli_real_escape_string($conn, $_POST['seedCompany']);
    $status = 'Pending';  // Set default status to 'Pending'

    // Insert data into the 'sowing' table
    $sql = "INSERT INTO sowing (date, seed, seed_company, status) VALUES ('$date', '$seed', '$seedCompany', '$status')";

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
