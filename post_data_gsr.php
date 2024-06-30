<?php
// Database connection
session_start();
include 'config.php';
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from POST request
$data = json_decode(file_get_contents('php://input'), true);


// Extract data
$user_id = $_SESSION['user_id'];
$gsr = $data['gsr'];

$currentDateTime = date('Y-m-d H:i:s');
// Insert data into database
$sql = "INSERT INTO gsr (value, time, user) VALUES ('$gsr', '$currentDateTime', '$user_id' )";
if ($conn->query($sql) === TRUE) {
    echo "GSR data added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// $sql = "INSERT INTO gsr (user_id, gsr) VALUES ('$user_id', '$gsr')";
// if ($conn->query($sql) === TRUE) {
//     echo "GSR data added successfully";
// } else {
//     echo "Error: " . $sql . "<br>" . $conn->error;
// }

$conn->close();
?>