<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script> <!-- Include Popper.js for Bootstrap tooltips -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <title>Hotel Facilities</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .facility-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding-top: 20px;
        }

        .facility-card {
            width: 300px;
            margin: 10px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .facility-card:hover {
            transform: translateY(-5px);
        }

        .facility-card img {
            width: 100%;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .facility-info {
            padding: 20px;
        }

        .facility-info h3 {
            margin-top: 0;
            font-size: 1.2rem;
            color: #333;
        }

        .facility-info p {
            margin: 0;
            font-size: 1rem;
            color: #777;
        }

        .facility-info a {
            display: block;
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease-in-out;
        }

        .facility-info a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    @include("layouts.navigation")
    <br><br>
    <h1 style="text-align: center; margin-top: 30px;">Hotel Facilities</h1>

    <div class="facility-container">
        @foreach($facilities as $facility)
            <div class="facility-card">
                <img src="{{ asset('images/' . $facility->image) }}" alt="{{ $facility->name }}">
                <div class="facility-info">
                    <h3>{{ $facility->name }}</h3>
                   <a href="{{ 
                    $facility->name === 'Book_guide' ? 
                    route('book_guide') : 
                    ($facility->name === 'Cab_booking' ? 
                    route('cab-booking') :
                    ($facility->name === 'Spa_booking' ? 
                    route('spa') :
                    route('custom_decoration')))
                    }}">Book Now</a>

                </div>
            </div>
        @endforeach

        <!-- <a href="{{route("cab-booking")}}">Cab booking </a>
    <a href="{{route("spa")}}">Spa Booking</a> -->
    </div>
</body>
</html>

    

    
