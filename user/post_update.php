<?php
    session_start();    
    include 'connectdb.php';
    include 'session_end.php';
    
    $postID = $_GET['POST_ID'];
    $newCategory = mysqli_real_escape_string($link, $_POST['category']);
    $newTitle = mysqli_real_escape_string($link, $_POST['title']);
    $newDescription = mysqli_real_escape_string($link, $_POST['description']);
    $newIngredient = mysqli_real_escape_string($link, $_POST['ingredient']);
    $newStep = mysqli_real_escape_string($link, $_POST['step']);

    /* -------------------------------------- IMAGE ------------------------------------------- */
    if($_FILES["image"]["error"] === 4){
        // do nothing, no new photo upload
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
            $newImage = uniqid();
            $newImage .= '.'. $imageExtension;

            /*--- UPLOAD PHOTO INTO FOLDER NAME imagePost ---*/
            move_uploaded_file($tmpName, '../imagePost/'. $newImage); 

            $queryImage = "UPDATE post SET POST_IMAGE = '$newImage' WHERE POST_ID = '$postID'";
            $updateImage = mysqli_query($link,$queryImage);

            if($updateImage)
                echo "<script> alert('new image uploaded'); </script>";
            else
                echo "<script> alert('problem uploading new image'); </script>";
        }
    }        
    /* ---------------------------------------------------------------------------------------- */
    
    $queryUpdate = "UPDATE post SET POST_CATEGORY='$newCategory', POST_TITLE='$newTitle', POST_DESCRIPTION='$newDescription',
                                    POST_INGREDIENTS='$newIngredient', POST_STEP='$newStep' WHERE POST_ID = '$postID'";

    $updateResult = mysqli_query($link,$queryUpdate);

    if($updateResult){
        echo         
        "<script> 
            alert('Edit Successfull !');            
            window.location.href = 'profile_view.php';
        </script>";
    }
    else{
        echo "<script> alert('Edit Fail !'); </script>";
    }
    mysqli_close($link);
?>