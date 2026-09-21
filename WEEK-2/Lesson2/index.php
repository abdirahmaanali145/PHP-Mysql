<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
//Creating Array - numeric array
// First way to create array
    $names = array();

//second way to intialize array
    $names [0]= "CA233 is the best class";
    $names [1]= 123;
    $names [3]= 15.4;
    echo $names[3] ."<br>";
    echo $names[1] ."<br>";
    echo $names[5] ."<br>";
    
    //display 
    var_dump($names);


    //display all values using pre tag 

    echo "<pre>";
    print_r($names);
    echo "</pre>";

    echo "<br>";

    echo "<pre>";
    var_dump($names);
    echo "</pre>";


    //using  for loop
    echo "<h3> for loop </h3> <br>";


    //   for ($i = 0; $i < count ($names); $i++){
    //     echo $names[$i] . "<br>";
    //   };

     
    // for ($i = 0; $i < count ($names); $i++){
    //     echo $names[$i] . "<br>";
    // }







    //Associative arrays
    $info = array (
        "id "=>"101",
        "name"=>"Abdirahman ali hasan",
        // "age"=>"20";
        "address"=>"Hodan district ",
        // "status"=>"single";
        "weight"=> 178.5
    );

    //displaying the information stored in the associative array
    echo "<pre>";
    echo "information about the person: <br>";
    print_r($info);
    var_dump($info);
    echo "</pre>";


    //using for loop
    echo "<h3> Using for loop </h3> <br>";
    $keys = array_keys($info);

    for ($i = 0; $i < count ($keys); $i++){
        $key = $keys[$i];
        echo $key . ": " . $info[$key] . "<br>";
    }


   






    ?>
</body>
</html>