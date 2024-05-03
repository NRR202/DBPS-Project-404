<?php
    require_once('php/config.php');
    // Check if the search button is clicked
    if (isset($_GET['search'])) {
        // Fetch search parameters if submitted
        $searchCourse = isset($_GET['courses']) ? $_GET['courses'] : '';
        $searchSection = isset($_GET['sections']) ? $_GET['sections'] : '';
        $searchYearLevel = isset($_GET['yearlevel']) ? $_GET['yearlevel'] : '';

        
        // Construct the SQL query based on search parameters
        $query = "SELECT s.*, e.Status_E
                  FROM student_info s
                  LEFT JOIN evaluationstatus e ON s.username = e.userID
                  WHERE 1=1"; // Start with a basic query

        // Append conditions based on search parameters
        if (!empty($searchSection)) {
            $query .= " AND s.section = '$searchSection'";
        }
        if (!empty($searchCourse)) {
            $query .= " AND s.course = '$searchCourse'";
        }
        if (!empty($searchYearLevel)) {
            $query .= " AND s.year_level = '$searchYearLevel'";
        }

        // Execute the query
        $result_student = mysqli_query($con, $query);

        // Check for errors
        if (!$result_student) {
            die("Query failed: " . mysqli_error($con));
        }
    } else {
        // If search button is not clicked, fetch all students
        $query = "SELECT s.*, e.Status_E
                  FROM student_info s
                  LEFT JOIN evaluationstatus e ON s.username = e.userID";
        $result_student = mysqli_query($con, $query);

        // Check for errors
        if (!$result_student) {
            die("Query failed: " . mysqli_error($con));
        }
    }
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
<div class="SelectionTable">
    <form id="searchForm" method="GET" action="">
        <div class="courses">Course Student:</div>
        <select class="CourseItem" id="courses" name="courses">
            <option value="">All Courses</option>
            <option value="BSIT" <?php if(isset($_GET['courses']) && $_GET['courses'] == 'BSIT') echo 'selected="selected"'; ?>>BSIT</option>
            <option value="BSCPE" <?php if(isset($_GET['courses']) && $_GET['courses'] == 'BSCPE') echo 'selected="selected"'; ?>>BSCPE</option>
            <option value="BSCS" <?php if(isset($_GET['courses']) && $_GET['courses'] == 'BSCS') echo 'selected="selected"'; ?>>BSCS</option>
        </select>
        <div class="section">Section:</div>
        <select class="SectionItem" id="sections" name="sections">
            <option value="">All Section</option>
            <option value="A" <?php if(isset($_GET['sections']) && $_GET['sections'] == 'A') echo 'selected="selected"'; ?>>A</option>
            <option value="B" <?php if(isset($_GET['sections']) && $_GET['sections'] == 'B') echo 'selected="selected"'; ?>>B</option>
            <option value="C" <?php if(isset($_GET['sections']) && $_GET['sections'] == 'C') echo 'selected="selected"'; ?>>C</option>
            <option value="D" <?php if(isset($_GET['sections']) && $_GET['sections'] == 'D') echo 'selected="selected"'; ?>>D</option>
        </select>
        <div class="yearlevel">Year Level:</div>
        <select class="YearLevelItem" id="yearlevel" name="yearlevel">
            <option value="">All Year Level</option>
            <option value="1st year" <?php if(isset($_GET['yearlevel']) && $_GET['yearlevel'] == '1st year') echo 'selected="selected"'; ?>>1st Year</option>
            <option value="2nd year" <?php if(isset($_GET['yearlevel']) && $_GET['yearlevel'] == '2nd year') echo 'selected="selected"'; ?>>2nd Year</option>
            <option value="3rd year" <?php if(isset($_GET['yearlevel']) && $_GET['yearlevel'] == '3rd year') echo 'selected="selected"'; ?>>3rd Year</option>
            <option value="4th year" <?php if(isset($_GET['yearlevel']) && $_GET['yearlevel'] == '4th year') echo 'selected="selected"'; ?>>4th Year</option>
        </select>
        <button type="submit" name="search" class="searchCourseButton">Search</button>
    </form>
</div>
<div class="CourseTecherTable" id="CTT">
    <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Course</th>
                    <th>Year Level</th>
                    <th>Section</th>
                    <th>Gender</th>
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
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['firstname'] . ' ' . $row['lastname']; ?></td>
                                <td><?php echo $row['course']; ?></td>
                                <td><?php echo $row['year_level']; ?></td>
                                <td><?php echo $row['section']; ?></td>
                                <td><?php echo $row['gender']; ?></td>
                            </tr>
                            <?php
                        }
                    } else {
                        // If no rows are returned, display a message
                        ?>
                        <tr>
                            <td colspan="5">No students found.</td>
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
    top: 30px;
    right: 30px;
    bottom: 30px;
    left: 260px;
    border-style: solid;
    border-color: gray;
    
}
.SelectionTable{
    position: absolute;
    left: 15px;
    top: 15px;
    font-size: 25px;
    margin-top: 0px;
    font-weight: bold;
}
.section{
    margin-top: 20px;
}
.yearlevel{
    margin-top: 20px;
}
.YearLevelItem{
    display: block;
}
.searchCourseButton{
    position: absolute;
    left: 10px;
    top: 310px;
    width: 200px;
}
.colorset{
    background-color: #d9d4d4;
}
</style>
</body>
</html>

