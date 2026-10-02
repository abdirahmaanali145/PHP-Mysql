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
//creating multidimensional array 
$info = array (
    array (10,20,"CA233",90.12),
    array(123,"Abdirahmaan Ali Hassan","CA233",90.12)
);

    // display for each
    foreach($info as $list)
        echo $list [0] , $list[1];



// Two-dimensional numerical indexed array

$student = array(
    array("Abdirahmaan", 2006, "Hodan", "0619765349"),
    array("Mohamed ", 2008, "Yaaqshiid", "0628124391"),
    array("Hassan", 1987, "Shangaaani", "0618124392")
);

echo "<table border='1' cellpadding='10'>";

echo "<tr>";
echo "<th>Index</th>";
echo "<th>Name</th>";
echo "<th>Year Of Birth</th>";
echo "<th>Address</th>";
echo "<th>Phone Number</th>";
echo "</tr>";

foreach ($student as $index => $s) {
    echo "<tr>";
    echo "<td>$index</td>";
    echo "<td>$s[0]</td>";
    echo "<td>$s[1]</td>";
    echo "<td>$s[2]</td>";
    echo "<td>$s[3]</td>";
    echo "</tr>";
}

echo "</table>";



//checks whether the variable contains an array  using the is_array() function
$info = array (
    10,
    "Abdirahmaan",
    "Ali",
    90
);


if(is_array($info))
    {
        echo"waa soo helay";
    }else{
        echo"masoo helin";
    }
  

//checks for a specific value in a multidimensional array.
$info = array(
    10,
    "Abdirahman",
    "Ali",
    90
);

$multi = array(
    array(10, 90, 100),
    array(35, 90, 60)
);

if (in_array(90, $multi[1]))
{
    echo "The size of array \$info is " . count($info);
}
    ?>
</body>
</html>