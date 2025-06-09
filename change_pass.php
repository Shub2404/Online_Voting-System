<?php
if (!isset($_SESSION)) { 
    session_start();
}
include "auth.php";
include "header_voter.php"; 
?>

<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #74ebd5, #ACB6E5);
        margin: 0;
        padding: 0;
        height: 100vh;
    }

    h3 {
        margin-top: 30px;
        color: #2c3e50;
        font-size: 28px;
        animation: fadeInDown 1s ease;
    }

    form {
        background-color: #ffffffcc;
        padding: 35px;
        border-radius: 15px;
        width: 400px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        margin-top: 20px;
        animation: slideUp 1s ease;
    }

    input[type="password"] {
        width: 100%;
        padding: 12px;
        margin-top: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 8px;
        transition: border 0.3s;
    }

    input[type="password"]:focus {
        border-color: #007BFF;
        outline: none;
    }

    input[type="submit"] {
        background: linear-gradient(45deg, #007BFF, #00c6ff);
        color: white;
        padding: 12px 25px;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        transition: background 0.3s;
    }

    input[type="submit"]:hover {
        background: linear-gradient(45deg, #0056b3, #0095ff);
    }

    .error-message {
        color: #e74c3c;
        margin-top: 10px;
        animation: fadeIn 1s ease;
    }

    .forgot-password {
        margin-top: 20px;
    }

    .forgot-password a {
        color: #007BFF;
        text-decoration: none;
        transition: color 0.3s;
    }

    .forgot-password a:hover {
        text-decoration: underline;
        color: #0056b3;
    }

    /* Animations */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<center><h3>Change Password</h3></center>

<?php global $nam; echo "<center><div class='error-message'>$nam</div></center>"; ?> 
<?php global $error; echo "<center><div class='error-message'>$error</div></center>"; ?>                  

<center>
    <form action="change_pass_action.php" method="post" id="myform">
        Current Password:
        <input type="password" name="cpassword" value="">

        New Password:
        <input type="password" name="npassword" value="">

        Confirm New Password:
        <input type="password" name="cnpassword" value="">

        <input type="submit" name="cpass" value="UPDATE">

        <div class="forgot-password">
            <a href="forgot_password.php">Forgot Password?</a>
        </div>
    </form>
</center>

<script type="text/javascript">
var frmvalidator = new Validator("myform"); 
frmvalidator.addValidation("cpassword", "req", "Please enter Current Password"); 
frmvalidator.addValidation("cpassword", "maxlen=50");

frmvalidator.addValidation("npassword", "req", "Please enter New Password"); 
frmvalidator.addValidation("npassword", "maxlen=50");

frmvalidator.addValidation("cnpassword", "req", "Please enter Confirm New Password"); 
frmvalidator.addValidation("cnpassword", "maxlen=50");
</script>

<br><br>
<?php include "footer.php"; ?>
