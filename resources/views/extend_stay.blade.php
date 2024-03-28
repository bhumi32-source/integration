<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Extend Stay</title>
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
                    Extend Stay
                </div>
                <div class="card-body">
                    <form id="bookingForm" action="{{ route("extend-stay.add") }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label> Extend Till </label>
                            <input type="date" class="form-control mb-2 @error('date') is-invalid @enderror" id="date" name="date" min="{{ date('Y-m-d') }}" value="{{ old('date')}}">
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
                    
                        <button type="submit" class="btn btn-primary btn-block">Extend</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<center><a href="{{route('extend-stay-list')}}" class="btn btn-secondary mt-3">View List</a></center>
</body>
</html>
