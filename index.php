<?php
require 'db.php';

$errors  = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $full_name   = trim($_POST['fullName']   ?? '');
    $dob         = trim($_POST['dob']        ?? '');
    $age         = intval($_POST['age']      ?? 0);
    $gender      = trim($_POST['gender']     ?? '');
    $religion    = trim($_POST['religion']   ?? '');
    $education   = trim($_POST['education']  ?? '');
    $profession  = trim($_POST['profession'] ?? '');
    $father_name = trim($_POST['fatherName'] ?? '');
    $mother_name = trim($_POST['motherName'] ?? '');
    $contact     = trim($_POST['contact']    ?? '');
    $address     = trim($_POST['address']    ?? '');

    // Server-side validation
    if ($full_name === '')                          $errors['fullName']   = 'Full Name is required.';
    if ($dob === '')                                $errors['dob']        = 'Date of Birth is required.';
    if ($age < 18 || $age > 100)                   $errors['age']        = 'Valid age (18–100) is required.';
    if ($gender === '')                             $errors['gender']     = 'Please select a gender.';
    if ($religion === '')                           $errors['religion']   = 'Religion is required.';
    if ($education === '')                          $errors['education']  = 'Education is required.';
    if ($profession === '')                         $errors['profession'] = 'Profession is required.';
    if ($father_name === '')                        $errors['fatherName'] = "Father's Name is required.";
    if ($mother_name === '')                        $errors['motherName'] = "Mother's Name is required.";
    if (!preg_match('/^[0-9]{10,15}$/', $contact)) $errors['contact']    = 'Enter a valid contact number (10–15 digits).';
    if ($address === '')                            $errors['address']    = 'Address is required.';

    if (empty($errors)) {
        $stmt = $pdo->prepare('
            INSERT INTO biodata
                (full_name, dob, age, gender, religion, education, profession,
                 father_name, mother_name, contact, address)
            VALUES
                (:full_name, :dob, :age, :gender, :religion, :education, :profession,
                 :father_name, :mother_name, :contact, :address)
        ');
        $stmt->execute([
            ':full_name'   => $full_name,
            ':dob'         => $dob,
            ':age'         => $age,
            ':gender'      => $gender,
            ':religion'    => $religion,
            ':education'   => $education,
            ':profession'  => $profession,
            ':father_name' => $father_name,
            ':mother_name' => $mother_name,
            ':contact'     => $contact,
            ':address'     => $address,
        ]);
        $success = 'Record saved successfully!';
    }
}

// Helper to re-populate field value safely
function old(string $key, string $default = ''): string {
    return htmlspecialchars(trim($_POST[$key] ?? $default), ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matrimonial Biodata Form</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>

<div class="container">
    <div class="nav-links">
        <a href="records.php" class="nav-btn">View All Records</a>
    </div>

    <h1 class="form-title">Matrimonial Biodata Form</h1>

    <?php if ($success): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?> <a href="records.php">View Records →</a></div>
    <?php endif; ?>

    <form id="biodataForm" method="POST" action="index.php" novalidate>

        <div class="form-group">
            <label for="fullName">Full Name</label>
            <input type="text" id="fullName" name="fullName" value="<?= old('fullName') ?>" required>
            <span class="error-message" id="fullNameError"><?= $errors['fullName'] ?? '' ?></span>
        </div>

        <div class="form-group">
            <label for="dob">Date of Birth</label>
            <input type="date" id="dob" name="dob" value="<?= old('dob') ?>" required>
            <span class="error-message" id="dobError"><?= $errors['dob'] ?? '' ?></span>
        </div>

        <div class="form-group">
            <label for="age">Age</label>
            <input type="number" id="age" name="age" min="18" max="100" value="<?= old('age') ?>" required>
            <span class="error-message" id="ageError"><?= $errors['age'] ?? '' ?></span>
        </div>

        <div class="form-group">
            <label for="gender">Gender</label>
            <select id="gender" name="gender" required>
                <option value="">Select</option>
                <?php foreach (['Male', 'Female', 'Other'] as $g): ?>
                    <option value="<?= $g ?>" <?= (old('gender') === $g) ? 'selected' : '' ?>><?= $g ?></option>
                <?php endforeach; ?>
            </select>
            <span class="error-message" id="genderError"><?= $errors['gender'] ?? '' ?></span>
        </div>

        <div class="form-group">
            <label for="religion">Religion</label>
            <input type="text" id="religion" name="religion" value="<?= old('religion') ?>" required>
            <span class="error-message" id="religionError"><?= $errors['religion'] ?? '' ?></span>
        </div>

        <div class="form-group">
            <label for="education">Education</label>
            <input type="text" id="education" name="education" value="<?= old('education') ?>" required>
            <span class="error-message" id="educationError"><?= $errors['education'] ?? '' ?></span>
        </div>

        <div class="form-group">
            <label for="profession">Profession</label>
            <input type="text" id="profession" name="profession" value="<?= old('profession') ?>" required>
            <span class="error-message" id="professionError"><?= $errors['profession'] ?? '' ?></span>
        </div>

        <div class="form-group">
            <label for="fatherName">Father's Name</label>
            <input type="text" id="fatherName" name="fatherName" value="<?= old('fatherName') ?>" required>
            <span class="error-message" id="fatherNameError"><?= $errors['fatherName'] ?? '' ?></span>
        </div>

        <div class="form-group">
            <label for="motherName">Mother's Name</label>
            <input type="text" id="motherName" name="motherName" value="<?= old('motherName') ?>" required>
            <span class="error-message" id="motherNameError"><?= $errors['motherName'] ?? '' ?></span>
        </div>

        <div class="form-group">
            <label for="contact">Contact Number</label>
            <input type="text" id="contact" name="contact" value="<?= old('contact') ?>" required>
            <span class="error-message" id="contactError"><?= $errors['contact'] ?? '' ?></span>
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <textarea rows="4" id="address" name="address" required><?= old('address') ?></textarea>
            <span class="error-message" id="addressError"><?= $errors['address'] ?? '' ?></span>
        </div>

        <button type="submit" class="submit-btn">Submit</button>
    </form>
</div>

<script src="script.js"></script>
</body>
</html>
