<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home</title>
<script src="jscript/validation.js" type="text/javascript"></script>
<style>
    body {
        margin: 0;
        padding: 0;
        background-color: #EBE9E9;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Marquee Styling */
    marquee {
        background-color: #2c3e50;
        color: #fff;
        padding: 10px 0;
        font-size: 18px;
        font-weight: bold;
    }

    /* Navbar Styling */
    .navbar {
        background: linear-gradient(to right, #4e54c8, #8f94fb);
        padding: 15px 0;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .navbar a {
        text-decoration: none;
        color: white;
        font-size: 20px;
        margin: 0 20px;
        padding: 10px 15px;
        transition: all 0.3s ease-in-out;
        position: relative;
    }

    .navbar a::before {
        content: '';
        position: absolute;
        bottom: 5px;
        left: 50%;
        transform: translateX(-50%);
        width: 0%;
        height: 3px;
        background-color: #ffdb58;
        transition: width 0.3s ease;
        border-radius: 2px;
    }

    .navbar a:hover::before {
        width: 100%;
    }

    .navbar a:hover {
        color: #ffd700;
        transform: scale(1.1);
    }

</style>
</head>

<body>
<marquee>Welcome To Online Voting System Coded By <b>SHUBHANKAR TIWARI & SNEHA JAISWAL</b></marquee>

<!-- Navigation Bar -->
<div class="navbar">
    <a href="voter.php">Home</a>
    <a href="lan_view.php">Vote Results</a>
    <a href="profile.php">Profile</a>
    <a href="logout.php">Logout</a>
    <a href="change_pass.php">Change Password</a>
</div>
</body>
</html>
