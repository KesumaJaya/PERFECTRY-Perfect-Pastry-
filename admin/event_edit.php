<?php session_start(); include 'session_end.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <link rel="stylesheet" href="../admin_css/dashboard.css">
    <link rel="stylesheet" href="../admin_css/viewedit.css">
    <link rel="icon" href="../images/PERFECTRY_header.svg" type="image/x-icon">
    <title>Perfectry | Edit Event</title>
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
            <div class="display">
                <div class="header">
                    <h3>Edit Event</h3>
                </div>

                <!-- Update Event Form -->
                <div class="content-box">
                    <p>Back to <a href="event_list.php">Event List</a></p>

                    <?php
                    // Include database connection
                    include 'connectdb.php';

                    // Initialize variables to hold event details
                    $event_name = $event_description = $event_date = $event_time = '';

                    // Check if EVENT_ID is provided via GET
                    if (isset($_GET['event_id'])) {
                        $event_id = $_GET['event_id'];

                        // Fetch event details from the database
                        $query = "SELECT * FROM event WHERE EVENT_ID='$event_id'";
                        $result = mysqli_query($link, $query);

                        if ($event = mysqli_fetch_assoc($result)) {
                            $event_name = $event['EVENT_NAME'];
                            $event_description = $event['EVENT_DESCRIPTION'];
                            $event_date = $event['EVENT_DATE'];
                            $event_time = $event['EVENT_TIME'];
                            $event_price = $event['EVENT_PRICE'];
                            // Assuming EVENT_PIC is stored as a filename in the database
                            $event_pic = $event['EVENT_PIC'];
                        } else {
                            echo "No event found with ID $event_id";
                            exit;
                        }
                    } else {
                        echo "No event ID provided";
                        exit;
                    }

                    // Update event data
                    if (isset($_POST['update'])) {
                        $event_name = mysqli_real_escape_string($link, $_POST['event_name']);
                        $event_description = mysqli_real_escape_string($link, $_POST['event_description']);
                        $event_date = mysqli_real_escape_string($link, $_POST['event_date']);
                        $event_time = mysqli_real_escape_string($link, $_POST['event_time']);
                        $event_price = mysqli_real_escape_string($link, $_POST['event_price']);

                        // Update query for event
                        $updateQuery = "UPDATE event SET
                                        EVENT_NAME='$event_name',
                                        EVENT_DESCRIPTION='$event_description',
                                        EVENT_DATE='$event_date',
                                        EVENT_TIME='$event_time',
                                        EVENT_PRICE='$event_price'
                                        WHERE EVENT_ID='$event_id'";

                        if (mysqli_query($link, $updateQuery)) {
                            echo "Event updated successfully!";
                            // JavaScript redirect after 2 seconds
                            echo '<script>window.setTimeout(function() { window.location.href = "event_list.php"; }, 2000);</script>';
                        } else {
                            echo "Error updating event: " . mysqli_error($link);
                        }
                    }
                    ?>

                    <!-- Edit Event Form -->
                    <form method="post" action="">
                        <table>
                            <tr>
                                <td><strong>Event Name:</strong></td>
                                <td><input type="text" name="event_name" id="title" value="<?php echo htmlspecialchars($event_name); ?>"></td>
                            </tr>
                            <tr>
                                <td><strong>Event Description:</strong></td>
                                <td><textarea name="event_description" rows="4" cols="50"><?php echo htmlspecialchars($event_description); ?></textarea></td>
                            </tr>
                            <tr>
                                <td><strong>Event Date:</strong></td>
                                <td><input type="date" name="event_date" id="date" value="<?php echo htmlspecialchars($event_date); ?>"></td>
                            </tr>
                            <tr>
                                <td><strong>Event Time:</strong></td>
                                <td><input type="time" name="event_time" id="time" value="<?php echo htmlspecialchars($event_time); ?>"></td>
                            </tr>
                            <tr>
                                <td><strong>Event Price:</strong></td>
                                <td><input type="number" name="event_price" id="price" value="<?php echo htmlspecialchars($event_price); ?>"></td>
                            </tr>
                            <!-- You can add more fields as needed -->

                            <tr>
                                <td colspan="2"><input type="submit" name="update" value="Update"></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<style>

.content-box form table td input {
    font-size: 15px;
    border-radius: 10px;
    background-color: #fff;
    border: 2px solid #ccc;
    color: black;
    width: 250px;
    height: 35px;
    outline: none;
    padding: 10px 20px;
}
.content-box form table td input#price {
    width: 110px;
}
.content-box form table td input#time, input#date {
    width: 180px;
}
.content-box form table td input[type=submit]{
    font-size: 18px;
    font-weight: bold;
    border-radius: 10px;
    background-color: #ffb95d;
    border: 1px solid #ccc;    
    width: 200px;
    height: 50px;
    padding: 5px 30px;
    cursor: pointer;
    bottom: 0;
}
.content-box form table td textarea{
    margin-top: 10px;
    background-color: #fff;
    border: 2px solid #ccc;
    border-radius: 10px;
    width: 450px;
    height: 145px;
    outline: none;
    font-size: 15px;
    padding: 10px 20px;
}

</style>