<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="register-container">
        <h2>Registration</h2>
        <form action="register_user.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>

            <label for="ime">Ime:</label>
            <input type="text" id="ime" name="ime" required><br>
            <label for="prezime">Prezime:</label>
            <input type="text" id="prezime" name="prezime" required><br>
            
            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>