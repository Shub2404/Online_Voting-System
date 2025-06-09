<?php
session_start();
include "connection.php";

if (isset($_POST['submit'])) {
    $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $checkUser = mysqli_query($con, "SELECT username FROM loginusers WHERE username='$username'");
    if (mysqli_num_rows($checkUser) > 0) {
        echo "<script>alert('The username already exists.'); window.location.href='register.php';</script>";
        exit();
    }

    if (!isset($_POST['face_image']) || empty($_POST['face_image'])) {
        echo "<script>alert('Please capture your face image.'); window.location.href='register.php';</script>";
        exit();
    }

    // Save image
    $base64_image = str_replace('data:image/jpeg;base64,', '', $_POST['face_image']);
    $base64_image = str_replace(' ', '+', $base64_image);
    $image_binary = base64_decode($base64_image);

    if (!file_exists('faces')) {
        mkdir('faces', 0777, true);
    }
    file_put_contents("faces/$username.jpg", $image_binary);

    mysqli_query($con, "INSERT INTO voters (firstname, lastname, username) VALUES ('$firstname', '$lastname', '$username')");
    $hashed_password = md5($password);
    mysqli_query($con, "INSERT INTO loginusers (username, password) VALUES ('$username', '$hashed_password')");

    echo "<script>alert('Registration successful!'); window.location.href='voter_login.php';</script>";
    exit();

} else {
    echo "<script>alert('Invalid request.'); window.location.href='register.php';</script>";
}
?>
