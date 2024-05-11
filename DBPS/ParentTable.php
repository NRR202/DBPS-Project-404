<?php
    require_once('php/config.php');
    // Check if the search button is clicked
    if (isset($_GET['search'])) {
        // Fetch search parameters if submitted
        $searchstudentname = isset($_GET['namestudent']) ? $_GET['namestudent'] : '';
        $searchName = isset($_GET['nameparent']) ? $_GET['nameparent'] : '';
        
        // Construct the SQL query based on search parameters
        $query = "SELECT *
                  FROM parent_info
                  WHERE 1=1"; // Start with a basic query

        // Append conditions based on search parameters
        if (!empty($searchstudentname)) {
            $query .= " AND student_name = '$searchstudentname'";
        }
        if (!empty($searchName)) {
            $query .= " AND (firstname LIKE '%$searchName%' OR lastname LIKE '%$searchName%')";
        }
        // Execute the query
        $result_parent = mysqli_query($con, $query);

        // Check for errors
        if (!$result_parent) {
            die("Query failed: " . mysqli_error($con));
        }
    } else {
        // If search button is not clicked, fetch all students
        $query = "SELECT * FROM parent_info";
        $result_parent = mysqli_query($con, $query);

        // Check for errors
        if (!$result_parent) {
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
        <div class="nameparentsearch">Parent Name:</div>
        <input type="text" name="nameparent" value="<?php if(isset($_GET['nameparent'])){echo $_GET['nameparent'];}?>" maxlength="50" class="namep" autocomplete="off">
        <div class="namestudentsearch">Student Name:</div>
        <input type="text" name="namestudent" value="<?php if(isset($_GET['namestudent'])){echo $_GET['namestudent'];}?>" maxlength="50" class="namestu" autocomplete="off">
        <button type="submit" name="search" class="searchCourseButton">Search</button>
    </form>
</div>
<div class="TeacherInfoTable" id="SIF">
    <div class="row tbl-fixed">
        <table class="table-striped table-condensed">
            <thead>
                <tr>
                    <th>Parent Account</th>
                    <th>Parent Name</th>
                    <th>Student Name</th>
                    <th>Gender</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Check if there are any rows returned
                    if ($result_parent->num_rows > 0) {
                        // Iterate over each row and output it in the table
                        while ($row = mysqli_fetch_assoc($result_parent)) {
                            ?>
                            <tr>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['firstname'] . ' ' . $row['lastname']; ?></td>
                                <td><?php echo $row['student_name']; ?></td>
                                <td><?php echo $row['gender']; ?></td>
                                <td><button type="button" class="btn btn-danger delete-btn" onclick="confirmDelete('<?php echo urlencode($row['username']); ?>')">Delete</button></td>
                            </tr>
                            <?php
                        }
                    } else {
                        // If no rows are returned, display a message
                        ?>
                        <tr>
                            <td colspan="5">No Parents found.</td>
                        </tr>
                        <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
<style>
.nameparentsearch{
    margin-left: 10px;
}
.nameparentsearch, .namestudentsearch{
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
.namestu, .namep {
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
        if (confirm("Are you sure you want to delete Parent User? Parent Account: '" + username + "'")) {
            window.location.href = "deleteparentuser.php?user=" + encodeURIComponent(username);
        } else {
            // Stay on the page
        }
    }
</script>
</body>
</html>