<?php
include '../progressive_farmer/db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data and sanitize
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $seed = mysqli_real_escape_string($conn, $_POST['seed']);
    $seedCompany = mysqli_real_escape_string($conn, $_POST['seedCompany']);
    $details = isset($_POST['details']) ? $_POST['details'] : null;
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $plotId = mysqli_real_escape_string($conn, $_POST['plotId']); // Get plot_id from the form data

    // Update data in the 'sowing' table where both id and plot_id match
    $sql = "UPDATE sowing SET date='$date', seed='$seed', seed_company='$seedCompany', details='$details', status='$status' WHERE id = $id AND plot_id = $plotId";

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
