<?php
    session_start();
    include 'connectdb.php';
    include 'session_end.php';
    $userID = $_SESSION['userID'];

    $query = "SELECT * FROM user where USER_ID = '$userID'";
    $result = mysqli_query($link,$query);

    if($result){

        $user = mysqli_fetch_array($result);

        $name = $user['USER_NAME'];
        $email = $user['USER_EMAIL'];
        $username = $user['USER_USERNAME'];
        $password = $user['USER_PASSWORD'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../user_css/dashboard.css">
    <link rel="stylesheet" href="../user_css/profile_style.css">
    <link rel="icon" href="../images/PERFECTRY_header.svg" type="image/x-icon">
    <title>Perfectry | Profile Edit</title>
</head>
<body>
    <div class="home">
        <div class="wrapper">
            <!-----------------------------DASHBOARD------------------------------>

            <input type="checkbox" id="menu" hidden> <!-- phone view -->
            <label for="menu" class="menu-icon">
                <img width="45px" src="../images/menu-svgrepo-com.svg" alt="">
            </label>

            <nav class="dashboard">
                <div class="image-frame">
                    <img src="../images/PERFECTRY.svg" alt="">
                </div>
                <ul>
                    <li><a href="profile_view.php">Profile</a></li>
                    <li><a href="feed_view.php">Feed</a></li>
                    <li><a href="post_add.php">Add Post</a></li>
                    <li><a href="event_view.php">Event</a></li>
                </ul>
                <div class="out">
                    <a href="user_logout.php"><input type="button" value="Log Out"></a>
                </div>
            </nav>

            <nav class="display">
                <div class="header">
                    <h3>Profile Edit</h3>
                </div>

                <div class="content-box">

                     <!-- use to avoid from redirect to different page -->
                    <iframe name="dummyframe" id="dummyframe" style="display: none;"></iframe>

                    <form class="profile-update" action="profile_update.php" method="post">
                        <h3 align="center">User Detail</h3>

                        <img id="image" src="../images/bxs-user-circle.svg" alt=""><br>

                        <label for="name">Name</label><br>
                        <input type="text" name="name" id="name" value="<?php echo $name; ?>"><br><br>

                        <label for="email">Email</label><br>
                        <input type="email" name="email" id="email" value="<?php echo $email; ?>"><br><br>

                        <label for="username">Username</label><br>
                        <input type="text" name="username" id="username" value="<?php echo $username; ?>"><br><br>

                        <label for="password">Password</label><br>
                        <input type="password" name="password" id="password" value="aaaaaaaa"><br><br>

                        <input type="submit" value="Update Profile">
                        <input type="button" value="Delete Profile" onclick="confirmDelete('<?php echo $userID; ?>')">
                    </form>
                    
                </div>   

            </div>
        </div>
    </div>
</html>

<script>
    function confirmDelete(userId) {
        if (confirm("Are you sure you want to delete your profile? \nAll your data will be deleted and you will be redirect to login page")) {
            window.location.href = 'profile_delete.php?USER_ID=' + userId;
        }
    }
</script>