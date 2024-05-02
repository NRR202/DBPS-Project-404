<?php
    require_once('php/config.php');
    $query = "SELECT s.*, e.Status_E FROM student_info s
              LEFT JOIN evaluationstatus e ON s.username = e.userID
              WHERE e.Status_E = 0";
    $result_student = mysqli_query($con, $query);
?>
<?php
    require_once('php/config.php');
    $query = "SELECT COUNT(*) AS count_zero FROM evaluationstatus WHERE Status_E = 0";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    // Free result set
    mysqli_free_result($result);
?>

<?php
    require_once('php/config.php');
    $queryone = "SELECT COUNT(*) AS count_one FROM evaluationstatus WHERE Status_E = 1";
    $resultone = mysqli_query($con, $queryone);
    $rowone = mysqli_fetch_assoc($resultone);
    // Free result set
    mysqli_free_result($resultone);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<meta charset="UTF-8">
<link href="css/bootstrap.min.css" rel="stylesheet">
<script defer src="js\bootstrap.bundle.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="refresh" content="10">
</head>
<body class="colorset">
<div class="nameheader">Evaluation Task</div>
<div class="tablecounts">
    <div>Evaluation Pending: <?php echo $row['count_zero']; ?></div>
    <div>Evaluation Completed: <?php echo $rowone['count_one']; ?></div>
</div>
<div class="CourseTecherTable">
    <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Student ID</th>
                    <th>Course</th>
                    <th>Year Level</th>
                    <th>Section</th>
                    <th>Evaluation Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Check if there are any rows returned
                    if ($result_student->num_rows > 0) {
                        // Iterate over each row and output it in the table
                        while ($row = mysqli_fetch_assoc($result_student)) {
                            ?>
                            <tr>
                                <td><?php echo $row['firstname'] . ' ' . $row['lastname']; ?></td>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['course']; ?></td>
                                <td><?php echo $row['year_level']; ?></td>
                                <td><?php echo $row['section']; ?></td>
                                <td><?php
                                    // Display "Pending" if Status_E is 0, otherwise display "Remark"
                                    echo $row['Status_E'] == 0 ? 'Pending' : "";
                                ?></td>
                            </tr>
                            <?php
                        }
                    } else {
                        // If no rows are returned, display a message
                        ?>
                        <tr>
                            <td colspan="5">All Student been evaluated.</td>
                        </tr>
                        <?php
                    }
                ?>
            </tbody>
        </table>
</div>
<style>
.CourseTecherTable{
    position: absolute;
    top: 100px;
    right: 30px;
    bottom: 30px;
    left: 30px;
    border-style: solid;
    border-color: gray;
    font-size: 26px;
}
.colorset{
    background-color: #d9d4d4;
}
.table{
    margin-top: -30px;
}
.nameheader{
    font-size: 45pt;
    font-family: "Dutch801 XBd BT", Arial, sans-serif;
    margin-left: 30px;
}
.tablecounts{
    position: absolute;
    top: 8px;
    right: 70px;
    font-size: 20pt;
    font-family: "Dutch801 XBd BT", Arial, sans-serif;
    border-style: solid;
    border-color: gray;
}
</style>
</body>
</html>

