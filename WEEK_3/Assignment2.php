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

echo "</div>";

echo "<div style='height: 8px;'></div>";

echo "<h2> Declare and initialize the array</h2>";

$numbers = [5, -7, 12, 10, -7, 11, -6, 12, 1, -7, 2, 9];

// 2. Print all elements
echo "All elements: ";
foreach ($numbers as $number) {
    echo $number . " ";
}

echo "<br>";

// 3. Calculate total of all elements
$total = array_sum($numbers);
echo "Total of all elements: " . $total;

echo "<br>";

// 4. Calculate total of even elements
$evenTotal = 0;

foreach ($numbers as $number) {
    if ($number % 2 == 0) {
        $evenTotal += $number;
    }
}

echo "Total of even elements: " . $evenTotal;

echo "<br>";

// 5. Calculate total of odd elements
$oddTotal = 0;

foreach ($numbers as $number) {
    if ($number % 2 != 0) {
        $oddTotal += $number;
    }
}

echo "Total of odd elements: " . $oddTotal;

echo "<br>";

// 6. Find minimum element and its positions
$min = min($numbers);

echo "Minimum element: " . $min . "<br>";
echo "Minimum positions: ";

foreach ($numbers as $index => $number) {
    if ($number == $min) {
        echo $index . " ";
    }
}

echo "<br>";

// 7. Find maximum element and its positions
$max = max($numbers);

echo "Maximum element: " . $max . "<br>";
echo "Maximum positions: ";

foreach ($numbers as $index => $number) {
    if ($number == $max) {
        echo $index . " ";
    }
}


echo "</div>";

echo "<div style='height: 2px;'></div>";

echo "<h2> Two-Dimensional Associative Array</h2>";

$colors = [
    "Light" => [
        "Red" => "Light Red",
        "Green" => "Light Green",
        "Blue" => "Light Blue"
    ],

    "Normal" => [
        "Red" => "Normal Red",
        "Green" => "Normal Green",
        "Blue" => "Normal Blue"
    ],

    "Dark" => [
        "Red" => "Dark Red",
        "Green" => "Dark Green",
        "Blue" => "Dark Blue"
    ]
];

echo "<table border='1' cellpadding='10'>";

echo "<tr>";
echo "<th></th>";
echo "<th>Red</th>";
echo "<th>Green</th>";
echo "<th>Blue</th>";
echo "</tr>";

foreach ($colors as $row => $columns) {

    echo "<tr>";

    echo "<th>" . $row . "</th>";

    foreach ($columns as $value) {
        echo "<td>" . $value . "</td>";
    }

    echo "</tr>";
}

echo "</table>";

echo "<div style='height: 8px;'></div>";

echo "<h2> Student Two-Dimensional Associative Array</h2>";

$students = [
    "CA221" => [
        "Name" => "Abdiaziiz Abdi nur",
        "Phone" => "0618440403",
        "Address" => "Laba Dhagax, Wardhiigley"
    ],

    "CA223" => [
        "Name" => "Abdirahmaan Ali Hassan",
        "Phone" => "0619765349",
        "Address" => "Taleex, Hodan"
    ],

    "CA225" => [
        "Name" => "sahal Nur Abdi",
        "Phone" => "0626990276",
        "Address" => "Macmacaanka, Dharkeynley"
    ]
];

echo "<table border='1' cellpadding='10'>";

echo "<tr>";
echo "<th>Student ID</th>";
echo "<th>Name</th>";
echo "<th>Phone</th>";
echo "<th>Address</th>";
echo "</tr>";

foreach ($students as $id => $student) {

    echo "<tr>";

    echo "<td>" . $id . "</td>";
    echo "<td>" . $student["Name"] . "</td>";
    echo "<td>" . $student["Phone"] . "</td>";
    echo "<td>" . $student["Address"] . "</td>";

    echo "</tr>";
}

echo "</table>";


?>
    
</body>
</html>