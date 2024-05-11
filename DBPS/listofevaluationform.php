<?php
    require_once('php/config.php');
        // If search button is not clicked, fetch all students
        $query = "SELECT * FROM evaluationformtable";
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
<div class="label1">List of Evaluation Form</div>
<div id="studentTable" class="evaluationtable">
        <div class="row tbl-fixed">
            <table class="table-striped table-condensed">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Course</th>
                        <th>Professor Name</th>
                        <th>Year Level</th>
                        <th>Section</th>
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
                                <td><?php echo $row['Student_ID']; ?></td>
                                <td><?php echo $row['Student_Name']; ?></td>
                                <td><?php echo $row['course']; ?></td>
                                <td><?php echo $row['teacher_name']; ?></td>
                                <td><?php echo $row['year_level']; ?></td>
                                <td><?php echo $row['section']; ?></td>
                                <td><button type="button" class="btn btn-info view-btn" onclick="ViewForm('<?php echo urlencode($row['Student_ID']); ?>')">View</button>
                                    <button type="button" class="btn btn-danger view-btn" onclick="confirmDeletionForm('<?php echo urlencode($row['Student_ID']); ?>')">Delete</button></td>
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
<script src="js\selectoritem.js"></script>
<script>
    function ViewForm(username) {
        window.open("evaluationformpreview_admin.php?user=" + encodeURIComponent(username), "_blank");
    }
    function confirmDeletionForm(username) {
        if (confirm("Are you sure you want to delete Evaluation Form? Student Number: '" + username + "'")) {
            window.location.href = "deleteevaluation.php?user=" + encodeURIComponent(username);
        } else {
            // Stay on the page
        }
    }
</script>
<style>
.label1{
    position: absolute;
    top: -5px;
    left: 0px;
    right: 0px;
    text-align: center;
    font-size: 32pt;
    font-family: "Dutch801 XBd BT", Arial, sans-serif;
}
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
</style>
</body>
</html>

