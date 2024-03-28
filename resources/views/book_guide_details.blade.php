<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <div class="container">
        <h1 class="mt-4 mb-4">All Bookings</h1>

        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    {{-- <th>Booking ID</th> --}}
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
                <tr>
                    {{-- <td>{{ $booking->id }}</td> --}}
                    <td>{{ $booking->guide_id }}</td>
                    <td><img src="{{ asset('images/' . $booking->image) }}" alt="Guide Image" style="width: 100px;"></td>
                    <td>{{ $booking->name }}</td>
                    <td>{{ $booking->age }}</td>
                    <td>{{ $booking->date }}</td> 
                    <td>{{ $booking->time }}</td> 
                    <td>{{ $booking->experience }}</td>
                    <td>{{ $booking->price }}</td>
                    <td>
                        {{ $booking->description }}
                    </td>
                    <td>{{ $booking->status }}</td>
                    <td>
                        <button class="btn btn-cancel cancel-booking-btn" data-booking-id="{{ $booking->id }}">Cancel</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
            
        </table>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle click event on cancel booking button
            $('.cancel-booking-btn').click(function() {
                // Get the booking ID from the button's data attribute
                var bookingId = $(this).data('booking-id');
    
                // Store reference to the cancel button
                var cancelButton = $(this);
    
                // Show confirmation dialog using SweetAlert
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You are about to cancel this booking!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, cancel it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Disable the cancel button while processing
                        cancelButton.prop('disabled', true);
    
                        // User confirmed, send AJAX request to cancel booking
                        $.ajax({
                            method: 'POST',
                            url: '/cancel-booking/' + bookingId,
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                // Hide the cancel button
                                cancelButton.hide();
    
                                // Store the cancelled booking ID in local storage
                                var cancelledBookings = JSON.parse(localStorage.getItem('cancelledBookings')) || [];
                                cancelledBookings.push(bookingId);
                                localStorage.setItem('cancelledBookings', JSON.stringify(cancelledBookings));
    
                                // Show success message
                                Swal.fire(
                                    'Cancelled!',
                                    'Your booking has been cancelled.',
                                    'success'
                                );
    
                                // Reload the page after a short delay
                                setTimeout(function() {
                                    location.reload();
                                }, 500); // 500 milliseconds = 0.5 second
                            },
                            error: function(xhr, status, error) {
                                // Enable the cancel button
                                cancelButton.prop('disabled', false);
    
                                // Show error message
                                Swal.fire(
                                    'Error!',
                                    'Failed to cancel booking. Please try again later.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
    
            // Check if there are any cancelled bookings stored in local storage
            var cancelledBookings = JSON.parse(localStorage.getItem('cancelledBookings')) || [];
            cancelledBookings.forEach(function(bookingId) {
                // Hide the cancel button for each cancelled booking
                $('[data-booking-id="' + bookingId + '"]').hide();
            });
        });
    </script>
</body>
</html>
