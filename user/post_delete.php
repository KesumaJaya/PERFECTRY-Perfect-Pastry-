<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

<?php 
    session_start(); 
    include 'session_end.php';
    include 'connectdb.php';

    // Get the ID from the query string and validate it
    if (isset($_GET['POST_ID']) && is_numeric($_GET['POST_ID'])) {
        $delete_id = $_GET['POST_ID'];

        // Prepare the SQL statement to delete the record
        $query = "DELETE FROM post WHERE POST_ID = ?";
        $stmt = $link->prepare($query);
        $stmt->bind_param("i", $delete_id);

        // Execute the statement and check the result
        if ($stmt->execute()) {
            echo
            "<script> 
                alert('Delete Successfull !');            
                window.location.href = 'profile_view.php';
            </script>";
        } else {
            echo "Problem occurred!";
        }

        // Close the statement and connection
        $stmt->close();
    } else {
        echo "Invalid post ID!";
    }

    $link->close();
?>