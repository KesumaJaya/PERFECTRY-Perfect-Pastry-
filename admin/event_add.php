<?php session_start(); include 'session_end.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../admin_css/dashboard.css">
    <link rel="stylesheet" href="../admin_css/event_style.css">
    <link rel="icon" href="../images/PERFECTRY_header.svg" type="image/x-icon">
    <title>Perfectry | Add Event</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                    <h3>Add Event</h3>
                </div>

                <div class="content-box">
                    <!-----------------------------ADD EVENT------------------------------>
                    <form class="add-event" action="event_upload.php" method="post" enctype="multipart/form-data">
                        <div class="add-left">
                        
                            <label for="name">Event Title</label><br>
                            <input type="text" id="name" name="title" placeholder="Title" required><br><br>
                            
                            <label for="image">Image</label><br>
                            <div class="image-frame">
                                <img id="image" src="" alt="">
                            </div>
                            <input type="file" onchange="readURL(this);" id="file" name="image" accept=".jpg, .jpeg, .png" hidden required>
                            <input type="button" class="photo" value="Upload Photo"> <span>*max image size is 1MB</span> <br><br>
                        </div>
                        
                        <div class="add-right">
                            <label for="description">Event Description</label><br>
                            <textarea id="description" name="description" placeholder="event description" required></textarea><br><br>
                            
                            <label for="date">Event date</label><br>
                            <input type="date" id="date" name="date" placeholder="date" required><br><br>
                            
                            <label for="time">Time</label><br>
                            <input type="time" id="time" name="time" placeholder="time" required><br><br>

                            <label for="price">Price</label><br>
                            <input type="number" id="price" name="price" placeholder="price in RM" required><br><br>
                        </div>                        
                        
                        <div class="enter">
                            <input type="submit" value="Upload">
                        </div>
                    </form>
                </div>
            </div>    
        </div>
    </div>
</body>
</html>

<script>
    // JavaScript to handle file input click and image preview
    const selectImage = document.querySelector('.photo');
    const inputFile = document.querySelector('#file');

    selectImage.addEventListener('click', function() { 
        inputFile.click(); 
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#image').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
