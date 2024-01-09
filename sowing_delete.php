<?php
include '../progressive_farmer/db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $plotId = mysqli_real_escape_string($conn, $_POST['plot_id']); // Get plot_id from the form data

    // Delete record from the 'sowing' table where both id and plot_id match
    $sql = "DELETE FROM sowing WHERE id = $id AND plot_id = $plotId";

    if (mysqli_query($conn, $sql)) {
        // Success
        echo json_encode(array("status" => "success"));
        exit();
    } else {
        // Error
        echo json_encode(array("status" => "error", "message" => mysqli_error($conn)));
    }

    // Close the database connection
    mysqli_close($conn);
    exit();
}
