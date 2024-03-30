@include("layouts.navigation")

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Decoration</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .decoration-image {
            max-width: 100%;
            max-height: 200px;
            width: auto;
            height: auto;
        }

        .decoration-info {
            margin-bottom: 10px;
        }

        .success-message {
            color: green;
        }

        /* Custom CSS to increase width of select */
        select[name="booking_time_from"] {
            width: 150px;
            /* Adjust width as needed */
        }

        /* Custom CSS to increase width of select */
        select[name="booking_time_to"] {
            width: 150px;
            /* Adjust width as needed */
        }
        /* Custom CSS for the table */
        .custom-table {
         border: 1px solid #dee2e6; /* Add a thin border */
        }

    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
   </head>

<body>
      
      <div class="container mt-5">
        <h1 class="mt-4">Custom Decoration</h1>
    
        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <a href="order/decoration" class="btn btn-primary">Show orders</a>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Event Time Range</th>
                                <th>Booking Time From</th>
                                <th>Booking Time To</th>
                                <th>Booking Date</th>
                                <th>Booking</th> <!-- Booking button column -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($decorations as $decoration)
                            <tr id="decoration_{{ $decoration->id }}">
                                <td><img class="decoration-image" src="{{ asset('images/' . $decoration->image) }}" alt="{{ $decoration->name }} Image"></td>
                                <td><strong>{{ $decoration->name }}</strong></td>
                                <td>₹ {{ $decoration->price }}</td>
                                <td>
                                    <div class="description-container">
                                        <div id="description_{{ $decoration->id }}" style="display: none;">
                                            {{ $decoration->description }}
                                        </div>
                                        <br>
                                        <button type="button" class="btn btn-primary" onclick="toggleDescription({{ $decoration->id }})">View</button>
                                    </div>
                                </td>
                                <td>{{ $decoration->booking_time_from }} - {{ $decoration->booking_time_to }}</td>
                                <td>
                                    <form action="{{ route('decoration.book', ['id' => $decoration->id]) }}" method="post" class="book-form">
                                        @csrf
                                        <div class="form-group">
                                            <label for="booking_time_from_{{ $decoration->id }}">Booking Time From:</label>
                                            <select name="booking_time_from" id="booking_time_from_{{ $decoration->id }}" class="form-control booking-time-from" required>
                                                <option value="">Select From</option>
                                            </select>
                                        </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <label for="booking_time_to_{{ $decoration->id }}">Booking Time To:</label>
                                        <select name="booking_time_to" id="booking_time_to_{{ $decoration->id }}" class="form-control booking-time-to" required>
                                            <option value="">Select To</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <label for="booking_date">Booking Date:</label>
                                        <input type="date" name="booking_date" class="form-control" id="booking_date_{{ $decoration->id }}" required min="{{ date('Y-m-d') }}">
                                    </div>
                                </td>
                                <td>
                                    <input type="hidden" name="decoration_id" value="{{ $decoration->id }}">
                                    <!-- Other form fields -->
                                    <br>
                                    <button type="submit" class="btn btn-primary book-btn">Book</button>
                                </td>
                                </form>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    
        <div class="row mt-4">
            <div class="col">
                <div class="success-message" id="successMessage" style="display: none;">Your order is successfully placed.</div>
            </div>
        </div>
    </div>
    
    <!-- Include jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Include Sweet Alert library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- JavaScript to handle form submission and show Sweet Alert -->
    <script>
        $(document).ready(function() {
            // Listen for form submission
            $('form.book-form').on('submit', function(event) {
                event.preventDefault(); // Prevent default form submission
                var form = $(this);
    
                // Send AJAX request
                $.ajax({
                    method: form.attr('method'),
                    url: form.attr('action'),
                    data: form.serialize(),
                    success: function(response) {
                        // Show success message using Sweet Alert
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Booking successful.',
                        }).then(function() {
                            // Redirect to the order/decoration route after the alert is closed
                        window.location.href = "order/decoration";

                        });
                    },
                    error: function(xhr, status, error) {
                        // Show error message using Sweet Alert
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Failed to book guide. Please try again later.',
                        });
                    }
                });
            });
        });
    </script>
    

    
    
    
    <!-- JavaScript to handle form submission and show Sweet Alert -->
<script>
    // Disable past dates in the date input
    var today = new Date().toISOString().split('T')[0];
    document.getElementById("date").setAttribute("min", today);
</script>
    

    <script>

        document.addEventListener('DOMContentLoaded', function() {
        // Add event listeners and manipulate DOM elements here
        // For example:
        var button = document.getElementById('myButton');
        button.addEventListener('click', function() {
        // Handle button click event
        console.log('Button clicked!');
        });

        // You can also manipulate DOM elements here
        var paragraph = document.getElementById('myParagraph');
        paragraph.textContent = 'New content for the paragraph';
        });

    </script>

    <script>
        function populateFormFields(decorationId) {
        var decorationRow = document.getElementById('decoration_' + decorationId);
        var bookingTimeFrom = decorationRow.querySelector('.booking-time-from').value;
        var bookingTimeTo = decorationRow.querySelector('.booking-time-to').value;
        var bookingDate = decorationRow.querySelector('.booking-date').value;

        var form = document.getElementById('form_' + decorationId);
        form.querySelector('input[name="booking_time_from"]').value = bookingTimeFrom;
        form.querySelector('input[name="booking_time_to"]').value = bookingTimeTo;
        form.querySelector('input[name="booking_date"]').value = bookingDate;
        }

        function submitForm(decorationId) {
            populateFormFields(decorationId);
            document.getElementById('form_' + decorationId).submit();
        }

        // Event listener for time selection
        document.querySelectorAll('.booking-time-from, .booking-time-to').forEach(function(select) {
            select.addEventListener('change', function() {
                updateBookingTimeFields();
            });
        });

        document.querySelector('.book-form').addEventListener('submit', function(event) {
        // Update the booking date before submitting the form
        updateBookingTimeFields();
        }); 
</script>



{{-- script to populate time dropdowns and handle selection --}}
<script>
        
    // Function to populate time dropdowns
    function populateTimeDropdowns() {
        // Loop through each decoration row
        document.querySelectorAll('.table tbody tr').forEach(function(row) {
            // Select cells within the current row
            var eventTimeRangeCell = row.querySelector('td:nth-child(5)'); // Selecting the Event Time Range cell
            var timeFromDropdown = row.querySelector('.booking-time-from'); // Selecting the Booking Time From dropdown
            var timeToDropdown = row.querySelector('.booking-time-to'); // Selecting the Booking Time To dropdown
    
            if (eventTimeRangeCell && timeFromDropdown && timeToDropdown) {
                // Extract the starting and ending times from the Event Time Range cell
                var eventTimeRange = eventTimeRangeCell.textContent.trim();
                var startTime = eventTimeRange.split(' - ')[0];
                var endTime = eventTimeRange.split(' - ')[1];
                var startHour = parseInt(startTime.split(':')[0]);
                var startMinute = parseInt(startTime.split(':')[1]);
                var endHour = parseInt(endTime.split(':')[0]);
                var endMinute = parseInt(endTime.split(':')[1]);
    
                // Clear existing options
                timeFromDropdown.innerHTML = '';
                timeToDropdown.innerHTML = '';
    
                // Populate time dropdowns starting from the event start time and ending one slot before the event end time
                for (var hour = startHour; hour < endHour || (hour === endHour && startMinute <= 45); hour++) {
                    for (var minute = (hour === startHour ? startMinute : 0); minute < 60; minute += 15) {
                        // Check if the current time slot exceeds the event end time minus 15 minutes
                        if (hour === endHour && minute >= endMinute - 15) {
                            break; // Skip adding slots beyond the event end time minus 15 minutes
                        }
                        var time = (hour < 10 ? '0' + hour : hour) + ':' + (minute < 10 ? '0' + minute : minute);
                        var option = new Option(time, time);
                        timeFromDropdown.appendChild(option.cloneNode(true));
                    }
                }
    
                // Populate the Booking Time To dropdown starting from 15 minutes after the selected Booking Time From
                var selectedFromTime = timeFromDropdown.value;
                var selectedFromHour = parseInt(selectedFromTime.split(':')[0]);
                var selectedFromMinute = parseInt(selectedFromTime.split(':')[1]) + 15;
                if (selectedFromMinute >= 60) {
                    selectedFromHour += 1;
                    selectedFromMinute -= 60;
                }
                // Continue adding slots until the end time of the Event Time Range
                for (var hour = selectedFromHour; hour < endHour || (hour === endHour && selectedFromMinute <= endMinute); hour++) {
                    for (var minute = (hour === selectedFromHour ? selectedFromMinute : 0); minute < 60; minute += 15) {
                        // Check if the current time slot exceeds the event end time
                        if (hour === endHour && minute > endMinute) {
                            break; // Skip adding slots beyond the event end time
                        }
                        var time = (hour < 10 ? '0' + hour : hour) + ':' + (minute < 10 ? '0' + minute : minute);
                        var option = new Option(time, time);
                        timeToDropdown.appendChild(option.cloneNode(true));
                    }
                }
                // Add the end time of the Event Time Range to the Booking Time To dropdown without seconds
                var endTimeWithoutSeconds = endTime.split(':').slice(0, 2).join(':');
                var endTimeOption = new Option(endTimeWithoutSeconds, endTimeWithoutSeconds);
                timeToDropdown.appendChild(endTimeOption);
            }
        });
    }
    
    // Call the function to populate time dropdowns when the DOM is ready
    document.addEventListener('DOMContentLoaded', function() {
        populateTimeDropdowns();
    });
    
</script>
    
    
    
    
    






<script>
    function toggleDescription(decorationId) {
        var description = document.getElementById('description_' + decorationId);
        if (description) {
            var button = document.getElementById('view_button_' + decorationId);
            if (description.style.display === 'none' || description.style.display === '') {
                description.style.display = 'block';
                button.textContent = 'Hide';
            } else {
                description.style.display = 'none';
                button.textContent = 'View';
            }
        }
    }

    // Function to handle form submission
    function submitForm(decorationId) {
        // Set the decoration ID in the corresponding form input field
        var form = document.getElementById('form_' + decorationId);
        if (form) {
            var decorationIdField = form.querySelector('input[name="decoration_id"]');
            if (decorationIdField) {
                decorationIdField.value = decorationId;
            }
        }
    }
</script>


</body>

</html>
