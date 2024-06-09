<?php
session_start();
require_once '.\includes\functions.php';
$appFunctions = new TravelAppFunctions();

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $loginSuccess = $appFunctions->login($username, $password);

    if ($loginSuccess) 
    {
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $appFunctions->getUserId($username);
        header('Location: trips.php');
        exit();
    } 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Travel-app Login</title>
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
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="mt-5 text-center">Authentication</h2>
                <div class="form-shadow mt-4">
                    <form action="login.php" method="post">
                        <div class="form-group mb-3">
                            <label for="username"><i class="bi bi-person-fill"></i> Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password"><i class="bi bi-lock-fill"></i> Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100"><i class="bi bi-box-arrow-in-right"></i> Login</button>
                    </form>
                    <a href="./register.php">Don't have an account? Register</a>
                    <?php if (isset($loginSuccess) && !$loginSuccess): ?>
                        <p class="error-message mt-3">Authentication error. Try again.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script src=".\scripts\bootstrap.min.js"></script>
</body>
</html>
