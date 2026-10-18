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

    //selecting file
    if(!empty($_FILES['stdimages']['name']))
        {
            //Name the file
            echo "the File name is :" .$file['stdimages']['name']."<hr">;
            echo "the file name is :".$file['stdimages']['type']."<hr">;;
            echo "the file name is :".$file['stdimages']['size']."<hr">;;
            echo "the file name is :".$file['stdimages']['tmp_name'];

            //Rename the file name
            $Ext = explode(".",$_FILES['stdimages']['name']);
            $Ext = end($Ext);

            //saving temp folder path
            $temp = $_file['stdimages']['tmp_name'];

            //destination path
            // $Destination = "C:\Users\Hp\Pictures\screen".$_FILES['stdimages']['name']
            //rename the file name with destinition
            $Destination = "C:\Users\Hp\Pictures\screen".$_post['fullname'].".".$Ext;

            if(file_exists($Destination))
                {
                    echo "sorry the file directory not exit";
                }
            else
                {
                    //check file size
                    if($_FILES["stdimages"]['size'] <10 *1024 * 1024)
                        {
                            //limit of array extention 
                        $extension = array("png","pdf");
                        $name_ext = explode(".", $_FILES['stdimages']['name']);
                        $exts = strtolower(end($))
                        }
                  if(move_uploaded_file($temp,$Destination))
                    {
                    echo "file upload fail";

                    }
                else
                {
                    echo "file is too big";
                }
                }

            if (move_uploaded_file($temp,destination))
                {
                    echo "file upload success";
                }
            else
            {

            }
        }
    
</body>
</html>