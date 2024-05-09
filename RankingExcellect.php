<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script defer src="js/bootstrap.bundle.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="colorset">
    <div class="StudentRankInfoTable" id="SIF">
        <div class="row tbl-fixed">
            <table class="table-striped table-condensed">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Year Level</th>
                        <th>Section</th>
                        <th>Course</th>
                        <th>Performance</th>
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
                                    (CASE WHEN question1 = 'excellent' THEN 1 ELSE 0 END +
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
                                ORDER BY 
                                    excellent_count DESC;";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["Student_ID"] . "</td>";
                                echo "<td>" . $row["Student_Name"] . "</td>";
                                echo "<td>" . $row["year_level"] . "</td>";
                                echo "<td>" . $row["section"] . "</td>";
                                echo "<td>" . $row["course"] . "</td>";
                                // Calculate performance based on Excellent ratings
                                echo "<td>" . $row["excellent_count"]/20*100  . "%" . "</td>";
                                echo "</tr>";
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
        .StudentRankInfoTable {
            position: absolute;
            top: 50px;
            right: 0px;
            bottom: 0px;
            left: 0px;
            font-size: 12pt;
            overflow: hidden;
        }

        body {
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
    </style>
</body>
</html>