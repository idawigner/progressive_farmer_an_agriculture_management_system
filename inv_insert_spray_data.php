<?php
//include 'db_conn.php';
//
//if ($_SERVER["REQUEST_METHOD"] == "POST") {
//    $medicine_name = $_POST['medicineName'];
//    $stock_quantity = $_POST['stockQuantity'];
//    $cost = $_POST['cost'];
//
//    // Insert data into the database
//    $sql = "INSERT INTO spray_stock (medicine_name, stock_quantity, cost) VALUES ('$medicine_name', $stock_quantity, $cost)";
//
//    if (mysqli_query($conn, $sql)) {
//        // Success
//        echo json_encode(array("status" => "success"));
//    } else {
//        // Error
//        echo json_encode(array("status" => "error", "message" => mysqli_error($conn)));
//    }
//
//    // Close the database connection
//    mysqli_close($conn);
//}

include '../progressive_farmer/db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $medicine_name = $_POST['medicineName'];
    $stock_quantity = $_POST['stockQuantity'];
    $cost = $_POST['cost'];

    // Perform some basic input validation
    if (empty($medicine_name) || !is_numeric($stock_quantity) || !is_numeric($cost)) {
        $response['status'] = 'error';
        $response['message'] = 'Invalid input data.';
    } else {
        // Execute the SQL query
        $sql = "INSERT INTO inv_spray_stock (medicine_name, stock_quantity, cost) VALUES ('$medicine_name', $stock_quantity, $cost)";

        if (mysqli_query($conn, $sql)) {
            $response['status'] = 'success';
            $response['message'] = 'Record added successfully.';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Error: ' . mysqli_error($conn);
        }
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method.';
}

// Add debugging information to the response
$response['debug_info'] = array(
    'post_data' => $_POST,
    'sql_query' => $sql
);

// Return the JSON response
header('Content-Type: application/json');
echo json_encode($response);

mysqli_close($conn);
