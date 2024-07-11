<?php
    include 'connectdb.php';

    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO user (USER_NAME, USER_EMAIL, USER_USERNAME, USER_PASSWORD) VALUES (?, ?, ?, ?)";
    
    // Prepare and bind parameters
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hash);
    $result = mysqli_stmt_execute($stmt);

    if($result){
        echo 
        "<script> 
            alert('Register Successful, redirecting to login page...');
            window.location.href = '../index.html';
        </script>";
        
    } else {
        echo "<script> alert('Error Occurred! Please try again later.') </script>";
    }
    
    // Close statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($link);
?>
