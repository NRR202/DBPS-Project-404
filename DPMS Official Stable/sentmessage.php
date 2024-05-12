<?php
require_once('php/config.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $reference_num = $_POST['reference_number'];
    $fromname = $_POST['fromusername'];
    $toname = $_POST['tousername'];
    $message = $_POST['message_from_user'];
    $status = 'Submitted';

    // Prepare the SQL statement
    $query = "INSERT INTO conslutation_message_table (references_num, from_user_name, to_user_name, message_from_user, status_message)
                VALUES (?, ?, ?, ?, ?)";
    $stmt = $con->prepare($query);

    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("issss", $reference_num, $fromname, $toname, $message, $status);

        // Execute the SQL statement
        if ($stmt->execute()) {
            echo "<script>alert('Message sent successfully'); window.location.href = 'reachoutmessage.php';</script>";
        } else {
            echo "Error Insert status: " . $stmt->error;
        }
        // Close statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $con->error;
    }
}
?>