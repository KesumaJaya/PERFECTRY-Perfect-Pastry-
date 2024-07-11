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
    <title>Perfectry | Admin List</title>
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
                    <h3>Admin List</h3>
                </div>
                <!-----------------------------Admin List------------------------------>
                 <!-- Search Form -->
                 <form method="GET" action="" class="search-form">
                    <input type="text" name="search" placeholder="Search by username" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" class="search-input">
                    <input type="submit" value="Search" class="search-button">
                </form>

                <div class="content-box">
                    <button class="add-button" onclick="location.href='admin_add.php'">Add Admin</button>
                    <section class="list">
                        <div class="admin-list">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    // Connection to database 
                                    include 'connectdb.php';

                                    $search = isset($_GET['search']) ? mysqli_real_escape_string($link, $_GET['search']) : '';

                                    // SQL query to fetch admin data
                                    $query = "SELECT ADMIN_ID, ADMIN_USERNAME FROM administrator where ADMIN_USERNAME like '%$search%'";
                                    $result = mysqli_query($link, $query);

                                    if (!$result) {
                                        die("Query failed: " . mysqli_error($link));
                                    }

                                    // Data looping
                                    while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td style="font-weight: bold;"><?php echo $row['ADMIN_ID']; ?></td>
                                        <td><?php echo $row['ADMIN_USERNAME']; ?></td>
                                        <td><button class="action-button edit-button" onclick="editAdmin('<?php echo $row['ADMIN_ID']; ?>','<?php echo $_SESSION['adminID'] ?>')">Edit</button></td>
                                        <td><button class="action-button delete-button" onclick="confirmDelete('<?php echo $row['ADMIN_ID']; ?>','<?php echo $_SESSION['adminID'] ?>')">Delete</button></td>                                    
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
</body>
</html>

<script>
    function confirmDelete(adminId, currAdmin) {

        if( currAdmin == adminId) {
            if(confirm("Are you sure you want to DELETE your ADMIN account?")) {
                window.location.href = 'admin_delete.php?ADMIN_ID=' + adminId;
            }
        } else {
            alert('You have no right to DELETE this ADMIN !!');
        }
    }
    function editAdmin(adminId, currAdmin) {

        if( currAdmin == adminId) {
            window.location.href = 'admin_edit.php?ADMIN_ID=' + adminId;
        } else {
            alert('You have no right to change this ADMIN details !!');
        }
    }
</script>

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
