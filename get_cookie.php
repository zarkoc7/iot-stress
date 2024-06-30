<?php
session_start();

// Check if username and password are set
$data = json_decode(file_get_contents('php://input'), true);
$username = $data['username'];
$password = $data['password'];

// Database connection
include 'config.php';
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);

}

// Fetch user details from MySQL
$sql = "SELECT * FROM user WHERE username='$username'";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // User authenticated, store user ID in session
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        $_SESSION['user_id'] = $row['userID'];
        $_SESSION['ime'] = $row['Ime'];
        $_SESSION['prezime'] = $row['Prezime'];
        http_response_code(200);
    } else {
        http_response_code(401);
        echo "Invalid credentials";
    }
    
} else {
    http_response_code(401);
    echo "Invalid credentials";
}
$conn->close();
?>