<?php
if(!isset($_SESSION)) { 
    session_start();
}
include "auth.php";
include "header_voter.php";
include "connection.php";
?>

<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(120deg, #f6d365, #fda085);
        margin: 0;
        padding: 0;
        animation: fadeInBody 1s ease-in-out;
    }

    @keyframes fadeInBody {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .container {
        max-width: 600px;
        margin: 60px auto;
        background: white;
        padding: 35px;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25);
        animation: slideIn 0.7s ease-out;
    }

    @keyframes slideIn {
        from { transform: translateY(50px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    h4 {
        text-align: center;
        color: #333;
        margin-bottom: 25px;
    }

    .profile {
        margin: 20px 0;
        padding: 20px;
        background-color: #fafafa;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        animation: fadeInProfile 0.8s ease-in;
    }

    @keyframes fadeInProfile {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }

    .profile p {
        font-size: 16px;
        color: #444;
        margin: 10px 0;
        line-height: 1.6;
    }

    .status-message {
        font-size: 16px;
        text-align: center;
        margin-top: 20px;
        padding: 15px;
        border-radius: 8px;
        transition: background 0.3s;
    }

    .status-message.voted {
        background-color: #dcedc8;
        color: #33691e;
    }

    .status-message.not-voted {
        background-color: #ffecb3;
        color: #e65100;
    }
</style>

<div class="container">
    <h4>Welcome, <?php echo htmlspecialchars($_SESSION['SESS_NAME']); ?></h4>

    <?php
    $username = $_SESSION['SESS_NAME'];
    $sql = mysqli_query($con, "SELECT * FROM voters WHERE username='$username'");

    if ($sql && mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);

        $fullname = htmlspecialchars($row['firstname'] . " " . $row['lastname']);
        $status = htmlspecialchars($row['status']);
        $voted = htmlspecialchars($row['voted']);

        echo '<div class="profile">';
        echo "<p><strong>Full Name:</strong> $fullname</p>";
        echo "<p><strong>Username:</strong> $username</p>";
        echo '</div>';

        if ($status === "VOTED") {
            echo '<div class="status-message voted">✅ You have voted for: <strong>' . $voted . '</strong></div>';
        } else {
            echo '<div class="status-message not-voted">🕓 You have not voted yet. Please cast your vote soon!</div>';
        }
    } else {
        echo "<p>Error fetching user details.</p>";
    }
    ?>
</div>
