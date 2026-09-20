<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    //Example using constant variable name
    define("Age",10);
    echo Age;

    //line break Html tag
    echo "<br>";



    //Example condition
   $Age= 20;
    if ($Age >= 18)
       echo "Adult ";
    else
        echo"child ";
    //line break Html tag
    echo "<br>";

  

    //Switch example
    $marks =100;

     switch($marks){
        case 100;
         echo "A+";
         break;

        case 90;
         echo "A";
         break;

        case 80;
         echo "B";
         break;

        case 70;
         echo "c";
         break;

        case 60;
         echo "60";
         break;

        default:
        echo "fail";

     }
     //line break html tag
     echo "<br>";
    
        // the ?ternary operator

       $Age =20;
       echo ($Age >= 18) ?"Adult" : "child";

       //line break html tag
       echo "<br>";

    

    //if else example

    $fuel = 5;
    if ($fuel < 10){
    echo "fill tank now";
    } else {
        echo "there's enough fuel";
        }

    //line break html tag
    echo "<br>";

    //while loop example
    echo "<h3>while loop</h3> <br>";
    $counter =1;
    while ($counter <=5) {
        echo $counter . "<br>";
        $counter++;
    }
    //line break html tag
    echo "<br>";

    
    //Do while loop example
    echo "<h3> Do while loop</h3> <br>";
    $count =1;
    do {
        echo $count . "<br>";
        $count++;
    }while ($count <=5);

    //line break html tag
    echo "<br>";

    //for loop example
    echo "<h3> for loop</h3> <br>";
    for ($i = 1; $i <= 12; ++$i) {
        echo $i . "<br>";
    }

    //this for loop that calculates square of numbers from 1 to 10
    for ($i = 1; $i <= 10; ++$i) {
        echo "the square of $i is :"  .$i * $i . "<br>";
    }

    // nasted loop
    

for ($i = 1; $i <= 3; $i++) {

    for ($j = 1; $j <= 3; $j++) {
        echo "i = $i, j = $j <br>";
    }

}
    
     //line break html tag
       echo "<br>";
    
    

    

    


  

    
   








 ?>
    
</body>
</html>