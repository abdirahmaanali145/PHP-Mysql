<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>
    body{
         background-color: lightblue;
        
    }
    </style>
<?php

//===============================
// PASSING BY VALUE
// ===============================

function addByValue($x, $y) {

    // Add x and y
    $z = $x + $y;

    // Display the result
    echo "Passing by Value: " . $z;
}

// Create two variables
$a = 10;
$b = 20;

// Pass the variables to the function
addByValue($a, $b);


// New line
echo "<br><br>";


// ===============================
// PASSING BY REFERENCE
// ===============================

function addByReference(&$x, &$y) {

    // Change the original values
    $x = $x + 5;
    $y = $y + 5;

    // Add x and y
    $z = $x + $y;

    // Display the result
    echo "Passing by Reference: " . $z;
}

// Create two variables
$a = 10;
$b = 20;

// Pass the variables by reference
addByReference($a, $b);

// Display the changed original values
echo "<br>";
echo "a = " . $a;

echo "<br>";
echo "b = " . $b;



// ===============================
// LOCAL VARIABLE
// ===============================

function localExample() {

    // This is a local variable
    // It can only be used inside this function
    $x = 10;

    // Display the local variable
    echo "Local Variable: " . $x;
}

// Call the function
localExample();


// New line
echo "<br><br>";


// ===============================
// GLOBAL VARIABLE
// ===============================

// This is a global variable
// It is created outside the function
$y = 20;

function globalExample() {

    // Use the global variable inside the function
    global $y;

    // Display the global variable
    echo "Global Variable: " .  $y ."<br>";
}

// Call the function
globalExample();

//
function sum (){
    static $x = 0;
    $x++;
    echo $x . "<br>";
}

sum();
sum();
sum();





?>
    
    
</body>
</html>