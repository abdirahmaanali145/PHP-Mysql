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
    $info = array (
        "Abdirahmaan",
        "ali",
        "hasan",
        21
    );
    //check if a variable is an array
    if(is_array($info))
    {
        echo "Yes, it is an array<br>";
    }
    else
    {
        echo "No, it is not an array<br>";
    }



    //check if specific key exists in an array
    if(array_key_exists(0, $info))
    {
        echo "Yes, the key exists in the array<br>";
    }
    else
    {
        echo "No, the key does not exist in the array<br>";
    }


    //creating multidimensional array
    $multiArray = array(
        array("Mohamed", 21, "Hodan"),
        array("Ahmed", 22, "Wadajir"),
        array("Jaamac", 23, "Hodan")
    );
    if(is_array($multiArray))
    {
        echo "Yes, it is a multidimensional array<br>";
    }
    else
    {
        echo "No, it is not a multidimensional array<br>";
    }

    echo "the size of the array is: " . count($info) . "<br>";
    

    //creating functionin php sum
    function sum($x,$y=100){
        $z = $x + $y;
        echo "The sum of $x and $y is: $z<br>";
    }

    //calling the function
    sum(10,200);

    function multiply($x, $y)
    {
        return $x * $y;
    }

    echo "The multiplication result is: " . multiply(10, 200) . "<br>";
    
    ?>
    
</body>
</html>