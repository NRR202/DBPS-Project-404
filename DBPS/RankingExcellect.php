<?php
    // Establish connection to MySQL database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "dbps_database";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if (isset($_GET['search'])) {
        // Fetch search parameters if submitted
        $searchCourse = isset($_GET['courses']) ? $_GET['courses'] : '';
        $searchSection = isset($_GET['sections']) ? $_GET['sections'] : '';
        $searchYearLevel = isset($_GET['yearlevel']) ? $_GET['yearlevel'] : '';

        
        // Construct the SQL query based on search parameters
        $query = "SELECT 
                        *,
                        SUM(CASE WHEN question1 = 'excellent' THEN 1 ELSE 0 END +
                        CASE WHEN question2 = 'excellent' THEN 1 ELSE 0 END +
                        CASE WHEN question3 = 'excellent' THEN 1 ELSE 0 END +
                        CASE WHEN question4 = 'excellent' THEN 1 ELSE 0 END +
                        CASE WHEN question5 = 'excellent' THEN 1 ELSE 0 END +
                        CASE WHEN question6 = 'excellent' THEN 1 ELSE 0 END +
                        CASE WHEN question7 = 'excellent' THEN 1 ELSE 0 END +
                        CASE WHEN question8 = 'excellent' THEN 1 ELSE 0 END +
                        CASE WHEN question9 = 'excellent' THEN 1 ELSE 0 END +
                        CASE WHEN question10 = 'excellent' THEN 1 ELSE 0 END +
                        CASE WHEN question11 = 'excellent' THEN 1 ELSE 0 END +
                        CASE WHEN question12 = 'excellent' THEN 1 ELSE 0 END +
                        CASE WHEN question13 = 'excellent' THEN 1 ELSE 0 END +
                        CASE WHEN question14 = 'excellent' THEN 1 ELSE 0 END +
                        CASE WHEN question15 = 'excellent' THEN 1 ELSE 0 END +
                        CASE WHEN question16 = 'excellent' THEN 1 ELSE 0 END +
                        CASE WHEN question17 = 'excellent' THEN 1 ELSE 0 END +
                        CASE WHEN question18 = 'excellent' THEN 1 ELSE 0 END +
                        CASE WHEN question19 = 'excellent' THEN 1 ELSE 0 END +
                        CASE WHEN question20 = 'excellent' THEN 1 ELSE 0 END) AS excellent_count
                    FROM 
                        evaluationformtable 
                    WHERE 1=1 ";
        // Append conditions based on search parameters
        if (!empty($searchSection)) {
            $query .= "AND section = '$searchSection' ";
        }
        if (!empty($searchCourse)) {
            $query .= "AND course = '$searchCourse' ";
        }
        if (!empty($searchYearLevel)) {
            $query .= "AND year_level = '$searchYearLevel' ";
        }

        $query .= " GROUP BY Student_ID 
                    ORDER BY excellent_count DESC 
                    LIMIT 3;";

        // Execute the query
        $resultrank = mysqli_query($conn, $query);
        if (!$resultrank) {
            die("Query failed: " . mysqli_error($conn));
        }
    } else {
        // If search button is not clicked, fetch all students
        $query = "SELECT 
                        *,
                        SUM(CASE WHEN question1 = 'excellent' THEN 1 ELSE 0 END +
                        CASE WHEN question2 = 'excellent' THEN 1 ELSE 0 END +
                        CASE WHEN question3 = 'excellent' THEN 1 ELSE 0 END +
                        CASE WHEN question4 = 'excellent' THEN 1 ELSE 0 END +
                        CASE WHEN question5 = 'excellent' THEN 1 ELSE 0 END +
                        CASE WHEN question6 = 'excellent' THEN 1 ELSE 0 END +
                        CASE WHEN question7 = 'excellent' THEN 1 ELSE 0 END +
                        CASE WHEN question8 = 'excellent' THEN 1 ELSE 0 END +
                        CASE WHEN question9 = 'excellent' THEN 1 ELSE 0 END +
                        CASE WHEN question10 = 'excellent' THEN 1 ELSE 0 END +
                        CASE WHEN question11 = 'excellent' THEN 1 ELSE 0 END +
                        CASE WHEN question12 = 'excellent' THEN 1 ELSE 0 END +
                        CASE WHEN question13 = 'excellent' THEN 1 ELSE 0 END +
                        CASE WHEN question14 = 'excellent' THEN 1 ELSE 0 END +
                        CASE WHEN question15 = 'excellent' THEN 1 ELSE 0 END +
                        CASE WHEN question16 = 'excellent' THEN 1 ELSE 0 END +
                        CASE WHEN question17 = 'excellent' THEN 1 ELSE 0 END +
                        CASE WHEN question18 = 'excellent' THEN 1 ELSE 0 END +
                        CASE WHEN question19 = 'excellent' THEN 1 ELSE 0 END +
                        CASE WHEN question20 = 'excellent' THEN 1 ELSE 0 END) AS excellent_count
                    FROM 
                        evaluationformtable
                    GROUP BY 
                        Student_ID 
                    ORDER BY 
                        excellent_count DESC
                    LIMIT 3;";
        $resultrank = mysqli_query($conn, $query);

        // Check for errors
        if (!$resultrank) {
            die("Query failed: " . mysqli_error($conn));
        }
    }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script defer src="js/bootstrap.bundle.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="5">
</head>
<body>
    <div class="labelone">
        <div class="L1">Top 3 Highest Performance Points</div>
    </div>
    <div class="labeltwo">
        <div class="L2">List of Performance Points</div>
    </div>
    <div class="labelthree">
        <div class="L3">List of Rank</div>
    </div>
    <div class="top3rank">
        <div class="Top_3_Rank" id="T3R">
            <div class="row tbl-fixed1">
                <table class="table-striped table-condensed">
                    <thead>
                        <tr>
                            <th>Places</th>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th>Year Level</th>
                            <th>Section</th>
                            <th>Course</th>
                            <th>Performance Points</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if ($resultrank->num_rows > 0) {
                                // Output data of each row
                                $count = 1;
                                while ($row = $resultrank->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $count . "</td>"; //
                                    echo "<td>" . $row["Student_ID"] . "</td>";
                                    echo "<td>" . $row["Student_Name"] . "</td>";
                                    echo "<td>" . $row["year_level"] . "</td>";
                                    echo "<td>" . $row["section"] . "</td>";
                                    echo "<td>" . $row["course"] . "</td>";
                                    // Calculate performance based on Excellent ratings
                                    echo "<td>" . $row["excellent_count"] . "</td>";
                                    echo "</tr>";
                                    $count++;
                                }
                            } else {
                                echo "<tr><td colspan='7'>No records found.</td></tr>";
                            }

                            $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="SearchSelector" id="SS" style="border-radius: 10px;">
        <div class="Dropdown_Search">
            <form method="GET" action="">
                <div class="pickcourse">
                <div class="courses">Course Student:</div>
                <select class="CourseItem" id="courses" name="courses">
                    <option value="BSIT" <?php if(isset($_GET['courses']) && $_GET['courses'] == 'BSIT') echo 'selected="selected"'; ?>>BSIT</option>
                    <option value="BSCPE" <?php if(isset($_GET['courses']) && $_GET['courses'] == 'BSCPE') echo 'selected="selected"'; ?>>BSCPE</option>
                    <option value="BSCS" <?php if(isset($_GET['courses']) && $_GET['courses'] == 'BSCS') echo 'selected="selected"'; ?>>BSCS</option>
                </select>
                </div>
                <div class="picksection">
                <div class="section">Section:</div>
                <select class="SectionItem" id="sections" name="sections">
                    <option value="">All Section</option>
                    <option value="A" <?php if(isset($_GET['sections']) && $_GET['sections'] == 'A') echo 'selected="selected"'; ?>>A</option>
                    <option value="B" <?php if(isset($_GET['sections']) && $_GET['sections'] == 'B') echo 'selected="selected"'; ?>>B</option>
                    <option value="C" <?php if(isset($_GET['sections']) && $_GET['sections'] == 'C') echo 'selected="selected"'; ?>>C</option>
                    <option value="D" <?php if(isset($_GET['sections']) && $_GET['sections'] == 'D') echo 'selected="selected"'; ?>>D</option>
                </select>
                </div>
                <div class="pickyearlevel">
                <div class="yearlevel">Year Level:</div>
                <select class="YearLevelItem" id="yearlevel" name="yearlevel">
                    <option value="">All Year Level</option>
                    <option value="1st year" <?php if(isset($_GET['yearlevel']) && $_GET['yearlevel'] == '1st year') echo 'selected="selected"'; ?>>1st Year</option>
                    <option value="2nd year" <?php if(isset($_GET['yearlevel']) && $_GET['yearlevel'] == '2nd year') echo 'selected="selected"'; ?>>2nd Year</option>
                    <option value="3rd year" <?php if(isset($_GET['yearlevel']) && $_GET['yearlevel'] == '3rd year') echo 'selected="selected"'; ?>>3rd Year</option>
                    <option value="4th year" <?php if(isset($_GET['yearlevel']) && $_GET['yearlevel'] == '4th year') echo 'selected="selected"'; ?>>4th Year</option>
                </select>
                </div>
                <button type="submit" name="search" class="searchButton" style="border-radius: 10px;">Submit</button>
            </form>
        </div>
    </div>
    <div class="StudentRankInfoTable" id="SIF">
        <div class="row tbl-fixed">
            <table class="table-striped table-condensed">
                <thead>
                    <tr>
                        <th>Places</th>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Year Level</th>
                        <th>Section</th>
                        <th>Course</th>
                        <th>Performance Points</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // Establish connection to MySQL database
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $database = "dbps_database";

                        $conn = new mysqli($servername, $username, $password, $database);

                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        // SQL query to retrieve data
                        $sql = "SELECT 
                                    *,
                                    SUM(CASE WHEN question1 = 'excellent' THEN 1 ELSE 0 END +
                                    CASE WHEN question2 = 'excellent' THEN 1 ELSE 0 END +
                                    CASE WHEN question3 = 'excellent' THEN 1 ELSE 0 END +
                                    CASE WHEN question4 = 'excellent' THEN 1 ELSE 0 END +
                                    CASE WHEN question5 = 'excellent' THEN 1 ELSE 0 END +
                                    CASE WHEN question6 = 'excellent' THEN 1 ELSE 0 END +
                                    CASE WHEN question7 = 'excellent' THEN 1 ELSE 0 END +
                                    CASE WHEN question8 = 'excellent' THEN 1 ELSE 0 END +
                                    CASE WHEN question9 = 'excellent' THEN 1 ELSE 0 END +
                                    CASE WHEN question10 = 'excellent' THEN 1 ELSE 0 END +
                                    CASE WHEN question11 = 'excellent' THEN 1 ELSE 0 END +
                                    CASE WHEN question12 = 'excellent' THEN 1 ELSE 0 END +
                                    CASE WHEN question13 = 'excellent' THEN 1 ELSE 0 END +
                                    CASE WHEN question14 = 'excellent' THEN 1 ELSE 0 END +
                                    CASE WHEN question15 = 'excellent' THEN 1 ELSE 0 END +
                                    CASE WHEN question16 = 'excellent' THEN 1 ELSE 0 END +
                                    CASE WHEN question17 = 'excellent' THEN 1 ELSE 0 END +
                                    CASE WHEN question18 = 'excellent' THEN 1 ELSE 0 END +
                                    CASE WHEN question19 = 'excellent' THEN 1 ELSE 0 END +
                                    CASE WHEN question20 = 'excellent' THEN 1 ELSE 0 END) AS excellent_count
                                FROM 
                                    evaluationformtable
                                GROUP BY 
                                    Student_ID  
                                ORDER BY 
                                    excellent_count DESC;";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Output data of each row
                            $count = 1;
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $count . "</td>";
                                echo "<td>" . $row["Student_ID"] . "</td>";
                                echo "<td>" . $row["Student_Name"] . "</td>";
                                echo "<td>" . $row["year_level"] . "</td>";
                                echo "<td>" . $row["section"] . "</td>";
                                echo "<td>" . $row["course"] . "</td>";
                                // Calculate performance based on Excellent ratings
                                echo "<td>" . $row["excellent_count"] . "</td>";
                                echo "</tr>";
                                $count++;
                            }
                        } else {
                            echo "0 results";
                        }

                        $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <style>
        .labelone{
            position: absolute;
            left: 20px;
            margin-top: 100px;
            font-size: 36pt;
            font-family: "Dutch801 XBd BT", Arial, sans-serif;
        }
        .L1{
            -webkit-text-stroke: 1px gray;
            color: white;
        }
        .labeltwo{
            position: absolute;
            left: 20px;
            margin-top: 300px;
            font-size: 36pt;
            font-family: "Dutch801 XBd BT", Arial, sans-serif;
        }
        .L2{
            -webkit-text-stroke: 1px gray;
            color: white;
        }
        .labelthree{
            position: absolute;
            left: 0px;
            right: 0px;
            font-size: 45pt;
            font-family: "Dutch801 XBd BT", Arial, sans-serif;
            text-align: center;
            background: #ebebeb;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);
        }
        .L3{
            -webkit-text-stroke: 1px black;
            color: blue;
        }
        .StudentRankInfoTable {
            position: absolute;
            top: 375px;
            right: 10px;
            bottom: 10px;
            left: 10px;
            font-size: 12pt;
            border-style: solid;
            border-color: blue;
            overflow: hidden;
            background-color: lightgray;
        }
        .Top_3_Rank{
            position: absolute;
            top: 175px;
            right: 400px;
            left: 10px;
            bottom: 150px;
            border-style: solid;
            border-color: blue;
            background-color: lightgray;
            overflow: hidden;
        }
        .courses,
        .section,
        .yearlevel{
            display: inline-block;
            font-weight: bold;
        }
        .picksection, .pickyearlevel{
            margin-top: 10px;
        }
        .SearchSelector{
            position: absolute;
            width: 350px;
            border-style: solid;
            border-color: blue;
            top: 130px;
            right:10px;
            height: 210px;
            font-size: 14pt;
            background-color: lightgray;
        }
        .Dropdown_Search{
            position: absolute;
            top: 10px;
            right: 10px;
            bottom: 10px;
            left: 10px;
            font-size: 16pt;
        }
        .searchButton{
            position: relative;
            margin-left: 60px;
            margin-top: 20px;
            width: 200px
           
        }
        body{
            background: #d9d4d4;
        }
        .top3rank{
            position: absolute;
            top: 0px;
            right: 0px;
            left: 0px;
            height: 450px;
            font-size: 12pt;
            overflow: hidden;
            z-index: -2;
        }
        

        .tbl-fixed1 {
            overflow-y: scroll;
            height: fit-content;
            max-height: 17vh;
        }

        .tbl-fixed {
            overflow-y: scroll;
            height: fit-content;
            max-height: 80vh;
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

        .StudentRankInfoTable table tbody tr:nth-child(odd) {
            background-color: lightgray; /* Set background color for odd rows */
        }

        .StudentRankInfoTable table tbody tr:nth-child(even) {
            background-color: white; /* Set background color for even rows */
        }
        .Top_3_Rank table tbody tr:nth-child(odd) {
            background-color: lightgray; /* Set background color for odd rows */
        }

        .Top_3_Rank table tbody tr:nth-child(even) {
            background-color: white; /* Set background color for even rows */
        }
    </style>
</body>
</html>