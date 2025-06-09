<?php
include "header.php";
session_start();
if (isset($_SESSION['SESS_NAME']) != "") {
    header("Location: voter.php");
}
?>

<div class="hero">
    <h1>Welcome to the Online Voting System</h1>
    <p class="subtext">This system allows all registered users to cast their vote using their right to vote.</p>
    <p>In order to make a vote, you have to register first and then login.</p>
    <h2 class="gradient-text">पहले मतदान फिर जलपान, लोकतंत्र का करो सम्मान</h2>
</div>

<section id="why" class="info-section">
    <h2>Why Choose Online Voting?</h2>
    <p>It’s fast, secure, accessible, and empowers every eligible citizen to participate in the democratic process without geographical limitations. With face and fingerprint authentication, your vote is safer than ever!</p>
</section>

<?php include "footer.php"; ?>
