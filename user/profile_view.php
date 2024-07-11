<?php
    session_start();
    include 'connectdb.php';
    include 'session_end.php';
    $userID = $_SESSION['userID'];

    $query = "SELECT * FROM user where USER_ID = '$userID'";
    $result = mysqli_query($link,$query);

    if(mysqli_num_rows($result) >= 1){
        $user = mysqli_fetch_array($result);
        $name = $user['USER_NAME'];
        $username = $user['USER_USERNAME'];
    }
    else{
        echo "<script> alert('your account has been removed by Admin') </script>";
        include 'user_logout.php';
        include 'session_end.php';
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
    <title>Perfectry | Profile</title>
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
            <!-----------------------------PROFILE------------------------------>
            <nav class="display">
                <div class="header">
                    <h3>Profile</h3>
                </div>
                <div class="content-box">      
                    <div class="top">
                        <div class="header-image">
                            <img id="image" width="90px" src="../images/bxs-user-circle.svg" alt="">
                        </div>
                        <div class="profile-name">
                            <ul>
                                <li><span>@<?php echo $username; ?></span></li>
                                <li><?php echo $name; ?></li>
                            </ul>
                        </div>
                        <div class="profile-follow">
                            <ul>
                                <li><span>32</span></li>
                                <li>followers</li>
                            </ul>
                            <ul>
                                <li><span>156</span></li>
                                <li>following</li>
                            </ul>
                        </div>
                        <div class="profile-edit">
                            <a href="profile_edit.php"><img id="image"src="../images/bxs-cog.svg" alt=""></a>
                        </div>
                    </div>

                    <div class="bottom">
                        
                        <div class="content">

                            <!---------------------- DATABASE FOR POST -------------------------->

                            <?php
                                $query = "SELECT * FROM post";
                                $result = mysqli_query($link, $query);
                            ?>

                            <!-----------------------------POSTS------------------------------>
                            <div class="list-your-recipe">
                            <div class="label">
                                <h3>Your Post</h3>
                            </div class="content">

                                <?php while ($row = mysqli_fetch_array($result)){

                                    if($row['USER_ID'] == $userID){?>

                                        <table> <!--- ACTUAL POST (RETRIEVE FROM DATABASE --->
                                            
                                            <tr> 
                                                <th><?php echo $row['POST_TITLE']; ?></th> 

                                                <td rowspan="3" class="image-frame">
                                                    <a href="feed_detail.php?post_id=<?php print ($row['POST_ID']);?>">
                                                    <img src="../imagePost/<?php echo $row['POST_IMAGE']; ?>" alt=""></a>
                                                </td> 
                                            </tr>
                                            <tr> <td><?php echo $row['POST_DESCRIPTION']; ?></td> </tr>

                                            <tr><th>
                                                <input type="button" value="Edit" onclick="location.href='post_edit.php?POST_ID=<?php echo $row['POST_ID']; ?>'">
                                                <input type="button" value="Delete" onclick="confirmDeletePost('<?php echo $row['POST_ID']; ?>')">
                                            </th></tr>

                                        </table><?php
                                    }
                                } ?>

                            </div>
                        </div>                        
                    </div>
                </div>
            </nav>
        </div>
    </div>
</body>
</html>

<script>
    function confirmDeletePost(postId) {
        if (confirm("Are you sure you want to delete this post?")) {
            window.location.href = 'post_delete.php?POST_ID=' + postId;
        }
    }
</script>