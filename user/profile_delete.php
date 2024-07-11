<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

<?php 
    session_start(); 
    include 'session_end.php';
    include 'connectdb.php';

    // Get the ID from the query string and validate it
    if (isset($_GET['USER_ID']) && is_numeric($_GET['USER_ID'])) {
        $delete_id = $_GET['USER_ID'];

        // Start a transaction
        mysqli_begin_transaction($link);

        try {
            // Delete dependent records in the `post` table
            $delete_posts_query = "DELETE FROM post WHERE USER_ID = ?";
            $stmt = $link->prepare($delete_posts_query);
            $stmt->bind_param("i", $delete_id);
            $stmt->execute();
            $stmt->close();

            // Prepare the SQL statement to delete the user record
            $delete_user_query = "DELETE FROM user WHERE USER_ID = ?";
            $stmt = $link->prepare($delete_user_query);
            $stmt->bind_param("i", $delete_id);
            $stmt->execute();
            $stmt->close();

            // Commit the transaction
            mysqli_commit($link);
            
        } 
        catch (mysqli_sql_exception $exception) {
            // Rollback the transaction in case of error
            mysqli_rollback($link);
            echo "Problem occurred: " . $exception->getMessage();
        }
    } else {
        echo "Invalid ID!";
    }

    include 'user_logout.php';
    include 'session_end.php';
    $link->close();
?>
