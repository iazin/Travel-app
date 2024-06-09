<?php
session_start();
require_once '.\includes\functions.php';
$appFunctions = new TravelAppFunctions();

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if($appFunctions->getUserId($username) != NULL)
    {
        echo "<script>alert('Username is taken!');</script>";
    }
    else
    {
        $registerSuccess = $appFunctions->register($username, $email, $password);
        if ($registerSuccess) 
        {
            $loginSuccess = $appFunctions->login($username, $password);
            if ($loginSuccess) 
            {
                $_SESSION['username'] = $username;
                $_SESSION['user_id'] = $appFunctions->getUserId($username);
                header('Location: trips.php');
                exit();
            } 
            else 
            {
                header('Location: login.php');
                exit();
            }
        } 
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Travel-app Registration</title>
    <link rel="stylesheet" href=".\styles\bootstrap.min.css">
    <link rel="stylesheet" href=".\styles\bootstrap-icons-1.11.3\font\bootstrap-icons.min.css">
    <style>
        .form-shadow {
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }
        .error-message {
            color: #dc3545;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="mt-5 text-center">Registration</h2>
                <div class="form-shadow mt-4">
                    <form action="register.php" method="post" id="registrationForm">
                        <div class="form-group mb-3">
                            <label for="username"><i class="bi bi-person-fill"></i> Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email"><i class="bi bi-envelope-fill"></i> Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password"><i class="bi bi-lock-fill"></i> Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100"><i class="bi bi-box-arrow-in-right"></i> Register</button>
                    </form>
                    <a href="./login.php">Already have an account? Login</a>
                    <?php if (isset($registerSuccess) && !$registerSuccess): ?>
                        <p class="error-message"><i class="bi bi-exclamation-triangle-fill"></i> Registration error. Try again. </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script src=".\scripts\bootstrap.min.js"></script>
    <script>
        document.getElementById('registrationForm').addEventListener('submit', function(event) {
            var username = document.getElementById('username').value;
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            if(username.length < 5) 
            {
                alert('Username must be at least 5 characters long!');
                event.preventDefault();
            } else if(password.length < 8) 
            {
                alert('Password must be at least 8 characters long!');
                event.preventDefault();
            } else if(!email.includes('@')) 
            {
                alert('Please enter a valid email address!');
                event.preventDefault();
            } 
        });
    </script>
</body>
</html>
