<?php 
    session_start(); 
    include 'connectdb.php';
    include 'session_end.php'; 
    $userID = $_SESSION['userID'];

    $query = "SELECT * FROM user where USER_ID = '$userID'";
    $result = mysqli_query($link,$query);

    if(mysqli_num_rows($result)){

        $user = mysqli_fetch_array($result);
        $userName = $user['USER_NAME'];
        $userEmail = $user['USER_EMAIL'];
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../user_css/dashboard.css">
    <link rel="stylesheet" href="../user_css/event_style.css">
    <link rel="icon" href="../images/PERFECTRY_header.svg" type="image/x-icon">
    <title>Perfectry | Join Event</title>

    <script>
        // form submission
        function submitForm(price) {
            var name = document.getElementById('name').value;
            var email = document.getElementById('email').value;
            var contact = document.getElementById('contact').value;
            var pax = document.getElementById('pax').value;
            
            var amount = pax * price + 15; 

            // Prepare message
            var message = "Hello " + name + ", your booking is successful! \nThe amount that you need to pay is RM" + amount + ".00";

            // Display message using alert
            alert(message);

            // Reset form fields (optional)
            document.getElementById('contact').value = '';
            document.getElementById('pax').value = '';

            // Prevent form submission (optional)
            return false;
        }
</script>


    
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

                <?php
                    include 'connectdb.php';
                    $id = $_GET['event_id'];
                    $query = "SELECT * FROM event WHERE EVENT_ID = $id";
                    $result = mysqli_query($link, $query);

                    if($result)
                    {
                        $event = mysqli_fetch_array($result);

                        $name = $event['EVENT_NAME'];
                        $pic = $event['EVENT_PIC'];
                        $desc = $event['EVENT_DESCRIPTION'];
                        $time = $event['EVENT_TIME'];
                        $date = $event['EVENT_DATE'];
                        $price = $event['EVENT_PRICE'];
                    }
                ?>

            <!--------------------------- JOIN EVENT ---------------------------->
            <nav class="display">
                <div class="header">
                    <h3>Join Event</h3>
                </div>
                <div class="content-box" style='justify-content: center;'>
                    <div class="event-detail">
                        <h1><?php echo $name ?></h1>
                        <div class="event-top">
                            <div class="image-frame">
                                <img src="../imageEvent/<?php echo $pic; ?>" alt="">
                            </div>
                            <div>
                                <h3>Description</h3>
                                <p><?php echo $desc ?></p></br>
                            </div>
                        </div>
                        <div class="event-bottom">
                            <div class="details">
                                <h3>Time</h3>
                                <p><?php echo htmlspecialchars($time); ?></p></br>
                                <h3>Date</h3>
                                <p><?php echo htmlspecialchars($date); ?></p></br>
                                <h3>Price</h3>
                                <p>RM <?php echo $price ?>.00</p></br>
                            </div>

                            <h2>Booking Form</h2></br>
                            <form onsubmit="return submitForm(<?php echo $price ?>);" autocomplete="off">
                                <label for="name">Name :</label>
                                <input type="text" id="name" name="name" value="<?php echo $userName ?>" required>
                                <br></br>
                                <label for="email">Email :</label>
                                <input type="email" id="email" name="email" value="<?php echo $userEmail ?>" required>
                                <br></br>
                                <label for="contact">Contact :</label>
                                <input type="text" id="contact" name="contact" placeholder="contact number" required>
                                <br></br>
                                <label for="pax">Number of Pax :</label>
                                <input type="number" placeholder="1" id="pax" name="pax" min="1" required>
                                <br></br>
                                <p style="font-size: 11px; font-weight: bold;">*RM 15.00 will be added in your bill as service charge</p><br>
                                <button type="submit">Submit</button>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div> 
        </div>
    </div>
</body>

<style>
    .event-detail form input{
        font-size: 16px;
        border-radius: 5px;
        background-color: #fff;
        border: 2px solid #ccc;
        color: black;
        outline: none;
        padding: 2px 10px;
    }
    .event-detail form input#pax{
        width: 80px;
    }
</style>