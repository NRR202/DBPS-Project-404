<?php
session_start();

// Check if login attempts session variable exists
if (!isset($_SESSION['login_attempts'])) {
    // Initialize login attempts session variable
    $_SESSION['login_attempts'] = 0;
}

// Check if the user has reached the maximum number of login attempts
if ($_SESSION['login_attempts'] >= 3) {
    // Display error message and redirect to login page
    echo "You have exceeded the maximum number of login attempts. Please try again later.";
    echo '<meta http-equiv="refresh" content="1;url=DBPSLogin.html">'; // Redirect to login page
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
        $role = $row['type_entity']; // Assuming 'role' is the column name for user role

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
            echo "Login Successful as " . $role;
            header(""); // Redirect to student dashboard or other role-specific dashboard
            exit();
        } elseif ($role == 'Parent'){
            echo "Login Successful as " . $role;
            header(""); // Redirect to student dashboard or other role-specific dashboard
            exit();
        } else {
            echo "Login Successful as " . $role;
            header(""); // Redirect to student dashboard or other role-specific dashboard
            exit();
        }
    } else {
        // Increment login attempts
        $_SESSION['login_attempts']++;

        // User doesn't exist or invalid credentials
        echo "Invalid username or password either Account not Exist";
        echo '<meta http-equiv="refresh" content="1;url=DBPSLogin.html">';
        
        // Redirect to login page after three failed attempts
        if ($_SESSION['login_attempts'] >= 3) {
            echo '<meta http-equiv="refresh" content="1;url=DBPSLogin.html">'; // Redirect to login page
        }
    }
}

$conn->close();

?>
