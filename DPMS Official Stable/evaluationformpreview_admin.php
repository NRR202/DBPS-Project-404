<?php
    require_once('php/config.php');
    session_start();
    $student_id = $_GET['user'];
    $query = "SELECT * FROM evaluationformtable WHERE Student_ID = '$student_id'";
    $result_data = mysqli_query($con, $query);
    if($result_data) {
        // Fetch data from result set
        $row = mysqli_fetch_assoc($result_data);
    }  
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<meta charset="UTF-8">
<title>Evaluation</title>
<link rel="stylesheet" href="css\evaluationformpreview.css">
<!---Boxicons CDN Link --->
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body> 
            <div class="Title">Evaluation</div>

            <div class="Header">
                <!-- Display student name -->
                <div class="name">Name: <?php echo $row['Student_Name']; ?></div>
                <!-- Display course -->
                <div class="course">Course: <?php echo $row['course']; ?></div>
                <!-- Display section and year level -->
                <div class="section_yl">Year & Section: <?php echo $row['year_level'] . ' / ' . $row['section']; ?></div>
                <!-- Add evaluated by section if needed -->
                <div class="evaluatedby">Evaluated By: <?php echo $row['teacher_name']; ?></div>
            </div>
            
            <div class="evaluation-box" id="rd">
                <div class="question1">
                    <p>1. How would you rate the student's level of participation in class discussions?</p>
                    <?php
                        require_once('php/config.php');
                        $sql = "SELECT question1 FROM evaluationformtable WHERE Student_ID = '$student_id'";
                        $result = $con->query($sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            // Loop through each column (question)
                            foreach ($row as $question => $answer) {
                                if ($question != "student_id") {
                                    // Display radio buttons for each option
                                    $options = array("Observed", "Good", "Very Good", "Excellent");
                                    foreach ($options as $option) {
                                        $checked = ($answer == $option) ? "checked" : "";
                                        echo "<input type='radio' name='$question' value='$option' $checked disabled> <label>$option</label><br>";
                                    }
                                }
                            }
                        }
                    ?>
                </div>
                
                <div class="question2">
                    <p>2. How well does the student demonstrate understanding of the material during in-class activities?</p>
                    <?php
                        require_once('php/config.php');
                        $sql = "SELECT question2 FROM evaluationformtable WHERE Student_ID = '$student_id'";
                        $result = $con->query($sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            // Loop through each column (question)
                            foreach ($row as $question => $answer) {
                                if ($question != "student_id") { // Here, it should be $question2 instead of $question1
                                    // Display radio buttons for each option
                                    $options = array("Observed", "Good", "Very Good", "Excellent");
                                    foreach ($options as $option) {
                                        $checked = ($answer == $option) ? "checked" : "";
                                        echo "<input type='radio' name='$question' value='$option' $checked disabled> <label>$option</label><br>";
                                    }
                                }
                            }
                        }
                    ?>
                </div>
                
                <div class="question3">
                    <p>3. To what extent does the student engage with and support their classmates during group work?</p>
                    <?php
                        require_once('php/config.php');
                        $sql = "SELECT question3 FROM evaluationformtable WHERE Student_ID = '$student_id'";
                        $result = $con->query($sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            // Loop through each column (question)
                            foreach ($row as $question => $answer) {
                                if ($question != "student_id") { // Here, it should be $question2 instead of $question1
                                    // Display radio buttons for each option
                                    $options = array("Observed", "Good", "Very Good", "Excellent");
                                    foreach ($options as $option) {
                                        $checked = ($answer == $option) ? "checked" : "";
                                        echo "<input type='radio' name='$question' value='$option' $checked disabled> <label>$option</label><br>";
                                    }
                                }
                            }
                        }
                    ?>
                </div>

                <div class="question4">
                    <p>4. How consistently does the student complete and submit assignments on time?</p>
                    <?php
                        require_once('php/config.php');
                        $sql = "SELECT question4 FROM evaluationformtable WHERE Student_ID = '$student_id'";
                        $result = $con->query($sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            // Loop through each column (question)
                            foreach ($row as $question => $answer) {
                                if ($question != "student_id") { // Here, it should be $question2 instead of $question1
                                    // Display radio buttons for each option
                                    $options = array("Observed", "Good", "Very Good", "Excellent");
                                    foreach ($options as $option) {
                                        $checked = ($answer == $option) ? "checked" : "";
                                        echo "<input type='radio' name='$question' value='$option' $checked disabled> <label>$option</label><br>";
                                    }
                                }
                            }
                        }
                    ?>
                </div>

                <div class="question5">
                    <p>5.How effectively does the student apply feedback provided on their work?</p>
                    <?php
                        require_once('php/config.php');
                        $sql = "SELECT question5 FROM evaluationformtable WHERE Student_ID = '$student_id'";
                        $result = $con->query($sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            // Loop through each column (question)
                            foreach ($row as $question => $answer) {
                                if ($question != "student_id") { // Here, it should be $question2 instead of $question1
                                    // Display radio buttons for each option
                                    $options = array("Observed", "Good", "Very Good", "Excellent");
                                    foreach ($options as $option) {
                                        $checked = ($answer == $option) ? "checked" : "";
                                        echo "<input type='radio' name='$question' value='$option' $checked disabled> <label>$option</label><br>";
                                    }
                                }
                            }
                        }
                    ?>
                </div>

                <div class="question6">
                    <p>6. How well does the student demonstrate critical thinking skills in their responses to questions?</p>
                    <?php
                        require_once('php/config.php');
                        $sql = "SELECT question6 FROM evaluationformtable WHERE Student_ID = '$student_id'";
                        $result = $con->query($sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            // Loop through each column (question)
                            foreach ($row as $question => $answer) {
                                if ($question != "student_id") { // Here, it should be $question2 instead of $question1
                                    // Display radio buttons for each option
                                    $options = array("Observed", "Good", "Very Good", "Excellent");
                                    foreach ($options as $option) {
                                        $checked = ($answer == $option) ? "checked" : "";
                                        echo "<input type='radio' name='$question' value='$option' $checked disabled> <label>$option</label><br>";
                                    }
                                }
                            }
                        }
                    ?>
                </div>

                <div class="question7">
                    <p>7. How thoroughly does the student prepare for assessments (tests, quizzes, etc.)?</p>
                    <?php
                        require_once('php/config.php');
                        $sql = "SELECT question7 FROM evaluationformtable WHERE Student_ID = '$student_id'";
                        $result = $con->query($sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            // Loop through each column (question)
                            foreach ($row as $question => $answer) {
                                if ($question != "student_id") { // Here, it should be $question2 instead of $question1
                                    // Display radio buttons for each option
                                    $options = array("Observed", "Good", "Very Good", "Excellent");
                                    foreach ($options as $option) {
                                        $checked = ($answer == $option) ? "checked" : "";
                                        echo "<input type='radio' name='$question' value='$option' $checked disabled> <label>$option</label><br>";
                                    }
                                }
                            }
                        }
                    ?>
                </div>

                <div class="question8">
                    <p>8. How well does the student demonstrate mastery of the subject matter through their perdivance on assessments?</p>
                    <?php
                        require_once('php/config.php');
                        $sql = "SELECT question8 FROM evaluationformtable WHERE Student_ID = '$student_id'";
                        $result = $con->query($sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            // Loop through each column (question)
                            foreach ($row as $question => $answer) {
                                if ($question != "student_id") { // Here, it should be $question2 instead of $question1
                                    // Display radio buttons for each option
                                    $options = array("Observed", "Good", "Very Good", "Excellent");
                                    foreach ($options as $option) {
                                        $checked = ($answer == $option) ? "checked" : "";
                                        echo "<input type='radio' name='$question' value='$option' $checked disabled> <label>$option</label><br>";
                                    }
                                }
                            }
                        }
                    ?>
                </div>

                <div class="question9">
                    <p>9. How effectively does the student communicate their ideas and understanding both verbally and in writing?</p>
                    <?php
                        require_once('php/config.php');
                        $sql = "SELECT question9 FROM evaluationformtable WHERE Student_ID = '$student_id'";
                        $result = $con->query($sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            // Loop through each column (question)
                            foreach ($row as $question => $answer) {
                                if ($question != "student_id") { // Here, it should be $question2 instead of $question1
                                    // Display radio buttons for each option
                                    $options = array("Observed", "Good", "Very Good", "Excellent");
                                    foreach ($options as $option) {
                                        $checked = ($answer == $option) ? "checked" : "";
                                        echo "<input type='radio' name='$question' value='$option' $checked disabled> <label>$option</label><br>";
                                    }
                                }
                            }
                        }
                    ?>
                </div>

                <div class="question10">
                    <p>10. Overall, how would you rate the student's engagement, effort, and perdivance in this class?</p>
                    <?php
                        require_once('php/config.php');
                        $sql = "SELECT question10 FROM evaluationformtable WHERE Student_ID = '$student_id'";
                        $result = $con->query($sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            // Loop through each column (question)
                            foreach ($row as $question => $answer) {
                                if ($question != "student_id") { // Here, it should be $question2 instead of $question1
                                    // Display radio buttons for each option
                                    $options = array("Observed", "Good", "Very Good", "Excellent");
                                    foreach ($options as $option) {
                                        $checked = ($answer == $option) ? "checked" : "";
                                        echo "<input type='radio' name='$question' value='$option' $checked disabled> <label>$option</label><br>";
                                    }
                                }
                            }
                        }
                    ?>
                </div>

                <div class="question11">
                    <p>11. How well does the student demonstrate curiosity and initiative in exploring topics beyond what is covered in class?</p>
                    <?php
                        require_once('php/config.php');
                        $sql = "SELECT question11 FROM evaluationformtable WHERE Student_ID = '$student_id'";
                        $result = $con->query($sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            // Loop through each column (question)
                            foreach ($row as $question => $answer) {
                                if ($question != "student_id") { // Here, it should be $question2 instead of $question1
                                    // Display radio buttons for each option
                                    $options = array("Observed", "Good", "Very Good", "Excellent");
                                    foreach ($options as $option) {
                                        $checked = ($answer == $option) ? "checked" : "";
                                        echo "<input type='radio' name='$question' value='$option' $checked disabled> <label>$option</label><br>";
                                    }
                                }
                            }
                        }
                    ?>
                </div>

                <div class="question12">
                    <p>12.How effectively does the student collaborate with peers on group projects or assignments?</p>
                    <?php
                        require_once('php/config.php');
                        $sql = "SELECT question12 FROM evaluationformtable WHERE Student_ID = '$student_id'";
                        $result = $con->query($sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            // Loop through each column (question)
                            foreach ($row as $question => $answer) {
                                if ($question != "student_id") { // Here, it should be $question2 instead of $question1
                                    // Display radio buttons for each option
                                    $options = array("Observed", "Good", "Very Good", "Excellent");
                                    foreach ($options as $option) {
                                        $checked = ($answer == $option) ? "checked" : "";
                                        echo "<input type='radio' name='$question' value='$option' $checked disabled> <label>$option</label><br>";
                                    }
                                }
                            }
                        }
                    ?>
                </div>
                <div class="question13">
                    <p>13. How consistently does the student demonstrate respect for classmates and the teacher during class discussions and activities?</p>
                    <?php
                        require_once('php/config.php');
                        $sql = "SELECT question13 FROM evaluationformtable WHERE Student_ID = '$student_id'";
                        $result = $con->query($sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            // Loop through each column (question)
                            foreach ($row as $question => $answer) {
                                if ($question != "student_id") { // Here, it should be $question2 instead of $question1
                                    // Display radio buttons for each option
                                    $options = array("Observed", "Good", "Very Good", "Excellent");
                                    foreach ($options as $option) {
                                        $checked = ($answer == $option) ? "checked" : "";
                                        echo "<input type='radio' name='$question' value='$option' $checked disabled> <label>$option</label><br>";
                                    }
                                }
                            }
                        }
                    ?>
                </div>

                <div class="question14">
                    <p>14. To what extent does the student take responsibility for their own learning and seek clarification when needed?</p>
                    <?php
                        require_once('php/config.php');
                        $sql = "SELECT question14 FROM evaluationformtable WHERE Student_ID = '$student_id'";
                        $result = $con->query($sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            // Loop through each column (question)
                            foreach ($row as $question => $answer) {
                                if ($question != "student_id") { // Here, it should be $question2 instead of $question1
                                    // Display radio buttons for each option
                                    $options = array("Observed", "Good", "Very Good", "Excellent");
                                    foreach ($options as $option) {
                                        $checked = ($answer == $option) ? "checked" : "";
                                        echo "<input type='radio' name='$question' value='$option' $checked disabled> <label>$option</label><br>";
                                    }
                                }
                            }
                        }
                    ?>
                </div>

                <div class="question15">
                    <p>15. How well does the student demonstrate organization and time management skills in completing tasks?</p>
                    <?php
                        require_once('php/config.php');
                        $sql = "SELECT question15 FROM evaluationformtable WHERE Student_ID = '$student_id'";
                        $result = $con->query($sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            // Loop through each column (question)
                            foreach ($row as $question => $answer) {
                                if ($question != "student_id") { // Here, it should be $question2 instead of $question1
                                    // Display radio buttons for each option
                                    $options = array("Observed", "Good", "Very Good", "Excellent");
                                    foreach ($options as $option) {
                                        $checked = ($answer == $option) ? "checked" : "";
                                        echo "<input type='radio' name='$question' value='$option' $checked disabled> <label>$option</label><br>";
                                    }
                                }
                            }
                        }
                    ?>
                </div>

                <div class="question16">
                    <p>16. How effectively does the student apply previously learned concepts and skills to new and unfamiliar situations?</p>
                    <?php
                        require_once('php/config.php');
                        $sql = "SELECT question16 FROM evaluationformtable WHERE Student_ID = '$student_id'";
                        $result = $con->query($sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            // Loop through each column (question)
                            foreach ($row as $question => $answer) {
                                if ($question != "student_id") { // Here, it should be $question2 instead of $question1
                                    // Display radio buttons for each option
                                    $options = array("Observed", "Good", "Very Good", "Excellent");
                                    foreach ($options as $option) {
                                        $checked = ($answer == $option) ? "checked" : "";
                                        echo "<input type='radio' name='$question' value='$option' $checked disabled> <label>$option</label><br>";
                                    }
                                }
                            }
                        }
                    ?>
                </div>

                <div class="question17">
                    <p>17. How well does the student demonstrate creativity and originality in their work?</p>
                    <?php
                        require_once('php/config.php');
                        $sql = "SELECT question17 FROM evaluationformtable WHERE Student_ID = '$student_id'";
                        $result = $con->query($sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            // Loop through each column (question)
                            foreach ($row as $question => $answer) {
                                if ($question != "student_id") { // Here, it should be $question2 instead of $question1
                                    // Display radio buttons for each option
                                    $options = array("Observed", "Good", "Very Good", "Excellent");
                                    foreach ($options as $option) {
                                        $checked = ($answer == $option) ? "checked" : "";
                                        echo "<input type='radio' name='$question' value='$option' $checked disabled> <label>$option</label><br>";
                                    }
                                }
                            }
                        }
                    ?>
                </div>

                <div class="question18">
                    <p>18. How consistently does the student demonstrate attendance and punctuality?</p>
                    <?php
                        require_once('php/config.php');
                        $sql = "SELECT question18 FROM evaluationformtable WHERE Student_ID = '$student_id'";
                        $result = $con->query($sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            // Loop through each column (question)
                            foreach ($row as $question => $answer) {
                                if ($question != "student_id") { // Here, it should be $question2 instead of $question1
                                    // Display radio buttons for each option
                                    $options = array("Observed", "Good", "Very Good", "Excellent");
                                    foreach ($options as $option) {
                                        $checked = ($answer == $option) ? "checked" : "";
                                        echo "<input type='radio' name='$question' value='$option' $checked disabled> <label>$option</label><br>";
                                    }
                                }
                            }
                        }
                    ?>
                </div>

                <div class="question19">
                    <p>19. How well does the student handle constructive feedback and incorporate it into their work or perdivance?</p>
                    <?php
                        require_once('php/config.php');
                        $sql = "SELECT question19 FROM evaluationformtable WHERE Student_ID = '$student_id'";
                        $result = $con->query($sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            // Loop through each column (question)
                            foreach ($row as $question => $answer) {
                                if ($question != "student_id") { // Here, it should be $question2 instead of $question1
                                    // Display radio buttons for each option
                                    $options = array("Observed", "Good", "Very Good", "Excellent");
                                    foreach ($options as $option) {
                                        $checked = ($answer == $option) ? "checked" : "";
                                        echo "<input type='radio' name='$question' value='$option' $checked disabled> <label>$option</label><br>";
                                    }
                                }
                            }
                        }
                    ?>
                </div>

                <div class="question20" method="post">
                    <p>20. Overall, how would you rate the student's commitment to their own academic growth and success?</p>
                    <?php
                        require_once('php/config.php');
                        $sql = "SELECT question20 FROM evaluationformtable WHERE Student_ID = '$student_id'";
                        $result = $con->query($sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            // Loop through each column (question)
                            foreach ($row as $question => $answer) {
                                if ($question != "student_id") { // Here, it should be $question2 instead of $question1
                                    // Display radio buttons for each option
                                    $options = array("Observed", "Good", "Very Good", "Excellent");
                                    foreach ($options as $option) {
                                        $checked = ($answer == $option) ? "checked" : "";
                                        echo "<input type='radio' name='$question' value='$option' $checked disabled> <label>$option</label><br>";
                                    }
                                }
                            }
                        }
                    ?>
                </div>

                
                <div class="feedback-box" >
                    <label for="feedback">Additional Feedback:</label><br>
                    <?php
                        require_once('php/config.php');
                        $query = "SELECT * FROM evaluationformtable WHERE Student_ID = '$student_id'";
                        $result_data = mysqli_query($con, $query);
                        $row = mysqli_fetch_assoc($result_data); // Fetch data from result set
                    ?>
                    <textarea id="feedback" name="feedback" placeholder="Enter your feedback here" disabled><?php echo isset($row['feedback']) ? $row['feedback'] : ''; ?></textarea><br>
                </div>
            </div>
</script>
</body>
</html>