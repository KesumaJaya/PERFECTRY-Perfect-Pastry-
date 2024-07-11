<?php session_start(); include 'session_end.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../admin_css/dashboard.css">
    <link rel="stylesheet" href="../admin_css/admin_style.css">
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
                    <li><a href="admin_list.php">Admin</a></li>
                    <li><a href="user_list.php">User</a></li>
                    <li><a href="admin_feed.php">Feed</a></li>
                    <li><a href="event_list.php">Event</a></li>
                    </ul>
                <div class="out">
                    <a href="admin_logout.php"><input type="button" value="Log Out"></a>
                </div>
            </nav>
            <?php
            // Include the PHP code here
            include 'connectdb.php';

            $search = isset($_GET['search']) ? mysqli_real_escape_string($link, $_GET['search']) : '';

            $query = "SELECT post.*, user.USER_NAME FROM post JOIN user ON post.USER_ID = user.USER_ID";
            if (!empty($search)) {
                $query .= " WHERE post.POST_TITLE LIKE '%$search%'";
            }
            $query .= " ORDER BY post.POST_ID DESC";
            $result = mysqli_query($link, $query);

            if (!$result) {
                die("Query failed: " . mysqli_error($link));
            }
            ?> 

            <div class="display">
                <div class="header">
                    <h3>Feed</h3>
                </div>
                <div class="slider">
                        <div class="tabs">
                            <input type="radio" id="tab1" name="category" onclick="filterPosts('All')">
                            <label for="tab1">All</label>
                            <input type="radio" id="tab2" name="category" onclick="filterPosts('cake')">
                            <label for="tab2">Cake</label>
                            <input type="radio" id="tab3" name="category" onclick="filterPosts('cookie')">
                            <label for="tab3">Cookie</label>
                            <input type="radio" id="tab4" name="category" onclick="filterPosts('bread')">
                            <label for="tab4">Bread</label>
                            <input type="radio" id="tab5" name="category" onclick="filterPosts('pie')">
                            <label for="tab5">Pie</label>
                        </div>
                        <div class="glider"></div>
                    </div>

                     <!-- Search Form -->
                 <form method="GET" action="" class="search-form">
                    <input type="text" name="search" placeholder="Search by Recipe name" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" class="search-input">
                    <input type="submit" value="Search" class="search-button">
                    <a href="admin_feed.php" class="all-button">All</a>
                </form>
                <div class="content-box">
                                        
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
                                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
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

    <script>
        function filterPosts(category) {
            var rows = document.querySelectorAll('#postTable tr');
            var labels = document.querySelectorAll('.tabs label');
            var glider = document.querySelector('.glider');

            labels.forEach((label, index) => {
                if (label.textContent.trim() === category) {
                    label.style.color = '#000';
                    glider.style.transform = `translateX(${label.offsetLeft}px)`;
                    glider.style.width = `${label.offsetWidth}px`;
                } else {
                    label.style.color = '#000';
                }
            });

            rows.forEach(row => {
                row.classList.add('sliding-exit');
                row.classList.remove('sliding-enter', 'sliding-enter-active', 'sliding-exit-active');
                
                setTimeout(() => {
                    if (category === 'All' || row.dataset.category === category) {
                        row.classList.remove('hidden');
                        row.classList.add('sliding-enter');
                        setTimeout(() => {
                            row.classList.add('sliding-enter-active');
                            row.classList.remove('sliding-exit', 'sliding-exit-active');
                        }, 10);
                    } else {
                        row.classList.add('hidden');
                        row.classList.remove('sliding-enter', 'sliding-enter-active');
                    }
                }, 500);
            });
        }

        // Initialize the glider to the first tab on page load
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('tab1').checked = true;
            filterPosts('All');
        });
    </script>

    <script>
    function deletePost(postId) {
        if (confirm("Are you sure you want to delete this post? \nMake sure you have review this post before do so \nClick on post ID to review \n\nclick \"Cancel\" if you did't review the content yet")) {
            window.location.href = 'delete_post.php?POST_ID=' + postId;
        }
    }
</script>
</body>
</html>

<style>    
    .home .wrapper .display .content-box{
        height: 70vh;
    }
    @media only screen and (max-width: 540px) {
        
        .search-input{
            width: 225px;
        }
    }
    
</style>