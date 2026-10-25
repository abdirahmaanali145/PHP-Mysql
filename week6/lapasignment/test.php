<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Registration</title>
</head>
<body>
    <h1>Employee Registration Form</h1>
    <form action="process.php" method="POST" enctype="multipart/form-data">
        <label for="fullName">Full Name:</label>
        <input type="text" id="fullName" name="fullName" required><br><br>

        <label for="employeeId">Employee ID:</label>
        <input type="text" id="employeeId" name="employeeId" required><br><br>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
        </select><br><br>

        <label for="department">Department:</label>
        <select id="department" name="department" required>
            <option value="HR">Human Resources</option>
            <option value="Finance">Finance</option>
            <option value="IT">Information Technology</option>
            <option value="Admin">Administration</option>
        </select><br><br>

        <label for="basicSalary">Basic Salary:</label>
        <input type="number" id="basicSalary" name="basicSalary" required><br><br>

        <label for="allowance">Allowance:</label>
        <input type="number" id="allowance" name="allowance" required><br><br>

        <label for="deduction">Deduction:</label>
        <input type="number" id="deduction" name="deduction" required><br><br>

        <label for="document">Upload Document:</label>
        <input type="file" id="document" name="document" accept=".pdf,.doc,.docx" required><br><br>

        <button type="submit">Register</button>
        <button type="button" onclick="calculate()">Calculate</button>
        <button type="reset">Reset</button>
    </form>

    <script>
        function calculate() {
            // Placeholder for calculation logic
            alert("Calculation functionality to be implemented.");
        }
    </script>

        
</body>
</html>

