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
    $sql_student = "SELECT * FROM student_info WHERE username = ?";
    $stmt_student = $conn->prepare($sql_student);
    $stmt_student->bind_param("s", $_SESSION['user_name']);
    $stmt_student->execute();
    $result_student = $stmt_student->get_result();
    
    // Check if student information is fetched successfully
    if ($result_student) {
        $student_info = $result_student->fetch_assoc();
    } else {
        // Handle error if student information cannot be fetched
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
    $_SESSION['student_info'] = $student_info;
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<meta charset="UTF-8">
<title>Dashboard</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<script defer src="js\bootstrap.bundle.min.js"></script>
<link  rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
<link rel="stylesheet" href="css\dashboard_student_style.css">
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
        <div class="item" onclick="CourseFunction()"><a class="sub-btn"><i class='bx bx-book-bookmark test'></i><span class="name-text" id="ctxt">Preview</span>
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
      <div class="Name_indicate">Name: <?php echo isset($student_info) ? $student_info['firstname'] . ' ' . $student_info['lastname'] : ''; ?></div>
      <div class="Role_indicate">Role: <?php echo isset($dashboard_data['type_entity']) ? $dashboard_data['type_entity'] : ''; ?></div>
    </div>
</div>

<div class="fullbg" id="body">
    
    <div class="RectangleDashboard" id="rd">
        <div class="dashboard" id="txt">Dashboard</div>
    </div>
    <!--reminder/events here-->
    <div class="form-event_reminder" id="fre">

      <!--reminder container here-->
        <form class="reminder_box" id="rsp">
            <!-- Add your reminder box content here -->
            
              <h2>Reminder</h2>
      
              <div class="reminders">
                  <div class="reminders-title">Upcoming Activities</div>
                  <ul class="task-list" id="upcoming-list">
                      <!-- Upcoming activities will be dynamically added here -->
                  </ul>
              </div>
      
              <div class="reminders">
                  <div class="reminders-title">Completed Activities</div>
                  <ul class="task-list" id="completed-list">
                      <!-- Completed activities will be dynamically added here -->
                  </ul>
              </div>
        </form>
        <!--end of remiinder-->

        <!--start of event-->
        <form class="event" id="esp">
            <!-- Add your event box content here -->
            <div class="event-box">
              <h2 class="event-text">EVENTS</h2>

              <div id="smart-box" class="sHome-processed"><div class="smart-box"><div class="smart-box-mid"><div class="item-list"><ul class="filter-block"><li class="smart-box-tab-0 filter-item academic add-event first last"><span tabindex="0" role="button" id="smart-box-tab-content-tab-0" class="smartbox-boxtab">Event</span></li>
              </ul></div>
                  <div id="smart-box-messages"></div>
                  <div id="smart-box-content">
                    <div id="smart-box-tab-content-0" class="smart-box-tab-content" style="display: none;"></div>
                  
                  </div></div></div></div>
                  <div class="update-sentence-inner"><a href="/user/120771024" title="View user profile." class="sExtlink-processed">Library Services</a> <span class="school-arrow-right"><span class="visually-hidden">posted to</span></span> <a href="/school/2558503832" class="sExtlink-processed">Dr. Yanga's Colleges, Inc.</a> <span class="update-body s-rte"><p><span style="font-size:13px;"><strong>New Facebook page of the DYCI Library Services. </strong></span></p>
                    
                    <p><span style="font-size:15px; left: 30px; position: relative;">We regret to inform you that the former facebook page of the DYCI library services has been compromised,<br> however you can reach us at our new facebook page below.&nbsp;</span></p>
                    <p><span style="font-size:15px; left: 30px; position: relative;"><a href="https://www.facebook.com/profile.php?id=61557528302634" class="sExtlink-processed">https://www.facebook.com/profile.php?id=61557528302634</a></span></p>
                    <p><img src="https://app.schoology.com/system/files/attachments/page_embeds/m/2024-04/frame_661778cf084d0.png" alt="" width="149" height="186" title="" class="picim"></p>
                    <p><span style="font-size:15px; left: 30px; position: relative;">Please like and follow to recieve important news, updates and announcements. Thank you.</span></p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p></span><a href="/update_post/7250721808/show_more/3a0c7974643053d495f7b5ecb723904a" id="edge-assoc-36370035679-show-more-link" class="show-more-link sExtlink-processed">Show More</a></div>

             <!-- 1st event-->

             <div class="update-sentence-inner"><a href="/user/120771024" title="View user profile." class="sExtlink-processed">Library Services</a> <span class="school-arrow-right"><span class="visually-hidden">posted to</span></span> <a href="/school/4758202496" class="sExtlink-processed">CCS</a> <span class="update-body s-rte"><p><span style="font-size:13px;"><strong>New Facebook page of the DYCI Library Services. </strong></span></p>
              <p><span style="font-size:15px; left: 30px; position: relative;">We regret to inform you that the former facebook page of the DYCI library services has been compromised,<br> however you can reach us at our new facebook page below.&nbsp;</span></p>
              <p><span style="font-size:15px; left: 30px; position: relative;"><a href="https://www.facebook.com/profile.php?id=61557528302634" class="sExtlink-processed">https://www.facebook.com/profile.php?id=61557528302634</a></span></p>
              <p><img src="https://app.schoology.com/system/files/attachments/page_embeds/m/2024-04/frame_661778cf084d0.png" alt="" width="149" height="186" title="" class="picim"></p>
              <p><span style="font-size:15px; left: 30px; position: relative;">Please like and follow to recieve important news, updates and announcements. Thank you.</span></p>
              <p>&nbsp;</p>
              <p>&nbsp;</p></span><a href="/update_post/7250721812/show_more/db7d48f60fc4759916dc05c9b96f0cd2" id="edge-assoc-36370035638-show-more-link" class="show-more-link sExtlink-processed">Show More</a></div>

              <!-- 2nd event-->

              <div class="edge-main-wrapper"><span class="edge-sentence"><div class="edge-sentence-actions"><div class="s-update-immersive-reader"><div class="immersive-reader-button-container" id="s-update-edge-immersive-reader-nid-7241279014"><button class="_button_1jkx4_1 _iconOnly_1jkx4_26" title="Immersive Reader"><span class="_icon_1jkx4_26"><svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M21 3v4.336h-1.016v-3.34h-5.588c-.762.2-2.236.798-2.236 1.546v5.58h-1.016v-5.58c0-.499-1.219-1.196-2.133-1.545H3.016v13.006h5.283V18H2V3h7.163l.102.05c.355.1 1.625.598 2.337 1.345.812-.897 2.336-1.295 2.54-1.345H21V3z" fill="#000"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M15.7 21V9h-.65l-3.85 3.95L9 13v4.2h2.2l3.7 3.8h.8zm4.5-11.4l-.8.6.157.226.17.27.134.235.147.274c.453.88.992 2.27.992 3.895 0 1.716-.601 3.17-1.066 4.037l-.142.254-.127.214-.192.293L19.4 20l.8.6.302-.458.212-.354.157-.287.165-.325c.47-.972.964-2.38.964-4.026 0-1.673-.494-3.107-.964-4.098l-.165-.331-.157-.293-.145-.252-.128-.209L20.2 9.6zm-5.55 1.2l-3.05 3.15H9.95v2.25h1.65l3.05 3.15V10.8zm3 .4l-.85.5.005.014.196.379.169.35.123.282.126.313c.228.6.431 1.336.431 2.062 0 .806-.284 1.653-.556 2.28l-.124.272-.116.236-.182.339-.072.123.85.5a.12.12 0 00.01-.014l.083-.133.143-.258.118-.231.13-.273.135-.31c.294-.706.581-1.631.581-2.531 0-.975-.288-1.925-.581-2.644l-.135-.314-.13-.277a8.446 8.446 0 00-.061-.124l-.11-.213-.183-.328z" fill="#0075DB"></path></svg></span></button></div><script type="text/javascript">(function () {
                function immersiveReaderAction() {
                  window.sgyImmersiveReader.renderButton({"targetId":"s-update-edge-immersive-reader-nid-7241279014","titleSelectorPath":"div.update-sentence-inner a","contentSelectorPath":"#edge-assoc-36271003936","origin":"Update","variant":"icon","beforeLaunch":() => sUpdateImmersiveReaderBeforeLaunch('edge-assoc-36271003936-show-more-link'),"getCustomContent":(contentSelectorPath) => sUpdateImmersiveReaderGetCustomContent(contentSelectorPath, 'Poll')});
                  window.removeEventListener("SgyImmersiveReaderLoaded", immersiveReaderAction);
                }
                (window.sgyImmersiveReader === undefined)
                  ? window.addEventListener("SgyImmersiveReaderLoaded", immersiveReaderAction)
                  : immersiveReaderAction();
              })();
              </script></div></div><div class="update-sentence-inner"><a href="/user/120771024" title="View user profile." class="sExtlink-processed">Library Services</a> <span class="school-arrow-right"><span class="visually-hidden">posted to</span></span> <a href="/school/4758202496" class="sExtlink-processed">CCS</a> <span class="update-body s-rte"><p style="line-height:1.3800000000000001;text-align:justify;margin-top:0pt;margin-bottom:10pt;" dir="ltr"><span style="font-size:15px; left: 30px; position: relative;">Good day, Dycians!</span></p>
              <p style="line-height:1.3800000000000001;text-align:justify;margin-top:0pt;margin-bottom:10pt;" dir="ltr"><span style="font-size:15px; left: 30px; position: relative;">Discover our collection of online resources, tailored to meet your learning and research needs. Explore a world of information<br>     from eBooks to academic journals and educational databases.&nbsp;</span></p>
              <p style="line-height:1.3800000000000001;text-align:justify;margin-top:0pt;margin-bottom:10pt;" dir="ltr"><span style="font-size:15px; left: 30px; position: relative;">Below are the online resources of the DYCI Library Services with their respective access information:</span></p>
              <p><img src="https://app.schoology.com/system/files/attachments/page_embeds/m/2024-04/CCS_BROCHURE_660e350aa76e1.png" alt="" width="584" height="451" title="" class="picim"></p>
              <p style="line-height:1.3800000000000001;text-align:justify;margin-top:0pt;margin-bottom:10pt;" dir="ltr"><span style="font-size:15px; left: 30px; position: relative;">1. </span><span style="font-size:15px; left: 30px; position: relative;">Harvard Business Review</span></p>
              <p style="line-height:1.3800000000000001;text-align:justify;margin-top:0pt;margin-bottom:10pt;" dir="ltr"><span style="font-size:15px; left: 30px; position: relative;">(Access for faculty only)</span></p>
              <p style="line-height:1.3800000000000001;text-align:justify;margin-top:0pt;margin-bottom:10pt;" dir="ltr"><span style="font-size:15px; left: 30px; position: relative;">For access kindly contact us at </span><a href="mailto:library.services@dyci.edu.ph" class="sExtlink-processed mailto"><span style="font-size:11pt;font-family:Calibri, sans-serif;color:#1155cc;vertical-align:baseline;white-space:pre-wrap;">...</span></a><span class="mailto"></span></p></span><a href="/update_post/7241279014/show_more/c22647c7c6bd7d53c817e62fc05e1d51" id="edge-assoc-36271003936-show-more-link" class="show-more-link sExtlink-processed">Show More</a></div></span><span class="edge-main"><div class="post-body"></div></span>
                      
                      
                      
                    </div>

              <!-- 3rd Event-->

              <div class="edge-main-wrapper"><span class="edge-sentence"><div class="edge-sentence-actions"><div class="s-update-immersive-reader"><div class="immersive-reader-button-container" id="s-update-edge-immersive-reader-nid-7211292861"><button class="_button_1jkx4_1 _iconOnly_1jkx4_26" title="Immersive Reader"><span class="_icon_1jkx4_26"><svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M21 3v4.336h-1.016v-3.34h-5.588c-.762.2-2.236.798-2.236 1.546v5.58h-1.016v-5.58c0-.499-1.219-1.196-2.133-1.545H3.016v13.006h5.283V18H2V3h7.163l.102.05c.355.1 1.625.598 2.337 1.345.812-.897 2.336-1.295 2.54-1.345H21V3z" fill="#000"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M15.7 21V9h-.65l-3.85 3.95L9 13v4.2h2.2l3.7 3.8h.8zm4.5-11.4l-.8.6.157.226.17.27.134.235.147.274c.453.88.992 2.27.992 3.895 0 1.716-.601 3.17-1.066 4.037l-.142.254-.127.214-.192.293L19.4 20l.8.6.302-.458.212-.354.157-.287.165-.325c.47-.972.964-2.38.964-4.026 0-1.673-.494-3.107-.964-4.098l-.165-.331-.157-.293-.145-.252-.128-.209L20.2 9.6zm-5.55 1.2l-3.05 3.15H9.95v2.25h1.65l3.05 3.15V10.8zm3 .4l-.85.5.005.014.196.379.169.35.123.282.126.313c.228.6.431 1.336.431 2.062 0 .806-.284 1.653-.556 2.28l-.124.272-.116.236-.182.339-.072.123.85.5a.12.12 0 00.01-.014l.083-.133.143-.258.118-.231.13-.273.135-.31c.294-.706.581-1.631.581-2.531 0-.975-.288-1.925-.581-2.644l-.135-.314-.13-.277a8.446 8.446 0 00-.061-.124l-.11-.213-.183-.328z" fill="#0075DB"></path></svg></span></button></div><script type="text/javascript">(function () {
                function immersiveReaderAction() {
                  window.sgyImmersiveReader.renderButton({"targetId":"s-update-edge-immersive-reader-nid-7211292861","titleSelectorPath":"div.update-sentence-inner a","contentSelectorPath":"#edge-assoc-35960346209","origin":"Update","variant":"icon","beforeLaunch":() => sUpdateImmersiveReaderBeforeLaunch('edge-assoc-35960346209-show-more-link'),"getCustomContent":(contentSelectorPath) => sUpdateImmersiveReaderGetCustomContent(contentSelectorPath, 'Poll')});
                  window.removeEventListener("SgyImmersiveReaderLoaded", immersiveReaderAction);
                }
                (window.sgyImmersiveReader === undefined)
                  ? window.addEventListener("SgyImmersiveReaderLoaded", immersiveReaderAction)
                  : immersiveReaderAction();
              })();
              </script></div></div><div class="update-sentence-inner"><a href="/user/120576856" title="View user profile." class="sExtlink-processed">DYCI Guidance and Counseling Center</a> <span class="school-arrow-right"><span class="visually-hidden">posted to</span></span> <a href="/school/4758202496" class="sExtlink-processed">CCS</a> <span class="update-body s-rte"><div style="font-family:'system-ui', '-apple-system', BlinkMacSystemFont, sans-serif;color:#050505;font-size:15px;white-space:pre-wrap;">
              <div style="font-size:15px; left: 30px; position: relative;">Good day, graduating <span class="x3nfvp2 x1j61x8r x1fcty0u xdj266r xhhsvwb xat24cr xgzva0m xxymvpz xlup9mm x1kky2od" style="vertical-align:middle;margin:0px 1px;height:16px;width:16px;font-family:inherit; position: relative; right: 30px;"><img src="https://static.xx.fbcdn.net/images/emoji.php/v9/tc4/2/16/1f393.png" alt="🎓" width="16" height="16" style="position: relative; right: 30px;" class="xz74otr"></span> and <span class="x3nfvp2 x1j61x8r x1fcty0u xdj266r xhhsvwb xat24cr xgzva0m xxymvpz xlup9mm x1kky2od" style="vertical-align:middle;margin:0px 1px;height:16px;width:16px;font-family:inherit; position: relative; right: 30px;"><img src="https://static.xx.fbcdn.net/images/emoji.php/v9/t1e/2/16/1f469_1f3fb_200d_1f4bb.png" alt="👩🏻‍💻" width="16" height="16" class="xz74otr"></span> intern<span class="x3nfvp2 x1j61x8r x1fcty0u xdj266r xhhsvwb xat24cr xgzva0m xxymvpz xlup9mm x1kky2od" style="vertical-align:middle;margin:0px 1px;height:16px;width:16px;font-family:inherit; position: relative; right: 30px;"><img src="https://static.xx.fbcdn.net/images/emoji.php/v9/t7f/2/16/1f468_1f3fb_200d_1f4bb.png" alt="👨🏻‍💻" width="16" height="16" class="xz74otr"></span>DYCIans!</div>
              <div style="font-size:15px; left: 30px; position: relative;">As we are about to embark on a new journey of work experiences, here is Sir Francis, one of the guidance advocates, helping<br> you to prepare for your interviews.</div>
              <div style="font-size:15px; left: 30px; position: relative;">God bless DYCIans!<span class="x3nfvp2 x1j61x8r x1fcty0u xdj266r xhhsvwb xat24cr xgzva0m xxymvpz xlup9mm x1kky2od" style="vertical-align:middle;margin:0px 1px;height:16px;width:16px;font-family:inherit;"><img src="https://static.xx.fbcdn.net/images/emoji.php/v9/t75/2/16/2728.png" alt="✨" width="16" height="16" class="xz74otr"></span></div>
              <p><iframe src="https://app.schoology.com/media/ifr/5986473537" scrolling="no" frameborder="0" style="border:0; position: relative; left: 30px;" allowfullscreen="true "></iframe></p>
              </div></span><a href="/update_post/7211292861/show_more/a5b3a8c77343980abe3915633a98b0b2" id="edge-assoc-35960346209-show-more-link" class="show-more-link sExtlink-processed">Show More</a></div></span><span class="edge-main"><div class="post-body"></div></span><div class="edge-footer"><div class="created">
              </div>

              <!-- 4rth event-->


            </div>
        </form>
        <!--end of event-->
                
        <!--end of fullbg-->
        </div>
        

</div>
<style> 
    .namesearch{
        margin-left:20px;   
    }
    .content{
        margin-bottom: 20px;
    }
   .courses{
    margin-left: 10px;
}
.courses, .section, .yearlevel, .namesearch{
    display: inline-block;
    font-weight: bold;
    background-color: transparent;
}
.StudentInfoTable{
    position: absolute;
    top: 50px;
    right: 0px;
    bottom: 0px;
    left: 0px;
    font-size: 12pt;
    overflow: hidden;
}
.namestu{
    width: 360px;
}
body{
    background-color: #d9d4d4;
}
.tbl-fixed {
    overflow-y: scroll;
    height: fit-content;
    max-height: 120vh;
}

table {
    border-collapse: separate;
    width: 100%; /* Ensure table takes full width */
}

table th {
    position: sticky;
    top: 0px;
    background: white;
    text-align: center;
}

table td {
    text-align: center;
}

.StudentInfoTable table tbody tr:nth-child(odd) {
    background-color: lightgray; /* Set background color for odd rows */
}

.StudentInfoTable table tbody tr:nth-child(even) {
    background-color: white; /* Set background color for even rows */
}
.SearchArea{
    position: absolute;
    left: 0px;
    right: 0px;
    top: 0px;
    height: 40;
}
</style>
        </form>
    </div>
</div>

<div class="fullbg2" id="body2">
    <div class="RectangleCourse" id="rc">
        <div class="coursename" id="txt2">Student Preview</div>
    </div>
    <div class="form-course-for-student">
        <form class="CourseforStudent" id="cs" method="GET" action="">
            <iframe id="searchResults" src="searchpreviewevalaution.php" width="100%" height="100%" frameborder="0" scrolling="auto"></iframe>
        </form>
    </div>
</div>
    <script src="js\functionality_student.js"></script>
    </body>
</body>
</html>