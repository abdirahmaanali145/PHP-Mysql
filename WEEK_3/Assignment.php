<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body{
         background-color: lightblue;
    }
    </style>
<body>

    
    <?php
     //greatest and Smallest
     
$a = 15;
$b = 8;
$c = 25;

$greatest = $a;
$smallest = $a;

if ($b > $greatest) {
    $greatest = $b;
}

if ($c > $greatest) {
    $greatest = $c;
}

if ($b < $smallest) {
    $smallest = $b;
}

if ($c < $smallest) {
    $smallest = $c;
}
echo "<h2>Display greatest and smallest</h2>";
echo "Greatest number: " . $greatest . "<br>";
echo "Smallest number: " . $smallest;

 
echo "<h3>Divisible numbers</h3>";
// check wether a number is divisible by 3,5, both,or none
 
$num = 15;
 echo "<br>";
if ($num % 3 == 0 && $num % 5 == 0) {
    echo "Divisible by both 3 and 5";
} elseif ($num % 3 == 0) {
    echo "Divisible by 3 only";
} elseif ($num % 5 == 0) {
    echo "Divisible by 5 only";
} else {
    echo "Divisible by neither 3 nor 5";
}
 echo "<br>";

// print odd numbers from 2 to 20 :<br>;
echo "Odd numbers from 2 to 20:<br>";

for ($i = 2; $i <= 20; $i++) {
    if ($i % 2 != 0) {
        echo $i . " ";
    }
}

echo "<br><br>";

// Print even numbers from 35 to 7

echo "Even numbers from 35 to 7:<br>";

for ($i = 35; $i >= 7; $i--) {
    if ($i % 2 == 0) {
        echo $i . " ";
    }
}
 echo "<br>";
echo "Print numbers divisible by 2 and 5 from 50 to 2:<br>";
// Starting from 50 down to 2

for ($i = 50; $i >= 2; $i--) {
    if ($i % 2 == 0 && $i % 5 == 0) {
        echo $i . " ";
    }
}
echo "<br>";
echo "<br>";
echo "Reverse number <br>";
echo "<br>";
//Find the reverse of a given number
// Do not use strrev()

$num = 12345;
$reverse = 0;

while ($num > 0) {
    // Get the last digit
    $digit = $num % 10;

    // Add the digit to the reverse number
    $reverse = ($reverse * 10) + $digit;

    // Remove the last digit
    $num = (int)($num / 10);
}

echo "Reverse: " . $reverse;

echo "<br>";
echo "<br>";
echo "Lcm of two possitive integers <br>";
//Calculate the LCM of two positive integers

$a = 8;
$b = 12;

// Start checking from the larger number
$max = ($a > $b) ? $a : $b;

while (true) {

    // Check if the number is divisible by both numbers
    if ($max % $a == 0 && $max % $b == 0) {
        $lcm = $max;
        break;
    }

    $max++;
}

echo "LCM of $a and $b = " . $lcm;

echo "<br>";
echo "<br>";
echo "HCF of two integers <br>";
//Calculate the HCF of two integers

$a = 18;
$b = 24;

$hcf = 1;
echo "<br>";
// Check all possible common factors
for ($i = 1; $i <= $a && $i <= $b; $i++) {

    if ($a % $i == 0 && $b % $i == 0) {
        $hcf = $i;
    }
}

echo "HCF of $a and $b = " . $hcf;
echo "<br>";

echo "Multiplication table 1 to 12<br>";
//  Print multiplication table up to 12 x 12
// Use nested loops

echo "<table border='1' cellpadding='8'>";

// Outer loop
for ($i = 1; $i <= 12; $i++) {

    echo "<tr>";

    // Inner loop
    for ($j = 1; $j <= 12; $j++) {

        echo "<td>";
        echo $i * $j;
        echo "</td>";
    }

    echo "</tr>";
}

echo "</table>";
echo "<br>";
echo "prime or none prime <br>";
//Check whether a number is prime or non-prime

$num = 17;
$isPrime = true;

// Numbers less than 2 are not prime
if ($num < 2) {
    $isPrime = false;
} else {

    // Check whether the number has a divisor
    for ($i = 2; $i < $num; $i++) {

        if ($num % $i == 0) {
            $isPrime = false;
            break;
        }
    }
}

// Print the result
if ($isPrime) {
    echo $num . " is a prime number.";
} else {
    echo $num . " is a non-prime number.";
}

echo "<br>";
echo "prime numbers from 10 to 50 <br>";
// Print prime numbers from 10 to 50

echo "Prime numbers from 10 to 50:<br>";

// Check every number from 10 to 50
for ($num = 10; $num <= 50; $num++) {

    $isPrime = true;

    // Numbers less than 2 are not prime
    if ($num < 2) {
        $isPrime = false;
    } else {

        // Check if the number has a divisor
        for ($i = 2; $i < $num; $i++) {

            if ($num % $i == 0) {
                $isPrime = false;
                break;
            }
        }
    }

    // Print only prime numbers
    if ($isPrime) {
        echo $num . " ";
    }
}





//
echo "<h2>Display html table </h2>";






$info = array(
    "Abdirahmaan",
    "Ali",
    "Hasan"
);

echo "<table border='1'>";
//display array using for each

foreach ($info as $name) {
    echo "<tr>";
    echo "<td>$name</td>";
    echo "</tr>";
}

echo "</table>";



?>
</body>
</html>