<?php
include("db/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $gov_id = $_POST['gov_id'];

    // Password length validation
    if (strlen($password) <= 4 || strlen($password) >= 6) {
        showPopup("Password Error", "Password must be more than 4 and less than 6 characters.");
    }

    // Validate Government ID
    $stmt = $conn->prepare("SELECT * FROM approved_admin_ids WHERE gov_id = ?");
    if (!$stmt) {
        showPopup("Database Error", "Failed to prepare statement for ID validation.");
    }
    $stmt->bind_param("s", $gov_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        showPopup("Invalid ID", "This Government-Allotted ID is not approved.");
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt2 = $conn->prepare("INSERT INTO admin_users (fullname, username, password, gov_id) VALUES (?, ?, ?, ?)");

        if (!$stmt2) {
            showPopup("Database Error", "Failed to prepare statement for registration.");
        }

        $stmt2->bind_param("ssss", $fullname, $username, $hashedPassword, $gov_id);
        if ($stmt2->execute()) {
            showPopup("Success", "Admin Registered Successfully!", "admin_login.php");
        } else {
            showPopup("Registration Error", "Could not register. Please try again.");
        }
    }
}

// Function to show popup
function showPopup($title, $message, $redirect = null) {
    echo "<!DOCTYPE html><html><head><title>$title</title></head><body>
    <div style='position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);display:flex;justify-content:center;align-items:center;z-index:9999;'>
        <div style='background:white;padding:30px;border-radius:10px;text-align:center;min-width:300px;'>
            <h2>$title</h2>
            <p>$message</p>
            <button onclick='handleClose()' style='padding:10px 20px;background:#6a11cb;color:white;border:none;border-radius:5px;'>OK</button>
        </div>
    </div>
    <script>
        function handleClose() {
            " . ($redirect ? "window.location.href = '$redirect';" : "window.history.back();") . "
        }
    </script>
    </body></html>";
    exit();
}
?>
