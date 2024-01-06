<?php
include 'db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fertilizer_id = $_POST['fertilizerId'];
    $fertilizer_type = $_POST['typeFertilizer'];
    $stock_quantity = $_POST['stockQuantityFertilizer'];
    $cost = $_POST['costFertilizer'];

    // Update data in the database
    $sql = "UPDATE inv_fertilizer_stock SET fertilizer_type = '$fertilizer_type', stock_quantity = $stock_quantity, cost = $cost WHERE id = $fertilizer_id";

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
