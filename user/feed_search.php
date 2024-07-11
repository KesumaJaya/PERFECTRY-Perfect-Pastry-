<?php 
    session_start(); 
    include 'connectdb.php';

    $search = mysqli_real_escape_string($link, $_REQUEST["search"]);
    $result = false;

    try{
        $query = "SELECT * FROM post WHERE POST_TITLE LIKE '%$search%' ";
        $result = mysqli_query( $link,$query) or die("Query failed");
    }
    catch(mysqli_sql_exception){
        echo "<h2>Search Not Found..</h2>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="feed_style.css">
    <title>Feed</title>
</head>

<body>  
    <?php if($result) {?>
    <h2>Search Found..</h2>
    
    <div class="feed">

        <?php while ($row = mysqli_fetch_array($result)){?> <!--- RETRIEVE FROM DATABASE --->
        
            <a href="feed_detail.php?post_id=<?php print ($row['POST_ID']);?>"><table>
                <tr><td colspan="2" class="image-frame"><img src="../imagePost/<?php echo $row['POST_IMAGE']; ?>" alt=""></td></tr>
                <tr><td colspan="2" class="image-title"><?php echo $row['POST_TITLE']; ?></td></tr>

                <?php
                    /*--- FIND AUTHOR NAME (PERSON WHO POST THE RECIPE) ---*/
                    $id = $row['USER_ID']; 
                    $query = "SELECT USER_NAME FROM user WHERE USER_ID = '$id'";
                    $user = mysqli_query($link,$query);
                    $name = mysqli_fetch_assoc($user)['USER_NAME'];
                ?>

                <tr>
                    <td class="image-author">By <?php echo $name; ?></td>
                    <td width=20% class="rating">4.8</td>
                </tr>
            </table></a><br><?php
            
        } ?>
    </div>

    <?php } ?>
</body>


<style>
    .feed{
        display: flex;
        flex-wrap: wrap;
        overflow-x: hidden;
        overflow-y: hidden;
        white-space: nowrap;
        margin-bottom: 50px;
    }
</style>

