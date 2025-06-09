<?php
include "connection.php";
session_start();

if(empty($_POST['lan'])){
    $_SESSION['VOTE_STATUS'] = "no_selection";
    header("Location: voter.php");
    exit();
}

$lan = mysqli_real_escape_string($con, $_POST['lan']);
$username = $_SESSION['SESS_NAME'];

// Check if already voted
$sql = mysqli_query($con, 'SELECT * FROM voters WHERE username="'.$username.'" AND status="VOTED"');
if(mysqli_num_rows($sql) > 0 ) {
    $_SESSION['VOTE_STATUS'] = "already_voted";
    header("Location: voter.php");
    exit();
} else {
    $sql1 = mysqli_query($con, 'UPDATE languages SET votecount = votecount + 1 WHERE fullname = "'.$lan.'"');
    $sql2 = mysqli_query($con, 'UPDATE voters SET status="VOTED", voted="'.$lan.'" WHERE username="'.$username.'"');

    if(!$sql1 || !$sql2){
        die("Database Error: ".mysqli_error($con));
    } else {
        $_SESSION['VOTE_STATUS'] = "vote_success";
        header("Location: voter.php");
        exit();
    }
}
?>
