<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
function calculateGrossSalary($basicSalary, $allowance) {
    return $basicSalary + $allowance;
}

function calculateNetSalary($grossSalary, $deduction) {
    return $grossSalary - $deduction; 
}

function calculateBonus($basicSalary) {
    if ($basicSalary < 3000) {
        return $basicSalary * 0.05; // 5% bonus
    } elseif ($basicSalary >= 3000 && $basicSalary < 5000) {
        return $basicSalary * 0.10; // 10% bonus
    } else {
        return $basicSalary * 0.15; // 15% bonus
    }
}

function checkSalaryStatus($netSalary) {
    if ($netSalary < 2000) {
        return "Low";
    } elseif ($netSalary >= 2000 && $netSalary < 4000) {
        return "Medium";
    } else {
        return "High";
    }
}
?>
    
</body>
</html>