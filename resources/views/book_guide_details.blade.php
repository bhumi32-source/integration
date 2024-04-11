<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>All Bookings</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include SweetAlert library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        /* Custom CSS for styling */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        img.guide-image {
            width: 100px; /* Adjust this value as needed */
            height: auto; /* Automatically adjust the height to maintain aspect ratio */
        }
        .btn-cancel {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-cancel:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
        .description {
            display: none; /* Hide the description by default */
        }
    </style>
</head>
<body>
    @section('content')
    <div class="container">
        <h1 class="mt-4 mb-4">All Bookings</h1>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Guide ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Date</th> 
                    <th>Time</th> 
                    <th>Experience</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <td>{{ $booking->guide_id }}</td>
                    <td><img src="{{ asset('images/' . $booking->image) }}" alt="Guide Image" style="width: 100px;"></td>
                    <td>{{ $booking->name }}</td>
                    <td>{{ $booking->age }}</td>
                    <td>{{ $booking->date }}</td> 
                    <td>{{ $booking->time }}</td> 
                    <td>{{ $booking->experience }}</td>
                    <td>{{ $booking->price }}</td>
                    <td>
                        <!-- Description section -->
                        <div class="description" id="description_{{ $booking->guide_id }}" style="display: none;">
                            {!! nl2br(e($booking->description)) !!}
                        </div>
                        <!-- View button to toggle description -->
                        <button class="btn btn-primary view-description-btn" data-toggle-id="{{ $booking->guide_id }}">View</button>
                    </td>
                    
                    
                    <td>
                        
                        @if($booking->status == 1)
                            Waiting for approval
                        @elseif($booking->status == 2)
                            In Process
                        @elseif($booking->status == 3)
                            Cancelled
                        @elseif($booking->status == 4)
                            Confirmed
                        @elseif($booking->status == 5)
                            Completed
                        @elseif($booking->status == 6)
                            Awaiting Acknowledgement
                        @endif
                    </td>
                    <td>
                        @if($booking->status != 3 && $booking->status != 5)
                            <button class="btn btn-danger cancel-btn" data-booking-id="{{ $booking->guide_id }}">Cancel</button>
                        @endif
                    </td>
                    
                    
                </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    
<script>
    $(document).ready(function() {
        $('.view-description-btn').click(function() {
            var guideId = $(this).data('toggle-id');
            var descriptionDiv = $('#description_' + guideId);

            // Check if the description is currently visible
            if (descriptionDiv.is(':visible')) {
                // If visible, hide the description
                descriptionDiv.slideUp();
            } else {
                // If hidden, make an AJAX request to fetch the guide description
                $.ajax({
                    url: '/guide/booking-description/' + guideId,
                    type: 'GET',
                    success: function(response) {
                        // Update the description section with the fetched description
                        descriptionDiv.html(response.description).slideDown();
                    },
                    error: function(xhr) {
                        console.error(xhr);
                        alert('Failed to retrieve description. See console for details.');
                    }
                });
            }
        });
    });
</script>


<!-- Include SweetAlert CSS and JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script>
    $(document).ready(function() {
        $('.cancel-btn').click(function() {
            var guideId = $(this).data('booking-id');

            // Get CSRF token from the meta tag
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Use SweetAlert for confirmation
            swal({
                title: "Are you sure?",
                text: "Once cancelled, this booking cannot be undone!",
                icon: "warning",
                buttons: ["Cancel", "Yes, cancel it!"],
                dangerMode: true,
            })
            .then((willCancel) => {
                if (willCancel) {
                    // Make AJAX request to cancel the booking
                    $.ajax({
                        url: '/guide/cancel-booking/' + guideId,
                        type: 'PUT', // Use PUT method
                        headers: {
                            'X-CSRF-TOKEN': csrfToken // Include CSRF token in the headers
                        },
                        success: function(response) {
                            console.log(response);
                            swal("Booking cancelled successfully!", {
                                icon: "success",
                            }).then(() => {
                                // Reload the page after confirmation
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            console.error(xhr);
                            swal("Failed to cancel booking!", {
                                icon: "error",
                            });
                        }
                    });
                }
            });
        });
    });
</script>





</script>


</body>
</html>
