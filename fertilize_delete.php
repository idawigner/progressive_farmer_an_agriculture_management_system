<?php
// Include database connection
include '../progressive_farmer/db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $plotId = mysqli_real_escape_string($conn, $_POST['plot_id']); // Get plot_id from the form data

    // SQL query to delete data from the 'spray' table
    $sql = "DELETE FROM fertilize WHERE id = $id AND plot_id = $plotId";

    // Check if the query is successful
    if (mysqli_query($conn, $sql)) {
        // Return success status and message
        $response = array('status' => 'success', 'message' => 'Spray record deleted successfully.');
    } else {
        // Return error status and message
        $response = array('status' => 'error', 'message' => 'Error deleting spray record: ' . mysqli_error($conn));
    }
}
// Close the database connection
mysqli_close($conn);

// Return JSON response
echo json_encode($response);
