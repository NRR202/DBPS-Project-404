<?php
// Include the database configuration file
require_once('php/config.php');

// Check if the username is provided and is a string
if (isset($_GET['user']) && is_string($_GET['user'])) {
    // Escape the username to prevent SQL injection
    $username = mysqli_real_escape_string($con, $_GET['user']);

    // Perform the deletion query
    $iquery = "DELETE FROM student_info WHERE username = '$username'";
    $inforesult = mysqli_query($con, $iquery);

    $cquery = "DELETE FROM credentials_account WHERE username = '$username'";
    $credresult = mysqli_query($con, $cquery);

    if ($inforesult && $credresult) {
        // Deletion successful
        echo '<script>alert("Student Info and Credentials deleted successfully."); window.location.href = "StudentTable.php";</script>';
        exit;
    } else {
        // Error handling
        echo 'Error: ' . mysqli_error($con);
    }
} else {
    // Invalid request
    echo 'Invalid request.';
}
?>
