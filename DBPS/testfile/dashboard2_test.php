<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<meta charset="UTF-8">
<title>Drop Down Sidebar Mene</title>
<link rel="stylesheet" href="dashboardstyle.css">
<!---Boxicons CDN Link --->
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body> 
        <div class="fullbg">
        <div class="sidebar">
     
    <div class="menulogo"><i class='bx bx-menu'></i></div>
    <div class="logo-details">
        <div class="logo-container">
            <img class="logo00" src="Images\Logoyanga.png" alt="Your Logo">
            <img class="logo100" src="Images\CCSLogo.png" alt="Your Logo">
        </div>
    <span class="logo_name"><h6> DYCIAN Performance <br> Monitoring System</h6></span>

    </div>

    
    <div class="menu">
        <div class="item"><a class="dashboard"><i class='bx bx-grid-alt'></i>Dasboard</a></div>
        <div class="item"><a class="sub-btn"><i class='bx bxs-envelope'></i>Messages
        <!--dropdown 01-->
        <!--dropdown arrow-->
        <i class="bx bxs-chevron-down dropdown"></i>
        </a>
        <div class="sub-menu">
            <a href="" class="sub-item">Teacher</a>
            <a href="" class="sub-item">Student</a>
        </div>
        </div>
        <div class="item"><a class="sub-btn"><i class='bx bx-book-bookmark'></i>Course
        <!--dropdown 02-->
        <!--dropdown arrow-->
        <i class="bx bxs-chevron-down dropdown"></i>
        </a>
        <div class="sub-menu">
            <a href="" class="sub-item">CCS</a>
            <a href="" class="sub-item">BSIT</a>
            <a href="" class="sub-item">BSCS</a>
            <a href="" class="sub-item">BSCPE</a>
        </div>
        </div>
        <div class="item"><a class="sub-btn"><i class='bx bxs-cog'></i>Settings
        <!--dropdown 03-->
        <!--dropdown arrow-->
        <i class="bx bxs-chevron-down dropdown"></i>
        </a>
        <div class="sub-menu">
            <a href="" class="sub-item">Info</a>
            <a href="" class="sub-item">About</a>
        </div>
        </div>
        <div class="item"><a href="DBPS.html" class="logout"><i class='bx bx-log-out'></i>LOG OUT</a></div>

    </div>

</div>
</div>

<form class="reminder">
    <!-- Add your reminder box content here -->
    <div class="reminder-box">
        <h2>Reminder Title</h2>
        <p>This is a reminder content.</p>
    </div>
</form>

<form class="event">
    <!-- Add your reminder box content here -->
    <div class="reminder-box">
        <h2>Event Title</h2>
        <p>This is a event content.</p>
    </div>
</form>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    <script>
        let menulogo = document.querySelector('.menulogo');
        let sidebar = document.querySelector('.navigation');
        
        menulogo.onclick= function(){ 
            sidebar.classList.toggle('active')
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