<?php
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['user_name'])) {
        // Redirect to the login page if the user is not logged in
        header("Location: index.html");
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
    
    // Fetch student information if the user is a student
    $sql_parent = "SELECT * FROM parent_info WHERE username = ?";
    $stmt_parent = $conn->prepare($sql_parent);
    $stmt_parent->bind_param("s", $_SESSION['user_name']);
    $stmt_parent->execute();
    $result_parent = $stmt_parent->get_result();
    
    if ($result_parent) {
        $parent_info = $result_parent->fetch_assoc();
        $_SESSION['parent_info'] = $parent_info;
    } else {
        echo "Error fetching student information: " . $conn->error;
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
<link rel="stylesheet" href="css\dashboard_parent_style.css">
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
        <div class="item"  onclick="DashBoardFunction()"><a class="sub-btn"><i class='bx bx-grid-alt'></i><span class="name-text" id="dhtxt">Student</span>
        </a>
        </div>
        <div class="item" onclick="ReachoutFunction()"><a class="sub-btn"><i class='bx bx-envelope'></i><span class="name-text" id="ctxt">Reachout</span>
        </a>
        </div>    
    </div>
    <form class="logoutform" method="post" action="loginexecute.php">
        <button class = "logout" type="submit" name="logout" value="Logout">
            <i class='bx bx-log-out'></i><div class="logout-text" id="logouttxt">Log Out</div> 
        </button>
    </form>
</div>

<div class="ProfilePic">
    <div class="Name_Role" id="nr">
      <div class="Name_indicate">Name: <?php echo isset($parent_info) ? $parent_info['firstname'] . ' ' . $parent_info['lastname'] : ''; ?></div>
      <div class="Role_indicate">Role: <?php echo isset($dashboard_data['type_entity']) ? $dashboard_data['type_entity'] : ''; ?></div>
    </div>
</div>

<div class="fullbg" id="body">
    <img src = "Images\v960-ning-31.jpg" class="background1">
    <div class="RectanglePreviewEva" id="rpe">
        <div class="dashboard" id="txt">Student Preview</div>
    </div>
    <div class="form-event_reminder" id="fre">
        <form class="event" id="esp">
            <iframe src="searchpreviewevalautionparent.php" width="100%" height="100%" frameborder="0" scrolling="auto"></iframe>
        </form>
    </div>
</div>

<div class="fullbg2" id="body2">
    <img src = "Images\v960-ning-31.jpg" class="background1">
    <div class="RectangleReachout" id="rro">
        <div class="coursename" id="txt2">Reach Out</div>
    </div>
    <div class="form-course-for-student">
        <form class="ReachoutforStudent" id="rfs">
            <iframe src="reachoutmessage.php" width="100%" height="100%" frameborder="0" scrolling="auto"></iframe>
        </form>
    </div>
</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="js\functionality_parent.js"></script>
    </body>
</body>
</html>