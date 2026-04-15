<?php
require 'db.php';

$stmt    = $pdo->query('SELECT * FROM biodata ORDER BY id DESC');
$records = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Biodata Records</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>

<div class="container wide">
    <div class="nav-links">
        <a href="index.php" class="nav-btn">+ Add New Record</a>
    </div>

    <h1 class="form-title">All Biodata Records</h1>

    <?php if (isset($_GET['deleted'])): ?>
        <div class="alert alert-success">Record deleted successfully.</div>
    <?php endif; ?>

    <?php if (empty($records)): ?>
        <p class="no-records">No records found. <a href="index.php">Add one now →</a></p>
    <?php else: ?>
    <div class="table-wrapper">
        <table class="records-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Full Name</th>
                    <th>DOB</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Religion</th>
                    <th>Education</th>
                    <th>Profession</th>
                    <th>Father's Name</th>
                    <th>Mother's Name</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $row): ?>
                <tr>
                    <td><?= (int) $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['full_name'])   ?></td>
                    <td><?= htmlspecialchars($row['dob'])         ?></td>
                    <td><?= (int) $row['age']                     ?></td>
                    <td><?= htmlspecialchars($row['gender'])      ?></td>
                    <td><?= htmlspecialchars($row['religion'])    ?></td>
                    <td><?= htmlspecialchars($row['education'])   ?></td>
                    <td><?= htmlspecialchars($row['profession'])  ?></td>
                    <td><?= htmlspecialchars($row['father_name']) ?></td>
                    <td><?= htmlspecialchars($row['mother_name']) ?></td>
                    <td><?= htmlspecialchars($row['contact'])     ?></td>
                    <td><?= htmlspecialchars($row['address'])     ?></td>
                    <td class="action-btns">
                        <a href="edit.php?id=<?= (int) $row['id'] ?>" class="btn-edit">Edit</a>
                        <a href="delete.php?id=<?= (int) $row['id'] ?>"
                           class="btn-delete"
                           onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</div>

</body>
</html>
