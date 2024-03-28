<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laundry Request</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
   
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.js"></script>

  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
  @include("layouts.navigation")
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{route("laundry.add")}}" method="POST" id="laundryForm">
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
                            <button type="submit" class="btn btn-primary btn-block">Book</button>
                        </div>
                    </form>                  
                </div>
            </div>
        </div>
    </div>
<center><a href="{{route("laundry.list")}}" class="btn btn-secondary  mt-3">View Order List</a></center>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function(){
        $('#laundryForm').submit(function(e){
            if($('#laundryType').val() === ''){
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please select a laundry service!'
                });
            }
        });
    });
</script>
</body>
</html>
