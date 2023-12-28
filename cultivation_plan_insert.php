<?php
include 'db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $taskType = $_POST['taskType'];
    $date = $_POST['date'];
    $crop = $_POST['crop'];
    $estExpense = $_POST['estExpense'];

    // Insert data into the database
    $sql = "INSERT INTO cultivation_plan (taskType, date, crop, estExpense) VALUES ('$taskType', '$date', '$crop', $estExpense)";

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