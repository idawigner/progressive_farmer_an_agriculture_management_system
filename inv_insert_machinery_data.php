<?php
include '../progressive_farmer/db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $machinery_type = $_POST['machineryType'];
    $available_units = $_POST['availableUnits'];
    $cost = $_POST['cost'];

    // Insert data into the database
    $sql = "INSERT INTO inv_machinery_stock (machinery_type, available_units, cost) VALUES ('$machinery_type', $available_units, $cost)";

    if (mysqli_query($conn, $sql)) {
        // Success
        echo json_encode(array("status" => "success"));
    } else {
        // Error
        echo json_encode(array("status" => "error", "message" => mysqli_error($conn)));
    }

    // Close the database connection
    mysqli_close($conn);
}
