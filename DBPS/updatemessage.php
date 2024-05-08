
    <?php
    // Include the database connection file
    require_once('php/config.php');
    
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve data from the form
        $reference_num = $_POST['hidden_refernum'];
        $consult_message_ans = $_POST['consultans'];
        $status_message = $_POST['status'];
    
        // Prepare the update statement
        $query = "UPDATE conslutation_message_table SET status_message = ?, message_to_user = ? WHERE references_num = ?";
        $stmt = $con->prepare($query);
    
        // Bind parameters
        $stmt->bind_param("ssi", $status_message, $consult_message_ans, $reference_num);
    
        // Execute the update statement
        if ($stmt->execute()) {
            echo "<script>alert('Update Successfully'); window.location.href = 'consultationMessage.php';</script>";
        } else {
            echo "Error updating status: " . $stmt->error;
        }
        // Close statement
        $stmt->close();
    }
    ?>