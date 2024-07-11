<?php
    session_start();    
    include 'connectdb.php';
    include 'session_end.php';
    
    $category = $_POST['category'];
    $title = mysqli_real_escape_string($link, $_POST['title']);
    $description = mysqli_real_escape_string($link, $_POST['description']);
    $ingredient = mysqli_real_escape_string($link, $_POST['ingredient']);
    $step = mysqli_real_escape_string($link, $_POST['step']);
    $userId = $_SESSION['userID'];
    $result = false;
    /* -------------------------------------- IMAGE ------------------------------------------- */
    if($_FILES["image"]["error"] === 4){
        $image = null;
    }
    else{
        $fileName = $_FILES["image"]["name"];
        $fileSize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];

        $validImageExtension = ['jpg','jpeg','png'];
        $imageExtension = explode('.', $fileName);
        $imageExtension = strtolower(end($imageExtension));

        if(!in_array($imageExtension,$validImageExtension)){
            echo "<script> alert('Image type does not support...'); </script>";
        }
        else if($fileSize > 1048576){ /*--- MAX IMAGE SIZE 1MB ---*/
            echo "<script> alert('Image too large...'); </script>";
        }
        else{
            $image = uniqid();
            $image .= '.'. $imageExtension;

            /*--- UPLOAD PHOTO INTO FOLDER NAME imagePost ---*/
            move_uploaded_file($tmpName, '../imagePost/'. $image); 

            $query = "INSERT INTO post (POST_CATEGORY, POST_TITLE, POST_IMAGE, POST_DESCRIPTION, POST_INGREDIENTS, POST_STEP, USER_ID) VALUES ('$category','$title','$image','$description','$ingredient','$step','$userId')";
            $result = mysqli_query($link,$query);
        }
    }
    /* ---------------------------------------------------------------------------------------- */


    if($result){
        echo         
        "<script> 
            alert('Upload Successfull !');            
            window.location.href = 'post_add.php';
        </script>";

    }
    else{
        echo "<script> 
                alert('Upload Fail !');   
                window.location.href = 'post_add.php'; 
            </script>";
    }
    mysqli_close($link);
?>
