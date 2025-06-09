<?php
if (!isset($_SESSION)) { session_start(); }
include "auth.php";
include "header_voter.php";

// Show welcome modal only once
$showWelcomeModal = false;
if (isset($_SESSION['just_logged_in']) && $_SESSION['just_logged_in'] === true) {
    $showWelcomeModal = true;
    unset($_SESSION['just_logged_in']); // prevent re-showing
}

$election = $_GET['election'] ?? '';
$candidates = [];

// Dummy data for "loksabha" election
if ($election == 'loksabha') {
    $candidates = [
        ['name' => 'Narendra Modi (BJP)', 'value' => 'BJP', 'img' => 'images/modi.jpg', 'symbol' => 'bjp sign.jpg'],
        ['name' => 'Rahul Gandhi (Congress)', 'value' => 'CONGRESS', 'img' => 'images/rahul.jpg', 'symbol' => 'congress siogn.png'],
        ['name' => 'Arvind Kejriwal (AAP)', 'value' => 'AAP', 'img' => 'images/keju.jpg', 'symbol' => 'aap sign.png'],
        ['name' => 'Akhilesh Yadav (SP)', 'value' => 'SP', 'img' => 'images/akhilesh.jpg', 'symbol' => 'sp sign.png'],
        ['name' => 'NOTA (None of the Above)', 'value' => 'NOTA', 'img' => 'images/nota.jpg', 'symbol' => 'nota sign.png'],
    ];
}
?>

<?php if ($showWelcomeModal): ?>
<!-- Welcome Modal -->
<div class="modal-overlay" id="welcomeModal">
    <div class="modal-content">
        <h4>Welcome <?php echo $_SESSION['SESS_NAME']; ?></h4>
        <h3>Make a Vote - <?php echo ucfirst($election); ?> Election</h3>
        <button onclick="closeModal()">OK</button>
    </div>
</div>
<?php endif; ?>

<!-- Voting Form -->
<div class="vote-container" id="voteContainer" style="<?php if ($showWelcomeModal) echo 'display:none;'; ?>">
    <form action="submit_vote.php" method="post">
        <centre><div class="question">Whom do you want to cast your vote for?</div></centre>

<table class="vote-table">
    <tr>
        <?php foreach ($candidates as $index => $cand): ?>
            <td>
                <label class="table-card">
                    <input type="radio" name="lan" value="<?= $cand['value'] ?>" required>
                    <img src="<?= $cand['img'] ?>" alt="Candidate" class="candidate-img"><br>
                    <img src="<?= $cand['symbol'] ?>" alt="Symbol" class="symbol-img"><br>
                    <span class="candidate-name"><?= $cand['name'] ?></span>
                </label>
            </td>
            <?php if (($index + 1) % 3 === 0): ?>
                </tr><tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </tr>
</table>


        <input type="submit" value="Submit Vote" name="submit" class="submit-btn" />
    </form>

    <?php
    if (isset($_SESSION['VOTE_STATUS'])) {
        echo '<script>';
        echo 'document.addEventListener("DOMContentLoaded", function() {';
        switch ($_SESSION['VOTE_STATUS']) {
            case 'already_voted':
                echo 'Swal.fire({ icon: "info", title: "Already Voted", text: "You have already submitted your vote." });';
                break;
            case 'vote_success':
                echo 'Swal.fire({ icon: "success", title: "Vote Submitted", text: "Thank you for voting!" });';
                break;
            case 'no_selection':
                echo 'Swal.fire({ icon: "warning", title: "No Selection", text: "Please choose a candidate." });';
                break;
        }
        echo '});</script>';
        unset($_SESSION['VOTE_STATUS']);
    }
    ?>
</div>

<!-- JS + CSS -->
<script>
function closeModal() {
    document.getElementById('welcomeModal').style.display = 'none';
    document.getElementById('voteContainer').style.display = 'block';
}
</script>

<style>
.modal-overlay {
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0,0,0,0.7);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}
.modal-content {
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 0 10px #000;
}
.modal-content button {
    margin-top: 20px;
    padding: 10px 25px;
    font-size: 16px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}
.vote-container {
    padding: 30px;
}
.cards-wrapper {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}
.card {
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 15px;
    width: 280px;
    text-align: center;
    transition: 0.3s;
    background-color: #f9f9f9;
    cursor: pointer;
}
.card:hover {
    box-shadow: 0 0 10px #aaa;
}
.card input[type="radio"] {
    margin-bottom: 10px;
}
.candidate-img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
}
.symbol-img {
    width: 50px;
    margin: 10px 0;
}
.candidate-name {
    display: block;
    font-size: 18px;
    font-weight: bold;
}
.submit-btn {
    margin-top: 20px;
    padding: 10px 20px;
    font-size: 18px;
    background-color: green;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}
.vote-table {
    width: 100%;
    text-align: center;
    border-collapse: separate;
    border-spacing: 30px 20px;
    margin-top: 20px;
}
.vote-table td {
    vertical-align: top;
}

.table-card {
    display: inline-block;
    padding: 15px;
    background: #f8f8f8;
    border: 1px solid #ccc;
    border-radius: 10px;
    width: 200px;
    cursor: pointer;
    transition: 0.3s;
}
.table-card:hover {
    box-shadow: 0 0 10px #aaa;
}
.candidate-img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
}
.symbol-img {
    width: 50px;
    margin: 10px 0;
}
.candidate-name {
    display: block;
    margin-top: 10px;
    font-weight: bold;
}
</style>
