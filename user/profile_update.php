<?php 
    
    session_start();
    include 'connectdb.php';
    $userID = $_SESSION['userID'];

    $edit_name = mysqli_real_escape_string($link, $_POST['name']);
    $edit_email = mysqli_real_escape_string($link, $_POST['email']);
    $edit_username = mysqli_real_escape_string($link, $_POST['username']);
    $edit_password = mysqli_real_escape_string($link, $_POST['password']);

    if($edit_password != 'aaaaaaaa') { // to check if user edit their password or not ( 'aaaaaaaa' is default value, if same mean password don't need to change)
        $hashedPassword = password_hash($edit_password, PASSWORD_DEFAULT);
        $query = "UPDATE user SET USER_NAME='$edit_name', USER_EMAIL='$edit_email', USER_USERNAME='$edit_username', USER_PASSWORD='$hashedPassword' where USER_ID='$userID'" ;
    }
    else {
        $query = "UPDATE user SET USER_NAME='$edit_name', USER_EMAIL='$edit_email', USER_USERNAME='$edit_username' where USER_ID='$userID'" ;
    }

    $result = mysqli_query( $link,$query) or die("Query failed");

    if ($result){ 
        echo        
        "<script> 
            alert('Update Profile Successfull !');
            window.location.href = 'profile_view.php';
        </script>";
    }
    else{ 
        echo "<script> alert('Problem occured !') </script>"; 
    }

    mysqli_close($link);	
?>
