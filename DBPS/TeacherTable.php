<?php
    require_once('php/config.php');
    // Check if the search button is clicked
    if (isset($_GET['search'])) {
        // Fetch search parameters if submitted
        $searchCourse = isset($_GET['courses_handle']) ? $_GET['courses_handle'] : '';
        $searchName = isset($_GET['nameteacher']) ? $_GET['nameteacher'] : '';
        
        // Construct the SQL query based on search parameters
        $query = "SELECT *
                  FROM teacher_info
                  WHERE 1=1"; // Start with a basic query

        // Append conditions based on search parameters
        if (!empty($searchCourse)) {
            $query .= " AND course_handle = '$searchCourse'";
        }
        if (!empty($searchName)) {
            $query .= " AND (firstname LIKE '%$searchName%' OR lastname LIKE '%$searchName%')";
        }
        // Execute the query
        $result_teacher = mysqli_query($con, $query);

        // Check for errors
        if (!$result_teacher) {
            die("Query failed: " . mysqli_error($con));
        }
    } else {
        // If search button is not clicked, fetch all students
        $query = "SELECT * FROM teacher_info";
        $result_teacher = mysqli_query($con, $query);

        // Check for errors
        if (!$result_teacher) {
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
        <div class="courseshandle">Course Handle:</div>
        <select class="CourseItem" id="courses" name="courses_handle">
            <option value="">All Courses</option>
            <option value="BSIT" <?php if(isset($_GET['courses_handle']) && $_GET['courses_handle'] == 'BSIT') echo 'selected="selected"'; ?>>BSIT</option>
            <option value="BSCPE" <?php if(isset($_GET['courses_handle']) && $_GET['courses_handle'] == 'BSCPE') echo 'selected="selected"'; ?>>BSCPE</option>
            <option value="BSCS" <?php if(isset($_GET['courses_handle']) && $_GET['courses_handle'] == 'BSCS') echo 'selected="selected"'; ?>>BSCS</option>
        </select>
        <div class="namesearch">Name:</div>
        <input type="text" name="nameteacher" value="<?php if(isset($_GET['nameteacher'])){echo $_GET['nameteacher'];}?>" maxlength="50" class="namet" autocomplete="off">
        <button type="submit" name="search" class="searchCourseButton">Search</button>
    </form>
</div>
<div class="TeacherInfoTable" id="SIF">
    <div class="row tbl-fixed">
        <table class="table-striped table-condensed">
            <thead>
                <tr>
                    <th>Teacher ID</th>
                    <th>Teacher Name</th>
                    <th>Course Handle</th>
                    <th>Gender</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Check if there are any rows returned
                    if ($result_teacher->num_rows > 0) {
                        // Iterate over each row and output it in the table
                        while ($row = mysqli_fetch_assoc($result_teacher)) {
                            ?>
                            <tr>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['firstname'] . ' ' . $row['lastname']; ?></td>
                                <td><?php echo $row['course_handle']; ?></td>
                                <td><?php echo $row['gender']; ?></td>
                                <td><button type="button" class="btn btn-danger delete-btn" onclick="confirmDelete('<?php echo urlencode($row['username']); ?>')">Delete</button></td>
                            </tr>
                            <?php
                        }
                    } else {
                        // If no rows are returned, display a message
                        ?>
                        <tr>
                            <td colspan="5">No Teachers found.</td>
                        </tr>
                        <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
<style>
.courseshandle{
    margin-left: 10px;
}
.courseshandle, .namesearch{
    display: inline-block;
    font-weight: bold;
    background-color: transparent;
}
.TeacherInfoTable{
    position: absolute;
    top: 50px;
    right: 0px;
    bottom: 0px;
    left: 0px;
    font-size: 12pt;
    overflow: hidden;
}
.namet{
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

.TeacherInfoTable table tbody tr:nth-child(odd) {
    background-color: lightgray; /* Set background color for odd rows */
}

.TeacherInfoTable table tbody tr:nth-child(even) {
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
            window.location.href = "deleteteacheruser.php?user=" + encodeURIComponent(username);
        } else {
            // Stay on the page
        }
    }
</script>
</body>
</html>