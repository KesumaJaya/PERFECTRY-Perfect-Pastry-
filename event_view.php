<?php session_start(); include 'session_end.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../user_css/dashboard.css">
    <link rel="stylesheet" href="../user_css/event_style.css">
    <title>Event</title>
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

            <!-----------------------------EVENT------------------------------>
            <nav class="display">
                <div class="header">
                    <h3>Event</h3>
                </div>
                <div class="content-box">   
                    <div class="event">

                    <?php
                    include 'connectdb.php'; // Include the database connection file

                    // Fetch events from the database
                    $query = "SELECT * FROM event";
                    $result = mysqli_query($link, $query);
                    
                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<div class='box'>";
                            echo "<table>";
                            echo "<tr><th class='event-title'>" . htmlspecialchars($row['EVENT_NAME']) . "</th></tr>";
                            echo "<tr><td class='image-frame'><img src='../imageEvent/" . htmlspecialchars($row['EVENT_PIC']) . "' alt='Event Image'></td></tr>";
                            echo "<tr><td>Description: " . nl2br(htmlspecialchars($row['EVENT_DESCRIPTION'])) . "</td></tr>";
                            echo "<tr><td><strong>Date: " . htmlspecialchars($row['EVENT_DATE']) . "</strong></td></tr>";
                            echo "<tr><td><strong>Time: " . htmlspecialchars($row['EVENT_TIME']) . "</strong></td></tr>";
                            echo "</table>";
                            echo "</div><br>";
                        }
                    } else {
                        echo "<p>No events found</p>";
                    }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>