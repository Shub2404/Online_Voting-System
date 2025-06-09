<?php
include("db/connection.php");

// Make sure you have a valid elections table
$sql = "SELECT COUNT(*) AS total FROM elections WHERE status = 'ongoing'";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    echo "<h2>" . $row['total'] . "</h2>";
} else {
    echo "<p style='color:red;'>Error fetching elections: " . mysqli_error($conn) . "</p>";
}
?>
