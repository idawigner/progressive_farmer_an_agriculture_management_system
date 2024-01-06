<?php
include '../progressive_farmer/db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $date = $_POST['date'];
    $medicine = $_POST['medicine'];
    $amount = $_POST['amount'];
    $cost = $_POST['cost'];

    // Insert data into the 'spray' table
    $sql = "INSERT INTO spray (date, medicine, amount, cost) VALUES ('$date', '$medicine', '$amount', '$cost')";

    if (mysqli_query($conn, $sql)) {
        // Success
        echo json_encode(array("status" => "success"));
        exit(); // Add this line
    } else {
        // Error
        echo json_encode(array("status" => "error", "message" => mysqli_error($conn)));
    }

    // Close the database connection
    mysqli_close($conn);
    exit();
}
