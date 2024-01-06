<?php
include 'db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $spray_id = $_POST['sprayId'];
    $medicine_name = $_POST['medicineName'];
    $stock_quantity = $_POST['stockQuantity'];
    $cost = $_POST['cost'];

    // Update data in the database
    $sql = "UPDATE inv_spray_stock SET medicine_name = '$medicine_name', stock_quantity = $stock_quantity, cost = $cost WHERE id = $spray_id";

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
