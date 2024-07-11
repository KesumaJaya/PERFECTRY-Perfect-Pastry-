<?php session_start(); include 'session_end.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../user_css/dashboard.css">
    <link rel="stylesheet" href="../user_css/feed_style.css">
    <link rel="icon" href="../images/PERFECTRY_header.svg" type="image/x-icon">
    <title>Perfectry | Feed Details</title>
</head>

<body>    
    <div class="home">
        <div class="wrapper">

            <input type="checkbox" id="menu" hidden> <!-- phone view -->
            <label for="menu" class="menu-icon">
                <img width="45px" src="../images/menu-svgrepo-com.svg" alt="">
            </label>

            <nav class="dashboard">
                <div class="image-frame">
                    <img src="../images/PERFECTRY.svg" alt="">
                </div>
                <ul>
                    <li><a href="admin_list.php">Admin</a></li>
                    <li><a href="user_list.php">User</a></li>
                    <li><a href="admin_feed.php">Feed</a></li>
                    <li><a href="event_list.php">Event</a></li>
                </ul>
                <div class="out">
                    <a href="user_logout.php"><input type="button" value="Log Out"></a>
                </div>
            </nav>

            <?php
                include 'connectdb.php';

                $id = $_GET['post_id'];
                $query = "SELECT * FROM post WHERE POST_ID = $id";
                $result = mysqli_query($link, $query);

                if($result){

                    $post = mysqli_fetch_array($result);

                    $title = $post['POST_TITLE'];       
                    $image = $post['POST_IMAGE']; 
                    $description = $post['POST_DESCRIPTION'];
                    $ingredient = $post['POST_INGREDIENTS'];
                    $step = $post['POST_STEP'];
                }
            ?>

            <div class="display">
                <div class="header">
                    <h3>Feed</h3>
                </div>

                <div class="content-box">
                    <div class="recipe-detail">
                        <h1><?php echo $title ?></h1>
                        <div class="recipe-top">
                            <div class="image-frame">
                                <img src="../imagePost/<?php echo $image; ?>" alt="">
                            </div>
                            <div>
                                <h3>Description</h3>
                                <p><?php echo $description ?></p>
                            </div>
                        </div>  
                        <div class="recipe-bottom">
                            <div class="ingredient">
                                <h3>Ingredient</h3>
                                <p><?php echo nl2br(htmlspecialchars($ingredient)); ?></p>
                            </div>
                            <div class="instruction">
                                <h3>Instruction</h3>
                                <p><?php echo nl2br(htmlspecialchars($step)); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</body>

<style>

    .home .wrapper .display .content-box{
        height: 85vh;
    }

@media only screen and (max-width: 540px) {

    .home .wrapper .display .content-box{
        height: 89vh;
        margin: 10px;
    }
}
</style>