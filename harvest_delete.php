<?php
include '../progressive_farmer/db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data and sanitize
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    // Delete record from the 'harvest' table
    $sql = "DELETE FROM harvest WHERE id = '$id'";

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
