<?php
include '../progressive_farmer/db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fertilizer_type = $_POST['fertilizerType'];
    $stock_quantity = $_POST['stockQuantity'];
    $cost = $_POST['cost']; // Add cost field

    // Insert data into the database
    $sql = "INSERT INTO inv_fertilizer_stock (fertilizer_type, stock_quantity, cost) VALUES ('$fertilizer_type', $stock_quantity, $cost)";

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
