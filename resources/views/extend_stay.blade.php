@extends('layouts.main')
@section('title', 'Extend Stay')
@include('layouts.navigation')
@section('styles')
  <link href="{{ url("css/bookingpage.css") }}" rel="stylesheet">
@endsection
@section('main-content')
<div class="container-fluid px-0">
    <div class="row justify-content-center mt-5 p-0">
        <div class="col-md-12 p-0">
            <div class="img-container">
                <img src="{{ asset('images/extend-stay.jpg') }}" class="img-fluid">
                <div class="dark-overlay"></div>
                <h2 class="text-overlay">Extend Stay</h2>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-2 p-0">
        <div class="col-md-4 col-sm-6 col-xs-12"> 
            <div class="form-container">               
                <form id="bookingForm" action="{{ route("extend-stay.add") }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label> Extend Till </label>
                            <input type="date" class="form-control mb-2 @error('date') is-invalid @enderror" id="date" name="date" min="{{ date('Y-m-d') }}" value="{{ old('date')}}" required>
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <textarea class="form-control mb-2 @error('specialRequest') is-invalid @enderror" rows="3" name="specialRequest" placeholder="Special Request">{{ old('specialRequest')}}</textarea>
                            @error('specialRequest')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <center><button type="submit" class="btn btn-primary btn-block">Extend</button></center>
                    </form>
            </div>
        </div>
    </div>
</div>
<center><a href="{{route('extend-stay-list')}}" class="btn btn-secondary mt-3">View List</a></center>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('#bookingForm').on('submit', function(event) {
            event.preventDefault(); 

            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function(data) {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Booking Successful',
                            text: 'Your service has been booked successfully!',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            window.location.href = "{{ route('extend-stay-list') }}";
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Booking Failed',
                            text: 'There was an error while processing your booking. Please try again later.'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Booking Failed',
                        text: 'Enter the required fields or Please try again later.'
                    });
                }
            });
        });
    });
</script>
@endsection
