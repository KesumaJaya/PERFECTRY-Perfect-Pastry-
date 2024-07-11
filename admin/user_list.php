<?php session_start(); include 'session_end.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <link rel="stylesheet" href="../admin_css/dashboard.css">
    <link rel="stylesheet" href="../admin_css/admin_style.css">
    <link rel="icon" href="../images/PERFECTRY_header.svg" type="image/x-icon">
    <title>Perfectry | User List</title>
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
                <!-----------------------------User List with Search------------------------------>
                 <!-- Search Form -->
                 <form method="GET" action="" class="search-form">
                    <input type="text" name="search" placeholder="Search by username" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" class="search-input">
                    <input type="submit" value="Search" class="search-button">
                </form>
                
                <div class="content-box">
                    <section class="list">
                        <div class="user-list">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Email</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    // Connection to database 
                                    include 'connectdb.php';

                                    // Get search query
                                    $search = isset($_GET['search']) ? mysqli_real_escape_string($link, $_GET['search']) : '';

                                    // SQL query to fetch user data with search functionality
                                    $query = "SELECT * FROM user WHERE USER_USERNAME LIKE '%$search%'";
                                    $result = mysqli_query($link, $query);

                                    if (!$result) {
                                        die("Query failed: " . mysqli_error($link));
                                    }

                                    // Data looping
                                    while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td id="postNumber"><a href="user_detail.php?user_id=<?php echo $row['USER_ID']; ?>"><?php echo $row['USER_ID']; ?></a></td>
                                        <td><?php echo $row['USER_EMAIL']; ?></td>
                                        <td><?php echo $row['USER_NAME']; ?></td>
                                        <td><?php echo $row['USER_USERNAME']; ?></td>
                                        <td><div align="center"><button class="action-button delete-button" onclick="confirmDelete('<?php echo $row['USER_ID']; ?>')">Delete</button></td>     
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
    function confirmDelete(userId) {
        if (confirm("Are you sure you want to delete this user? \nMake sure you have review their account and post before click \"OK\"")) {
            window.location.href = 'user_delete.php?USER_ID=' + userId;
        }
    }
    </script>
</body>
</html>

<style>    

.home .wrapper .display .content-box{
    height: 77vh;
}
@media only screen and (max-width: 750px) {
    .home .wrapper .display .content-box{
        height: 80vh;
    }
}
</style>