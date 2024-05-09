<!DOCTYPE html>
<html lang="en">
<head>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/consultation_style.css" rel="stylesheet">
<script defer src="js\bootstrap.bundle.min.js"></script>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="View-Table-ReachOut" id="display1">
        <div class="consulttable">
            <div class="row tbl-fixed">
                <table class="table-striped table-condensed">
                    <thead>
                        <tr>
                            <th>Reference Number</th>
                            <th>From User</th>
                            <th>To User</th>
                            <th>Message</th>
                            <th>Answer</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <?php
                            require_once('php/config.php');
                            session_start();
                            if (isset($_SESSION['teacher_info'])) {
                                // Retrieve the teacher information from the session variable
                                $teacher_info = $_SESSION['teacher_info'];
                            
                                // Display the name if available
                                if (isset($teacher_info['firstname']) && isset($teacher_info['lastname'])) {
                                    $name = $teacher_info['firstname'] . ' ' . $teacher_info['lastname'];
                                }
                            } 
                            $query = "SELECT * FROM conslutation_message_table WHERE to_user_name = ?";
                            $stmt = mysqli_prepare($con, $query);
                            mysqli_stmt_bind_param($stmt, "s", $to_user_name);
                            $to_user_name = $name; // Replace 'some_username' with the actual username
                            mysqli_stmt_execute($stmt);
                            $result_message_receive = mysqli_stmt_get_result($stmt);
                            if ($result_message_receive->num_rows > 0) {
                                while ($row = mysqli_fetch_assoc($result_message_receive)) {
                                    echo "<tr>";
                                    echo "<td class='referenceclick' onclick='switchFunction({$row['references_num']})'>{$row['references_num']}</td>";
                                    echo "<td>{$row['from_user_name']}</td>";
                                    echo "<td>{$row['to_user_name']}</td>";
                                    echo "<td>{$row['message_from_user']}</td>";
                                    echo "<td>{$row['message_to_user']}</td>";
                                    echo "<td>{$row['status_message']}</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr>";
                                echo "<td colspan='6'>No Consult Message found.</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="View_Send-Message" id="display2">
        <div class="box-messages">
            <form method="POST" action="updatemessage.php">
                <div class="send-message-title">Consult Viewing and Sending</div>
                <div class="from-user">From:</div>
                <input type="text" id="from_user" value="" disabled>
                <div class="to-user">To:</div>
                <input type="text" id="to_user" value="" disabled>
                <div class="to-user">Reference :</div>
                <input type="text" id="reference_num" value="" disabled name="refernum">
                <input type="hidden" id="hidden_reference_num" name="hidden_refernum">
                <div class="mess-from-user">Message From:</div>
                <textarea id="message_from_user" class="from-message" disabled name="message_from_user"></textarea>
                <div class="mess-to-user">Message To:</div>
                <textarea id="message_to_user" class="to-message" name="consultans"></textarea>
                <div class="status">Status:</div>
                <select id="status_select" class="StatusChange" name="status">
                    <option value="Submitted">Submitted</option>
                    <option value="On-Going">On-Going</option>
                    <option value="Processing">Processing</option>
                    <option value="Completed">Completed</option>
                </select>
                <button class="save-btn" type="submit" onclick="return confirm('Are you sure you want to save?')">Save</button>
                <style>
                    .back-btn{
                        font-size: 15pt;
                        background-color: lightcoral;
                        width: 100px;
                        border-radius: 5px;
                        margin-left: 645px;
                        margin-top: 5px;
                    }
                    .StatusChange{
                        font-size: 15pt;
                    }
                </style>
            </form>
            <button class="back-btn" onclick="back()">Back</button>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function switchFunction(reference_num){
            $.ajax({
                type: "POST",
                url: "php/retrieve_data_referenceNum.php",
                data: { reference_num: reference_num },
                success: function(response){
                    var data = JSON.parse(response);
                    $('#from_user').val(data.from_user_name);
                    $('#to_user').val(data.to_user_name);
                    $('#reference_num').val(data.references_num);
                    $('#hidden_reference_num').val(data.references_num); 
                    $('#message_from_user').val(data.message_from_user);
                    $('#message_to_user').val(data.message_to_user);
                    $('#status_select').val(data.status_message);
                    // Optionally, you can hide/display appropriate sections here
                }
            });
            var dis1 = document.getElementById('display1');
            var dis2 = document.getElementById('display2');
            dis1.style.visibility = "hidden";
            dis2.style.visibility = "visible";
        }
        function back(){
            if(confirm("Are you sure you want to go back? Any unsaved changes will be lost.")) {
                var dis1 = document.getElementById('display1');
                var dis2 = document.getElementById('display2');
                dis1.style.visibility = "visible";
                dis2.style.visibility = "hidden";
            }else{
                var dis1 = document.getElementById('display1');
                var dis2 = document.getElementById('display2');
                dis1.style.visibility = "hidden";
                dis2.style.visibility = "visible";
            }
        }
    </script>
</body>
</html>
