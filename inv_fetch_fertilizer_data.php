<?php
// Include the database connection file
include '../progressive_farmer/db_conn.php';

// Fetch Fertilizer data from the database
$sql = "SELECT * FROM inv_fertilizer_stock";
$result = mysqli_query($conn, $sql);

// Display Fertilizer data as table rows
while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo '<td>' . $row['fertilizer_type'] . '</td>';
    echo '<td>' . $row['stock_quantity'] . '</td>';
    echo '<td>' . $row['cost'] . '</td>';
    echo '<td>';
    echo '<i class="fas fa-edit text-primary mr-2" title="Edit"></i>';
    echo '<i class="fas fa-trash-alt text-danger" title="Delete"></i>';
    echo '</td>';
    echo '</tr>';
}

// Close the database connection
mysqli_close($conn);
