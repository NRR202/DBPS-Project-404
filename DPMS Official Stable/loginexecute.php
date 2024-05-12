<?php
session_start();

if (isset($_POST['logout'])) {
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session
    header("Location: index.html"); // Redirect to the login page
    exit();
}

// Check if login attempts session variable exists
if (!isset($_SESSION['login_attempts'])) {
    // Initialize login attempts session variable
    $_SESSION['login_attempts'] = 0;
    // Initialize last login attempt time session variable
    $_SESSION['last_login_attempt_time'] = 0;
}

// Reset login attempts if the last attempt was made more than 20 seconds ago
if ((time() - $_SESSION['last_login_attempt_time']) > 20) {
    $_SESSION['login_attempts'] = 0; // Reset login attempts
}

// Check if the user has reached the maximum number of login attempts
if ($_SESSION['login_attempts'] >= 3) {
    // Display error message and redirect to login page
    echo '<script>alert("You have exceeded the maximum number of login attempts. Please try again later.");window.location.href = "DBPSLogin.html";</script>';
    exit; // Stop further execution
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

// Get username and password from form
$username = $_POST['username'];
$password = $_POST['password'];

// SQL injection prevention: escape special characters
$username = mysqli_real_escape_string($conn, $username);
$password = mysqli_real_escape_string($conn, $password);

// Query to check if user exists
$sql = "SELECT * FROM credentials_account WHERE username='$username' AND pass_word='$password'";
$result = $conn->query($sql);

if ($result === false) {
    // Check for errors in the query execution
    echo "Error: " . $conn->error;
} else {
    // Check if any rows were returned
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $role = $row['type_entity']; // Assuming 'type_entity' is the column name for user role

        // Set session based on user role
        $_SESSION['user_name'] = $username;
        $_SESSION['type_entity'] = $role;

        // Reset login attempts because login is successful
        $_SESSION['login_attempts'] = 0;

        // Redirect based on user role
        if ($role == 'Teacher') {
            echo "Login Successful as Teacher";
            header("Location: dashboard_for_teacher.php"); // Redirect to teacher dashboard
            exit();
        } elseif ($role == 'Student') {
            echo "Login Successful as Student";
            header("Location: dashboard_for_student.php"); // Redirect to student dashboard or other role-specific dashboard
            exit();
        } elseif ($role == 'Parent') {
            echo "Login Successful as Parent";
            header("Location: dashboard_for_parent.php"); // Redirect to student dashboard or other role-specific dashboard
            exit();
        } else {
            echo "Login Successful as Administrator";
            header("Location: dashboard_for_admin.php"); // Redirect to student dashboard or other role-specific dashboard
            exit();
        }
    } else {
        // Increment login attempts
        $_SESSION['login_attempts']++;

        // Update last login attempt time
        $_SESSION['last_login_attempt_time'] = time();

        // User doesn't exist or invalid credentials
        echo '<script>alert("Invalid username or password either Account not Exist");window.location.href = "DBPSLogin.html";</script>';
    }
}
$conn->close();
?>