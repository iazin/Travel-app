$('#addTripForm').submit(function(e) {
    e.preventDefault();
    var formData = $(this).serialize();

    $.ajax({
        type: 'POST',
        url: './add_trip.php',
        data: formData,
        success: function(response) {
            console.log('The trip has been added.');
            $('#addTripModal').modal('hide');
            window.location.reload();
        },
        error: function() {
            console.error('Error adding trip!');
        }
    });
});

$('#editTripForm').submit(function(e) {
    e.preventDefault();
    var formData = $(this).serialize();

    $.ajax({
        type: 'POST',
        url: './edit_trip.php',
        data: formData,
        success: function(response) {
            console.log('The trip has been edited.');
            $('#editTripModal').modal('hide');
            window.location.reload();
        },
        error: function() {
            console.error('Error editing trip!');
        }
    });
});


function deleteTrip(tripId) {
    if (confirm('Are you sure?')) {
        $.ajax({
            type: 'POST',
            url: './delete_trip.php',
            data: { trip_id: tripId },
            success: function(response) {
                console.log('The trip has been deleted:', response);
                window.location.reload();
            },
            error: function() {
                console.error('Error deleting trip!');
            }
        });
    }
}

function deleteUser(userId) {
    if (confirm('Are you sure?')) {
        $.ajax({
            type: 'POST',
            url: './delete_user.php',
            data: { user_id: userId },
            success: function(response) {
                console.log('The account has been deleted:', response);
                window.location.reload();
            },
            error: function() {
                console.error('Error deleting account!');
            }
        });
    }
}

$(document).ready(function(){
    $("#addTripModal").modal({
        show: false
    });

    $(".btn-add-trip").click(function(){
        $("#addTripModal").modal('show');
    });

    $(".btn-add-trip-close").click(function(){
        $("#addTripModal").modal('hide');
    });
});

$(document).ready(function(){
    $("#editTripModal").modal({
        show: false
    });

    $(".btn-edit-trip").click(function(){
        $("#editTripModal").modal('show');
    });

    $(".btn-edit-trip-close").click(function(){
        $("#editTripModal").modal('hide');
    });
});

function fillEditForm(trip) {
    document.getElementById('trip_id_editform').value = trip.id;
    document.getElementById('title_editform').value = trip.title;
    document.getElementById('description_editform').value = trip.description;
    document.getElementById('start_date_editform').value = trip.start_date;
    document.getElementById('end_date_editform').value = trip.end_date;
    document.getElementById('place_editform').value = trip.place;
}