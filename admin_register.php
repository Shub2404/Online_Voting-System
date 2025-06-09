<?php include "header.php"; ?>
<style>
    .admin-form {
        width: 400px;
        margin: 50px auto;
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 8px 16px rgba(0,0,0,0.15);
    }
    .admin-form input {
        width: 100%;
        padding: 10px;
        margin-top: 12px;
        border-radius: 6px;
        border: 1px solid #ccc;
    }
    .admin-form input[type="submit"] {
        background-color: #6a11cb;
        color: white;
        font-weight: bold;
        cursor: pointer;
    }
    .admin-form h3 {
        text-align: center;
        color: #333;
    }

    /* Popup styles */
    #popupModal {
        display: none;
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0,0,0,0.5);
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }
    #popupModal .popup-box {
        background: white;
        padding: 30px;
        border-radius: 10px;
        text-align: center;
        min-width: 300px;
    }
    #popupModal button {
        margin-top: 10px;
        padding: 8px 16px;
        background: #6a11cb;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
</style>

<div class="admin-form">
    <h3>Admin Registration</h3>
    <form action="admin_reg_action.php" method="post" onsubmit="return validateForm()">
        Full Name:
        <input type="text" name="fullname" required>

        Username:
        <input type="text" name="username" required>

        Password:
        <input type="password" name="password" id="password" required>

        Government-Allotted ID:
        <input type="text" name="gov_id" required>

        <input type="submit" value="Register as Admin">
    </form>
</div>

<!-- Popup Modal -->
<div id="popupModal">
    <div class="popup-box">
        <h3 id="popupTitle">Message</h3>
        <p id="popupMessage"></p>
        <button onclick="closePopup()">OK</button>
    </div>
</div>

<script>
function validateForm() {
    const password = document.getElementById("password").value;
    if (password.length <= 4 || password.length >= 6) {
        showPopup("Password Error", "Password must be more than 4 and less than 6 characters.");
        return false;
    }
    return true;
}

function showPopup(title, message) {
    document.getElementById("popupTitle").innerText = title;
    document.getElementById("popupMessage").innerText = message;
    document.getElementById("popupModal").style.display = "flex";
}

function closePopup() {
    document.getElementById("popupModal").style.display = "none";
}
</script>

<?php include "footer.php"; ?>
