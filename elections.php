<?php
include('db/connection.php');

// Handle form submission to add election
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $status = $_POST['status'];

    $query = "INSERT INTO elections (title, description, start_date, end_date, status)
              VALUES ('$title', '$description', '$start_date', '$end_date', '$status')";
    mysqli_query($conn, $query);
    header("Location: elections.php");
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM elections");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Elections</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom right, #e0f7fa, #ffffff);
            font-family: 'Segoe UI', sans-serif;
        }
        .container {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 30px;
            margin-top: 50px;
            box-shadow: 0 0 25px rgba(0,0,0,0.1);
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(20px);}
            to {opacity: 1; transform: translateY(0);}
        }
        h2 {
            text-align: center;
            font-weight: bold;
            margin-bottom: 30px;
        }
        .form-control, .btn {
            border-radius: 8px;
        }
        .badge {
            font-size: 0.9em;
            padding: 0.5em 1em;
        }
        .table-hover tbody tr:hover {
            background-color: #f0f8ff;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Manage Elections</h2>

    <!-- Add Election Form -->
    <form method="POST" class="mb-4">
        <input type="text" name="title" class="form-control mb-2" placeholder="Election Title" required>
        <textarea name="description" class="form-control mb-2" placeholder="Election Description" required></textarea>
        <input type="date" name="start_date" class="form-control mb-2" required>
        <input type="date" name="end_date" class="form-control mb-2" required>
        <select name="status" class="form-control mb-3" required>
            <option value="upcoming">Upcoming</option>
            <option value="ongoing">Ongoing</option>
            <option value="completed">Completed</option>
        </select>
        <button type="submit" class="btn btn-primary w-100">Add Election</button>
    </form>

    <!-- Election Table -->
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= htmlspecialchars($row['title']) ?></td>
                <td><?= htmlspecialchars($row['description']) ?></td>
                <td><?= htmlspecialchars($row['start_date']) ?></td>
                <td><?= htmlspecialchars($row['end_date']) ?></td>
                <td>
                    <?php
                    $status = strtolower($row['status']);
                    $badgeColor = 'secondary';
                    if ($status == 'ongoing') $badgeColor = 'info';
                    elseif ($status == 'upcoming') $badgeColor = 'warning';
                    elseif ($status == 'completed') $badgeColor = 'success';
                    ?>
                    <span class="badge bg-<?= $badgeColor ?>"><?= strtoupper($row['status']) ?></span>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>
