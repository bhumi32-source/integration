<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cab Booking</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.js"></script>

  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
  <!-- Navigation Bar -->
  @include("layouts.navigation")
<br>
<div class="container mt-5">
    <div class="row justify-content-center ">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <form id="loginForm" action="{{ route("cab-booking.add") }}" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="tripType">Options</label>
                            <select class="form-select form-control" id="tripType" name="tripType">
                                <option {{ old('tripType') ? '' : 'selected' }} disabled>Choose Your Trip Type</option>
                                <option value="OneWay" {{ old('tripType') == 'OneWay' ? 'selected' : '' }}>One Way</option>
                                <option value="RoundTrip" {{ old('tripType') == 'RoundTrip' ? 'selected' : '' }}>Round Trip</option>
                                <option value="Rentals" {{ old('tripType') == 'Rentals' ? 'selected' : '' }}>Rentals</option>
                            </select>
                        </div>
                        <div id="oneWayForm" class="form-group @if(old('tripType') == 'OneWay' || $errors->has('tripType')) d-block @endif" style="display: none;">
                            <input type="text" class="form-control mb-1 @error('pickupLocationOneWay') is-invalid @enderror" name="pickupLocationOneWay" placeholder="PickUp Location" value="{{ old('pickupLocationOneWay') }}">
                            @error('pickupLocationOneWay')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <input type="text" class="form-control mb-1 @error('dropLocationOneWay') is-invalid @enderror" name="dropLocationOneWay" placeholder="Drop Location" value="{{ old('dropLocationOneWay')}}">
                            @error('dropLocationOneWay')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <input type="date" class="form-control mb-1 @error('pickupDateOneWay') is-invalid @enderror" name="pickupDateOneWay" placeholder="PickUp Date" min="{{ date('Y-m-d') }}" value="{{ old('pickupDateOneWay')}}">
                            @error('pickupDateOneWay')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <input type="text" class="form-control mb-1 pickup-time @error('pickupTimeOneWay') is-invalid @enderror" name="pickupTimeOneWay" id="pickupTimeOneWay" placeholder="PickUp Time" value="{{ old('pickupTimeOneWay')}}">
                            @error('pickupTimeOneWay')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <input type="number" class="form-control mb-1 @error('numberOfPersonsOneWay') is-invalid @enderror" name="numberOfPersonsOneWay" placeholder="Number of Persons" min="1" value="{{ old('numberOfPersonsOneWay')}}">
                            @error('numberOfPersonsOneWay')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <textarea class="form-control mb-2 @error('specialRequestOneWay') is-invalid @enderror" rows="3" name="specialRequestOneWay" placeholder="Special Request">{{ old('specialRequestOneWay')}}</textarea>
                            @error('specialRequestOneWay')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <button type="submit" class="btn btn-primary btn-block">Book One Way Cab</button>
                        </div>


                        <div id="roundTripForm" class="form-group @if(old('tripType') == 'RoundTrip' || $errors->has('tripType')) d-block @endif" style="display: none;">
                            <input type="text" class="form-control mb-1 @error('pickupLocationRoundTrip') is-invalid @enderror" name="pickupLocationRoundTrip" placeholder="PickUp Location" value="{{ old('pickupLocationRoundTrip') }}">
                            @error('pickupLocationRoundTrip')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <input type="text" class="form-control mb-1 @error('dropLocationRoundTrip') is-invalid @enderror" name="dropLocationRoundTrip" placeholder="Drop Location" value="{{ old('dropLocationRoundTrip')}}">
                            @error('dropLocationRoundTrip')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <input type="date" class="form-control mb-1 @error('pickupDateRoundTrip') is-invalid @enderror" name="pickupDateRoundTrip" placeholder="PickUp Date" min="{{ date('Y-m-d') }}" value="{{ old('pickupDateRoundTrip')}}">
                            @error('pickupDateRoundTrip')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <input type="text" class="form-control mb-1 pickup-time @error('pickupTimeRoundTrip') is-invalid @enderror" name="pickupTimeRoundTrip" id="pickupTimeRoundTrip" placeholder="PickUp Time" value="{{ old('pickupTimeRoundTrip')}}">
                            @error('pickupTimeRoundTrip')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <input type="number" class="form-control mb-1 @error('numberOfPersonsRoundTrip') is-invalid @enderror" name="numberOfPersonsRoundTrip" placeholder="Number of Persons" min="1" value="{{ old('numberOfPersonsRoundTrip')}}">
                            @error('numberOfPersonsRoundTrip')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <textarea class="form-control mb-2 @error('specialRequestRoundTrip') is-invalid @enderror" rows="3" name="specialRequestRoundTrip" placeholder="Special Request">{{ old('specialRequestRoundTrip')}}</textarea>
                            @error('specialRequestRoundTrip')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <button type="submit" class="btn btn-primary btn-block">Book Round Trip</button>
                        </div>

                        <div id="rentalsForm" class="form-group @if(old('tripType') == 'Rentals' || $errors->has('tripType')) d-block @endif" style="display: none;">
                            <input type="text" class="form-control mb-1 @error('pickupLocationRentals') is-invalid @enderror" name="pickupLocationRentals" placeholder="PickUp Location" value="{{ old('pickupLocationRentals') }}">
                            @error('pickupLocationRentals')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <input type="date" class="form-control mb-1 @error('pickupDateRentals') is-invalid @enderror" name="pickupDateRentals" placeholder="PickUp Date" min="{{ date('Y-m-d') }}" value="{{ old('pickupDateRentals')}}">
                            @error('pickupDateRentals')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <input type="text" class="form-control mb-1 pickup-time @error('pickupTimeRentals') is-invalid @enderror" name="pickupTimeRentals" id="pickupTimeRentals" placeholder="PickUp Time" value="{{ old('pickupTimeRentals')}}">
                            @error('pickupTimeRentals')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <input type="number" class="form-control mb-1 @error('numberOfPersonsRentals') is-invalid @enderror" name="numberOfPersonsRentals" placeholder="Number of Persons" min="1" value="{{ old('numberOfPersonsRentals')}}">
                            @error('numberOfPersonsRentals')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <input type="text" class="form-control mb-1 @error('numberOfHoursRentals') is-invalid @enderror" name="numberOfHoursRentals" placeholder="Number of Hours" value="{{ old('numberOfHoursRentals')}}">
                            @error('numberOfHoursRentals')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <textarea class="form-control mb-2 @error('specialRequestRentals') is-invalid @enderror" rows="3" name="specialRequestRentals" placeholder="Special Request">{{ old('specialRequestRentals')}}</textarea>
                            @error('specialRequestRentals')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <button type="submit" class="btn btn-primary btn-block">Book Rental Cab</button>
                        </div>

                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<center><a href="{{ route("cab-order-list") }}" class="btn btn-secondary  mt-3">View Order List</a></center>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        $('#tripType').on('change', function() {
            var selectedOption = $(this).val();

            $('#oneWayForm, #roundTripForm, #rentalsForm').hide();
            if(selectedOption === 'OneWay') {
                $('#oneWayForm').show();
            } else if(selectedOption === 'RoundTrip') {
                $('#roundTripForm').show();
            } else if(selectedOption === 'Rentals') {
                $('#rentalsForm').show();
            }
        });

       function setMinTimeForTimePicker(selectedDate, timePickerId) {
            var currentDate = new Date();
            var currentHour = currentDate.getHours();
            var currentMinute = currentDate.getMinutes();

            if (selectedDate.getDate() === currentDate.getDate() && 
                selectedDate.getMonth() === currentDate.getMonth() &&
                selectedDate.getFullYear() === currentDate.getFullYear()) {
                // Selected date is today
                currentHour += 2; // Minimum time 2 hours ahead of current time
                if (currentMinute >= 60) {
                    currentHour++;
                    currentMinute -= 60;
                }
                if(16<=currentMinute<=29){
                    currentMinute = 30;
                }
                var minTime = currentHour + ':' + (currentMinute < 10 ? '0' + currentMinute : currentMinute);
                $(timePickerId).timepicker('option', 'minTime', minTime);
                $(timePickerId).timepicker('option', 'maxTime', '11:45pm');
            } else {
                // Selected date is not today
                $(timePickerId).timepicker('option', 'minTime', null);
            }
        }

        // Event handler for date change
        $('input[type="date"]').on('change', function() {
            var selectedDate = new Date($(this).val());
            setMinTimeForTimePicker(selectedDate, '#pickupTimeOneWay');
            setMinTimeForTimePicker(selectedDate, '#pickupTimeRoundTrip');
            setMinTimeForTimePicker(selectedDate, '#pickupTimeRentals');
        });

        // Initialize time pickers
        $('.pickup-time').timepicker({
            showDuration: false,
            scrollbar: true,
            step: 15
        }); 
        
        
    /*    $('#loginForm').on('submit', function(event) {
            event.preventDefault();

            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            fetch($(this).attr('action'), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-CSRF-TOKEN': csrfToken 
                },
                body: new URLSearchParams(new FormData(this))
            })
            .then(response => {
                if (response.ok) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Booking Successful',
                        text: 'Your cab booking has been successful!',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    setTimeout(function() {
                        window.location.href = "{{ route('cab-order-list') }}";
                    }, 1500);
                } else {
                    throw new Error('Network response was not ok');
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Booking Failed',
                    text: 'There was an error while processing your booking. Please try again later.',
                });
            });
        });     */
    

    });
</script>

</body>
</html>
