<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
require_once 'functions.php';

$hasErrors = false;
$errors = '';




$fullName = isset($_POST['full_name']) ? $_POST['full_name'] : '';
$accountNumber = isset($_POST['account_number']) ? $_POST['account_number'] : '';
$gender = isset($_POST['gender']) ? $_POST['gender'] : '';
$accountType = isset($_POST['account_type']) ? $_POST['account_type'] : '';
$openingBalance = isset($_POST['opening_balance']) ? $_POST['opening_balance'] : '';
$transactionType = isset($_POST['transaction_type']) ? $_POST['transaction_type'] : '';
$transactionAmount = isset($_POST['transaction_amount']) ? $_POST['transaction_amount'] : '';
$accountDuration = isset($_POST['account_duration']) ? $_POST['account_duration'] : '';

if (empty($fullName)) {
    $hasErrors = true;
    $errors .= '<li>Customer full name is required.</li>';
}
if (empty($accountNumber)) {
    $hasErrors = true;
    $errors .= '<li>Account number is required.</li>';
}
if ($gender !== 'Male' && $gender !== 'Female' && $gender !== 'Other') {
    $hasErrors = true;
    $errors .= '<li>Please select a valid gender.</li>';
}
if ($accountType !== 'Savings' && $accountType !== 'Current' && $accountType !== 'Business') {
    $hasErrors = true;
    $errors .= '<li>Please select a valid account type.</li>';
}
if (!isset($_POST['opening_balance']) || $openingBalance === '' || $openingBalance < 0) {
    $hasErrors = true;
    $errors .= '<li>Opening balance must be zero or greater.</li>';
}
if ($transactionType !== 'Deposit' && $transactionType !== 'Withdrawal') {
    $hasErrors = true;
    $errors .= '<li>Please select a valid transaction type.</li>';
}
if (!isset($_POST['transaction_amount']) || $transactionAmount === '' || $transactionAmount <= 0) {
    $hasErrors = true;
    $errors .= '<li>Transaction amount must be greater than zero.</li>';
}
if (!isset($_POST['account_duration']) || $accountDuration === '' || !ctype_digit($accountDuration)) {
    $hasErrors = true;
    $errors .= '<li>Account duration must be a non-negative whole number.</li>';
}

$transactionFee = 0;
if (!$hasErrors) {
    $transactionFee = calculateTransactionFee($transactionType, $transactionAmount);
    if ($transactionType === 'Withdrawal' && $transactionAmount + $transactionFee > $openingBalance) {
        $hasErrors = true;
        $errors .= '<li>Withdrawal amount plus transaction fee cannot exceed the opening balance.</li>';
    }
}

$documentName = '';
$documentType = '';
$documentSize = 0;
$temporaryName = '';

if (!isset($_FILES['identification_document'])) {
    $hasErrors = true;
    $errors .= '<li>Please select an identification document.</li>';
} else {
    $documentName = isset($_FILES['identification_document']['name']) ? $_FILES['identification_document']['name'] : '';
    $documentType = isset($_FILES['identification_document']['type']) ? $_FILES['identification_document']['type'] : '';
    $documentSize = isset($_FILES['identification_document']['size']) ? $_FILES['identification_document']['size'] : 0;
    $temporaryName = isset($_FILES['identification_document']['tmp_name']) ? $_FILES['identification_document']['tmp_name'] : '';
    $uploadError = isset($_FILES['identification_document']['error']) ? $_FILES['identification_document']['error'] : UPLOAD_ERR_NO_FILE;

    if ($uploadError === UPLOAD_ERR_NO_FILE || $documentName === '') {
        $hasErrors = true;
        $errors .= '<li>Please select an identification document.</li>';
    } elseif ($uploadError !== UPLOAD_ERR_OK) {
        $hasErrors = true;
        $errors .= '<li>The identification document could not be uploaded. Please try again.</li>';
    } elseif ($documentSize > 2097152) {
        $hasErrors = true;
        $errors .= '<li>The identification document must not be larger than 2 MB.</li>';
    } elseif (strpos($documentName, '/') !== false || strpos($documentName, '\\') !== false || strpos($documentName, '..') !== false) {
        $hasErrors = true;
        $errors .= '<li>The identification document filename is invalid.</li>';
    } elseif (file_exists('uploads/' . $documentName)) {
        $hasErrors = true;
        $errors .= '<li>A file with that name already exists. Rename the document and try again.</li>';
    }
}

  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banking Transaction Receipt</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            padding: 32px 16px;
            background: #f1f5f9;
            color: #172033;
            font-family: Arial, sans-serif;
        }
        main {
            width: 100%;
            max-width: 850px;
            margin: 0 auto;
            padding: 30px;
            border-radius: 12px;
            background: #ffffff;
            box-shadow: 0 8px 28px rgba(20, 40, 70, 0.1);
        }
        h1 { color: #123b66; }
        table { width: 100%; border-collapse: collapse; }
        th, td {
            padding: 12px;
            border: 1px solid #dbe3ed;
            text-align: left;
        }
        th { width: 42%; background: #edf4fa; }
        .error {
            padding: 16px 20px;
            border: 1px solid #f0b4b4;
            border-radius: 8px;
            background: #fff1f1;
            color: #8a1c1c;
        }
        .back-link {
            display: inline-block;
            margin-top: 22px;
            color: #1261a0;
            font-weight: bold;
        }
        @media (max-width: 560px) {
            main { padding: 20px; }
            th, td { padding: 9px; }
        }
    </style>
</head>
<body>
    <main>
        <?php if ($hasErrors) { ?>
            <h1>Transaction Could Not Be Processed</h1>
            <p>Please correct the following issue(s):</p>
            <ul class="error"><?php echo $errors; ?></ul>
        <?php } else {
            $totalCharges = calculateTotalCharges($transactionFee);
            $finalBalance = calculateFinalBalance($openingBalance, $transactionAmount, $transactionType, $totalCharges);
            $interest = calculateInterest($finalBalance, $accountType, $accountDuration);

            if ($accountType === 'Savings') {
                $interestRate = 0.03;
            } elseif ($accountType === 'Current') {
                $interestRate = 0.05;
            } else {
                $interestRate = 0.02;
            }

            if ($accountDuration == 1) {
                $futureBalance = calculateFutureBalance($finalBalance, $interestRate);
            } else {
                $futureBalance = calculateFutureBalance($finalBalance, $interestRate, $accountDuration);
            }
            $accountStatus = checkAccountStatus($finalBalance);
            ?>
            <h1>Banking Transaction Receipt</h1>
            <table>
                <tr><th>Customer Full Name</th><td><?php echo $safeFullName; ?></td></tr>
                <tr><th>Account Number</th><td><?php echo $safeAccountNumber; ?></td></tr>
                <tr><th>Gender</th><td><?php echo $gender; ?></td></tr>
                <tr><th>Account Type</th><td><?php echo $accountType; ?></td></tr>
                <tr><th>Opening Balance</th><td>$<?php echo number_format($openingBalance, 2); ?></td></tr>
                <tr><th>Transaction Type</th><td><?php echo $transactionType; ?></td></tr>
                <tr><th>Transaction Amount</th><td>$<?php echo number_format($transactionAmount, 2); ?></td></tr>
                <tr><th>Transaction Fee</th><td>$<?php echo number_format($transactionFee, 2); ?></td></tr>
                <tr><th>Total Banking Charges</th><td>$<?php echo number_format($totalCharges, 2); ?></td></tr>
                <tr><th>Final Balance</th><td>$<?php echo number_format($finalBalance, 2); ?></td></tr>
                <tr><th>Account Status</th><td><?php echo $accountStatus; ?></td></tr>
                <tr><th>Account Duration</th><td><?php echo $accountDuration; ?> year(s)</td></tr>
                <tr><th>Interest Rate</th><td><?php echo number_format($interestRate * 100, 2); ?>%</td></tr>
                <tr><th>Calculated Interest</th><td>$<?php echo number_format($interest, 2); ?></td></tr>
                <tr><th>Projected Future Balance</th><td>$<?php echo number_format($futureBalance, 2); ?></td></tr>
                <tr><th>Document Name</th><td><?php echo $safeDocumentName; ?></td></tr>
                <tr><th>File Type</th><td><?php echo $safeDocumentType; ?></td></tr>
                <tr><th>File Size</th><td><?php echo $documentSize; ?> bytes</td></tr>
                <tr><th>Upload Status</th><td><?php echo $uploadStatus; ?></td></tr>

        <?php } ?>
        <a class="back-link" href="index.html">Back to Banking Form</a>
    </main>
</body>
</html>

    
</body>
</html>