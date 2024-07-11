<?php session_start(); include 'session_end.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../user_css/dashboard.css">
    <link rel="stylesheet" href="../user_css/feed_style.css"> 
    <link rel="icon" href="../images/PERFECTRY_header.svg" type="image/x-icon">
    <title>Perfectry | Feed</title>
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
                    <li><a href="profile_view.php">Profile</a></li>
                    <li><a href="feed_view.php">Feed</a></li>
                    <li><a href="post_add.php">Add Post</a></li>
                    <li><a href="event_view.php">Event</a></li>
                </ul>
                <div class="out">
                    <a href="user_logout.php"><input type="button" value="Log Out"></a>
                </div>
            </nav>

            <?php
                include 'connectdb.php';
                
                $query = "SELECT * FROM post ORDER BY POST_ID DESC";
                $result1 = mysqli_query($link, $query);
                $result2 = mysqli_query($link, $query);
                $result3 = mysqli_query($link, $query);
                $result4 = mysqli_query($link, $query);
            ?>

            <div class="display">
                <div class="header">
                    <h3>Feed</h3>
                </div>

                <!-- use to avoid from redirect to different page -->
                <iframe name="dummyframe" id="dummyframe" style="display: none;"></iframe>

                <form class="search-bar" action="feed_search.php" method="post" autocomplete="off">
                    <label for="search"><img src="../images/search-svgrepo-com.svg" alt=""></label>
                    <input type="text" name="search" id="search" placeholder="search by pastry name...">
                </form>

                <div class="content-box">
                
                    <h2>Breads</h2>
                    <div class="feed">
                        <?php while ($row = mysqli_fetch_array($result1)){

                            if($row['POST_CATEGORY'] == "bread"){?> <!--- ACTUAL POST (RETRIEVE FROM DATABASE --->
                        
                                <a href="feed_detail.php?post_id=<?php print ($row['POST_ID']);?>"><table>
                                    <tr><td colspan="2" class="image-frame"><img src="../imagePost/<?php echo $row['POST_IMAGE']; ?>" alt=""></td></tr>
                                    <tr><td colspan="2" class="image-title"><?php echo $row['POST_TITLE']; ?></td></tr>

                                    <?php
                                        /*--- FIND AUTHOR NAME (PERSON WHO POST THE RECIPE) ---*/
                                        $id = $row['USER_ID']; 
                                        $query = "SELECT USER_USERNAME FROM user WHERE USER_ID = '$id'";
                                        $result = mysqli_query($link,$query);
                                        $name = mysqli_fetch_assoc($result)['USER_USERNAME'];
                                    ?>

                                    <tr>
                                        <td class="image-author">By <?php echo $name; ?></td>
                                        <td width=20% class="rating">4.8</td>
                                    </tr>
                                </table></a><br><?php
                            }
                        } ?>
                    </div>
                
                    <h2>Cakes</h2>
                    <div class="feed">
                        <?php while ($row = mysqli_fetch_array($result2)){

                            if($row['POST_CATEGORY'] == "cake"){?> <!--- ACTUAL POST (RETRIEVE FROM DATABASE --->
                        
                                <a href="feed_detail.php?post_id=<?php print ($row['POST_ID']);?>"><table>
                                    <tr><td colspan="2" class="image-frame"><img src="../imagePost/<?php echo $row['POST_IMAGE']; ?>" alt=""></td></tr>
                                    <tr><td colspan="2" class="image-title"><?php echo $row['POST_TITLE']; ?></td></tr>

                                    <?php
                                        /*--- FIND AUTHOR NAME (PERSON WHO POST THE RECIPE) ---*/
                                        $id = $row['USER_ID']; 
                                        $query = "SELECT USER_USERNAME FROM user WHERE USER_ID = '$id'";
                                        $result = mysqli_query($link,$query);
                                        $name = mysqli_fetch_assoc($result)['USER_USERNAME'];
                                    ?>

                                    <tr>
                                        <td class="image-author">By <?php echo $name; ?></td>
                                        <td width=20% class="rating">4.8</td>
                                    </tr>
                                </table></a><br><?php
                            }
                        } ?>
                    </div>

                    <h2>Cookies</h2> 
                    <div class="feed">
                        <?php while ($row = mysqli_fetch_array($result3)){ 

                            if($row['POST_CATEGORY'] == "cookie"){?>
                        
                                <a href="feed_detail.php?post_id=<?php print ($row['POST_ID']);?>"><table>
                                    <tr><td colspan="2" class="image-frame"><img src="../imagePost/<?php echo $row['POST_IMAGE']; ?>" alt=""></td></tr>
                                    <tr><td colspan="2" class="image-title"><?php echo $row['POST_TITLE']; ?></td></tr>

                                    <?php
                                        /*--- FIND AUTHOR NAME (PERSON WHO POST THE RECIPE) ---*/
                                        $id = $row['USER_ID']; 
                                        $query = "SELECT USER_USERNAME FROM user WHERE USER_ID = '$id'";
                                        $result = mysqli_query($link,$query);
                                        $name = mysqli_fetch_assoc($result)['USER_USERNAME'];
                                    ?>

                                    <tr>
                                        <td class="image-author">By <?php echo $name; ?></td>
                                        <td width=20% class="rating">4.8</td>
                                    </tr>
                                </table></a><br><?php 
                            } 
                        } ?>
                    </div>

                    <h2>Pies</h2> 
                    <div class="feed">
                        <?php while ($row = mysqli_fetch_array($result4)){ 

                            if($row['POST_CATEGORY'] == "pie"){?>
                        
                                <a href="feed_detail.php?post_id=<?php print ($row['POST_ID']);?>"><table>
                                    <tr><td colspan="2" class="image-frame"><img src="../imagePost/<?php echo $row['POST_IMAGE']; ?>" alt=""></td></tr>
                                    <tr><td colspan="2" class="image-title"><?php echo $row['POST_TITLE']; ?></td></tr>

                                    <?php
                                        /*--- FIND AUTHOR NAME (PERSON WHO POST THE RECIPE) ---*/
                                        $id = $row['USER_ID']; 
                                        $query = "SELECT USER_USERNAME FROM user WHERE USER_ID = '$id'";
                                        $result = mysqli_query($link,$query);
                                        $name = mysqli_fetch_assoc($result)['USER_USERNAME'];
                                    ?>

                                    <tr>
                                        <td class="image-author">By <?php echo $name; ?></td>
                                        <td width=20% class="rating">4.8</td>
                                    </tr>
                                </table></a><br><?php 
                            } 
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    $(document).ready(function() {
        // Event listener for form submission
        $('.search-bar').submit(function(event) {
            event.preventDefault(); // Prevent default form submission
            var formData = $(this).serialize(); // Serialize form data
            var inputValue = $('#search').val(); // Get the value of the input field
            if (inputValue.trim() === '') {
                window.location.reload(); // Reload the page if input is empty or contains only whitespace characters
            }
            else {
            $.post('feed_search.php', formData, function(response) {
                $('.content-box').html(response); // Update content of .content-box with response from feed_search.php
            });}
        });
    });
</script>   