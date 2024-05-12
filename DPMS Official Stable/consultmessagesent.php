<!DOCTYPE html>
<html lang="en">
<head>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css\consultation_style_sent.css" rel="stylesheet">
<script defer src="js\bootstrap.bundle.min.js"></script>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="View_Send-Message" id="display2">
        <div class="box-messages">
            <form id="consultationForm" method="POST" action="sentmessage.php">
                <div class="send-message-title">Send Consultation Message</div>
                <div class="from-user">From:</div>
                <?php
                    require_once('php/config.php');
                    session_start();
                    if (isset($_SESSION['parent_info'])) {
                        // Retrieve the parent information from the session variable
                        $parent_info = $_SESSION['parent_info'];
                        
                        // Check if the necessary keys exist in $parent_info
                        if (isset($parent_info['firstname']) && isset($parent_info['lastname'])) {
                            // Concatenate the first name and last name to form the full name
                            $name = $parent_info['firstname'] . ' ' . $parent_info['lastname'];
                        }
                    }  
                ?>
                <input type="text" name="fromusername" value="<?php echo $name; ?>" readonly>

                <div class="to-user">To:</div>
                <?php
                require_once('php/config.php');
                $sql = "SELECT CONCAT(firstname, ' ', lastname) AS teacher_name FROM teacher_info";
                $result = $con->query($sql);
                echo "<select name='tousername'>";
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $teacher_name = $row['teacher_name'];
                        $selected = (isset($_GET['teachername']) && $_GET['teachername'] == $teacher_name) ? 'selected="selected"' : '';
                        echo "<option value='$teacher_name' $selected>$teacher_name</option>";
                    }
                }
                echo "</select>";
                ?>
                <div class="mess-from-user">Message From:</div>
                <textarea id="message_from_user" class="from-message" name="message_from_user"></textarea>
                <div class="buttonbox">
                    <button class="sent-btn" type="submit" >Sent</button>
                </div>
            </form>
            <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the current datetime
        var currentDatetime = new Date();
        
        // Convert datetime to a 7-digit string format (YYMMDDH)
        var datetimeString = currentDatetime.getFullYear().toString().substring(2, 4) + 
                            (currentDatetime.getMonth() + 1).toString().padStart(2, '0') + 
                            currentDatetime.getDate().toString().padStart(2, '0') +
                            currentDatetime.getMilliseconds().toString().padStart(2, '0');

        // Set the reference number value to a hidden input field
        var referenceInput = document.createElement("input");
        referenceInput.type = "hidden";
        referenceInput.name = "reference_number";
        referenceInput.value = datetimeString;
        document.getElementById("consultationForm").appendChild(referenceInput);
    });
</script>
            <button class="back-btn" onclick="BackFun()">Back</button>
        </div>
    </div>
    <script>
        function BackFun() {
            if (confirm("Are you sure you want to stop create Consult Message?")) {
                window.location.href = "reachoutmessage.php";
            } else {
                // Stay on the page
            }
        }
    </script>
</body>
</html>
