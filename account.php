<?php
session_start();
require_once '.\includes\functions.php';
$appFunctions = new TravelAppFunctions();

if (!$appFunctions->isUserLoggedIn()) 
{
    session_destroy();
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$userData = $appFunctions->getUser($user_id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['update_account'])) 
    {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $appFunctions->editUser($user_id, $username, $email, $password);
        header('Location: trips.php');
        exit();
    } 
    elseif (isset($_POST['delete_account'])) 
    {
        $appFunctions->deleteUser($user_id);
        session_destroy();
        header('Location: index.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account</title>
    <link rel="stylesheet" href=".\styles\bootstrap.min.css">
    <link rel="stylesheet" href=".\styles\bootstrap-icons-1.11.3\font\bootstrap-icons.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Account settings</h1>
                <form method="post" action="account.php">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($userData['username']); ?>" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($userData['email']); ?>" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
                    <button type="submit" name="update_account" class="btn btn-primary">Save changes</button>
                </form>
                <form method="post" action="account.php" class="mt-3">
                    <button type="submit" name="delete_account" class="btn btn-danger">Delete account</button>
                </form>
                <form class="mt-3">
                    <a href=".\trips.php" name="Back" class="btn btn-secondary"><-- Back</a>
                </form>
            </div>
        </div>
    </div>

    <script src=".\scripts\jquery-3.7.1.min.js"></script>
    <script src=".\scripts\bootstrap.min.js"></script>
    <script src=".\scripts\script.js"></script>
</body>
</html>
