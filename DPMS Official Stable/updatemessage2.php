
    <?php
    // Include the database connection file
    require_once('php/config.php');
    
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve data from the form
        $reference_num = $_POST['refernum'];
        $change_message = $_POST['message_from_user'];
    
        // Prepare the update statement
        $query = "UPDATE conslutation_message_table SET message_from_user = ? WHERE references_num = ?";
        $stmt = $con->prepare($query);
    
        // Bind parameters
        $stmt->bind_param("si", $change_message, $reference_num);
    
        // Execute the update statement
        if ($stmt->execute()) {
            echo "<script>alert('Update Successfully'); window.location.href = 'reachoutmessage.php';</script>";
        } else {
            echo "Error updating status: " . $stmt->error;
        }
        // Close statement
        $stmt->close();
    }
    ?>