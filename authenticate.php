<?php
session_start();

// Check if username and password are set
if(isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
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
    echo $username;

  
    if ($result->num_rows > 0) {
        // User authenticated, store user ID in session
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            echo $row['Prezime'];
            $_SESSION['user_id'] = $row['userID'];
            $_SESSION['ime'] = $row['Ime'];
            $_SESSION['prezime'] = $row['Prezime'];
            header("Location: home.php");
        } else {
            $_SESSION['errorMsg']="Invalid credentials";
            header('Location: login.php');
        }    
    } else {
        // Invalid credentials
        $_SESSION['errorMsg']="Invalid credentials";
        header("Location: login.php");
    }
    $conn->close();
} else {
    $_SESSION['errorMsg']="Please enter username and password!";
    header("Location: login.php");
}
?>