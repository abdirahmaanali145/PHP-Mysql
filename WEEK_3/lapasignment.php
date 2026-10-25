<?php
$faculties = ['Arts', 'Business', 'Education', 'Engineering', 'Health Sciences', 'Science'];
$subjects = ['Subject 1', 'Subject 2', 'Subject 3', 'Subject 4', 'Subject 5', 'Subject 6'];
$values = [
    'student_name' => '',
    'student_id' => '',
    'gender' => '',
    'faculty' => '',
    'marks' => array_fill(0, count($subjects), ''),
];
$errors = [];
$success = false;
$examFileName = '';
$maxFileSize = 5 * 1024 * 1024;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $values['student_name'] = trim((string) ($_POST['student_name'] ?? ''));
    $values['student_id'] = trim((string) ($_POST['student_id'] ?? ''));
    $values['gender'] = (string) ($_POST['gender'] ?? '');
    $values['faculty'] = (string) ($_POST['faculty'] ?? '');

    if ($values['student_name'] === '') {
        $errors['student_name'] = 'Enter the student name.';
    }
    if ($values['student_id'] === '') {
        $errors['student_id'] = 'Enter the student ID.';
    }
    if (!in_array($values['gender'], ['Female', 'Male', 'Other'], true)) {
        $errors['gender'] = 'Choose a gender.';
    }
    if (!in_array($values['faculty'], $faculties, true)) {
        $errors['faculty'] = 'Choose a faculty.';
    }

    foreach ($subjects as $index => $subject) {
        $mark = trim((string) ($_POST['marks'][$index] ?? ''));
        $values['marks'][$index] = $mark;
        if ($mark === '' || !is_numeric($mark) || (float) $mark < 0 || (float) $mark > 100) {
            $errors["mark_$index"] = "$subject must be a number from 0 to 100.";
        }
    }

    $examFile = $_FILES['examination'] ?? null;
    if (!$examFile || $examFile['error'] === UPLOAD_ERR_NO_FILE) {
        $errors['examination'] = 'Upload the examination file.';
    } elseif ($examFile['error'] !== UPLOAD_ERR_OK) {
        $errors['examination'] = 'The examination file could not be uploaded.';
    } elseif ($examFile['size'] > $maxFileSize) {
        $errors['examination'] = 'The examination file must be 5 MB or smaller.';
    } elseif ((new finfo(FILEINFO_MIME_TYPE))->file($examFile['tmp_name']) !== 'application/pdf') {
        $errors['examination'] = 'Upload a PDF examination file.';
    }

    if (!$errors) {
        $uploadDirectory = _DIR_ . '/uploads';
        if (!is_dir($uploadDirectory) && !mkdir($uploadDirectory, 0755, true) && !is_dir($uploadDirectory)) {
            $errors['examination'] = 'The upload folder could not be created.';
        } else {
            $examFileName = bin2hex(random_bytes(16)) . '.pdf';
            if (!move_uploaded_file($examFile['tmp_name'], $uploadDirectory . '/' . $examFileName)) {
                $errors['examination'] = 'The examination file could not be saved.';
            } else {
                $success = true;
            }
        }
    }
}

function escape(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function gradeForMark(float $mark): string
{
    if ($mark >= 80) {
        return 'A';
    }
    if ($mark >= 70) {
        return 'B';
    }
    if ($mark >= 60) {
        return 'C';
    }
    if ($mark >= 50) {
        return 'D';
    }
    return 'F';
}

$overallPass = $success && count(array_filter($values['marks'], static fn ($mark): bool => (float) $mark >= 50)) === count($subjects);
$averageMark = $success ? array_sum(array_map('floatval', $values['marks'])) / count($subjects) : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information</title>
    <style>
        :root {
            color-scheme: light;
            font-family: "Segoe UI", Tahoma, sans-serif;
            color: #202b35;
            background: #f3f5f2;
            font-synthesis: none;
        }
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; background: linear-gradient(135deg, #f3f5f2 0%, #e7efed 100%); }
        header { padding: 30px max(24px, calc((100% - 880px) / 2)); background: #174b3b; color: #fff; }
        header p { margin: 0 0 5px; color: #c7e0d4; font-size: 13px; text-transform: uppercase; }
        h1 { margin: 0; font-size: 28px; font-weight: 650; }
        main { width: min(880px, calc(100% - 32px)); margin: 28px auto 48px; }
        form, .result { padding: 28px; background: #fff; border: 1px solid #dbe3df; border-radius: 6px; box-shadow: 0 12px 32px #1a3a2d0c; }
        section + section { margin-top: 28px; }
        h2 { margin: 0 0 16px; padding-bottom: 9px; border-bottom: 1px solid #dce5e0; color: #174b3b; font-size: 17px; }
        .grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; }
        .field label, legend { display: block; margin-bottom: 7px; font-size: 14px; font-weight: 600; }
        input, select { width: 100%; min-height: 42px; padding: 9px 11px; border: 1px solid #cbd5d0; border-radius: 4px; background: #fff; color: #202b35; font: inherit; }
        input:focus, select:focus { outline: 3px solid #31826733; border-color: #318267; }
        fieldset { margin: 0; padding: 0; border: 0; }
        .radio-row { display: flex; flex-wrap: wrap; gap: 18px; min-height: 42px; align-items: center; }
        .radio-row label { display: inline-flex; align-items: center; gap: 7px; margin: 0; font-weight: 400; }
        .radio-row input { width: 16px; min-height: 16px; margin: 0; accent-color: #174b3b; }
        .marks { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 14px; }
        .hint { margin: 6px 0 0; color: #63716a; font-size: 12px; }
        .error { margin: 6px 0 0; color: #a12828; font-size: 13px; }
        .alert { margin-bottom: 20px; padding: 14px 16px; border-radius: 4px; }
        .alert-error { border: 1px solid #e8b8b8; background: #fff2f2; color: #7d2020; }
        .alert-success { border: 1px solid #b8d8c9; background: #edf8f1; color: #174b3b; }
        .alert ul { margin: 8px 0 0; }
        .actions { margin-top: 26px; }
        button { min-height: 44px; padding: 0 20px; border: 0; border-radius: 4px; background: #174b3b; color: #fff; font: inherit; font-weight: 600; cursor: pointer; }
        button:hover { background: #103a2d; }
        .result dl { display: grid; grid-template-columns: 150px 1fr; gap: 10px 18px; }
        .result dt { font-weight: 600; }
        .result dd { margin: 0; }
        @media (max-width: 600px) {
            form, .result { padding: 20px; }
            .grid, .marks { grid-template-columns: 1fr; }
            .result dl { grid-template-columns: 1fr; gap: 4px; }
            .result dd { margin-bottom: 8px; }
        }
    </style>
</head>
<body>
    <header>
        <p>Student Services</p>
        <h1>Student Information</h1>
    </header>
    <main>
        <?php if ($errors): ?>
            <div class="alert alert-error" role="alert">
                <strong>Please correct the following:</strong>
                <ul><?php foreach ($errors as $message): ?><li><?= escape($message) ?></li><?php endforeach; ?></ul>
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <section class="result alert-success" aria-labelledby="submitted-heading">
                <h2 id="submitted-heading">Student information submitted</h2>
                <dl>
                    <dt>Student name</dt><dd><?= escape($values['student_name']) ?></dd>
                    <dt>Student ID</dt><dd><?= escape($values['student_id']) ?></dd>
                    <dt>Gender</dt><dd><?= escape($values['gender']) ?></dd>
                    <dt>Faculty</dt><dd><?= escape($values['faculty']) ?></dd>
                    <dt>Overall result</dt><dd><?= $overallPass ? 'Pass' : 'Fail' ?></dd>
                    <dt>Average grade</dt><dd><?= escape(gradeForMark($averageMark)) ?> (<?= escape((string) round($averageMark, 2)) ?>%)</dd>
                    <?php foreach ($subjects as $index => $subject): ?>
                        <?php $mark = (float) $values['marks'][$index]; ?>
                        <dt><?= escape($subject) ?></dt>
                        <dd><?= escape($values['marks'][$index]) ?>% | Grade <?= escape(gradeForMark($mark)) ?> | <?= $mark >= 50 ? 'Pass' : 'Fail' ?></dd>
                    <?php endforeach; ?>
                    <dt>Examination file</dt><dd><?= escape($examFileName) ?></dd>
                </dl>
            </section>
        <?php else: ?>
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="MAX_FILE_SIZE" value="<?= $maxFileSize ?>">
                <section aria-labelledby="details-heading">
                    <h2 id="details-heading">Student details</h2>
                    <div class="grid">
                        <div class="field">
                            <label for="student_name">Student name</label>
                            <input id="student_name" name="student_name" value="<?= escape($values['student_name']) ?>" required autocomplete="name">
                        </div>
                        <div class="field">
                            <label for="student_id">Student ID</label>
                            <input id="student_id" name="student_id" value="<?= escape($values['student_id']) ?>" required>
                        </div>
                        <fieldset>
                            <legend>Gender</legend>
                            <div class="radio-row">
                                <?php foreach (['Female', 'Male', 'Other'] as $gender): ?>
                                    <label><input type="radio" name="gender" value="<?= escape($gender) ?>" <?= $values['gender'] === $gender ? 'checked' : '' ?> required> <?= escape($gender) ?></label>
                                <?php endforeach; ?>
                            </div>
                        </fieldset>
                        <div class="field">
                            <label for="faculty">Faculty</label>
                            <select id="faculty" name="faculty" required>
                                <option value="">Choose a faculty</option>
                                <?php foreach ($faculties as $faculty): ?>
                                    <option value="<?= escape($faculty) ?>" <?= $values['faculty'] === $faculty ? 'selected' : '' ?>><?= escape($faculty) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </section>

                <section aria-labelledby="marks-heading">
                    <h2 id="marks-heading">Subject marks</h2>
                    <div class="marks">
                        <?php foreach ($subjects as $index => $subject): ?>
                            <div class="field">
                                <label for="mark-<?= $index ?>"><?= escape($subject) ?></label>
                                <input id="mark-<?= $index ?>" type="number" name="marks[<?= $index ?>]" min="0" max="100" step="any" value="<?= escape($values['marks'][$index]) ?>" required>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>

                <section aria-labelledby="exam-heading">
                    <h2 id="exam-heading">Examination file</h2>
                    <div class="field">
                        <label for="examination">Upload examination (PDF)</label>
                        <input id="examination" type="file" name="examination" accept="application/pdf,.pdf" required>
                        <p class="hint">PDF only, maximum 5 MB.</p>
                    </div>
                </section>

                <div class="actions"><button type="submit">Submit student information</button></div>
            </form>
        <?php endif; ?>
    </main>
</body>
</html>