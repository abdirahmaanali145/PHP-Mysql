<?php
session_start();

$errors = [];
$values = [
    'student_name' => '', 'pob' => '', 'dob' => '', 'address' => '',
    'gender' => '', 'telephone' => '', 'email' => '',
    'parent_name' => '', 'parent_telephone' => '', 'relationship' => '',
    'student_id' => '', 'faculty' => '', 'department' => '', 'class_name' => '',
    'registration_date' => ''
];

$labels = [
    'student_name' => 'Student name',
    'pob' => 'Place of birth',
    'dob' => 'Date of birth',
    'address' => 'Address',
    'gender' => 'Gender',
    'telephone' => 'Student telephone',
    'email' => 'Email',
    'parent_name' => 'Parent/guardian name',
    'parent_telephone' => 'Parent/guardian telephone',
    'relationship' => 'Relationship',
    'student_id' => 'Student ID',
    'faculty' => 'Faculty',
    'department' => 'Department',
    'class_name' => 'Class',
    'registration_date' => 'Registration date'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($values as $key => $value) {
        $values[$key] = trim($_POST[$key] ?? '');
        if ($values[$key] === '') {
            $errors[$key] = 'Please enter ' . strtolower($labels[$key]) . '.';
        }
    }

    if ($values['student_name'] !== '' &&
        !preg_match("/^[\p{L} ]+$/u", $values['student_name'])) {
        $errors['student_name'] = 'Student name must contain letters and spaces only.';
    }

    if ($values['parent_name'] !== '' &&
        !preg_match("/^[\p{L} ]+$/u", $values['parent_name'])) {
        $errors['parent_name'] = 'Parent/guardian name must contain letters and spaces only.';
    }

    if ($values['email'] !== '' &&
        !filter_var($values['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address.';
    }

    if (!isset($_FILES['image']) || $_FILES['image']['error'] === UPLOAD_ERR_NO_FILE) {
        $errors['image'] = 'Please choose a student image.';
    } elseif ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        $errors['image'] = 'The image could not be uploaded. Please try again.';
    } else {
        $maxSize = 5 * 1024 * 1024; // 5 MB
        if ($_FILES['image']['size'] > $maxSize) {
            $errors['image'] = 'Image must be 5 MB or smaller.';
        } else {
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime = $finfo->file($_FILES['image']['tmp_name']);
            $allowedTypes = [
                'image/jpeg' => 'jpg',
                'image/png'  => 'png',
                'image/gif'  => 'gif',
                'image/webp' => 'webp'
            ];
            if (!isset($allowedTypes[$mime])) {
                $errors['image'] = 'Only JPG, JPEG, PNG, GIF, and WEBP image files are allowed.';
            }
        }
    }

    if (!$errors) {
        $uploadDir = __DIR__ . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;
        if (!is_dir($uploadDir) && !mkdir($uploadDir, 0755, true)) {
            $errors['image'] = 'Upload folder could not be created.';
        } else {
            $extension = $allowedTypes[$mime];
            $imageName = 'student_' . bin2hex(random_bytes(8)) . '.' . $extension;
            $destination = $uploadDir . $imageName;

            if (!move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
                $errors['image'] = 'Image upload failed. Please try again.';
            } else {
                $values['image'] = 'uploads/' . $imageName;
                $_SESSION['student_registration'] = $values;
                header('Location: result.php');
                exit;
            }
        }
    }
}

function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

function fieldError($key, $errors) {
    if (isset($errors[$key])) {
        return '<div class="invalid-feedback d-block">' . e($errors[$key]) . '</div>';
    }
    return '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration Form</title>
    <link href=""C:\Users\Hp\Pictures\screnshot week3\check if specific key exists in an array.png  rel="stylesheet">
    <style>
        body { background: #f3f6fb; }
        .page-wrap { max-width: 1000px; }
        .form-card { border: 0; border-radius: 16px; box-shadow: 0 8px 28px rgba(25, 45, 80, .09); }
        .section-title { color: #174ea6; font-weight: 700; border-bottom: 2px solid #e6edf8; padding-bottom: .65rem; margin-bottom: 1.25rem; }
        .required::after { content: " *"; color: #dc3545; }
    </style>
</head>
<body>
<div class="container page-wrap py-5">
    <div class="text-center mb-4">
        <h1 class="fw-bold">Student Registration</h1>
        <p class="text-secondary mb-0">Please complete all sections before registering.</p>
    </div>

    <?php if ($errors): ?>
        <div class="alert alert-danger" role="alert">
            <strong>Please correct the following:</strong>
            <ul class="mb-0 mt-2">
                <?php foreach ($errors as $message): ?>
                    <li><?= e($message) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="index.php" enctype="multipart/form-data" novalidate>
        <div class="card form-card mb-4">
            <div class="card-body p-4 p-md-5">
                <h2 class="h4 section-title">1. Personal Information</h2>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="student_name" class="form-label required">Full Name</label>
                        <input type="text" class="form-control <?= isset($errors['student_name']) ? 'is-invalid' : '' ?>" id="student_name" name="student_name" value="<?= e($values['student_name']) ?>" required>
                        <?= fieldError('student_name', $errors) ?>
                    </div>
                    <div class="col-md-6">
                        <label for="pob" class="form-label required">Place of Birth (POB)</label>
                        <input type="text" class="form-control" id="pob" name="pob" value="<?= e($values['pob']) ?>" required>
                        <?= fieldError('pob', $errors) ?>
                    </div>
                    <div class="col-md-6">
                        <label for="dob" class="form-label required">Date of Birth (DOB)</label>
                        <input type="date" class="form-control" id="dob" name="dob" value="<?= e($values['dob']) ?>" max="<?= date('Y-m-d') ?>" required>
                        <?= fieldError('dob', $errors) ?>
                    </div>
                    <div class="col-md-6">
                        <label for="address" class="form-label required">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="<?= e($values['address']) ?>" required>
                        <?= fieldError('address', $errors) ?>
                    </div>
                    <div class="col-md-6">
                        <label for="gender" class="form-label required">Gender</label>
                        <select class="form-select" id="gender" name="gender" required>
                            <option value="">Choose gender</option>
                            <option value="Male" <?= $values['gender'] === 'Male' ? 'selected' : '' ?>>Male</option>
                            <option value="Female" <?= $values['gender'] === 'Female' ? 'selected' : '' ?>>Female</option>
                            <option value="Other" <?= $values['gender'] === 'Other' ? 'selected' : '' ?>>Other</option>
                        </select>
                        <?= fieldError('gender', $errors) ?>
                    </div>
                    <div class="col-md-6">
                        <label for="telephone" class="form-label required">Telephone</label>
                        <input type="tel" class="form-control" id="telephone" name="telephone" value="<?= e($values['telephone']) ?>" required>
                        <?= fieldError('telephone', $errors) ?>
                    </div>
                    <div class="col-12">
                        <label for="email" class="form-label required">Email</label>
                        <input type="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" id="email" name="email" value="<?= e($values['email']) ?>" required>
                        <?= fieldError('email', $errors) ?>
                    </div>
                    <div class="col-12">
                        <label for="image" class="form-label required">Student Image</label>
                        <input type="file" class="form-control <?= isset($errors['image']) ? 'is-invalid' : '' ?>" id="image" name="image" accept=".jpg,.jpeg,.png,.gif,.webp,image/jpeg,image/png,image/gif,image/webp" required>
                        <div class="form-text">Allowed: JPG, JPEG, PNG, GIF, WEBP. Maximum size: 5 MB.</div>
                        <?= fieldError('image', $errors) ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="card form-card mb-4">
            <div class="card-body p-4 p-md-5">
                <h2 class="h4 section-title">2. Parent Information</h2>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="parent_name" class="form-label required">Parent/Guardian Name</label>
                        <input type="text" class="form-control <?= isset($errors['parent_name']) ? 'is-invalid' : '' ?>" id="parent_name" name="parent_name" value="<?= e($values['parent_name']) ?>" required>
                        <?= fieldError('parent_name', $errors) ?>
                    </div>
                    <div class="col-md-6">
                        <label for="parent_telephone" class="form-label required">Parent/Guardian Telephone</label>
                        <input type="tel" class="form-control" id="parent_telephone" name="parent_telephone" value="<?= e($values['parent_telephone']) ?>" required>
                        <?= fieldError('parent_telephone', $errors) ?>
                    </div>
                    <div class="col-12">
                        <label for="relationship" class="form-label required">Relationship</label>
                        <select class="form-select" id="relationship" name="relationship" required>
                            <option value="">Choose relationship</option>
                            <?php foreach (['Father', 'Mother', 'Guardian', 'Other'] as $relationship): ?>
                                <option value="<?= e($relationship) ?>" <?= $values['relationship'] === $relationship ? 'selected' : '' ?>><?= e($relationship) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?= fieldError('relationship', $errors) ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="card form-card mb-4">
            <div class="card-body p-4 p-md-5">
                <h2 class="h4 section-title">3. Academic Information</h2>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="student_id" class="form-label required">Student ID</label>
                        <input type="text" class="form-control" id="student_id" name="student_id" value="<?= e($values['student_id']) ?>" required>
                        <?= fieldError('student_id', $errors) ?>
                    </div>
                    <div class="col-md-6">
                        <label for="faculty" class="form-label required">Faculty</label>
                        <input type="text" class="form-control" id="faculty" name="faculty" value="<?= e($values['faculty']) ?>" required>
                        <?= fieldError('faculty', $errors) ?>
                    </div>
                    <div class="col-md-6">
                        <label for="department" class="form-label required">Department</label>
                        <input type="text" class="form-control" id="department" name="department" value="<?= e($values['department']) ?>" required>
                        <?= fieldError('department', $errors) ?>
                    </div>
                    <div class="col-md-6">
                        <label for="class_name" class="form-label required">Class</label>
                        <input type="text" class="form-control" id="class_name" name="class_name" value="<?= e($values['class_name']) ?>" required>
                        <?= fieldError('class_name', $errors) ?>
                    </div>
                    <div class="col-md-6">
                        <label for="registration_date" class="form-label required">Registration Date</label>
                        <input type="date" class="form-control" id="registration_date" name="registration_date" value="<?= e($values['registration_date']) ?>" required>
                        <?= fieldError('registration_date', $errors) ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-grid d-sm-flex justify-content-sm-end gap-2">
            <button type="reset" class="btn btn-outline-secondary btn-lg">Clear Form</button>
            <button type="submit" class="btn btn-primary btn-lg px-5">Register Student</button>
        </div>
    </form>
    <p class="text-center text-secondary small mt-4">PHP xammp; MySQL — Chapter 4 Assignment (Forms)</p>
</div>
<script>
    // Send the user to the first field that needs attention after server-side validation.
    document.addEventListener('DOMContentLoaded', function () {
        const firstInvalid = document.querySelector('.is-invalid, .invalid-feedback.d-block');
        if (firstInvalid) {
            const field = firstInvalid.matches('input, select, textarea')
                ? firstInvalid
                : firstInvalid.previousElementSibling;
            if (field && typeof field.focus === 'function') {
                field.focus();
                field.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }
    });
</script>
</body>
</html>
