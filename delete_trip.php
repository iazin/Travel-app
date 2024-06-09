<?php
include '.\includes\functions.php';
$travelApp = new TravelAppFunctions();
session_start();

if (!$travelApp->isUserLoggedIn()) 
{
    session_destroy();
    header('Location: login.php');
    exit();
}

$trip_id = $_POST['trip_id'];
$travelApp->deleteTrip($trip_id);
?>
