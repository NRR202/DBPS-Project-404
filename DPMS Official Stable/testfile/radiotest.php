<?php
// Step 1: Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbps_database";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 2: Query the database for all questions
$user_id = "2024-00001"; // Set the user ID
$sql = "SELECT question1, question2, question3, question4, question5, question6, question7, question8, question9, question10,
        question11, question12, question13, question14, question15, question16, question17, question18, question19, question20 
        FROM evaluationformtable WHERE Student_ID = '$user_id'";
$result = $conn->query($sql);

// Step 3: Fetch data and display radio buttons for each question
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Loop through each column (question)
    foreach ($row as $question => $answer) {
        // Skip user_id column
        if ($question != "user_id") {
            // Display the question label
            echo "<div class='question'>";
            echo "<p>$question</p>";

            // Display radio buttons for each option
            $options = array("Observed", "Good", "Very Good", "Excellent");
            foreach ($options as $option) {
                $checked = ($answer == $option) ? "checked" : "";
                echo "<input type='radio' name='$question' value='$option' $checked disabled> <label>$option</label><br>";
            }
            echo "</div>";
        }
    }
} else {
    // If no data found, display default radio buttons for each question
    $questions = array(
        "Question 1" => "Observed",
        "Question 2" => "Observed",
        // Add more questions here...
        "Question 20" => "Observed"
    );

    foreach ($questions as $question => $default_answer) {
        echo "<div class='question'>";
        echo "<p>$question</p>";
        foreach ($options as $option) {
            $checked = ($default_answer == $option) ? "checked" : "";
            echo "<input type='radio' name='$question' value='$option' $checked disabled> <label>$option</label><br>";
        }
        echo "</div>";
    }
}

$conn->close();
?>
