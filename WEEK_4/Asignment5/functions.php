<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

// Add a deposit to the opening balance.
function calculateDeposit($openingBalance, $transactionAmount)
{
    return $openingBalance + $transactionAmount;
}

// Subtract a withdrawal from the opening balance.
function calculateWithdrawal($openingBalance, $transactionAmount)
{
    return $openingBalance - $transactionAmount;
}

// Return the transaction fee for the selected transaction.
function calculateTransactionFee($transactionType, $transactionAmount)
{
    if ($transactionType === 'Deposit') {
        return 0;
    } elseif ($transactionType === 'Withdrawal' && $transactionAmount < 500) {
        return 2;
    } elseif ($transactionType === 'Withdrawal' && $transactionAmount >= 500) {
        return 5;
    } else {
        return 0;
    }
}

// Calculate simple interest using the rate for the selected account type.
function calculateInterest($finalBalance, $accountType, $duration)
{
    if ($accountType === 'Savings') {
        $interestRate = 0.03;
    } elseif ($accountType === 'Current') {
        $interestRate = 0.05;
    } elseif ($accountType === 'Business') {
        $interestRate = 0.02;
    } else {
        $interestRate = 0;
    }

    return $finalBalance * $interestRate * $duration;
}

// Transaction fees are the only banking charges in this assignment.
function calculateTotalCharges($transactionFee)
{
    return $transactionFee;
}

// Calculate the balance after applying the transaction and its charges.
function calculateFinalBalance($openingBalance, $transactionAmount, $transactionType, $totalCharges)
{
    if ($transactionType === 'Deposit') {
        return calculateDeposit($openingBalance, $transactionAmount) - $totalCharges;
    } else {
        return calculateWithdrawal($openingBalance, $transactionAmount) - $totalCharges;
    }
}

// Categorize the final balance.
function checkAccountStatus($finalBalance)
{
    if ($finalBalance >= 5000) {
        return 'High Balance';
    } elseif ($finalBalance >= 1000) {
        return 'Medium Balance';
    } else {
        return 'Low Balance';
    }
}

// Project a simple-interest balance; the duration defaults to one year.
function calculateFutureBalance($finalBalance, $interestRate, $duration = 1)
{
    $interest = $finalBalance * $interestRate * $duration;
    return $finalBalance + $interest;
}

?>
</body>
</html>