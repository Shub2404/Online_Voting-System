<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #ffe0c3, #ffecd2);
            font-family: 'Segoe UI', sans-serif;
        }
        .navbar {
            background-color: #6a5acd;
        }
        .navbar a, .navbar-brand {
            color: white !important;
            font-weight: bold;
        }
        .dashboard-title {
            text-align: center;
            margin: 30px 0 20px;
            font-weight: bold;
            color: #333;
        }
        .election-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s;
            cursor: pointer;
        }
        .election-card:hover {
            transform: translateY(-5px);
        }
        .election-card img {
            height: 150px;
            object-fit: cover;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }
        .election-card-title {
            font-size: 1.2rem;
            font-weight: bold;
            margin-top: 10px;
            color: #333;
        }
        .election-card-body {
            padding: 15px;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand">Online Voting System</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a href="#" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="lan_view.php" class="nav-link">Vote Results</a></li>
                <li class="nav-item"><a href="profile.php" class="nav-link">Profile</a></li>
                <li class="nav-item"><a href="change_pass.php" class="nav-link">Change Password</a></li>
                <li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="container">
    <h2 class="dashboard-title">Choose an Election</h2>
    <div class="row g-4">
        <?php
        $elections = [
            ['title' => 'Loksabha Election', 'img' => 'images (9).jpg', 'link' => 'vote.php?election=loksabha'],
            ['title' => 'Vidhan Sabha Election', 'img' => 'download (30).jpg', 'link' => 'vote.php?election=vidhansabha'],
            ['title' => 'Gram Panchayat Election', 'img' => 'download (31).jpg', 'link' => 'vote.php?election=gram_panchayat'],
            ['title' => 'Mayor Election', 'img' => 'download (32).jpg', 'link' => 'vote.php?election=mayor'],
            ['title' => 'College President Election', 'img' => 'gettyimages-1683456546-612x612.jpg', 'link' => 'vote.php?election=college_president'],
        ];

        foreach ($elections as $election) {
            echo '
            <div class="col-md-4">
                <div class="election-card" onclick="location.href=\'' . $election['link'] . '\'">
                    <img src="' . $election['img'] . '" class="w-100">
                    <div class="election-card-body text-center">
                        <div class="election-card-title">' . $election['title'] . '</div>
                    </div>
                </div>
            </div>';
        }
        ?>
    </div>
</div>

</body>
</html>
