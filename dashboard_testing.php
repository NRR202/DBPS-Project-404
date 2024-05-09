<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_name'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: loginexecute.php");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbps_database";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data for the dashboard
$sql = "SELECT * FROM credentials_account WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION['user_name']);
$stmt->execute();
$result = $stmt->get_result();
$dashboard_data = $result->fetch_all(MYSQLI_ASSOC);


// Logout process
if (isset($_POST['logout'])) {
    // Destroy the session
    session_destroy();
    // Redirect to the login page after logout
    header("Location: DBPS.html");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome to the Dashboard, <?php echo $_SESSION['user_name']; ?></h1>

    <!-- Display dashboard data -->
    <ul>
        <?php foreach ($dashboard_data as $data): ?>
            <?php if ($data['type_entity'] === 'Teacher'): ?>
                <?php
                $sql_teacher = "SELECT * FROM teacher_info WHERE username = ?";
                $stmt_teacher = $conn->prepare($sql_teacher);
                $stmt_teacher->bind_param("i", $data['username']);
                $stmt_teacher->execute();
                $result_teacher = $stmt_teacher->get_result();
                $teacher_info = $result_teacher->fetch_assoc();
                ?>
                <!-- Display student-specific information -->
                <li>Student Name: <?php echo $teacher_info['firstname'] . ' ' . $teacher_info['lastname']; ?></li>
                <li>Gender: <?php echo $teacher_info['gender']; ?></li>
                <li>Course to Handle: <?php echo $teacher_info['course_handle']; ?></li>
                <!-- Add other teacher-specific fields here -->
            <?php elseif ($data['type_entity'] === 'Student'): ?>
                <?php
                $sql_student = "SELECT * FROM student_info WHERE username = ?";
                $stmt_student = $conn->prepare($sql_student);
                $stmt_student->bind_param("i", $data['username']);
                $stmt_student->execute();
                $result_student = $stmt_student->get_result();
                $student_info = $result_student->fetch_assoc();
                ?>
                <!-- Display student-specific information -->
                <li>Student Name: <?php echo $student_info['firstname'] . ' ' . $student_info['lastname']; ?></li>
                <li>Gender: <?php echo $student_info['gender']; ?></li>
                <li>Course: <?php echo $student_info['course']; ?></li>
                <li>Section: <?php echo $student_info['section']; ?></li>
                <li>Year Level: <?php echo $student_info['year_level']; ?></li>
                <!-- Add other student-specific fields here -->
            <?php elseif ($data['type_entity'] === 'Parent'): ?>
                <?php
                $sql_parent = "SELECT * FROM parent_info WHERE username = ?";
                $stmt_parent = $conn->prepare($sql_parent);
                $stmt_parent->bind_param("i", $data['username']);
                $stmt_parent->execute();
                $result_parent = $stmt_parent->get_result();
                $parent_info = $result_parent->fetch_assoc();
                ?>
                <!-- Display student-specific information -->
                <li>Student Name: <?php echo $parent_info['firstname'] . ' ' . $parent_info['lastname']; ?></li>
                <li>Gender: <?php echo $parent_info['gender']; ?></li>
                <li>Student Name: <?php echo $parent_info['student_name']; ?></li>
                <!-- Add other parent-specific fields here -->
            <?php else: ?>
                <li>Welcome Admin!.</li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>

    <!-- Logout button -->
    <form method="post" action="">
        <input type="submit" name="logout" value="Logout">
    </form>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
