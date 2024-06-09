<?php
include '.\includes\functions.php';
$travelApp = new TravelAppFunctions();
session_start();

if ($_SERVER['REQUEST_METHOD'] != 'POST') 
{
    if (!$travelApp->isUserLoggedIn()) {
        session_destroy();
        header('Location: login.php');
        exit();
    }
}

$user_id = $_SESSION['user_id'];
$title = $_POST['title'];
$description = $_POST['description'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$place = $_POST['place'];

$travelApp->createTrip($user_id, $title, $description, $start_date, $end_date, $place);
?>
