<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu of the Day</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f9f9f9;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            text-align: center;
        }
        .banner {
            background-image: url("{{ asset('images/banner.png') }}");
            background-size: cover;
            background-position: center;
            height: 400px; /* Height of the banner */
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            margin-bottom: 30px;
            animation: fadeIn 1s ease-in-out; /* Fade-in animation */
        }
        .banner::before {
            content: "";
            background: rgba(0, 0, 0, 0.6);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        .item-container {
            display: flex;
            align-items: center;
            margin-top: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease; /* Smooth scale effect on hover */
        }
        .item-container:hover {
            transform: scale(1.02); /* Scale up on hover */
        }
        .item-container img {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 10px 0 0 10px;
        }
        .badge {
            background-color: rgba(0, 128, 0, 0.7);
            color: white;
            padding: 6px 10px;
            font-size: 12px;
            font-weight: bold;
            position: absolute;
            top: 10px;
            right: 10px;
            border-radius: 0 10px 0 10px;
        }
        .item-details {
            padding: 20px;
            flex: 1;
        }
        .item-details b {
            font-size: 20px;
            margin-bottom: 10px;
        }
        .item-details .text-muted {
            color: #666;
        }
        .item-details .price {
            font-size: 18px;
            font-weight: bold;
            color: #f90;
            margin-top: 10px;
        }
        .order-now-btn {
            display: inline-block;
            background-color: #f90;
            color: white;
            padding: 12px 24px;
            font-size: 18px;
            font-weight: bold;
            text-decoration: none;
            border-radius: 30px;
            transition: background-color 0.3s;
            animation: slideIn 1s ease-in-out; /* Slide-in animation */
        }
        .order-now-btn:hover {
            background-color: #e80;
        }

        /* Keyframe animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        @keyframes slideIn {
            from {
                transform: translateY(-20px);
            }
            to {
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
      @include("layouts.navigation")
    <div class="container">
        <div class="banner">
            <div class="banner-content">
                <h1 class="banner-text">Welcome to the Menu of the Day</h1>
            </div>
        </div>

        @foreach($menuItems as $item)
            @if($item->is_menu_item)
                <div class="item-container">
                    <div style="position: relative;">
                        <img src="{{ asset('images/' . $item->image_path) }}" alt="{{ $item->name }}">
                        <div class="badge">Menu of the Day</div>
                    </div>
                    <div class="item-details">
                        <b>{{ $item->name }}</b>
                        <div class="text-muted">{{ $item->description }}</div>
                        <div class="price">Rs. {{ $item->price }}</div>
                    </div>
                </div>
            @elseif(request()->query('from_menu') === 'true')
                <!-- If redirected from menu and item is not menu item, skip displaying -->
            @else
                <div class="item-container">
                    <div style="position: relative;">
                        <img src="{{ asset('images/' . $item->image_path) }}" alt="{{ $item->name }}">
                    </div>
                    <div class="item-details">
                        <b>{{ $item->name }}</b>
                        <div class="text-muted">{{ $item->description }}</div>
                        <div class="price">Rs. {{ $item->price }}</div>
                    </div>
                </div>
            @endif
        @endforeach
             <!-- Add Order Now button -->
        <div style="text-align: center; margin-top: 20px;">
            <a href="{{ route('food.index', ['from_menu' => true]) }}" class="order-now-btn">Order Now </a>
        </div>
    </div>
</body>
</html>

