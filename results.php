<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Election Results</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f0f2f5;
            padding: 40px;
        }
        .container {
            background: white;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h3 {
            color: #333;
            font-weight: bold;
        }
        .badge {
            font-size: 0.85rem;
        }
    </style>
</head>
<body>

<?php
include 'db/connection.php';

// Fetch candidates
$sql = "SELECT fullname, votecount FROM languages ORDER BY votecount DESC";
$candidates = $conn->query($sql);

if ($candidates && $candidates->num_rows > 0) {
    $results = [];
    $maxVotes = 0;

    // Collect data and find max votes
    while ($row = $candidates->fetch_assoc()) {
        $row['votecount'] = (int)$row['votecount'];
        $results[] = $row;
        if ($row['votecount'] > $maxVotes) {
            $maxVotes = $row['votecount'];
        }
    }

    // Count how many have max votes (for tie logic)
    $topCandidates = array_filter($results, fn($res) => $res['votecount'] === $maxVotes);
    $isTie = count($topCandidates) > 1 && $maxVotes > 0;

    echo '<div class="container">';
    echo '<h3 class="mb-4">Election Results</h3>';
    echo '<ul class="list-group">';

    foreach ($results as $res) {
        echo '<li class="list-group-item d-flex justify-content-between align-items-center">';
        echo '<span>' . htmlspecialchars($res['fullname']) . '</span>';
        echo '<span><strong>' . $res['votecount'] . ' votes</strong> ';

        if ($res['votecount'] === $maxVotes && $maxVotes > 0) {
            echo $isTie
                ? '<span class="badge bg-warning text-dark ms-2">Tie</span>'
                : '<span class="badge bg-success ms-2">Winner</span>';
        } else {
            echo '<span class="badge bg-secondary ms-2">Loser</span>';
        }

        echo '</span>';
        echo '</li>';
    }

    echo '</ul>';
    echo '</div>';
} else {
    echo '<div class="container"><div class="alert alert-warning mt-4">No candidates found.</div></div>';
}
?>

</body>
</html>
