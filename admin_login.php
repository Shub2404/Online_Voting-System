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
</style>

<div class="admin-form">
    <h3>Admin Login</h3>
    <form action="admin_login_action.php" method="post">
        Government ID:
        <input type="text" name="username" required>
        Password:
        <input type="password" name="password" required>
        <input type="submit" value="Login">
    </form>
</div>

<?php include "footer.php"; ?>
