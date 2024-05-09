<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $courseforstudent = $_POST['course_select_s'];
    $sectionforstudent = $_POST['section-input'];
    $yearlevelforstudent = $_POST['year-level'];
    $coursehandleforteacher = $_POST['course-handle'];
    $studenameforparent = $_POST['student_name'];
    $genderS = isset($_POST['student_gender']) ? $_POST['student_gender'] : null;
    $genderT = isset($_POST['teacher_gender']) ? $_POST['teacher_gender'] : null; // Gender for teacher (set to null if not provided)
    $genderP = isset($_POST['parent_gender']) ? $_POST['parent_gender'] : null; // Gender for parent (set to null if not provided)
    $user_type = $_POST['type-entity'];

    $conn = new mysqli('localhost', 'root', '', 'dbps_database');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($user_type === "Student" || $user_type === "Teacher" || $user_type === "Parent") {
        $stmt_account = $conn->prepare("INSERT INTO credentials_account (username, pass_word, type_entity) VALUES (?, ?, ?)");
        $stmt_account->bind_param("sss", $username, $password, $user_type);
        if (!$stmt_account->execute()) {
            die("Error inserting into credentials_account: " . $stmt_account->error);
        }
    
        switch ($user_type) {
            case "Student":
                $status_e = 0;
                $stmt_student_info = $conn->prepare("INSERT INTO student_info (firstname, lastname, username, gender, course, section, year_level) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt_student_info->bind_param("sssssss", $firstname, $lastname, $username, $genderS, $courseforstudent, $sectionforstudent, $yearlevelforstudent);
                if (!$stmt_student_info->execute()) {
                    die("Error inserting into student_info table: " . $stmt_student_info->error);
                }
                break;
            case "Teacher":
                $stmt_info = $conn->prepare("INSERT INTO teacher_info (firstname, lastname, username, gender, course_handle) VALUES (?, ?, ?, ?, ?)");
                $stmt_info->bind_param("sssss", $firstname, $lastname, $username, $genderT, $coursehandleforteacher);
                if (!$stmt_info->execute()) {
                    die("Error inserting into teacher_info table: " . $stmt_info->error);
                }
                break;
            case "Parent":
                $stmt_info = $conn->prepare("INSERT INTO parent_info (firstname, lastname, username, gender, student_name) VALUES (?, ?, ?, ?, ?)");
                $stmt_info->bind_param("sssss", $firstname, $lastname, $username, $genderP, $studenameforparent);
                if (!$stmt_info->execute()) {
                    die("Error inserting into parent_info table: " . $stmt_info->error);
                }
                break;
        }
    
        echo "Registration successful!";
        // Redirect to login page or another page
        echo '<meta http-equiv="refresh" content="1;url=DBPSLogin.html">';
        exit();
    } else {
        die("Invalid user type.");
    }

    $conn->close();
}
?>