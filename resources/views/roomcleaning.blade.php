@extends('layouts.main')
@section('title', 'Room Cleaning')
@include('layouts.navigation')
@section('styles')
  <link href="{{ url("css/bookingpage.css") }}" rel="stylesheet">
@endsection
@section('main-content')
<div class="container-fluid px-0">
    <div class="row justify-content-center mt-5 p-0">
        <div class="col-md-12 p-0">
            <div class="img-container">
                <img src="{{ asset('images/room_cleaning2.jpg') }}" class="img-fluid">
                <div class="dark-overlay"></div>
                <h2 class="text-overlay">Book a Room Cleaning Appointment</h2>
            </div>
        </div>
        </div>
        <div class="row justify-content-center mt-2 p-0">
        <div class="col-md-4 col-sm-6 col-xs-12"> 
            <div class="form-container">
                <form id="bookingForm" action="{{ route("room-cleaning-booking.add") }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="date" class="form-control mb-2 @error('date') is-invalid @enderror" id="date" name="date" placeholder="PickUp Date" min="{{ date('Y-m-d') }}" value="{{ old('date')}}" required>
                        @error('date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control mb-2 @error('time') is-invalid @enderror" id="time" name="time" placeholder="Time" required>
                        @error('time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <textarea class="form-control mb-2 @error('specialRequest') is-invalid @enderror" rows="3" name="specialRequest" placeholder="Special Request">{{ old('specialRequest')}}</textarea>
                        @error('specialRequest')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                
                    <center><button type="submit" class="btn btn-primary btn-block">Book</button></center>
                </form>
            </div>
        </div>
    </div>
</div>

<center><a href="{{ route("room-cleaning-list") }}" class="btn btn-secondary mt-1">View Order List</a></center>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    var currentDate = new Date();
    var currentHour = currentDate.getHours();
    var currentMinute = currentDate.getMinutes();

    function formatTime(hours, minutes) {
        var ampm = hours >= 12 ? 'pm' : 'am';
        hours = hours % 12;
        hours = hours ? hours : 12;
        return (hours < 10 ? '0' + hours : hours) + ':' + (minutes < 10 ? '0' + minutes : minutes) + ' ' + ampm;
    }

    $('#date').on('change', function() {
        $('#time').val('');
        var selectedDate = new Date($(this).val());
        var currentDate = new Date();
        
        if (selectedDate.getDate() === currentDate.getDate() && 
            selectedDate.getMonth() === currentDate.getMonth() &&
            selectedDate.getFullYear() === currentDate.getFullYear()) {
            // Selected date is today
            var currentHour = currentDate.getHours();
            var currentMinute = currentDate.getMinutes();
            var roundedMinute = Math.ceil(currentMinute / 15) * 15; 
            if (roundedMinute >= 60) {
                currentHour++;
                roundedMinute -= 60;
            }
            var minTimeHour = currentHour;
            var minTimeMinute = roundedMinute + 10;
            if (minTimeMinute >= 60) {
                minTimeHour++;
                minTimeMinute -= 60;
            }
            var minTime = formatTime(minTimeHour, minTimeMinute);
            $('#time').timepicker('option', 'minTime', minTime);
        } else {
            $('#time').timepicker('option', 'minTime', '8:00am');
        }
    });

    $('#time').timepicker({
        'minTime': '8:00am',
        'maxTime': '10:30pm',
        'showDuration': false,
    });

    $('#bookingForm').on('submit', function(event) {
        event.preventDefault(); 
        
        var form = $(this);
        
        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: form.serialize(), 
            success: function(response) {
                swal.fire({
                    icon: 'success',
                    title: 'Booking Successful',
                    text: 'Your service has been booked successfully!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    window.location.href = "{{ route('room-cleaning-list') }}";
                });
            },
            error: function(xhr, status, error) {
                swal.fire({
                    icon: 'error',
                    title: 'Booking Failed',
                    text: 'There was an error while processing your booking. Please try again later.',
                });
            }
        });
    });

});
</script>

@endsection
