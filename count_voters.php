<?php
include "db/connection.php";
$result = mysqli_query($conn, "SELECT COUNT(*) as total FROM voters");
$row = mysqli_fetch_assoc($result);
echo $row['total'];
?>
