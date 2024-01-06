<?php
include 'db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $machinery_id = $_POST['machineryId'];
    $machinery_type = $_POST['machineryType'];
    $available_units = $_POST['availableUnits'];
    $cost = $_POST['cost'];

    // Update data in the database
    $sql = "UPDATE inv_machinery_stock SET machinery_type = '$machinery_type', available_units = $available_units, cost = $cost WHERE id = $machinery_id";

    if (mysqli_query($conn, $sql)) {
        // Success
        echo json_encode(array("status" => "success"));
    } else {
        // Error
        echo json_encode(array("status" => "error", "message" => mysqli_error($conn)));
    }

    // Close the database connection
    mysqli_close($conn);
    exit;
}
