<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        .login-container {
            text-align: center;
        }
        .or-separator {
            margin: 10px 0;
        }
    </style>
</head>
<body>

    <div class='login-container'>
    <?php
        session_start();
        if(isset($_SESSION['errorMsg']) && !($_SESSION['errorMsg']=="")) {
            echo "<div id='error-msg' class='error-message'>". $_SESSION['errorMsg'] ."</div>";
            $_SESSION['errorMsg']="";
            
        }
    ?>
        <h2>Login</h2>
        <form action="authenticate.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        
        <label for="register">Don't have an account?</label>
        <br>
        <a href="register.php" class="btn btn-primary">Register</a>
    </div>
    
    <script>
        setTimeout(() => {
            document.getElementById('error-msg').classList.add('display-none');
        }, 5000);
    </script>
</body>
</html>
