<?php
include("dbcon.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = mysqli_real_escape_string($con, $_POST["name"]);
    $email   = mysqli_real_escape_string($con, $_POST["email"]);
    $subject = mysqli_real_escape_string($con, $_POST["subject"]);
    $message = mysqli_real_escape_string($con, $_POST["message"]);

    $query = "INSERT INTO contact_messages (name, email, subject, message, created_at)
              VALUES ('$name', '$email', '$subject', '$message', NOW())";

    if (mysqli_query($con, $query)) {
        echo "<script>alert('Message sent successfully!'); window.location='contact.php';</script>";
    } else {
        echo "<script>alert('Failed to send message.'); window.location='contact.php';</script>";
    }
}
?>
