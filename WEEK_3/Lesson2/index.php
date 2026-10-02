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

    //Creating multidiamensentional array
    //$info = array(
        //array(10,20,"Ca233",90.12),
    //)

   $student = array(
    array("Abdirahmaan"; "2000"; "Hodan"; "0619765349"),
    array ("Mohamed"; "2003"; "YAAQSHID"; "0619765399"),
    array (Abdiqani; "2002"; "Dharkeynle"; "0619705349"),
   );
   echo "<table border= '1' cellpadding='10'>";

    echo "<tr>";
    echo "<th> Name </th>";
    echo "<th> Year of birth </th>";
    echo "<th> Address </th>";
    echo "<th> phone number </th">;
    echo "</tr>";

    foreach ($student as $index => $student){
        echo "<tr>";
        echo "<td>$index</td>";
        echo "<td>$student[0]</td>";
        echo "<td>$student[1]</td>";
        echo "<td>$student[2]</td>";
        echo "<td>$student[3]</td>";
        
    }
    echo "</table>";
    
    











?>
    
</body>
</html>