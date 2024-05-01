<?php
    require_once('php/config.php');

    // Check if the search button is clicked
    if (isset($_GET['search'])) {
        // Fetch search parameters if submitted
        $searchName = isset($_GET['studentname']) ? $_GET['studentname'] : '';
        $searchCourse = isset($_GET['courses']) ? $_GET['courses'] : '';

        // Construct the SQL query based on search parameters
        $query = "SELECT * FROM student_info WHERE 1=1"; // Start with a basic query

        // Append conditions based on search parameters
        if (!empty($searchName)) {
            $query .= " AND (firstname LIKE '%$searchName%' OR lastname LIKE '%$searchName%')";
        }
        if (!empty($searchCourse)) {
            $query .= " AND course = '$searchCourse'";
        }

        // Execute the query
        $result_student = mysqli_query($con, $query);
    } else {
        // If search button is not clicked, fetch all students
        $query = "SELECT * FROM student_info";
        $result_student = mysqli_query($con, $query);
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
<div class="HeaderEvaluation">
    <form id="searchForm" method="GET" action="">
        <div class="evaluation">
            <div class="nameheader">Course</div>
            <select class="CourseIteminEvaluation" id="courses" name="courses">
                <option value="">All Course</option>
                <option value="BSIT">BSIT</option>
                <option value="BSCpE">BSCpE</option>
                <option value="BSCS">BSCS</option>
            </select>
        </div>
        <div class="namesearchbar">Search</div>
        <input type="text" name="studentname" value="<?php if(isset($_GET['studentname'])){echo $_GET['studentname'];}?>" class="searchbarmk1" maxlength="50" id="searchInput">
        <button type="submit" name="search" class="searchButton">Search</button>
    </form>
</div>
<div id="studentTable" class="evaluationtable">
    <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Student ID</th>
                    <th>Course</th>
                    <th>Year Level</th>
                    <th>Section</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <?php
                    if ($result_student->num_rows > 0) {
                        while($row = mysqli_fetch_assoc($result_student)){
                ?>
                            <tr>
                                <td><?php echo $row['firstname'] . ' ' . $row['lastname']; ?></td>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['course']; ?></td>
                                <td><?php echo $row['year_level']; ?></td>
                                <td><?php echo $row['section']; ?></td>
                                <td>
                                <a class="btn btn-primary" href="">Evaluation Form</a>
                                </td>
                            </tr>
                <?php
                        }
                    } else {
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
.nameheader{
    display: inline;
    font-weight: bold;
}
.namesearchbar{
    font-size: 22px;
    font-weight: bold;
    display: inline;
}
.evaluation{
    display: inline;
    font-size: 22px;
    margin-left: 10px;
}
.searchbarmk1{
    width: 500px;
}
.HeaderEvaluation{
    position: fixed;
    top: 10px;

}
.evaluationtable{
    position: relative;
    top: 30px;
    font-size: 18px;
}
.colorset{
    background-color: #d9d4d4;
}
</style>
</body>
</html>