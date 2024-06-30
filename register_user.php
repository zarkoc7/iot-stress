<?php
// Database connection
include 'config.php';
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if username and password are set
if(isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];

    // Insert user into MySQL
    $sql = "INSERT INTO user (username, password, Ime, Prezime) VALUES ('$username', '$hashed_password', '$ime', '$prezime')";
    if ($conn->query($sql) === TRUE) {
        echo "Registration successful";
         header("Location: login.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Username and password are required";
}

$conn->close();
?>