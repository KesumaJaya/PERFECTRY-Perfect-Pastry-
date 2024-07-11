<?php
include 'connectdb.php'; // Include the database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $event_id = intval($_POST['event_id']);

    // Prepare and execute the delete query
    $query = "DELETE FROM event WHERE EVENT_ID = ?";
    $stmt = $link->prepare($query);
    $stmt->bind_param("i", $event_id);

    if ($stmt->execute()) {
        header("Location: event_list.php");
        exit();
    } else {
        echo "Error deleting record: " . $link->error;
    }
}
?>
