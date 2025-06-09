<?php include "header.php";
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['SESS_NAME']) != "") {
    header("Location: voter.php");
}
?>
<!-- WebcamJS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>

<style>
    body {
        font-family: Arial, sans-serif;
        background: linear-gradient(135deg, #74ebd5, #ACB6E5);
        margin: 0;
        padding: 0;
        animation: fadeInBody 1s ease-in;
    }

    @keyframes fadeInBody {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .form-container {
        background: white;
        border-radius: 15px;
        box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        width: 400px;
        margin: 50px auto;
        padding: 30px;
        animation: slideUp 0.8s ease-out;
    }

    @keyframes slideUp {
        from {
            transform: translateY(50px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .form-container h3 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    .form-container input[type="text"],
    .form-container input[type="password"],
    .form-container input[type="tel"],
    .form-container input[type="date"] {
        width: 100%;
        padding: 10px;
        margin: 8px 0;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 14px;
    }

    .form-container input[type="submit"] {
        width: 100%;
        padding: 12px;
        background: #74ebd5;
        color: #000;
        font-size: 16px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
    }

    #camera {
        width: 320px;
        margin: 10px auto;
    }

    .error-message {
        color: red;
        font-size: 14px;
        text-align: center;
    }

    .capture-btn {
        background-color: #4CAF50;
        color: white;
        padding: 8px 14px;
        margin-top: 8px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
    }
</style>

<div class="form-container">

    <form action="reg_action.php" method="post" id="myform">
        <h3>Register</h3>
        <?php global $nam; echo "<div class='error-message'>$nam</div>"; ?>
        <?php global $error; echo "<div class='error-message'>$error</div>"; ?>

        Firstname:
        <input type="text" name="firstname" required />

        Lastname:
        <input type="text" name="lastname" required />

        Username:
        <input type="text" name="username" required />

        Password:
        <input type="password" name="password" required />

        Aadhar No:
        <input type="tel" name="aadhar_no" pattern="\d{12}" maxlength="12" required />

        Date of Birth:
        <input type="date" name="dob" id="dob" required />

        <div id="camera"></div>
        <input type="hidden" name="face_image" id="face_image" />
        <button type="button" class="capture-btn" onclick="take_snapshot()">Capture Face</button>

        <input type="submit" name="submit" value="Register" />
        
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
            alert("Face captured!");
        });
    }

    document.getElementById("myform").onsubmit = function () {
        var dob = new Date(document.getElementById("dob").value);
        var today = new Date();
        var age = today.getFullYear() - dob.getFullYear();
        var m = today.getMonth() - dob.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) {
            age--;
        }

        if (age < 18) {
            alert("You must be at least 18 years old.");
            return false;
        }

        if (!document.getElementById('face_image').value) {
            alert("Please capture your face before submitting.");
            return false;
        }

        return true;
    };
</script>

<?php include "footer.php"; ?>
