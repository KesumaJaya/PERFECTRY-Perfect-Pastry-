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

    <title>Report</title>
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

                <div class="content-box">

                    <?php 
                    include 'connectdb.php';

                    // Get the ID from the query string and validate it
                    if (isset($_GET['ADMIN_ID']) && is_numeric($_GET['ADMIN_ID'])) {
                        $delete_id = $_GET['ADMIN_ID'];

                        // Prepare the SQL statement to delete the record
                        $query = "DELETE FROM administrator WHERE ADMIN_ID = ?";
                        $stmt = $link->prepare($query);
                        $stmt->bind_param("i", $delete_id);

                        // Execute the statement and check the result
                        if ($stmt->execute()) {
                            echo "Delete Successfully! <a href='admin_list.php'>Back to Admin List</a>";
                        } else {
                            echo "Problem occurred!";
                        }

                        // Close the statement and connection
                        $stmt->close();
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