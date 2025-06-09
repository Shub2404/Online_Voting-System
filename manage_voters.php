<?php
include('db/connection.php');
$result = mysqli_query($conn, "SELECT * FROM voters");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Voters</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
    background: linear-gradient(135deg, #dfe9f3 0%, #ffffff 100%);
    font-family: 'Segoe UI', sans-serif;
    min-height: 100vh;
}

.table-container {
    background: rgba(255, 255, 255, 0.9);
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    animation: fadeInSlide 0.8s ease;
    backdrop-filter: blur(8px);
}

@keyframes fadeInSlide {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

tr {
    transition: all 0.3s ease;
}

tr:hover {
    background-color: #e6f0fa !important;
    transform: scale(1.01);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.status-badge {
    padding: 6px 14px;
    border-radius: 20px;
    font-weight: bold;
    font-size: 14px;
    transition: background 0.3s ease, transform 0.2s ease;
}

.status-VOTED {
    background: linear-gradient(to right, #a8e063, #56ab2f);
    color: white;
}

.status-NOTVOTED {
    background: linear-gradient(to right, #e53935, #e35d5b);
    color: white;
}

#searchInput {
    padding: 12px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-shadow: inset 0 1px 2px rgba(0,0,0,0.05);
    transition: box-shadow 0.3s ease;
}

#searchInput:focus {
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    outline: none;
}
body {
            background-color: #f1f4f9;
            font-family: 'Segoe UI', sans-serif;
        }

        .container {
            margin-top: 60px;
        }

        .table-container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.1);
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(10px);}
            to {opacity: 1; transform: translateY(0);}
        }

        tr:hover {
            background-color: #f6f9fc;
        }

        .status-badge {
            padding: 6px 14px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 14px;
        }

        .status-VOTED {
            background-color: #d4edda;
            color: #155724;
        }

        .status-NOTVOTED {
            background-color: #f8d7da;
            color: #721c24;
        }

        #searchInput {
            width: 100%;
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        h2 {
            text-align: center;
            font-weight: 600;
            margin-bottom: 30px;
        }
        

    </style>
</head>
<body>

<div class="container">
    <div class="table-container">
        <h2>Manage Voters</h2>

        <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search by username, name or status...">

        <table class="table table-bordered table-striped" id="voterTable">
            <thead class="table-dark">
                <tr>
                    <th>Username</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['username']) ?></td>
                    <td><?= htmlspecialchars($row['firstname']) ?></td>
                    <td><?= htmlspecialchars($row['lastname']) ?></td>
                    <td>
                        <span class="status-badge status-<?= htmlspecialchars($row['status']) ?>">
                            <?= htmlspecialchars($row['status']) ?>
                        </span>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function searchTable() {
    const input = document.getElementById("searchInput").value.toUpperCase();
    const table = document.getElementById("voterTable");
    const trs = table.getElementsByTagName("tr");

    for (let i = 1; i < trs.length; i++) {
        let show = false;
        const tds = trs[i].getElementsByTagName("td");
        for (let j = 0; j < tds.length; j++) {
            const td = tds[j];
            if (td && td.textContent.toUpperCase().includes(input)) {
                show = true;
                break;
            }
        }
        trs[i].style.display = show ? "" : "none";
    }
}
</script>

</body>
</html>
