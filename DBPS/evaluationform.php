<?php
    require_once('php/config.php');

    session_start(); // Start the session

    $user_id = $_GET['user']; // Assuming you're getting the userID from the form
    $stmt_check_user = $con->prepare("SELECT * FROM evaluationstatus WHERE userID = ?");
    $stmt_check_user->bind_param("s", $user_id);
    $stmt_check_user->execute();
    $result = $stmt_check_user->get_result();
    $row = $result->fetch_assoc();
    // Check if there are any rows returned
    if ($row && $row['Status_E'] == 1) {
        // If userID exists and Status_E is greater than 0 (assuming 1 or higher means evaluation is completed), show an alert and close the window
        echo "<script>alert('You have already evaluated the form.'); window.close();</script>";
        exit(); // Make sure to exit after showing the alert
    }
    // Check if the session variable is set and contains teacher information
    if (isset($_SESSION['teacher_info'])) {
        // Retrieve the teacher information from the session variable
        $teacher_info = $_SESSION['teacher_info'];
    
        // Display the name if available
        if (isset($teacher_info['firstname']) && isset($teacher_info['lastname'])) {
            $name = $teacher_info['firstname'] . ' ' . $teacher_info['lastname'];
        }
    } 
    $firstname = $_GET['firstname'];
    $lastname = $_GET['lastname1'];
    $userID = $_GET['user'];
    $course = $_GET['course'];
    $section = $_GET['section'];
    $year_level = $_GET['year_level'];
    $teachername = $name;

    ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<meta charset="UTF-8">
<title>Evaluation</title>
<link rel="stylesheet" href="css\evaluationform.css">
<!---Boxicons CDN Link --->
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body> 
        <form action="evaluationformsubmit.php" method="POST">
            <div class="Title">Evaluation</div>

            <div class="Header">
                <!-- Display student name -->
                <div class="name">Name: <?php echo $firstname ?> <?php echo $lastname; ?></div>
                <input type="hidden" name="Student_Name" value="<?php echo $firstname ?> <?php echo $lastname; ?>">
                <input type="hidden" name="Student_IDNumber" value="<?php echo $userID; ?>">
                <!-- Display course -->
                <div class="course">Course: <?php echo $course; ?></div>
                <input type="hidden" name="Student_Course" value="<?php echo $course; ?>">
                <!-- Display section and year level -->
                <div class="section_yl">Year & Section: <?php echo $year_level . ' / ' . $section; ?></div>
                <input type="hidden" name="Student_Year" value="<?php echo $year_level; ?>">
                <input type="hidden" name="Student_section" value="<?php echo $section; ?>">
                <!-- Add evaluated by section if needed -->
                <div class="evaluatedby">Evaluated By: <?php echo $teachername; ?></div>
                <input type="hidden" name="Teacher_Evaluated_Name" value="<?php echo $teachername; ?>">
            </div>
            
            <div class="evaluation-box" id="rd">
                <div class="question1">
                    <p>1. How would you rate the student's level of participation in class discussions?</p>
                    <input type="radio" name="question1" value="Observed">
                    <label>Observed</label><br>
                    <input type="radio" name="question1" value="Good">
                    <label>Good</label><br>
                    <input type="radio" name="question1" value="Very Good">
                    <label>Very Good</label><br>
                    <input type="radio" name="question1" value="Excellent">
                    <label>Excellent</label><br>
                </div>
                
                <div class="question2">
                    <p>2. How well does the student demonstrate understanding of the material during in-class activities?</p>
                    <input type="radio" name="question2" value="Observed">
                    <label >Observed</label><br>
                    <input type="radio" name="question2" value="Good">
                    <label>Good</label><br>
                    <input type="radio" name="question2" value="Very Good">
                    <label>Very Good</label><br>
                    <input type="radio" name="question2" value="Excellent">
                    <label>Excellent</label><br>
                </div>
                
                <div class="question3">
                    <p>3. To what extent does the student engage with and support their classmates during group work?</p>
                    <input type="radio" name="question3" value="Observed">
                    <label >Observed</label><br>
                    <input type="radio" name="question3" value="Good">
                    <label>Good</label><br>
                    <input type="radio" name="question3" value="Very Good">
                    <label>Very Good</label><br>
                    <input type="radio" name="question3" value="Excellent">
                    <label>Excellent</label><br>
                </div>

                <div class="question4">
                    <p>4. How consistently does the student complete and submit assignments on time?</p>
                    <input type="radio" name="question4" value="Observed">
                    <label>Observed</label><br>
                    <input type="radio" name="question4" value="Good">
                    <label>Good</label><br>
                    <input type="radio" name="question4" value="Very Good">
                    <label>Very Good</label><br>
                    <input type="radio" name="question4" value="Excellent">
                    <label>Excellent</label><br>
                </div>

                <div class="question5">
                    <p>5.How effectively does the student apply feedback provided on their work?</p>
                    <input type="radio" name="question5" value="Observed">
                    <label >Observed</label><br>
                    <input type="radio" name="question5" value="Good">
                    <label>Good</label><br>
                    <input type="radio" name="question5" value="Very Good">
                    <label>Very Good</label><br>
                    <input type="radio" name="question5" value="Excellent">
                    <label>Excellent</label><br>
                </div>

                <div class="question6">
                    <p>6. How well does the student demonstrate critical thinking skills in their responses to questions?</p>
                    <input type="radio" name="question6" value="Observed">
                    <label >Observed</label><br>
                    <input type="radio" name="question6" value="Good">
                    <label>Good</label><br>
                    <input type="radio" name="question6" value="Very Good">
                    <label>Very Good</label><br>
                    <input type="radio" name="question6" value="Excellent">
                    <label>Excellent</label><br>
                </div>

                <div class="question7">
                    <p>7. How thoroughly does the student prepare for assessments (tests, quizzes, etc.)?</p>
                    <input type="radio" name="question7" value="Observed">
                    <label >Observed</label><br>
                    <input type="radio" name="question7" value="Good">
                    <label>Good</label><br>
                    <input type="radio" name="question7" value="Very Good">
                    <label>Very Good</label><br>
                    <input type="radio" name="question7" value="Excellent">
                    <label>Excellent</label><br>
                </div>

                <div class="question8">
                    <p>8. How well does the student demonstrate mastery of the subject matter through their perdivance on assessments?</p>
                    <input type="radio" name="question8" value="Observed">
                    <label >Observed</label><br>
                    <input type="radio" name="question8" value="Good">
                    <label>Good</label><br>
                    <input type="radio" name="question8" value="Very Good">
                    <label>Very Good</label><br>
                    <input type="radio" name="question8" value="Excellent">
                    <label>Excellent</label><br>
                </div>

                <div class="question9">
                    <p>9. How effectively does the student communicate their ideas and understanding both verbally and in writing?</p>
                    <input type="radio" name="question9" value="Observed">
                    <label >Observed</label><br>
                    <input type="radio" name="question9" value="Good">
                    <label>Good</label><br>
                    <input type="radio" name="question9" value="Very Good">
                    <label>Very Good</label><br>
                    <input type="radio" name="question9" value="Excellent">
                    <label>Excellent</label><br>
                </div>

                <div class="question10">
                    <p>10. Overall, how would you rate the student's engagement, effort, and perdivance in this class?</p>
                    <input type="radio" name="question10" value="Observed">
                    <label >Observed</label><br>
                    <input type="radio" name="question10" value="Good">
                    <label>Good</label><br>
                    <input type="radio" name="question10" value="Very Good">
                    <label>Very Good</label><br>
                    <input type="radio" name="question10" value="Excellent">
                    <label>Excellent</label><br>
                </div>

                <div class="question11">
                    <p>11. How well does the student demonstrate curiosity and initiative in exploring topics beyond what is covered in class?</p>
                    <input type="radio" name="question11" value="Observed">
                    <label >Observed</label><br>
                    <input type="radio" name="question11" value="Good">
                    <label>Good</label><br>
                    <input type="radio" name="question11" value="Very Good">
                    <label>Very Good</label><br>
                    <input type="radio" name="question11" value="Excellent">
                    <label>Excellent</label><br>
                </div>

                <div class="question12">
                    <p>12.How effectively does the student collaborate with peers on group projects or assignments?</p>
                    <input type="radio" name="question12" value="Observed">
                    <label >Observed</label><br>
                    <input type="radio" name="question12" value="Good">
                    <label>Good</label><br>
                    <input type="radio" name="question12" value="Very Good">
                    <label>Very Good</label><br>
                    <input type="radio" name="question12" value="Excellent">
                    <label>Excellent</label><br>
                </div>
                <div class="question13">
                    <p>13. How consistently does the student demonstrate respect for classmates and the teacher during class discussions and activities?</p>
                    <input type="radio" name="question13" value="Observed">
                    <label >Observed</label><br>
                    <input type="radio" name="question13" value="Good">
                    <label>Good</label><br>
                    <input type="radio" name="question13" value="Very Good">
                    <label>Very Good</label><br>
                    <input type="radio" name="question13" value="Excellent">
                    <label>Excellent</label><br>
                </div>

                <div class="question14">
                    <p>14. To what extent does the student take responsibility for their own learning and seek clarification when needed?</p>
                    <input type="radio" name="question14" value="Observed">
                    <label >Observed</label><br>
                    <input type="radio" name="question14" value="Good">
                    <label>Good</label><br>
                    <input type="radio" name="question14" value="Very Good">
                    <label>Very Good</label><br>
                    <input type="radio" name="question14" value="Excellent">
                    <label>Excellent</label><br>
                </div>

                <div class="question15">
                    <p>15. How well does the student demonstrate organization and time management skills in completing tasks?</p>
                    <input type="radio" name="question15" value="Observed">
                    <label >Observed</label><br>
                    <input type="radio" name="question15" value="Good">
                    <label>Good</label><br>
                    <input type="radio" name="question15" value="Very Good">
                    <label>Very Good</label><br>
                    <input type="radio" name="question15" value="Excellent">
                    <label>Excellent</label><br>
                </div>

                <div class="question16">
                    <p>16. How effectively does the student apply previously learned concepts and skills to new and unfamiliar situations?</p>
                    <input type="radio" name="question16" value="Observed">
                    <label >Observed</label><br>
                    <input type="radio" name="question16" value="Good">
                    <label>Good</label><br>
                    <input type="radio" name="question16" value="Very Good">
                    <label>Very Good</label><br>
                    <input type="radio" name="question16" value="Excellent">
                    <label>Excellent</label><br>
                </div>

                <div class="question17">
                    <p>17. How well does the student demonstrate creativity and originality in their work?</p>
                    <input type="radio" name="question17" value="Observed">
                    <label >Observed</label><br>
                    <input type="radio" name="question17" value="Good">
                    <label>Good</label><br>
                    <input type="radio" name="question17" value="Very Good">
                    <label>Very Good</label><br>
                    <input type="radio" name="question17" value="Excellent">
                    <label>Excellent</label><br>
                </div>

                <div class="question18">
                    <p>18. How consistently does the student demonstrate attendance and punctuality?</p>
                    <input type="radio" name="question18" value="Observed">
                    <label >Observed</label><br>
                    <input type="radio" name="question18" value="Good">
                    <label>Good</label><br>
                    <input type="radio" name="question18" value="Very Good">
                    <label>Very Good</label><br>
                    <input type="radio" name="question18" value="Excellent">
                    <label>Excellent</label><br>
                </div>

                <div class="question19">
                    <p>19. How well does the student handle constructive feedback and incorporate it into their work or perdivance?</p>
                    <input type="radio" name="question19" value="Observed">
                    <label >Observed</label><br>
                    <input type="radio" name="question19" value="Good">
                    <label>Good</label><br>
                    <input type="radio" name="question19" value="Very Good">
                    <label>Very Good</label><br>
                    <input type="radio" name="question19" value="Excellent">
                    <label>Excellent</label><br>
                </div>

                <div class="question20" method="post">
                    <p>20. Overall, how would you rate the student's commitment to their own academic growth and success?</p>
                    <input type="radio" name="question20" value="Observed">
                    <label >Observed</label><br>
                    <input type="radio" name="question20" value="Good">
                    <label>Good</label><br>
                    <input type="radio" name="question20" value="Very Good">
                    <label>Very Good</label><br>
                    <input type="radio" name="question20" value="Excellent">
                    <label>Excellent</label><br>
                </div>

                
                <div class="feedback-box" >
                    <label for="feedback">Additional Feedback:</label><br>
                    <textarea id="feedback" name="feedback" placeholder="Enter your feedback here"></textarea><br>
                    <div class="contain">
                        <div class="button">
                            <button type="submit" class="feedbackbtn">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
</body>
</html>