<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Online Voting System</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Navbar Styling */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .topbar {
            background-color: #111;
            color: white;
            padding: 10px 0;
            text-align: center;
            font-weight: bold;
        }

        .navbar {
            background: linear-gradient(to right, #4b0082, #4169e1);
            display: flex;
            justify-content: center;
            gap: 40px;
            padding: 15px 0;
            position: relative;
        }

        .navbar .nav-item {
            position: relative;
        }

        .navbar button {
            background: none;
            border: none;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .dropdown {
            display: none;
            position: absolute;
            top: 40px;
            left: 50%;
            transform: translateX(-50%);
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
            z-index: 1000;
            min-width: 120px;
        }

        .dropdown a {
            display: block;
            padding: 10px 15px;
            color: #333;
            text-decoration: none;
        }

        .dropdown a:hover {
            background-color: #eee;
        }
    </style>
</head>
<body>

<div class="topbar">
    <marquee>Welcome To Online Voting System Coded By <b>SHUBHANKAR TIWARI & SNEHA JAISWAL</b></marquee>
</div>

<nav class="navbar">
    <a href="index.php">Home</a>
    <a href="about.php">About Us</a>
    <a href="contact.php">Contact Us</a>

    <div class="nav-item">
        <button onclick="toggleDropdown('adminDropdown')">Admin</button>
        <div id="adminDropdown" class="dropdown">
            <a href="admin_register.php">Register</a>
            <a href="admin_login.php">Login</a>
        </div>
    </div>

    <div class="nav-item">
        <button onclick="toggleDropdown('voterDropdown')">Voter</button>
        <div id="voterDropdown" class="dropdown">
            <a href="voter_register.php">Register</a>
            <a href="voter_login.php">Login</a>
        </div>
    </div>
</nav>

<script>
    function toggleDropdown(id) {
        // Close any other open dropdowns
        document.querySelectorAll('.dropdown').forEach(drop => {
            if (drop.id !== id) drop.style.display = 'none';
        });

        // Toggle the selected one
        const dropdown = document.getElementById(id);
        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
    }

    // Close dropdowns if clicked outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.nav-item')) {
            document.querySelectorAll('.dropdown').forEach(drop => drop.style.display = 'none');
        }
    });
</script>
