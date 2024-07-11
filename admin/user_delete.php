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
    <title>Perfectry | Delete User</title>
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
                    <h3>Delete User</h3>
                </div>
                <!-----------------------------Delete User------------------------------>
                <div class="content-box">
                    <?php 
                    include 'connectdb.php';

                    // Get the ID from the query string and validate it
                    if (isset($_GET['USER_ID']) && is_numeric($_GET['USER_ID'])) {
                        $delete_id = $_GET['USER_ID'];

                        // Start a transaction
                        mysqli_begin_transaction($link);

                        try {
                            // Delete dependent records in the `post` table
                            $delete_posts_query = "DELETE FROM post WHERE USER_ID = ?";
                            $stmt = $link->prepare($delete_posts_query);
                            $stmt->bind_param("i", $delete_id);
                            $stmt->execute();
                            $stmt->close();

                            // Prepare the SQL statement to delete the user record
                            $delete_user_query = "DELETE FROM user WHERE USER_ID = ?";
                            $stmt = $link->prepare($delete_user_query);
                            $stmt->bind_param("i", $delete_id);
                            $stmt->execute();
                            $stmt->close();

                            // Commit the transaction
                            mysqli_commit($link);

                            echo "User and related posts deleted successfully! <a href='user_list.php'>Back to User List</a>";
                        } catch (mysqli_sql_exception $exception) {
                            // Rollback the transaction in case of error
                            mysqli_rollback($link);
                            echo "Problem occurred: " . $exception->getMessage();
                        }
                    } else {
                        echo "Invalid ID!";
                    }

                    $link->close();
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
