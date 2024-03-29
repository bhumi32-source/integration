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
                <img src="{{ asset('images/extra-bed.jpg') }}" class="img-fluid">
                <div class="dark-overlay"></div>
                <h2 class="text-overlay">Order Extra Bed</h2>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-2 p-0">
        <div class="col-md-4 col-sm-6 col-xs-12 "> 
            <div class="form-container">
                <form id="bookingForm" action="{{ route('extra-bed.add') }}" method="POST">
                    @csrf
                    <label for="quantity">Rate</label>
                    <div class="form-group">
                        <input type="text" name="rate" value="&#8377; {{ $rate->rate }}" class="form-control mb-2" required readonly>
                    </div>
                    <div class="form-group">
                        <input type="number" id="quantity" name="quantity" placeholder="No. Of Beds Required" class="form-control mb-2" min="1" required>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control mb-2 @error('specialRequest') is-invalid @enderror" rows="3" name="specialRequest" placeholder="Special Request">{{ old('specialRequest')}}</textarea>
                        @error('specialRequest')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="total_amount">Total Amount</label>
                        <input type="text" id="total_amount" name="total_amount" class="form-control mb-2" readonly>
                    </div>
                    <center><button type="submit" class="btn btn-primary btn-block">Order</button></center>
                </form>
            </div>
        </div>
    </div>
</div>

<center><a href="{{ route("extra-bed-orders") }}" class="btn btn-secondary mt-3">View Order List</a></center>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){

        document.getElementById('quantity').addEventListener('input', function() {
            var rate = parseFloat(document.getElementsByName('rate')[0].value.replace('₹ ', '').trim());
            var quantity = parseInt(this.value);
            var total_amount = rate * quantity;
            document.getElementById('total_amount').value = '₹ ' + total_amount.toFixed(2);
        });

        $('#bookingForm').on('submit', function(event) {
            event.preventDefault(); 

            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Booking Successful',
                            text: 'Your service has been booked successfully!',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.href = "{{ route('extra-bed-orders') }}";
                        });
                    } else {
                        throw new Error('Booking failed');
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Booking Failed',
                        text: 'Enter the required Number of Beds or Please try again later.',
                    });
                }
            });
        });
    });
</script>

@endsection
