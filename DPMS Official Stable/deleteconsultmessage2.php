<?php
// Include the database configuration file
require_once('php/config.php');

// Check if the username is provided and is a string
if (isset($_GET['refernum']) && is_string($_GET['refernum'])) {
    // Escape the username to prevent SQL injection
    $refernumber = mysqli_real_escape_string($con, $_GET['refernum']);

    // Perform the deletion query
    $iquery = "DELETE FROM conslutation_message_table WHERE references_num = '$refernumber'";
    $result = mysqli_query($con, $iquery);


    if ($result) {
        // Deletion successful
        echo '<script>alert("Consultation Message Deletion Successful."); window.location.href = "reachoutmessage.php";</script>';
        exit;
    } else {
        // Error handling
        echo 'Error: ' . mysqli_error($con);
    }
} else {
    // Invalid request
    echo 'Invalid request.';
    echo '<script>window.location.href = "reachoutmessage.php";</script>';
    exit;
}
?>
