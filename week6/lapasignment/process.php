<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

include 'functions.php';

// Check the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $fullName = trim($_POST['full_name']);
    $employeeId = trim($_POST['employee_id']);
    $gender = $_POST['gender'];
    $department = $_POST['department'];
    $basicSalary = floatval($_POST['basic_salary']);
    $allowance = floatval($_POST['allowance']);
    $deduction = floatval($_POST['deduction']);
    
    // Validate form data
    $errors = [];
    if (empty($fullName)) {
        $errors[] = "Full name is required.";
    }
    if (empty($employeeId)) {
        $errors[] = "Employee ID is required.";
    }
    if (empty($gender)) {
        $errors[] = "Gender is required.";
    }
    if (empty($department)) {
        $errors[] = "Department is required.";
    }
    if ($basicSalary <= 0) {
        $errors[] = "Basic salary must be greater than zero.";
    }
    if ($allowance < 0) {
        $errors[] = "Allowance cannot be negative.";
    }
    if ($deduction < 0) {
        $errors[] = "Deduction cannot be negative.";
    }

    // Handle file upload
    $uploadDir = 'uploads/';
    $uploadFile = $uploadDir . basename($_FILES['document']['name']);
    $fileSize = $_FILES['document']['size'];
    $fileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
    
    // Check for file upload errors
    if ($_FILES['document']['error'] !== UPLOAD_ERR_OK) {
        $errors[] = "File upload error.";
    } elseif ($fileSize > 2000000) { // Limit file size to 2MB
        $errors[] = "File size must be less than 2MB.";
    } elseif (!in_array($fileType, ['pdf', 'doc', 'docx', 'jpg', 'png'])) {
        $errors[] = "Only PDF, DOC, DOCX, JPG, and PNG files are allowed.";
    }

    // If there are no errors, process the data
    if (empty($errors)) {
        // Move the uploaded file to the uploads directory
        if (move_uploaded_file($_FILES['document']['tmp_name'], $uploadFile)) {
            // Calculate salaries
            $grossSalary = calculateGrossSalary($basicSalary, $allowance);
            $netSalary = calculateNetSalary($grossSalary, $deduction);
            $bonus = calculateBonus($basicSalary);
            $salaryStatus = checkSalaryStatus($netSalary);

            // Display employee information and salary calculations
            echo "<h2>Employee Registration Successful</h2>";
            echo "<table border='1'>
                    <tr><th>Field</th><th>Value</th></tr>
                    <tr><td>Full Name</td><td>{$fullName}</td></tr>
                    <tr><td>Employee ID</td><td>{$employeeId}</td></tr>
                    <tr><td>Gender</td><td>{$gender}</td></tr>
                    <tr><td>Department</td><td>{$department}</td></tr>
                    <tr><td>Basic Salary</td><td>{$basicSalary}</td></tr>
                    <tr><td>Allowance</td><td>{$allowance}</td></tr>
                    <tr><td>Deduction</td><td>{$deduction}</td></tr>
                    <tr><td>Gross Salary</td><td>{$grossSalary}</td></tr>
                    <tr><td>Net Salary</td><td>{$netSalary}</td></tr>
                    <tr><td>Bonus</td><td>{$bonus}</td></tr>
                    <tr><td>Salary Status</td><td>{$salaryStatus}</td></tr>
                    <tr><td>Uploaded Document</td><td><a href='{$uploadFile}'>View Document</a></td></tr>
                  </table>";
        } else {
            echo "Error moving the uploaded file.";
        }
    } else {
        // Display errors
        foreach ($errors as $error) {
            echo "<p style='color:red;'>{$error}</p>";
        }
    }
}
?>
</body>
</html>