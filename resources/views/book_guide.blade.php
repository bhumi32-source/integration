@include("layouts.navigation")


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guide Details</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /* Custom CSS for styling */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .table-responsive {
            overflow-x: auto;
        }
        th, td {
            text-align: center;
        }
        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
      

{{-- <p>This is my seesion id : {{$guestId}}</p>  --}}

    <div class="container mt-5">
        <h1 class="mt-4 mb-4">Guide Details</h1>
        <div class="table-responsive">
            <a href="{{ route('book_guide_details') }}" class="btn btn-primary">Show Details</a>
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Guide ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Experience</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Booking Date</th>
                        <th>Booking Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($guides as $guide)
                    <tr>
                        <td>{{ $guide->guide_id }}</td>
                        <td><img src="/images/{{ $guide->image }}" alt="{{ $guide->name }}"></td>
                        <td>{{ $guide->name }}</td>
                        <td>{{ $guide->age }}</td>
                        <td>{{ $guide->experience }}</td>
                        <td>{{ $guide->price }}</td>
                        <td>
                            <!-- Description section -->
                            <div class="description" id="description_{{ $guide->guide_id }}" style="display: none;">
                                {!! nl2br(e($guide->description)) !!}
                            </div>
                            <!-- View button to toggle description -->
                            <button class="btn btn-primary view-description-btn" data-toggle-id="{{ $guide->guide_id }}">View</button>
                        </td>
                        
                        
                        <form class="bookingForm" method="POST" action="{{ route('book_guide.book', ['id' => $guide->id]) }}">
                            @csrf
                            <!-- Hidden input fields -->
                            <input type="hidden" name="guide_id" value="{{ $guide->guide_id }}">
                            <input type="hidden" name="name" value="{{ $guide->name }}">
                            <input type="hidden" name="age" value="{{ $guide->age }}">
                            <input type="hidden" name="experience" value="{{ $guide->experience }}">
                            <input type="hidden" name="image" value="{{ $guide->image }}">
                            <input type="hidden" name="price" value="{{ $guide->price }}">
                            <input type="hidden" name="description" value="{{ $guide->description }}">
                            <!-- Date input field -->
                            <td><input type="date" name="date" class="form-control" required min="{{ date('Y-m-d') }}"></td>
                            <!-- Time select field -->
                            <td>
                                <select name="time" class="form-select" required>
                                    <!-- Loop to generate time options with 15-minute intervals -->
                                    @for ($hour = 0; $hour < 24; $hour++)
                                        @for ($minute = 0; $minute < 60; $minute += 15)
                                            <!-- Format the hour and minute values with leading zeros -->
                                            @php
                                                $hourFormatted = str_pad($hour, 2, '0', STR_PAD_LEFT);
                                                $minuteFormatted = str_pad($minute, 2, '0', STR_PAD_LEFT);
                                            @endphp
                                            <!-- Display time option -->
                                            <option value="{{ $hourFormatted }}:{{ $minuteFormatted }}">{{ $hourFormatted }}:{{ $minuteFormatted }}</option>
                                        @endfor
                                    @endfor
                                </select>
                            </td>
                            <!-- Button to submit the form -->
                            <td><button type="submit" class="btn btn-primary book-btn">Book</button></td>
                        </form>
                        
                       
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
        $('.bookingForm').submit(function(event) {
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
                        // Redirect to the book_guide_details route after the alert is closed
                        window.location.href = "{{ route('book_guide_details') }}";
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




    <script>

            // Handle click event on view description button
            $('.view-description-btn').click(function() {
                var guideId = $(this).data('toggle-id');
                var descriptionDiv = $('#description_' + guideId);
                descriptionDiv.toggle();
            });
    </script>


<!-- JavaScript to handle form submission and show Sweet Alert -->
<script>
    // Disable past dates in the date input
    var today = new Date().toISOString().split('T')[0];
    document.getElementById("date").setAttribute("min", today);
</script>

<!-- JavaScript to toggle description -->
<script>
    $(document).ready(function() {
        // Handle click event on view description button
        $('.view-description-btn').click(function() {
            var guideId = $(this).data('toggle-id');
            var descriptionDiv = $('#description_' + guideId);
            descriptionDiv.toggleClass('expanded');
            if (descriptionDiv.hasClass('expanded')) {
                descriptionDiv.slideDown();
                $(this).text('Hide');
            } else {
                descriptionDiv.slideUp();
                $(this).text('View');
            }
        });
    });
</script>

</body>

</html>
