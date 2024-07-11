<?php session_start(); include 'session_end.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfectry | Edit Admin</title>
    <link rel="stylesheet" href="../admin_css/dashboard.css">
    <link rel="stylesheet" href="../admin_css/viewedit.css">
    <link rel="icon" href="../images/PERFECTRY_header.svg" type="image/x-icon">
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
                    <h3>Edit Admin</h3>
                </div>
                <div class="content-box">
                    <p>Back to <a href="admin_list.php">Admins List</a></p>

                    <?php
                    include 'connectdb.php';

                    if (isset($_GET['ADMIN_ID'])) {
                        $id = $_GET['ADMIN_ID'];

                        $query = "SELECT * FROM administrator WHERE ADMIN_ID='$id'";
                        $result = mysqli_query($link, $query) or die("Query failed: " . mysqli_error($link));

                        if ($admin = mysqli_fetch_assoc($result)) {
                            $id = $admin['ADMIN_ID'];
                            $username = $admin['ADMIN_USERNAME'];
                            $password = $admin['ADMIN_PASSWORD'];
                        } else {
                            echo "No admin found with ID $id";
                            exit;
                        }
                    } else {
                        echo "No admin ID provided";
                        exit;
                    }

                    // Update admin data
                    if (isset($_POST['update'])) {
                        
                        $username = $_POST['username'];
                        $password = $_POST['password'];
                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                        
                        if( $password != 'ppppp') {
                            $updateQuery = "UPDATE administrator SET ADMIN_USERNAME='$username', ADMIN_PASSWORD='$hashedPassword' WHERE ADMIN_ID='$id'";
                        } else {
                            $updateQuery = "UPDATE administrator SET ADMIN_USERNAME='$username' WHERE ADMIN_ID='$id'";
                        }

                        if (mysqli_query($link, $updateQuery)) {
                            echo "Admin updated successfully!";
                        } else {
                            echo "Error updating admin: " . mysqli_error($link);
                        }
                    }
                    ?>

                    <form method="post" action="">
                        <table width="100%" border="1">
                            <tr> 
                                <td width="25%"><strong>ID</strong></td>
                                <td><?php echo $id; ?></td>
                            </tr>
                            <tr> 
                                <td><strong>Username</strong></td>
                                <td><input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>"></td>
                            </tr>
                            <tr> 
                                <td><strong>Password</strong></td>
                                <td><input type="password" name="password" value="ppppp"></td>
                            </tr>
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

</style>