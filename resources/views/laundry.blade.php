@extends('layouts.main')
@section('title', 'Extra Bed')
@include('layouts.navigation')
@section('styles')
  <link href="{{ url("css/bookingpage.css") }}" rel="stylesheet">
@endsection
@section('main-content')
<div class="container-fluid px-0">
    <div class="row justify-content-center mt-5 p-0">
        <div class="col-md-12 p-0">
            <div class="img-container">
                <img src="{{ asset('images/laundry.jpg') }}" class="img-fluid">
                <div class="dark-overlay"></div>
                <h2 class="text-overlay">Laundry</h2>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-2 p-0">
        <div class="col-md-4 col-sm-6 col-xs-12 "> 
            <div class="form-container">
                
                <form action="{{route("laundry.add")}}" method="POST" id="bookingForm">
                        @csrf
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="laundryType">Options</label>
                            <select class="form-select form-control" id="laundryType" name="laundryType">
                                <option value="">Choose Laundry Service</option>
                                @foreach( $types as $type )
                                <option value="{{$type->id}}">{{$type->title}}</option>
                                @endforeach
                            </select>
                            </div>
                            <div class="form-group">
                            <textarea class="form-control mb-2 @error('specialRequest') is-invalid @enderror" rows="3" name="specialRequest" placeholder="Special Request">{{ old('specialRequest')}}</textarea>
                            @error('specialRequest')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            </div>
                            <center><button type="submit" class="btn btn-primary btn-block">Book</button><center>
                        </div>
                    </form>    
            </div>
        </div>
    </div>
</div>
<center><a href="{{route("laundry.list")}}" class="btn btn-secondary  mt-3">View Order List</a></center>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $('#bookingForm').submit(function(event) {
        event.preventDefault(); 
        if ($('#laundryType').val() === '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please select a laundry service!'
            });
            return;
        }
        fetch($(this).attr('action'), {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: new URLSearchParams(new FormData(this))
        })
        .then(response => {
            if (response.ok) {
                Swal.fire({
                    icon: 'success',
                    title: 'Booking Successful',
                    text: 'Your Service has been booked successfully!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    window.location.href = "{{ route('laundry.list') }}";
                });
            } else {
                throw new Error('Network response was not ok');
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Booking Failed',
                text: 'Enter the required fields or Please try again later.',
            });
        });
    });
</script>
@endsection
