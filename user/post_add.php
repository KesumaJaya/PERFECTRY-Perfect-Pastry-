<?php session_start(); include 'session_end.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <link rel="stylesheet" href="../user_css/dashboard.css">
    <link rel="stylesheet" href="../user_css/post_style.css">
    <link rel="icon" href="../images/PERFECTRY_header.svg" type="image/x-icon">
    <title>Perfectry | Add Post</title>
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
            <div class="display">
                <div class="header">
                    <h3>Add Post</h3>
                </div>

                <div class="content-box">
                    <!-----------------------------ADD POST------------------------------>

                    <form class="add-post" action="post_upload.php" method="post" enctype="multipart/form-data">

                        <div class="add-left">
                            <label for="category">Category</label><br>
                            <select name="category" id="category" required>
                                <option value="">select category</option>
                                <option value="bread">Bread</option>
                                <option value="cake">Cake</option>
                                <option value="cookie">Cookies</option>
                                <option value="pie">Pie</option>
                            </select><br><br>

                            <label for="name">Recipe Name</label><br>
                            <input type="text" id="name" name="title" placeholder="Title" required><br><br>
                            
                            <label>Pastry Image</label><br>
                            <div class="image-frame">
                                <img id="image" src="" alt="">
                            </div>
                            <input type="file" onchange="readURL(this);" id="file" name="image" accept=".jpg, .jpeg, .png" value="none.png" hidden required>
                            <input type="button" class="photo" value="Upload Photo"> <span>*max image size is 1MB</span> <br><br>
                        </div>
                        
                        <div class="add-right">
                            <label for="description">Description</label><br>
                            <textarea id="description" name="description" placeholder="recipe description..." required></textarea><br><br>
                            
                            <label for="ingredient">Ingredient</label><br>
                            <textarea id="ingredient" name="ingredient" placeholder="ingredients..." required></textarea><br><br>
                            
                            <label for="step">Preparation Steps</label><br>
                            <textarea id="step" name="step" placeholder="recipe steps..." required></textarea><br><br>
                        </div>                        
                        
                        <div class="enter">
                            <input type="submit" value="Post">
                        </div>
                    </form>

                </div>
            </div>    
        </div>
    </div>
</body>
</html>

<script>
   
    const selectImage = document.querySelector('.photo');
    const inputFile = document.querySelector('#file');

    selectImage.addEventListener('click', function(){ inputFile.click(); })   

    /*--- USE TO PREVIEW IMAGE BEFORE SUBMIT ---*/
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#image')
                    .attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }    
    
</script>