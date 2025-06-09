<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            background: #f2f6fc;
        }

        .navbar {
            background: linear-gradient(to right, #4e54c8, #8f94fb);
            padding: 15px 20px;
            color: white;
            font-size: 20px;
            display: flex;
            justify-content: space-between;
        }

        .navbar a {
            color: white;
            margin-left: 20px;
            text-decoration: none;
            font-weight: bold;
        }

        .container {
            padding: 30px;
            animation: fadeIn 0.7s ease-in;
        }

        .card {
            background: white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            border-radius: 12px;
            padding: 20px;
            margin: 20px 0;
            transition: transform 0.2s ease;
        }

        .card:hover {
            transform: scale(1.02);
        }

        .stats {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .stat-card {
            flex: 1;
            min-width: 200px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 20px;
            border-radius: 10px;
        }

        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(20px);}
            to {opacity: 1; transform: translateY(0);}
        }
    </style>
</head>
<body>

    <div class="navbar">
        <div>Welcome, Admin</div>
        <div>
            <a href="manage_voters.php">Manage Voters</a>
            <a href="elections.php">Elections</a>
            <a href="results.php">Results</a>
            <a href="admin_logout.php">Logout</a>
        </div>
    </div>

    <div class="container">
        <h2>Admin Dashboard</h2>

        <div class="stats">
            <div class="stat-card">
                <h3>Total Voters</h3>
                <p><?php include 'count_voters.php'; ?></p>
            </div>
            <div class="stat-card">
                <h3>Ongoing Elections</h3>
                <p><?php include 'count_elections.php'; ?></p>
            </div>
        </div>

        <div class="card">
            <h3>Recent Activities</h3>
            <ul>
                <li>Voter “Rahul” registered - 5 mins ago</li>
                <li>Election “Local Body” created - 1 hour ago</li>
                <li>Result for “2025 Mayoral Election” declared</li>
            </ul>
        </div>
    </div>

</body>
</html>
