<?php
    require_once('php/config.php');
    // If search button is not clicked, fetch all students
    $query = "SELECT * FROM conslutation_message_table";
    $result_evaluated_tb = mysqli_query($con, $query);

        // Check for errors
    if (!$result_evaluated_tb) {
         die("Query failed: " . mysqli_error($con));
    }
    mysqli_close($con);
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
<div id="studentTable" class="evaluationtable">
        <div class="row tbl-fixed">
            <table class="table-striped table-condensed">
                <thead>
                    <tr>
                        <th>Reference Number</th>
                        <th>From User Name</th>
                        <th>To User Name</th>
                        <th>From Message</th>
                        <th>To Message</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <?php
                        if ($result_evaluated_tb->num_rows > 0) {
                            while($row = mysqli_fetch_assoc($result_evaluated_tb)){
                    ?>
                                <tr>
                                <td class='referenceclick' onclick="ViewLetter(<?php echo $row['references_num']; ?>)"><?php echo $row['references_num']; ?></td>
                                <td><?php echo $row['from_user_name']; ?></td>
                                <td><?php echo $row['to_user_name']; ?></td>
                                <td><?php echo $row['message_from_user']; ?></td>
                                <td><?php echo $row['message_to_user']; ?></td>
                                <td><?php echo $row['status_message']; ?></td>
                                <td><button type="button" class="btn btn-danger view-btn" onclick="confirmDelete(<?php echo $row['references_num']; ?>)">Delete</button></td>
                                </tr>
                    <?php
                            }
                        } else {
                    ?>
                            <tr>
                                <td colspan="7">No recorded found.</td>
                            </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
</div>
<script>
    function ViewLetter(referenceNum) {
        window.location.href = "consultmessagepreview.php?refernum=" + encodeURIComponent(referenceNum);
    }
    function confirmDelete(referenceNum) {
        if (confirm("Are you sure you want to delete Consult Message? Reference Number: '" + referenceNum + "'")) {
            window.location.href = "deleteconsultmessage.php?refernum=" + encodeURIComponent(referenceNum);
        } else {
            // Stay on the page
        }
    }
</script>
<style>
.evaluationtable{
    position: absolute;
    top: 50px;
    left: 0px;
    right: 0px;
    bottom: 0px;
    font-size: 18px;
    overflow: hidden;
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

