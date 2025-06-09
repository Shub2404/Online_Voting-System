<?php 
include "header.php"; 
session_start();

// Simulating login success (for demo)
// In actual login_voter.php, after successful login, set:
if (!isset($_SESSION['SESS_NAME'])) {
    $_SESSION['SESS_NAME'] = 'Shubhankar'; // Replace with actual login name
    $_SESSION['just_logged_in'] = true;
}
?>

<style>
    .popup-overlay {
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex; justify-content: center; align-items: center;
        z-index: 9999;
    }
    .popup-box {
        background: white;
        padding: 30px;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
    }
    .popup-box h3 {
        margin-bottom: 20px;
    }
    .popup-box button {
        margin-top: 15px;
        padding: 10px 25px;
        background-color: #6a11cb;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
</style>

<?php if (isset($_SESSION['just_logged_in']) && $_SESSION['just_logged_in'] === true): ?>
    <div class="popup-overlay" id="welcomePopup">
        <div class="popup-box">
            <h3>Welcome, <?php echo $_SESSION['SESS_NAME']; ?>!</h3>
            <p>You have successfully logged in.</p>
            <button onclick="closeWelcome()">Continue</button>
        </div>
    </div>

    <script>
        function closeWelcome() {
            document.getElementById('welcomePopup').style.display = 'none';
        }
    </script>

    <?php unset($_SESSION['just_logged_in']); ?>
<?php endif; ?>
