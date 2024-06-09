<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Travel-app</title>
    <link rel="stylesheet" href=".\styles\bootstrap.min.css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        .bg {
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .btn-primary:hover {
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
            transform: scale(1.05);
        }
        .btn-success:hover {
            box-shadow: 0 0 10px rgba(40, 167, 69, 0.5);
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="bg d-flex align-items-center justify-content-center">
        <div class="text-center">
            <h1 class="mb-4">Welcome to Travel-app!</h1>
            <p class="lead mb-4">Plan your trips easily!</p>
            <a href="login.php" class="btn btn-primary btn-lg">Login</a>
            <a href="register.php" class="btn btn-success btn-lg">Registration</a>
        </div>
    </div>

    <script src=".\scripts\bootstrap.min.js"></script>
</body>
</html>
