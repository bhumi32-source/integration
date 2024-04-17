<!DOCTYPE html>
<html lang="en">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
 
<head>
      @include("layouts.navigation")
    <title>Past Orders</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Global styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            overflow-x: auto; /* Enable horizontal scrolling */
        }

        h2 {
            color: #3498db;
            margin-bottom: 20px;
            text-align: center;
        }

        .order-container {
            margin-bottom: 20px;
            overflow: auto; /* Enable vertical scrolling */
            border-bottom: 2px solid #ddd; /* Add border between order groups */
        }

        .order-details {
            display: none;
            padding: 10px;
            margin-top: 10px;
        }

        .toggle-details {
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 5px 10px; /* Adjust button padding */
            cursor: pointer;
            float: right; /* Align button to the right */
            margin-top: -25px; /* Adjust button position */
        }

        .toggle-details:hover {
            background-color: #2980b9;
        }

        .order-details p {
            margin-bottom: 10px;
        }

        .total-price {
            float: right;
            font-weight: bold;
        }

        .order-details-container {
            display: flex;
        }

        .image-container {
            width: 40%;
            margin-right: 20px;
        }

        .image-container img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        /* Media query for smaller screens */
        @media only screen and (max-width: 600px) {
            .container {
                max-width: 90%;
            }

            .toggle-details {
                margin-top: 0; /* Adjust button position */
                float: none; /* Reset button alignment */
                display: block; /* Make button full width */
                width: 100%; /* Make button full width */
                margin-bottom: 10px; /* Add margin below button */
            }

            .order-details-container {
                flex-direction: column;
            }

            .image-container {
                width: 100%;
                margin-right: 0;
                margin-bottom: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2>Your Past Orders</h2>
        @if($pastOrders->isNotEmpty())
        @php
        $ordersGroupedByOrderId = $pastOrders->groupBy('order_id');
        @endphp

        @foreach($ordersGroupedByOrderId as $orderGroup)
        <div class="order-container">
            <h3>Order ID: {{ $orderGroup->first()->order_id }}</h3>
            <h4>Date: {{ $orderGroup->first()->created_at->format('d/m/Y') }}</h4>
            <button class="toggle-details">More Info</button>
            <div class="order-details">
                @foreach($orderGroup as $pastOrder)
                <div class="order-details-container">
                    <div class="image-container">
                        <img src="{{ asset('images/' . $pastOrder->image_path) }}" alt="{{ $pastOrder->name }}">
                    </div>
                    <div>
                        <p><strong>Name:</strong> {{ $pastOrder->name }}</p>
                        <p><strong>Description:</strong> {{ $pastOrder->description }}</p>
                        <p><strong>Quantity:</strong> {{ $pastOrder->quantity }}</p>
                        <p><strong>Total Price:</strong> {{ $pastOrder->quantity }} * {{ $pastOrder->price }} = Rs.{{ $pastOrder->price * $pastOrder->quantity }}</p>

                    </div>
                </div>
                @endforeach
                <p class="total-price">Total Price for Order: Rs. {{ $orderGroup->sum(function ($item) { return $item->price * $item->quantity; }) }}</p>
            </div>
        </div>
        @endforeach
        @else
        <p>No past orders available.</p>
        @endif
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script>
        // Add event listeners to all toggle-details buttons
        const toggleButtons = document.querySelectorAll('.toggle-details');
        toggleButtons.forEach(button => {
            button.addEventListener('click', () => {
                const details = button.nextElementSibling;
                details.style.display = details.style.display === 'none' ? 'block' : 'none';
            });
        });
    </script>
</body>

</html>
