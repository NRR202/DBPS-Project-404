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
$dashboard_data = $result->fetch_assoc();

// Fetch teacher information if the user is a teacher
$sql_teacher = "SELECT * FROM teacher_info WHERE username = ?";
$stmt_teacher = $conn->prepare($sql_teacher);
$stmt_teacher->bind_param("s", $_SESSION['user_name']);
$stmt_teacher->execute();
$result_teacher = $stmt_teacher->get_result();

// Check if teacher information is fetched successfully
if ($result_teacher) {
    $teacher_info = $result_teacher->fetch_assoc();
} else {
    // Handle error if teacher information cannot be fetched
    echo "Error fetching teacher information: " . $conn->error;
}

// Logout process
if (isset($_POST['logout'])) {
    // Destroy the session
    session_destroy();
    // Redirect to the login page after logout
    header("Location: index.html");
    exit();
}
$_SESSION['teacher_info'] = $teacher_info;
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<meta charset="UTF-8">
<title>Dashboard</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<script defer src="js\bootstrap.bundle.min.js"></script>
<link  rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
<link rel="stylesheet" href="css\dashboard_teacher_style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body class="body">        
        
<div class="sidebar" id="sidebar">     
    <div class="menulogo" onclick="toggleSidebar()">
        <i class='bx bx-menu'></i>
    </div>
    <div class="logo-details">
        <div class="logo-container">
            <img class="logo1" src="Images\LogoYanga1.0.png" alt="Your Logo">
        </div>
        <span class="logo_name"><div class="title"> DYCIAN Performance <br> Monitoring System</div></span>
    </div>

    
    <div class="menu">
        <div class="item"  onclick="DashBoardFunction()"><a class="sub-btn"><i class='bx bx-grid-alt'></i><span class="name-text" id="dhtxt">Dashboard</span>
        </a>
        </div>
        <div class="item" onclick="EvaluationFunction()"><a class="sub-btn"><i class='bx bx-task' ></i><span class="name-text" id="etxt">Evaluation</span></span>
        </a>
        </div>
        <div class="item" onclick="CourseFunction()"><a class="sub-btn"><i class='bx bx-book-bookmark test'></i><span class="name-text" id="ctxt">Course</span>
        </a>
        </div>  
        <div class="item" onclick="ConsultationFunction()"><a class="sub-btn"><i class='bx bxs-envelope'></i><span class="name-text" id="cntxt">Consultation</span>
        </a>
        </div>  
    </div>
    <form class="logoutform" method="post" action="">
        <button class = "logout" type="submit" name="logout" value="Logout">
            <i class='bx bx-log-out'></i><div class="logout-text" id="logouttxt">Log Out</div> 
        </button>
    </form>
</div>

<div class="ProfilePic">
    <div class="Name_Role" id="nr">
      <div class="Name_indicate">Name: <?php echo isset($teacher_info) ? $teacher_info['firstname'] . ' ' . $teacher_info['lastname'] : ''; ?></div>
      <div class="Role_indicate">Role: <?php echo isset($dashboard_data['type_entity']) ? $dashboard_data['type_entity'] : ''; ?></div>
    </div>
</div>

<div class="fullbg" id="body">
    <img src = "Images\v960-ning-31.jpg" class="background1">
    <div class="RectangleDashboard" id="rd">
        <div class="dashboard" id="txt">Dashboard</div>
    </div>
    <div class="form-event_reminder" id="fre">
        <form class="event" id="esp">
            <iframe src="event.php" width="100%" height="100%" frameborder="0" scrolling="auto"></iframe>
        </form>
    </div>
</div>

<div class="fullbg2" id="body2">
    <img src = "Images\v960-ning-31.jpg" class="background1">
    <div class="RectangleCourse" id="rc">
        <div class="coursename" id="txt2">Course</div>
    </div>
    <div class="form-course-for-student">
        <form class="CourseforStudent" id="cs">
            <iframe id="searchResults" src="searchstudentCourse.php" width="100%" height="100%" frameborder="0" scrolling="auto"></iframe>
        </form>
    </div>
</div>
<div class="fullbg3" id="body3">
    <img src = "Images\v960-ning-31.jpg" class="background1">
    <div class="RectangleEvaluation" id="eva">
        <div class="evaluationname" id="txt3">Evaluation</div>
    </div>
    <div class="form-evaluation-for-teacher">
        <form class="evaluationforTeacher" id="es">
            <iframe id="evaluationFormFrame1" src="searchEvalaution.php" width="100%" height="100%" frameborder="0" scrolling="auto"></iframe>
        </form>
    </div>
</div>
<div class="fullbg4" id="body4">
    <img src = "Images\v960-ning-31.jpg" class="background1">
    <div class="RectangleConsultation" id="rcon">
        <div class="Consultmessa" id="txt4">Consultation Message</div>
    </div>
    <div class="form-consultation-for-teacher">
        <form class="consultationforTeacher" id="cons">
            <iframe src="consultationMessage.php" width="100%" height="100%" frameborder="0" scrolling="auto"></iframe>
        </form>
    </div>
</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="js\functionality.js"></script>
    </body>
</body>
</html>