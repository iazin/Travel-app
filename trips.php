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


$trips = $appFunctions->getUserTrips($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trips</title>
    <link rel="stylesheet" href=".\styles\bootstrap.min.css">
    <link rel="stylesheet" href=".\styles\bootstrap-icons-1.11.3\font\bootstrap-icons.min.css">
    <style>
        .card-trip {
            margin-bottom: 1rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }
        .btn-icon {
            margin-right: 0.5rem;
        }
        .row {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -15px 30px;
        }
        .card {
        flex: 1 0 33%;
        padding: 0 15px;
        margin-bottom: 15px;
        }
        .card-content {
        height: 100px;
        border-radius: 10px;
        background-color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-3">Welcome, <?php echo $_SESSION['username']; ?>!</h1>
        <div class="d-flex justify-content-around my-3">
            <button type="button" class="btn btn-success mb-3 btn-add-trip" data-toggle="modal" data-target="#addTripModal">
                <i class="bi bi-plus-circle btn-icon"></i> Add trip
            </button>
            <a href=".\logout.php" type="button" class="btn btn-danger mb-3">
                <i class="bi bi-box-arrow-right btn-icon"></i> Logout
            </a>
            <a href=".\account.php" type="button" class="btn btn-primary mb-3">
                <i class="bi bi-person-circle btn-icon"></i> Account
            </a>
        </div>

        <div class="row">
            <?php 
            if ($trips != NULL)
            {
                foreach ($trips as $trip)
                {
                    $title = htmlspecialchars($trip['title'], ENT_QUOTES, 'UTF-8');
                    $start_date = htmlspecialchars($trip['start_date'], ENT_QUOTES, 'UTF-8');
                    $end_date = htmlspecialchars($trip['end_date'], ENT_QUOTES, 'UTF-8');
                    $place = htmlspecialchars($trip['place'], ENT_QUOTES, 'UTF-8');
                    $description = htmlspecialchars($trip['description'], ENT_QUOTES, 'UTF-8');
                    $id = $trip['id'];
                    echo "<div class='col-md-4'>";
                    echo "<div class='card card-trip'>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>{$title}</h5>";
                    echo "<h6 class='card-subtitle mb-2 text-muted'>{$start_date} - {$end_date}</h6>";
                    echo "<p class='card-text'><strong>Place:</strong> {$place}</p>";
                    echo "<p class='card-text'>{$description}</p>";
                    $json_trip = json_encode($trip);
                    echo "<a href='#' class='card-link btn-edit-trip' data-toggle='modal' data-target='#editTripModal' onclick='fillEditForm({$json_trip})'>Edit</a>";
                    echo "<a href='#' class='card-link' onclick='deleteTrip({$id})'>Delete</a>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            }
            ?>
        </div>
    </div>

    <div class="modal fade" id="addTripModal" tabindex="-1" role="dialog" aria-labelledby="addTripModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTripModalLabel">Add trip</h5>
                </div>
                <form id="addTripForm">
                    <div class="modal-body">
                        
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" required>
                            </div>
                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input type="date" class="form-control" id="end_date" name="end_date" required>
                            </div>
                            <div class="form-group">
                                <label for="place">Place</label>
                                <input type="text" class="form-control" id="place" name="place" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" required></textarea>
                            </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add trip</button>
                        <button type="button" class="btn btn-primary btn-add-trip-close" data-toggle="modal" data-target="#addTripModal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editTripModal" tabindex="-1" role="dialog" aria-labelledby="editTripModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTripModalLabel">Edit trip</h5>
                </div>
                <form id="editTripForm">
                    <div class="modal-body">
                            <input type="hidden" id="trip_id_editform" name="trip_id">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title_editform" name="title" required>
                            </div>
                            <div class="form-group">
                                <label for="start_date">Start date</label>
                                <input type="date" class="form-control" id="start_date_editform" name="start_date" required>
                            </div>
                            <div class="form-group">
                                <label for="end_date">End date</label>
                                <input type="date" class="form-control" id="end_date_editform" name="end_date" required>
                            </div>
                            <div class="form-group">
                                <label for="place">Place</label>
                                <input type="text" class="form-control" id="place_editform" name="place" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description_editform" name="description" required></textarea>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-primary btn-edit-trip-close" data-toggle="modal" data-target="#editTripModal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src=".\scripts\jquery-3.7.1.min.js"></script>
    <script src=".\scripts\bootstrap.min.js"></script>
    <script src=".\scripts\script.js"></script>
</body>
</html>
