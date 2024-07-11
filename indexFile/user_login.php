<?php

    include 'connectdb.php';
    session_start();

    /*------------------ Get user inputs and sanitize --------------------*/

    $username = mysqli_real_escape_string($link, $_POST['username']);
    $password = mysqli_real_escape_string($link, $_POST['password']);
    $type = $_POST['user-type'];
    $query = "";
    
    if ($type == 'user') {
        $query = "SELECT * FROM user WHERE USER_USERNAME = ?";
    } else {
        $query = "SELECT * FROM administrator WHERE ADMIN_USERNAME = ?";
    }
    
    /*---------- Prepare statement to prevent SQL injection --------------*/

    $stmt = mysqli_prepare($link, $query);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars(mysqli_error($link)));
    }

    mysqli_stmt_bind_param($stmt, 's', $username);  // Bind parameters
    mysqli_stmt_execute($stmt);                     // Execute query
    $result = mysqli_stmt_get_result($stmt);        // Get result

    /*--------------------------------------------------------------------*/

    if (mysqli_num_rows($result) == 1) {
        $info = mysqli_fetch_assoc($result);
        
        
        if ($type == 'user') {
            $stored_hash = $info['USER_PASSWORD'];
        } 
        else {
            $stored_hash = $info['ADMIN_PASSWORD'];
        }
        //$stored_hash = ($type == 'user') ? $info['USER_PASSWORD'] : $info['ADMIN_PASSWORD'];
        
        if (password_verify($password, $stored_hash)) {
            // Password is correct
            if ($type == 'user') {
                $_SESSION['userID'] = $info['USER_ID'];
                $_SESSION['name'] = $info['USER_NAME'];
                $_SESSION['username'] = $info['USER_USERNAME'];
                header("location:../user/feed_view.php");
            } 
            else {
                $_SESSION['adminID'] = $info['ADMIN_ID'];
                header("location:../admin/user_list.php");
            }
            exit();
        } 
        else {
            // Incorrect password
            echo 
            "<script> 
                alert('Incorrect username or password !!');
                window.location.href = '../index.html';
            </script>";
        }
    } 
    else {
        // User not found
        echo 
        "<script> 
            alert('Account not found');
            window.location.href = '../index.html';
        </script>";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($link);
?>