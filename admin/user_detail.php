<?php session_start(); include 'session_end.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../admin_css/dashboard.css">
    <link rel="stylesheet" href="../admin_css/admin_style.css">
    <link rel="icon" href="../images/PERFECTRY_header.svg" type="image/x-icon">
    <title>Perfectry | User Detail</title>
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
                    <img src="../images/PERFECTRY.svg" alt="Logo">
                </div>
                <ul>
                    <li><a href="admin_list.php">Admin</a></li>
                    <li><a href="user_list.php">User</a></li>
                    <li><a href="admin_feed.php">Feed</a></li>
                    <li><a href="event_list.php">Event</a></li>
                </ul>
                <div class="out">
                    <a href="admin_logout.php"><input type="button" value="Log Out"></a>
                </div>
            </nav>

            <div class="display">
                <div class="header">
                    <h3>User Review</h3>
                </div>

                <div class="content-box">
                    <p>Back to <a href="user_list.php">USER LIST</a></p>

                    <!----------- Review User ----------->
                    <?php 
                    include 'connectdb.php';

                    if (isset($_GET['user_id'])) {
                        $id = $_GET['user_id'];
                        
                        $query = "SELECT * FROM user WHERE user_id='$id'";
                        $result = mysqli_query($link, $query) or die("Query failed: " . mysqli_error($link));
                        
                        if ($user = mysqli_fetch_assoc($result)) {
                            $id = $user['USER_ID'];
                            $name = $user['USER_NAME'];
                            $username = $user['USER_USERNAME'];
                            $email = $user['USER_EMAIL'];
                        } else {
                            echo "No user found with ID $id";
                            exit;
                        }
                    } else {
                        echo "No user ID provided";
                        exit;
                    }
                    ?>

                    <table width="100%" border="1">
                        <tr> 
                            <td width="25%"><strong>ID</strong></td>
                            <td width="75%"><?php echo htmlspecialchars($id); ?></td>
                        </tr>
                        <tr> 
                            <td><strong>Name</strong></td>
                            <td><?php echo htmlspecialchars($name); ?></td>
                        </tr>
                        <tr> 
                            <td><strong>Username</strong></td>
                            <td><?php echo htmlspecialchars($username); ?></td>
                        </tr>
                        <tr> 
                            <td><strong>Email</strong></td>
                            <td><?php echo htmlspecialchars($email); ?></td>
                        </tr>
                    </table>

                    <!----------- Review User Post  ----------->
                    <br><br><h2>User Posts</h2>
                    <?php

                    $query = "SELECT post.*, user.USER_NAME FROM post JOIN user ON post.USER_ID = user.USER_ID WHERE user.USER_ID=$id ORDER BY post.POST_ID DESC";
                    $postResult = mysqli_query($link, $query);

                    if (!$postResult) {
                        die("Query failed: " . mysqli_error($link));
                    }
                    ?> 

                    <section class="list">
                        <div class="user-list">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Post Description</th>
                                        <th>By</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="postTable">
                                    <?php while ($row = mysqli_fetch_assoc($postResult)) { ?>
                                    <tr data-category="<?php echo $row['POST_CATEGORY']; ?>">
                                        <td id="postNumber">
                                            <a href="feed_detail.php?post_id=<?php print ($row['POST_ID']);?>">
                                            <?php echo $row['POST_ID']; ?></a>                                        
                                        </td>
                                        <td><?php echo $row['POST_TITLE']; ?></td>
                                        <td><?php echo $row['POST_CATEGORY']; ?></td>
                                        <td><?php echo $row['POST_DESCRIPTION']; ?></td>
                                        <td><?php echo $row['USER_NAME']; ?></td>
                                        <td> <div align="center"><button class="action-button" onclick="deletePost(<?php echo $row['POST_ID']; ?>)">Delete</button> </div></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script>
    function deletePost(postId) {
        if (confirm("Are you sure you want to delete this post? \nMake sure you have review this post before do so \nClick on post ID to review \n\nclick \"Cancel\" if you did't review the content yet")) {
            window.location.href = 'delete_post.php?POST_ID=' + postId;
        }
    }
</script>

<style>
    table th, table td {
        padding: 10px;
    }
</style>
