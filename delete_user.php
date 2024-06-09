<?php
include '.\includes\functions.php';
$travelApp = new TravelAppFunctions();
session_start();

if (!$travelApp->isUserLoggedIn()) 
{
    session_destroy();
    header('Location: index.php');
    exit();
}

$id = $_POST['user_id'];
$travelApp->deleteUser($id);
header('Location: index.php');
exit();
?>
