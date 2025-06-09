<?php
if (!isset($_SESSION)) { 
    session_start();
}
include "auth.php";
include "header_voter.php";
?>
<html>
<head>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #74ebd5, #9face6);
            margin: 0;
            padding: 20px;
            animation: fadeIn 1s ease-in;
        }

        h3 {
            color: #2c3e50;
            text-align: center;
            font-size: 30px;
            margin-top: 30px;
            animation: slideDown 1s ease-in;
        }

        table {
            width: 90%;
            margin: 30px auto;
            border-collapse: collapse;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
            border-radius: 12px;
            overflow: hidden;
            animation: fadeInUp 1s ease;
        }

        th, td {
            padding: 15px;
            text-align: left;
        }

        th {
            background: linear-gradient(90deg, #4e54c8, #8f94fb);
            color: white;
            font-size: 18px;
        }

        td {
            background-color: #ffffffd9;
            color: #333;
            font-size: 16px;
        }

        tr:nth-child(even) td {
            background-color: #f1f4ff;
        }

        tr:hover td {
            background-color: #e0ecff;
            transition: background-color 0.3s ease;
        }

        .no-results {
            color: #e74c3c;
            font-weight: bold;
            text-align: center;
            font-size: 18px;
            margin-top: 40px;
            animation: fadeIn 1s ease;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
    <title>Voting Results</title>
</head>
<body>
    <h3>Voting So Far</h3>

    <?php
    include "connection.php";
    
    $member = mysqli_query($con, 'SELECT * FROM languages');
    if (!$member) {
        die('Query failed: ' . mysqli_error($con));
    }

    if (mysqli_num_rows($member) == 0) {
        echo '<div class="no-results">No results found</div>';
    } else {
        echo '<table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Party</th>
                        <th>Candidate</th>
                        <th>Vote Count</th>
                    </tr>
                </thead>
                <tbody>';
        
        while ($mb = mysqli_fetch_object($member)) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($mb->lan_id) . '</td>';        
            echo '<td>' . htmlspecialchars($mb->fullname) . '</td>';
            echo '<td>' . htmlspecialchars($mb->about) . '</td>';
            echo '<td>' . htmlspecialchars($mb->votecount) . '</td>';
            echo '</tr>';
        }

        echo '</tbody></table>';
    }
    ?>
</body>
</html>
