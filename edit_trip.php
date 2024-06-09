<?php
include '.\includes\functions.php';
$travelApp = new TravelAppFunctions();

if ($_SERVER['REQUEST_METHOD'] != 'POST') 
{
    if (!$travelApp->isUserLoggedIn()) {
        header('Location: login.php');
        exit();
    }
}

$trip_id = $_POST['trip_id'];
$title = $_POST['title'];
$description = $_POST['description'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$place = $_POST['place'];

$travelApp->updateTrip($trip_id, $title, $description, $start_date, $end_date, $place);
?>
