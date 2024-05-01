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
        <div class="item"  onclick="DashBoardFunction()"><a class="sub-btn"><i class='bx bx-grid-alt'></i><span class="name-text" id="nametxt">Dashboard</span>
        </a>
        </div>
        <div class="item" onclick="EvaluationFunction()"><a class="sub-btn"><i class='bx bx-task' ></i><span class="name-text" id="nametxt">Evaluation</span></span>
        </a>
        </div>
        <div class="item" onclick="CourseFunction()"><a class="sub-btn"><i class='bx bx-book-bookmark test'></i><span class="name-text" id="nametxt">Course</span>
        </a>
        </div>    
    </div>
    <form class="logoutform" method="post" action="">
        <i class='bx bx-log-out'></i><button class = "logout" type="submit" name="logout" value="Logout"><div class="name-text" id="nametxt">Log Out</div></button>
    </form>
</div>

<div class="ProfilePic">
    <img src="Images\profilewhite.png" alt="Profile Image" class="profilepic">
    <div class="Name_Role" id="nr">
      <div class="Name_indicate">Name: <?php echo isset($teacher_info) ? $teacher_info['firstname'] . ' ' . $teacher_info['lastname'] : ''; ?></div>
      <div class="Role_indicate">Role: <?php echo isset($dashboard_data['type_entity']) ? $dashboard_data['type_entity'] : ''; ?></div>
    </div>
</div>

<div class="fullbg" id="body">
    
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
  <div class="RectangleCourse" id="rc">
      <div class="coursename" id="txt2">Course</div>
  </div>
  <div class="form-course-for-student">
      <form class="CourseforStudent" id="cs">
        <iframe src="searchstudentCourse.php" width="100%" height="100%" frameborder="0" scrolling="auto"></iframe>
      </form>
  </div>
</div>

<div class="fullbg3" id="body3">
  <div class="RectangleEvaluation" id="re">
      <div class="evaluationname" id="txt3">Evaluation</div>
  </div>
  <div class="form-evaluation-for-teacher">
      <form class="evaluationforTeacher" id="es">
        <iframe src="searchEvalaution.php" width="100%" height="100%" frameborder="0" scrolling="auto"></iframe>
      </form>
  </div>
</div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        var isLarge = false; // Initial state
        function toggleSidebar() {
            var body = document.getElementById('body');
            var csp = document.getElementById('cs');
            var esp = document.getElementById('es');
            var body2 = document.getElementById('body2');
            var body3 = document.getElementById('body3');
            var sp2 = document.getElementById('esp');
            var fre = document.getElementById('fre');
            var rd = document.getElementById('rd');
            var rc = document.getElementById('rc');
            var txt = document.getElementById('txt');
            var txt2 = document.getElementById('txt2');
            var sidebar = document.getElementById('sidebar');
            var elements = document.getElementsByClassName('name-text');
            if (esp.classList.contains('position-evaluation')) {
                esp.classList.remove('position-evaluation');
                esp.classList.add('position-evaluation-reverse');
            } else {
                esp.classList.remove('position-evaluation-reverse');
                esp.classList.add('position-evaluation');
            }
            if (csp.classList.contains('position-course')) {
                csp.classList.remove('position-course');
                csp.classList.add('position-course-reverse2');
            } else {
                csp.classList.remove('position-course-reverse2');
                csp.classList.add('position-course');
            }
            if (body.classList.contains('resize')) {
              body.classList.remove('resize');
              body.classList.add('resize-reverse');
            } else {
                body.classList.remove('resize-reverse');
                body.classList.add('resize');
            }
            if (body2.classList.contains('resize2')) {
                body2.classList.remove('resize2');
                body2.classList.add('resize-reverse2');
            } else {
                body2.classList.remove('resize-reverse2');
                body2.classList.add('resize2');
            }
            if (body3.classList.contains('resize3')) {
                body3.classList.remove('resize3');
                body3.classList.add('resize-reverse3');
            } else {
                body3.classList.remove('resize-reverse3');
                body3.classList.add('resize3');
            }
            if (sidebar.classList.contains('sidebar-resize')) {
                sidebar.classList.remove('sidebar-resize');
                sidebar.classList.add('sidebar-resize-reverse');
            } else {
                sidebar.classList.remove('sidebar-resize-reverse');
                sidebar.classList.add('sidebar-resize');
            }
            if (fre.classList.contains('position')) {
                fre.classList.remove('position');
                fre.classList.add('position-reverse');
            } else {
                fre.classList.remove('position-reverse');
                fre.classList.add('position');
            }
            if (rd.classList.contains('position-size')) {
                rd.classList.remove('position-size');
                rd.classList.add('position-size-reverse');
            } else {
                rd.classList.remove('position-size-reverse');
                rd.classList.add('position-size');
            }
            if (rc.classList.contains('position-size-course')) {
                rc.classList.remove('position-size-course');
                rc.classList.add('position-size-reverse-course');
            } else {
                rc.classList.remove('position-size-reverse-course');
                rc.classList.add('position-size-course');
            }
            if (txt.classList.contains('position-text')) {
                txt.classList.remove('position-text');
                txt.classList.add('position-text-reverse');
            } else {
                txt.classList.remove('position-text-reverse');
                txt.classList.add('position-text');
            }

            if (txt2.classList.contains('position-text2')) {
                txt2.classList.remove('position-text2');
                txt2.classList.add('position-text-reverse2');
            } else {
                txt2.classList.remove('position-text-reverse2');
                txt2.classList.add('position-text2');
            }
            if (sp2.classList.contains('event-sp')) {
                sp2.classList.remove('event-sp');
                sp2.classList.add('event-sp-reverse');
            } else {
                sp2.classList.remove('event-sp-reverse');
                sp2.classList.add('event-sp');
            }
            for (var i = 0; i < elements.length; i++) {
                elements[i].classList.toggle('hidden'); // Toggle the 'hidden' class
            }
            var menuItems = document.querySelectorAll('.menu .item a');
            // Toggle between two sets of styles based on the current state
                if (!isLarge) {
                    menuItems.forEach(function(item) {
                        item.classList.add('large'); // Add 'large' class
                    });
                } else {
                    menuItems.forEach(function(item) {
                        item.classList.remove('large'); // Remove 'large' class
                    });
                }
                var menuItems = document.querySelectorAll('.logoutform');
            // Toggle between two sets of styles based on the current state
                if (!isLarge) {
                    menuItems.forEach(function(item) {
                        item.classList.add('enlarge'); // Add 'large' class
                    });
                } else {
                    menuItems.forEach(function(item) {
                        item.classList.remove('enlarge'); // Remove 'large' class
                    });
                }
            var titleNames = document.querySelectorAll('.title'); // Select h6 elements
                // Toggle between two sets of styles based on the current state
                if (!isLarge) {
                    titleNames.forEach(function(item) {
                        item.classList.add('hidden'); // Add 'hidden' class
                    });
                } else {
                    titleNames.forEach(function(item) {
                        item.classList.remove('hidden'); // Remove 'hidden' class
                    });
                }
                // Toggle the state
                isLarge = !isLarge
        }
        function DashBoardFunction(){
            var dashboard = document.getElementById('body');
            var course = document.getElementById('body2');
            var evaluation = document.getElementById('body3');
            dashboard.style.position = "absolute";
            dashboard.style.visibility = "visible";
            course.style.visibility = "hidden";
            evaluation.style.visibility = "hidden"
        }
        function CourseFunction(){
            var dashboard = document.getElementById('body');
            var course = document.getElementById('body2');
            var evaluation = document.getElementById('body3');
            dashboard.style.position = "fixed";
            dashboard.style.visibility = "hidden";
            course.style.visibility = "visible";
            evaluation.style.visibility = "hidden"
        }
        function EvaluationFunction(){
            var dashboard = document.getElementById('body');
            var course = document.getElementById('body2');
            var evaluation = document.getElementById('body3');
            dashboard.style.position = "fixed";
            dashboard.style.visibility = "hidden";
            course.style.visibility = "hidden";
            evaluation.style.visibility = "visible";
        }
    </script>
    
    <script>
        $(document).ready(function(){

        $('.sub-btn').click(function(){
            $(this).next('.sub-menu').slideToggle();
            $(this).find('.dropdown').toggleClass('rotate');
        });
    });

    </script>
    </body>



</body>
</html>