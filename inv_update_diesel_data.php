<?php
include 'db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $diesel_id = $_POST['dieselId'];
    $quantity_liters = $_POST['quantityLiters'];
    $cost = $_POST['cost'];

    // Update data in the database
    $sql = "UPDATE inv_diesel_stock SET quantity_liters = $quantity_liters, cost = $cost WHERE id = $diesel_id";

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
