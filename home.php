<?php
session_start();

// Check if user is logged in
if(!isset($_SESSION['user_id'])) {
     header("Location: login.php");
}

// Database connection
include 'config.php';
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch pulse data from MySQL
$sql_pulse = "SELECT * FROM pulse WHERE user=" . $_SESSION['user_id'];
$result_pulse = $conn->query($sql_pulse);

// Fetch GSR data from MySQL
$sql_gsr = "SELECT * FROM gsr WHERE user=" . $_SESSION['user_id'];
$result_gsr = $conn->query($sql_gsr);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa; /* Background color */
            margin: 0; /* Remove default margin */
        }
        .container {
            padding: 20px; /* Padding inside container */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Shadow effect */
            background-image: url('pozadina2.png'); /* Background image */
            background-size: cover; /* Cover background */
            background-position: center; /* Center background */
            color: white; /* Text color */
        }
        .header {
            display: flex; /* Use flexbox */
            justify-content: space-between; /* Align items with space between them */
            align-items: center; /* Center items vertically */
            margin-bottom: 20px; /* Bottom margin for header */
        }
        .header h2 {
            margin: 0; /* Remove default margin */
        }
        .logout-btn {
            margin-bottom: 20px; /* Bottom margin for logout button */
        }
        .table-container {
            display: flex; /* Use flexbox */
            justify-content: space-between; /* Align items with space between them */
            margin-bottom: 20px; /* Bottom margin for table container */
            flex-wrap: wrap; /* Allow wrapping of items */
        }
        .table-container .table-wrapper {
            flex: 1; /* Each table container takes up equal space */
            margin-right: 10px; /* Right margin between tables */
        }
        .table-container table {
            width: 100%; /* Set width for tables */
        }
        .table-container table td {
            padding: 8px; /* Add padding to cells */
            background-color: #e6f0ff; /* Light blue background color for cells */
        }
        .table-container table th {
           
            background-color: #e6f0ff; /* Light blue background color for cells */
        }
        .table-container table tr:nth-child(even) {
            background-color: #f2f2f2; /* Light gray background for even rows */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Welcome, <?php echo $_SESSION['ime'] . " " . $_SESSION['prezime']?></h2>
        </div>
        <a href="logout.php" class="btn btn-outline-danger logout-btn">Logout</a>
        
        <div class="table-container pulse-table">
            <div class="table-wrapper">
                <h3>Pulse Data</h3>
                <table class="table">
                    <tr>
                        <th>Date Time</th>
                        <th>Pulse</th>
                    </tr>
                    <?php while($row_pulse = $result_pulse->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row_pulse['time']; ?></td>
                            <td><?php echo $row_pulse['value']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>
            <div class="table-wrapper gsr-table">
                <h3>GSR Data</h3>
                <table class="table">
                    <tr>
                        <th>Date Time</th>
                        <th>GSR</th>
                    </tr>
                    <?php while($row_gsr = $result_gsr->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row_gsr['time']; ?></td>
                            <td><?php echo $row_gsr['value']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>



