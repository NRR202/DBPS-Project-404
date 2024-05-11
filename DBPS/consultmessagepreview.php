<?php
    require_once('php\config.php');
    session_start();
    $refer_num = $_GET['refernum'];
    $query = "SELECT * FROM conslutation_message_table WHERE references_num = '$refer_num'";
    $result_evaluated_tb = mysqli_query($con, $query);
    if($result_evaluated_tb) {
        // Fetch data from result set
        $row = mysqli_fetch_assoc($result_evaluated_tb);
    }  
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css\consultation_style2.css" rel="stylesheet">
<script defer src="js\bootstrap.bundle.min.js"></script>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="View_Send-Message" id="display2">
        <div class="box-messages">
            <div class="send-message-title">Preview Consultation Message</div>
            <div class="from-user">From:</div>
            <input type="text" value="<?php echo $row['from_user_name']?>" disabled>
            <div class="to-user">To:</div>
            <input type="text" id="to_user" value="<?php echo $row['to_user_name']?>" disabled>
            <div class="to-user">Reference :</div>
            <input type="text" id="reference_num" value="<?php echo $row['references_num']?>" disabled name="refernum">
            <div class="mess-from-user">Message From:</div>
            <textarea id="message_from_user" class="from-message" disabled name="message_from_user" disabled><?php echo isset($row['message_from_user']) ? $row['message_from_user'] : ''; ?></textarea>
            <div class="mess-to-user">Message To:</div>
            <textarea id="message_to_user" class="to-message" name="consultans" disabled><?php echo isset($row['message_to_user']) ? $row['message_to_user'] : ''; ?></textarea>
            <div class="status">Status:</div>
            <?php
                require_once('php/config.php');

                // Assuming $refer_num contains the reference number you're querying for
                $sql = "SELECT status_message FROM conslutation_message_table WHERE references_num = '$refer_num'";
                $result = $con->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $status_message = $row['status_message'];

                    // Display dropdown menu for status selection
                    echo "<select id='status_select' class='StatusChange' name='status' disabled>";
                    $options = array("Submitted", "On-Going", "Processing", "Completed");
                    foreach ($options as $option) {
                        $selected = ($status_message == $option) ? "selected" : "";
                        echo "<option value='$option' $selected>$option</option>";
                    }
                    echo "</select>";
                }
            ?>
            <button class="back-btn" onclick="BackFun()">Back</button>
            <style>
                .StatusChange{
                    font-size: 15pt;
                }
            </style>
        </div>
    </div>
    <script>
        function BackFun() {
            window.location.href = "searchpreviewconsultation.php";
        }
    </script>
</body>
</html>
