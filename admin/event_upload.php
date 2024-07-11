<?php

session_start(); 
include 'session_end.php';
include 'connectdb.php';

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Retrieve form data
    $title = $_POST['title'];
    $description = $_POST['description'];
    $time = $_POST['time'] ;
    $date = $_POST['date'] ;
    $price = $_POST['price']; 
    $adminId = $_SESSION['adminID'] ;

    // Validate admin ID
    if (empty($adminId)) {
        die("Error: Admin ID is not set.");
    }
    $stmt = false;
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
            move_uploaded_file($tmpName, '../imageEvent/'. $image); 

            // Insert data into database if image upload is successful
            $query = "INSERT INTO event (EVENT_NAME, EVENT_DESCRIPTION, EVENT_PIC, EVENT_TIME, EVENT_DATE, EVENT_PRICE, ADMIN_ID) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($link, $query);
        }            
    }   
    /* ---------------------------------------------------------------------------------------- */

    

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssssis", $title, $description, $image, $time, $date, $price, $adminId);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            echo "Post successfully uploaded. Back to <a href='event_list.php'>Event</a>";
        } else {
            echo "Error occurred while uploading post.";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Event not uploaded !!. Back to <a href='event_add.php'>Add Event</a>";
    }

} else {
    echo "Invalid request method.";
}

mysqli_close($link);
?>
