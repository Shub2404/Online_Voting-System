<?php
session_start();
include("db/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if username exists
    $stmt = $conn->prepare("SELECT * FROM admin_users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // User found
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $username;
            header("Location: admin_dashboard.php");
            exit();
        } else {
            showPopup("Login Failed", "Incorrect password.");
        }
    } else {
        showPopup("Login Failed", "Username not found.");
    }
}

// Popup function
function showPopup($title, $message) {
    echo "<!DOCTYPE html><html><head><title>$title</title></head><body>
    <div style='position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);display:flex;justify-content:center;align-items:center;z-index:9999;'>
        <div style='background:white;padding:30px;border-radius:10px;text-align:center;min-width:300px;'>
            <h2>$title</h2>
            <p>$message</p>
            <button onclick='window.history.back();' style='padding:10px 20px;background:#6a11cb;color:white;border:none;border-radius:5px;'>OK</button>
        </div>
    </div>
    </body></html>";
    exit();
}
?>
