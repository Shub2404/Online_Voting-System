<?php 
session_start();
include "header.php"; 
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>

<style>
    body {
        font-family: Arial, sans-serif;
        background: linear-gradient(135deg, #FFDEE9, #B5FFFC);
        margin: 0;
        padding: 0;
    }
    .form-container {
        width: 400px;
        margin: 50px auto;
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }
    h3 {
        text-align: center;
    }
    input[type="text"], input[type="password"] {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border-radius: 6px;
        border: 1px solid #ccc;
    }
    input[type="submit"], .capture-btn {
        width: 100%;
        padding: 10px;
        margin-top: 10px;
        border: none;
        border-radius: 6px;
        background-color: #4CAF50;
        color: white;
        cursor: pointer;
    }
    #camera {
        width: 320px;
        margin: 10px auto;
    }
</style>

<div class="form-container">
    <form action="login_action.php" method="post" id="loginForm">
        <h3>Voter Login</h3>
        
        <?php 
        if (isset($_SESSION['LOGIN_ERROR'])) {
            echo "<div style='color:red;text-align:center;'>".htmlspecialchars($_SESSION['LOGIN_ERROR'])."</div>";
            unset($_SESSION['LOGIN_ERROR']);
        }
        ?>

        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required />

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required />

        <div id="camera"></div>
        <input type="hidden" name="face_image" id="face_image" />
        <button type="button" class="capture-btn" onclick="take_snapshot()">Capture Face</button>

        <input type="submit" name="login" value="Login" />
    </form>
</div>

<script>
    Webcam.set({
        width: 320,
        height: 240,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
    Webcam.attach('#camera');

    function take_snapshot() {
        Webcam.snap(function(data_uri) {
            document.getElementById('face_image').value = data_uri;
            alert("Face Captured!");
        });
    }

    document.getElementById("loginForm").onsubmit = function () {
        if (!document.getElementById("face_image").value) {
            alert("Please capture your face before logging in.");
            return false;
        }
        return true;
    };
</script>

<?php include "footer.php"; ?>
