<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Extra Bed Order</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
  @include("layouts.navigation")
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header text-center">
                   Order Extra Bed
                </div>
                <div class="card-body">
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
                        
                        <center><button type="submit" class="btn btn-primary btn-block">Book</button></center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<center><a href="{{ route("extra-bed-orders") }}" class="btn btn-secondary  mt-3">View Order List</a></center>

<script>
    document.getElementById('quantity').addEventListener('input', function() {
        var rate = parseInt(document.getElementsByName('rate')[0].value.replace('₹ ', '').trim());
        var quantity = parseInt(this.value);
        var total_amount = rate * quantity;
        document.getElementById('total_amount').value = '₹ ' + total_amount.toFixed(2);
    });
</script>

</body>
</html>
