<?php
include '../progressive_farmer/db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Perform the deletion
    $sql = "DELETE FROM inv_spray_stock WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $response = array('status' => 'success', 'message' => 'Record deleted successfully.');
    } else {
        $response = array('status' => 'error', 'message' => 'Error deleting record: ' . mysqli_error($conn));
    }

    echo json_encode($response);
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Invalid request.'));
}

mysqli_close($conn);
