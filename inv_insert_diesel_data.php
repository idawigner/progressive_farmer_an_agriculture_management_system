<?php
include '../progressive_farmer/db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $quantity_liters = $_POST['quantityLiters'];
    $cost = $_POST['cost'];

    // Insert data into the database
    $sql = "INSERT INTO inv_diesel_stock (quantity_liters, cost) VALUES ($quantity_liters, $cost)";

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
