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
$sql = "SELECT * FROM evaluationformtable";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<p>Evaluation Form ID: " . $row["EvaluationForm_ID"] . "</p>";
        echo "<p>Student ID: " . $row["Student_ID"] . "</p>";
        echo "<p>Student Name: " . $row["Student_Name"] . "</p>";
        // Repeat for other columns and questions

        // Count the occurrences of each rating for each row
        $ratings = array_count_values($row);
        
        // Display the counts, set to 0 if not present
        echo "<p>Observed: " . (isset($ratings["Observed"]) ? $ratings["Observed"] : 0) . "</p>";
        echo "<p>Good: " . (isset($ratings["Good"]) ? $ratings["Good"] : 0) . "</p>";
        echo "<p>Very Good: " . (isset($ratings["Very Good"]) ? $ratings["Very Good"] : 0) . "</p>";
        echo "<p>Excellent: " . (isset($ratings["Excellent"]) ? ($ratings["Excellent"] / 20) * 100 : 0) . "%" . "</p>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>