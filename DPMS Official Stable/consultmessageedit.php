<?php
require_once('php/config.php');
session_start();

// Check if 'refernum' is set in the URL
if(isset($_GET['refernum'])) {
    $refer_num = mysqli_real_escape_string($con, $_GET['refernum']); // Prevent SQL injection
    $query = "SELECT * FROM conslutation_message_table WHERE references_num = '$refer_num'";
    $result_evaluated_tb = mysqli_query($con, $query);
    if($result_evaluated_tb) {
        // Fetch data from result set
        $row = mysqli_fetch_assoc($result_evaluated_tb);
    }  
} else {
    // Handle case where 'refernum' is not set
    echo "Error: Refernum not provided in the URL.";
    exit(); // Stop further execution
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css\consultation_style4.css" rel="stylesheet">
<script defer src="js/bootstrap.bundle.min.js"></script>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="View_Send-Message" id="display2">
        <div class="box-messages">
        <form method="POST" action="updatemessage2.php">
            <div class="send-message-title">Edit Consultation Message</div>
            <div class="from-user">From:</div>
            <input type="text" value="<?php echo isset($row['from_user_name']) ? $row['from_user_name'] : ''; ?>" disabled>
            <div class="to-user">To:</div>
            <input type="text" id="to_user" value="<?php echo isset($row['to_user_name']) ? $row['to_user_name'] : ''; ?>" disabled>
            <div class="to-user">Reference :</div>
            <input type="text" id="reference_num" value="<?php echo isset($row['references_num']) ? $row['references_num'] : ''; ?>" readonly name="refernum">
            <div class="mess-from-user">Message From:</div>
            <textarea id="message_from_user" class="from-message" name="message_from_user"><?php echo isset($row['message_from_user']) ? $row['message_from_user'] : ''; ?></textarea>
            <!-- Your code for 'Status' field -->
            <div class="buttonbox">
                <button class="save-btn" type="submit" onclick="return confirm('Are you sure you want to save?')">Save</button>
            </div>
        </form>
            <!-- Your code for 'StatusChange' -->
        <button class="back-btn" onclick="BackFun()">Back</button>
        </div>
    </div>
    <style>
        .save-btn{
            font-size: 15pt;
            background-color: lightgreen;
            width: 100px;
            border-radius: 5px;
        }
        .buttonbox{
            width: 98%;
            text-align: right;
        }
    </style>
    <script>
        function BackFun() {
            window.location.href = "reachoutmessage.php";
        }
    </script>
</body>
</html>
