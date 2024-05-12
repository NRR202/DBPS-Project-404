<?php
    require_once('php/config.php');
    session_start();

    // Initialize $name variable

    if (isset($_SESSION['parent_info'])) {
        // Retrieve the parent information from the session variable
        $parent_info = $_SESSION['parent_info'];
        
        // Check if the necessary keys exist in $parent_info
        if (isset($parent_info['firstname']) && isset($parent_info['lastname'])) {
            // Concatenate the first name and last name to form the full name
            $name = $parent_info['firstname'] . ' ' . $parent_info['lastname'];
        }
    } 

    $sortby = isset($_GET['datesort']) ? $_GET['datesort'] : '';

    $query = "SELECT * FROM conslutation_message_table WHERE from_user_name = ?";
    if (!empty($sortby)) {
        $query .= " ORDER BY datetime_sent $sortby";
    }

    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "s", $from_user_name);
    $from_user_name = $name; // Assign the value of $name to $from_user_name
    mysqli_stmt_execute($stmt);
    $result_message_send = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<meta charset="UTF-8">
<link href="css/bootstrap.min.css" rel="stylesheet">
<script defer src="js\bootstrap.bundle.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="colorset">
<div class="HeaderSort">
    <form class="formbox" id="searchForm" method="GET" action="">
        <div class="sortbox">
        <div class="sortdate">Sort By:</div>
            <select class="SortItem" id="datesort" name="datesort">
                <option value="">None</option>
                <option value="DESC" <?php if(isset($_GET['datesort']) && $_GET['datesort'] == 'Recent') echo 'selected="selected"'; ?>>Recent</option>
                <option value="ASC" <?php if(isset($_GET['datesort']) && $_GET['datesort'] == 'Relevance') echo 'selected="selected"'; ?>>Relevance</option>
            </select>
        <button type="submit" name="sortby" class="sortButton">Sort</button>
        </div>
        <!--<div class="nameheader">Professor Name</div>
        <?php
        /*echo "<select class='CourseIteminEvaluation' name='teachername'>";
        echo "<option value=''>All Professors</option>";

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $teacher_name = $row['teacher_name'];
                $selected = (isset($_GET['teachername']) && $_GET['teachername'] == $teacher_name) ? 'selected="selected"' : '';
                echo "<option value='$teacher_name' $selected>$teacher_name</option>";
            }
        }
        echo "</select>";*/
        ?>
        <button type="submit" name="search" class="searchButton">Search</button>-->
    </form>
    <button class="CreateNewMessage" onclick="Add()">Add</button>
</div>
<div id="studentTable" class="evaluationtable">
        <div class="row tbl-fixed">
            <table class="table-striped table-condensed">
                <thead>
                    <tr>
                        <th>Reference Number</th>
                        <th>From User</th>
                        <th>To User</th>
                        <th>Your Message</th>
                        <th>Teacher Message</th>
                        <th>Date Sent</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <?php
                        if ($result_message_send->num_rows > 0) {
                            while ($row = mysqli_fetch_assoc($result_message_send)) {
                                echo "<tr>";
                                echo "<td class='referenceclick' onclick='switchFunction({$row['references_num']})'>{$row['references_num']}</td>";
                                echo "<td>{$row['from_user_name']}</td>";
                                echo "<td>{$row['to_user_name']}</td>";
                                echo "<td>{$row['message_from_user']}</td>";
                                echo "<td>{$row['message_to_user']}</td>";
                                echo "<td>{$row['datetime_sent']}</td>";
                                echo "<td>{$row['status_message']}</td>";
                                echo "<td>
                                        <button type='button' class='btn btn-info'  onclick='Edit(" . $row['references_num'] . ")'>Edit</button>
                                        <button type='button' class='btn btn-danger' onclick='confirmDelete(" . $row['references_num'] . ")'>Delete</button>
                                    </td>";
                                echo "</tr>";
                                }
                        } else {
                            echo "<tr>";
                            echo "<td colspan='8'>No Consult Message found.</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
</div>
<script>
    function switchFunction(refernum) {
        window.location.href = "consultmessagepreview1.php?refernum=" + encodeURIComponent(refernum);
    }
    function confirmDelete(referenceNum) {
        if (confirm("Are you sure you want to delete your Consult Message? Reference Number: '" + referenceNum + "'")) {
            window.location.href = "deleteconsultmessage2.php?refernum=" + encodeURIComponent(referenceNum);
        } else {
            // Stay on the page
        }
    }
    function Edit(refernum) {
        window.location.href = "consultmessageedit.php?refernum=" + encodeURIComponent(refernum);
    }
    function Add() {
        window.location.href = "consultmessagesent.php";
    }
</script>
<style>
.sortdate{
    display: inline;
    margin-left: 10px;
}
.sortbox{
    margin-top: 22px;
}
.SortItem{
    width: 200px;
    margin-left: 5px;
    display: inline;
}
.sortbox, .sortdate{
    font-size: 16pt;
}
.sortButton{
    position: absolute;
    top: 20px;
    margin-left: 10px;
    font-size: 15pt;
    background-color: lightgreen;
    width: 100px;
    border-radius: 5px;
}
.CreateNewMessage{
    position: absolute;
    top: 20px;
    right: 10px;
    font-size: 15pt;
    background-color: lightblue;
    width: 100px;
    border-radius: 5px;
}
.nameheader, .searchButton{
    display: inline;
    font-weight: bold;
    font-size: 20;
}
.nameheader{
    margin-left: 10px;
}
.HeaderSort{
    position: fixed;
    top: 5px;
    right: 5px;
    left: 5px;
    height: 82px;
    background: white;
    border-radius: 5px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);
}
.evaluationtable{
    position: absolute;
    top: 90px;
    left: 5px;
    right: 5px;
    bottom: 5px;
    font-size: 18px;
    overflow: hidden;
    border-radius: 5px;
}
.tbl-fixed {
    overflow-y: scroll;
    height: fit-content;
    max-height: 120vh;
}

table {
    border-collapse: separate;
    width: 100%; /* Ensure table takes full width */
}

table th {
    position: sticky;
    top: 0px;
    background: white;
    text-align: center;
}

table td {
    text-align: center;
}

.evaluationtable table tbody tr:nth-child(odd) {
    background-color: lightgray; /* Set background color for odd rows */
}

.evaluationtable table tbody tr:nth-child(even) {
    background-color: white; /* Set background color for even rows */
}
body{
    background: #d9d4d4;
}
.referenceclick{
    cursor: pointer;
    color: blue; /* Set color to blue */
    text-decoration: underline;
}
</style>
</body>
</html>