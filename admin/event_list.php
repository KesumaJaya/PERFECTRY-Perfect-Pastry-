<?php session_start(); include 'session_end.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../admin_css/dashboard.css">
    <link rel="stylesheet" href="../admin_css/event_style.css">
    <link rel="icon" href="../images/PERFECTRY_header.svg" type="image/x-icon">
    <title>Perfectry | Event</title>
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

            <!-----------------------------EVENT------------------------------>
            <nav class="display">
                <div class="header">
                    <h3>Event</h3>
                </div>
                <div class="content-box">  
                    <button class="add-button" onclick="location.href='event_add.php'">Add Event</button> 
                    <div class="event">
                        <div class="box-container">
                        <?php
                            include 'connectdb.php'; // Include the database connection file

                            // Fetch events from the database
                            $query = "SELECT * FROM event";
                            $result = mysqli_query($link, $query);
                        ?>
                        <?php
                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "<div class='box'>";
                                echo "<table>";
                                echo "<tr><th colspan='2' class='event-title'>" . htmlspecialchars($row['EVENT_NAME']) . "</th></tr>";
                                echo "<tr><td colspan='2' class='image-frame'><img src='../imageEvent/" . htmlspecialchars($row['EVENT_PIC']) . "' alt='Event Image'></td></tr>";
                                echo "<tr><td>Description: " . nl2br(htmlspecialchars($row['EVENT_DESCRIPTION'])) . "</td></tr>";
                                echo "<tr><td><strong>Date: " . htmlspecialchars($row['EVENT_DATE']) . "</strong></td></tr>";
                                echo "<tr><td><strong>Time: " . htmlspecialchars($row['EVENT_TIME']) . "</strong></td></tr>";
                                echo "<tr><th colspan='2'>";
                                echo "<form method='GET' action='event_edit.php' style='display:inline-block; margin-left:10px;'>";
                                echo "<input type='hidden' name='event_id' value='" . htmlspecialchars($row['EVENT_ID']) . "'>";
                                echo "<input type='submit' value='Edit' class='edit-button'>";
                                echo "</form>";
                                echo "<form method='POST' action='event_delete.php' onsubmit='return confirm(\"Are you sure you want to delete this event? \\nMake sure the event date already expired before click OK\");' style='display:inline-block;'>";
                                echo "<input type='hidden' name='event_id' value='" . htmlspecialchars($row['EVENT_ID']) . "'>";
                                echo "<input type='submit' value='Delete' class='delete-button'>";
                                echo "</form>";
                                echo "</th></tr>";
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
            </nav>
        </div>
    </div>
    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this event? \nMake sure the date alredy expired before click \"Okay\"');
        }
    </script>
</body>
</html>

<style>
    
    @media only screen and (max-width: 750px) {

        .event table{
            padding: 5px;
            width: 80vw;
        }
    } 
</style>

