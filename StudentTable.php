<?php
    require_once('php/config.php');
    // Check if the search button is clicked
    if (isset($_GET['search'])) {
        // Fetch search parameters if submitted
        $searchCourse = isset($_GET['courses']) ? $_GET['courses'] : '';
        $searchSection = isset($_GET['sections']) ? $_GET['sections'] : '';
        $searchYearLevel = isset($_GET['yearlevel']) ? $_GET['yearlevel'] : '';
        $searchName = isset($_GET['namestudent']) ? $_GET['namestudent'] : '';
        
        // Construct the SQL query based on search parameters
        $query = "SELECT *
                  FROM student_info
                  WHERE 1=1"; // Start with a basic query

        // Append conditions based on search parameters
        if (!empty($searchSection)) {
            $query .= " AND section = '$searchSection'";
        }
        if (!empty($searchCourse)) {
            $query .= " AND course = '$searchCourse'";
        }
        if (!empty($searchYearLevel)) {
            $query .= " AND year_level = '$searchYearLevel'";
        }
        if (!empty($searchName)) {
            $query .= " AND (firstname LIKE '%$searchName%' OR lastname LIKE '%$searchName%')";
        }
        // Execute the query
        $result_student = mysqli_query($con, $query);

        // Check for errors
        if (!$result_student) {
            die("Query failed: " . mysqli_error($con));
        }
    } else {
        // If search button is not clicked, fetch all students
        $query = "SELECT * FROM student_info";
        $result_student = mysqli_query($con, $query);

        // Check for errors
        if (!$result_student) {
            die("Query failed: " . mysqli_error($con));
        }
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
<div class="SearchArea">
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
        <div class="namesearch">Name:</div>
        <input type="text" name="namestudent" value="<?php if(isset($_GET['namestudent'])){echo $_GET['namestudent'];}?>" maxlength="50" class="namestu" autocomplete="off">
        <button type="submit" name="search" class="searchCourseButton">Search</button>
    </form>
</div>
<div class="StudentInfoTable" id="SIF">
    <div class="row tbl-fixed">
        <table class="table-striped table-condensed">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Course</th>
                    <th>Year Level</th>
                    <th>Section</th>
                    <th>Gender</th>
                    <th>Action</th>
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
                                <td><button type="button" class="btn btn-danger delete-btn" onclick="confirmDelete('<?php echo urlencode($row['username']); ?>')">Delete</button></td>
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
</div>
<style>
.courses{
    margin-left: 10px;
}
.courses, .section, .yearlevel, .namesearch{
    display: inline-block;
    font-weight: bold;
    background-color: transparent;
}
.StudentInfoTable{
    position: absolute;
    top: 50px;
    right: 0px;
    bottom: 0px;
    left: 0px;
    font-size: 12pt;
    overflow: hidden;
}
.namestu{
    width: 360px;
}
body{
    background-color: #d9d4d4;
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

.StudentInfoTable table tbody tr:nth-child(odd) {
    background-color: lightgray; /* Set background color for odd rows */
}

.StudentInfoTable table tbody tr:nth-child(even) {
    background-color: white; /* Set background color for even rows */
}
.SearchArea{
    position: absolute;
    left: 0px;
    right: 0px;
    top: 0px;
    height: 40;
}
</style>
<script>
    function confirmDelete(username) {
        if (confirm("Are you sure you want to delete user '" + username + "'?")) {
            window.location.href = "deletestudentuser.php?user=" + encodeURIComponent(username);
        } else {
            // Stay on the page
        }
    }
</script>
</body>
</html>