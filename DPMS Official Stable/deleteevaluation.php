<?php
// Include the database configuration file
require_once('php/config.php');

// Check if the username is provided and is a string
if (isset($_GET['evaluationID']) && is_string($_GET['evaluationID'])) {
    // Escape the username to prevent SQL injection
    $evaID = mysqli_real_escape_string($con, $_GET['evaluationID']);

    // Perform the deletion query
    $iquery = "DELETE FROM evaluationformtable WHERE EvaluationForm_ID = '$evaID'";
    $inforesult = mysqli_query($con, $iquery);


    if ($inforesult) {
        // Deletion successful
        echo '<script>alert("Evaluation Form Deletion Successful."); window.location.href = "listofevaluationform.php";</script>';
        exit;
    } else {
        // Error handling
        echo 'Error: ' . mysqli_error($con);
    }
} else {
    // Invalid request
    echo 'Invalid request.';
    echo '<script>window.location.href = "listofevaluationform.php";</script>';
    exit;
}
?>
