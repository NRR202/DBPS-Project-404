<?php
    session_start();
    require_once('php/config.php');
    if (isset($_SESSION['parent_info'])) {
        // Retrieve the teacher student_info from the session variable
        $parent_info = $_SESSION['parent_info'];
    
        // Display the name if available
        if (isset($parent_info['student_name'])) {
            $studentname = $parent_info['student_name'];
        }
    } 
    // Check if the search button is clicked
    if (isset($_GET['search'])) {
        // Fetch search parameters if submitted
        $searchTeacher = isset($_GET['teachername']) ? $_GET['teachername'] : '';

        // Construct the SQL query based on search parameters
        $query = "SELECT *
                  FROM evaluationformtable
                  WHERE 1=1 AND Student_Name = '$studentname'"; // Start with a basic query

        // Append conditions based on search parameters
        if (!empty($searchTeacher)) {
            $query .= " AND teacher_name = '$searchTeacher'";
        }
        // Execute the query
        $result_evaluated_tb = mysqli_query($con, $query);

        // Check for errors
        if (!$result_evaluated_tb) {
            die("Query failed: " . mysqli_error($con));
        }
    } else {
        // If search button is not clicked, fetch all students
        $query = "SELECT * FROM evaluationformtable WHERE Student_Name = '$studentname'";
        $result_evaluated_tb = mysqli_query($con, $query);

        // Check for errors
        if (!$result_evaluated_tb) {
            die("Query failed: " . mysqli_error($con));
        }
    }
        // Assuming $con is your database connection object
        $sql = "SELECT CONCAT(firstname, ' ', lastname) AS teacher_name FROM teacher_info";
        $result = $con->query($sql);
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
<div class="HeaderEvaluation">
    <form id="searchForm" method="GET" action="">
        <div class="nameheader">Professor Name</div>
        <?php
        echo "<select class='CourseIteminEvaluation' name='teachername'>";
        echo "<option value=''>All Professors</option>";

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $teacher_name = $row['teacher_name'];
                $selected = (isset($_GET['teachername']) && $_GET['teachername'] == $teacher_name) ? 'selected="selected"' : '';
                echo "<option value='$teacher_name' $selected>$teacher_name</option>";
            }
        }

        echo "</select>";
        ?>

        <button type="submit" name="search" class="searchButton">Search</button>
    </form>
</div>
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
                                <td><button type="button" class="btn btn-info view-btn" onclick="ViewForm('<?php echo urlencode($row['EvaluationForm_ID']); ?>')">View</button></td>
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
    function ViewForm(evaID) {
        window.location.href = "evaluationformpreviewparent.php?evaluationID=" + encodeURIComponent(evaID);
    }
</script>
<style>
.nameheader, .searchButton{
    display: inline;
    font-weight: bold;
    font-size: 20;
}
.nameheader{
    margin-left: 10px;
}
.HeaderEvaluation{
    position: fixed;
    top: 10px;
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

