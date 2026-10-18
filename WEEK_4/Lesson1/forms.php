<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 300px;
            padding: 30px;
            border: 1px solid;
            border-radius: 10px;
        }

        label {
            display: block;
            margin-top: 5px;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #aaa;
            border-radius: 5px;
        }

        button[type="submit"],
        button[type="reset"] {
            margin-top: 20px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: blueviolet;
            color: white;
        }

        h4 {
            margin: 5px;
            font-size: 24px;
            font-weight: 600;
            font-style: italic;
        }

        textarea {

            border-radius: 10px;
        }

        .radio {
            display: flex;
        }
        .check{
            display: flex;
            flex-wrap: wrap;
        }

    </style>
</head>

<body>

    <form action="" class="form" method="post">
        <h4>Login</h4>
        <div>
            <label>Enter Full name</label>
            <input type="text" name="name">
        </div>
        <div>
            <label>Enter Password</label>
            <input type="password" name="password">
        </div>
        <div>
            <label for="">Comment</label>
            <textarea name="comment" col="30" rows="5"></textarea>
        </div>
        <div class="radio">
            <label for="">male</label>
            <input type="radio" name="sex" value="Male">
            <label for="">Female</label>
            <input type="radio" name="sex" value="Female">
        </div>
        <div class="check">
            <label for="medicine">medicine</label>
            <input type="checkbox" name="faculties[]" value="medicine" id="">
            <label for="medicine">engneering</label>
            <input type="checkbox" name="faculties[]" value="Engneering" id="">
            <label for="medicine">Computer Science</label>
            <input type="checkbox" name="faculties[]" value="Computer Science" id="">
        </div>
        
        <div class="btns">
            <button type="submit">Submit</button>
            <button type="reset" value="reset form">Reset</button>
        </div>
        
    </form>
    <br />


    <?php
    
    // display form info


    if (!empty($_POST['sex']) && !empty($_POST['name']) && !empty($_POST['password']) && !empty($_POST['comment']) && !empty($_POST['faculties'])) {
        echo "<br>Fullname is : ", $_POST["name"];
        echo "<br>Password is : ", $_POST["password"];
        echo "<br>The comment are : ", $_POST["comment"];
        echo "<br>Sex : ", $_POST['sex'];
        foreach ($_POST['faculties'] as $faculty){
            echo "<br>$faculty";
        }
    } else {
        echo "<br>please Make sure You Fill All inputs before submition";
    }

    if (!empty($_POST['faculties'])) {
        # code...
        foreach ($_POST['faculties'] as $faculty){
            echo "<br>$faculty" . "<br>";
        }
    }else{
        echo "You Did not choose any thing please choose";
    }

    ?>
</body>

</html>