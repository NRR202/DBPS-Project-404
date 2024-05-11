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
    <form class="logoutform" method="post" action="">
        <button class = "logout" type="submit" name="logout" value="Logout">
            <i class='bx bx-log-out'></i><div class="logout-text" id="logouttxt">Log Out</div> 
        </button>
    </form>
</div>

<div class="ProfilePic">
    <div class="Name_Role" id="nr">
      <div class="Name_indicate">Name: </div>
      <div class="Role_indicate">Role: </div>
    </div>
</div>

<div class="fullbg" id="body">
    <img src = "Images\v960-ning-31.jpg" class="background1">
    <div class="RectangleDashboard" id="rd">
        <div class="dashboard" id="txt">Student Preview</div>
    </div>
    <div class="form-event_reminder" id="fre">
        <form class="event" id="esp">
            
        </form>
    </div>
</div>

<div class="fullbg2" id="body2">
    <img src = "Images\v960-ning-31.jpg" class="background1">
    <div class="RectangleCourse" id="rc">
        <div class="coursename" id="txt2">Reach Out</div>
    </div>
    <div class="form-course-for-student">
        <form class="CourseforStudent" id="cs">
            
        </form>
    </div>
</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="js\functionality_parent.js"></script>
    </body>
</body>
</html>