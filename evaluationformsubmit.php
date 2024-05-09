<?php
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST['question1']) || empty($_POST['question2']) || empty($_POST['question3']) || empty($_POST['question4']) || empty($_POST['question5']) ||
            empty($_POST['question6']) || empty($_POST['question7']) || empty($_POST['question8']) || empty($_POST['question9']) || empty($_POST['question10']) ||
            empty($_POST['question11']) || empty($_POST['question12']) || empty($_POST['question13']) || empty($_POST['question14']) || empty($_POST['question15']) ||
            empty($_POST['question16']) || empty($_POST['question17']) || empty($_POST['question18']) || empty($_POST['question19']) || empty($_POST['question20']) ||
            empty($_POST['feedback'])) {
            // If any field is empty, display an error message and go back to previous page
            echo "<script>alert('Error: All fields are required.');window.history.back();</script>";
            exit(); // Stop further processing
        }
        $question1 = $_POST['question1'];
        $question2 = $_POST['question2'];
        $question3 = $_POST['question3'];
        $question4 = $_POST['question4'];
        $question5 = $_POST['question5'];
        $question6 = $_POST['question6'];
        $question7 = $_POST['question7'];
        $question8 = $_POST['question8'];
        $question9 = $_POST['question9'];
        $question10 = $_POST['question10'];
        $question11 = $_POST['question11'];
        $question12 = $_POST['question12'];
        $question13 = $_POST['question13'];
        $question14 = $_POST['question14'];
        $question15 = $_POST['question15'];
        $question16 = $_POST['question16'];
        $question17 = $_POST['question17'];
        $question18 = $_POST['question18'];
        $question19 = $_POST['question19'];
        $question20 = $_POST['question20'];
        $studentname = $_POST['Student_Name'];
        $studentidnum = $_POST['Student_IDNumber'];
        $studentcourse = $_POST['Student_Course'];
        $studentyr = $_POST['Student_Year'];
        $studentsec = $_POST['Student_section'];
        $feed_back = $_POST['feedback'];
        $teacher_evaluated_name = $_POST['Teacher_Evaluated_Name'];
        require_once('php\config.php');
        $stmt_evalaution_submit = $con->prepare("INSERT INTO evaluationformtable (question1, question2, question3, question4, question5, question6, question7, question8, question9,
        question10, question11, question12, question13, question14, question15, question16, question17, question18, question19, question20, Student_ID, Student_Name, feedback, course,
        section, year_level, teacher_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt_evalaution_submit->bind_param("sssssssssssssssssssssssssss", $question1, $question2, $question3, $question4, $question5, $question6, $question7, $question8, $question9,
        $question10, $question11, $question12, $question13, $question14, $question15, $question16, $question17, $question18, $question19, $question20, $studentidnum, $studentname, $feed_back,
        $studentcourse, $studentsec, $studentyr, $teacher_evaluated_name);
        if (!$stmt_evalaution_submit->execute()) {
            die("Error inserting into evaluationformtable table: " . $stmt_evalaution_submit->error);
        }

        $stmt_update_status = $con->prepare("UPDATE evaluationstatus SET Status_E = 1 WHERE userID = ?");
        $stmt_update_status->bind_param("s", $studentidnum);
        
        if (!$stmt_update_status->execute()) {
            die("Error updating status: " . $stmt_update_status->error);
        }

        $stmt_evalaution_submit->close();
        $stmt_update_status->close();
        $con->close();
    }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<meta charset="UTF-8">
<title>Evaluation</title>
<link rel="stylesheet" href="css\completion_evaluation.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
        <div class="box_notify">
            <h1>Evaluation Completed</h1>
            <h2>The Evaluation Form has been recorded to our system.</h2>
            <span id="closeForm">Close Form</span>
            <script>
                document.getElementById('closeForm').addEventListener('click', function() {
                    window.close();
                });
            </script>
        </div>
    <body> 
</body>
</html>