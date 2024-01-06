<?php
include '../progressive_farmer/db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $id = $_POST['id'];
    $date = $_POST['date'];
    $medicine = $_POST['medicine'];
    $amount = $_POST['amount'];
    $cost = $_POST['cost'];

    // Update data in the 'spray' table
    $sql = "UPDATE spray SET date='$date', medicine='$medicine', amount='$amount', cost='$cost' WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        // Success
        echo json_encode(array("status" => "success", "id" => $id));
        exit(); // Add this line
    } else {
        // Error
        echo json_encode(array("status" => "error", "message" => mysqli_error($conn)));
    }

    // Close the database connection
    mysqli_close($conn);
}
