<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toiletries Cart</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
            display: flex;
            align-items: center;
        }

        img {
            width: 100px;
            height: auto;
            margin-right: 20px;
        }

        p {
            margin: 0;
        }

        /* Positioning for buttons */
        #buttonContainer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        #backBtn, #placeOrderBtn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }

        #backBtn {
            background-color: #6c757d;
            color: #fff;
            text-decoration: none;
        }

        #backBtn:hover {
            background-color: #495057;
        }

        #placeOrderBtn {
            background-color: #007bff;
            color: #fff;
        }

        #placeOrderBtn:hover {
            background-color: #0056b3;
        }

        .input-group-prepend,
        .input-group-append {
            position: relative;
            display: flex;
        }

        .input-group-append .btn {
            z-index: 1;
        }
    </style>
</head>
<body>
      @include("layouts.navigation")
    <div class="container">
        <h1>Toiletries Cart</h1>
        <ul id="cartItemList" class="list-group">
            <!-- Cart items will be dynamically added here -->
            @forelse($cartItems as $index => $cartItem)
                <li class="list-group-item" data-item-id="{{ $cartItem->id }}" data-original-quantity="{{ $cartItem->quantity }}">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="{{ asset('images/' . $cartItem->image_path) }}" alt="{{ $cartItem->name }}" class="img-fluid rounded">
                        </div>
                        <div class="col-md-9">
                            <h5>{{ $index + 1 }}. {{ $cartItem->name }}</h5>
                            <p>Price: Rs. {{ $cartItem->price }}</p>
                            <p>Quantity: <span class="quantity" data-toiletries-id="{{ $cartItem->id }}">{{ $cartItem->quantity }}</span></p>
                            <div class="input-group">
                                <button class="btn btn-outline-secondary" type="button" onclick="updateQuantity('{{ $cartItem->id }}', -1)">-</button>
                                <button class="btn btn-outline-secondary" type="button" onclick="updateQuantity('{{ $cartItem->id }}', 1)">+</button>
                                <button class="btn btn-danger ms-1" type="button" onclick="removeCartItem('{{ $cartItem->id }}')">Remove</button>
                            </div>
                        </div>
                    </div>
                </li>
            @empty
                <li class="list-group-item">Your cart is empty</li>
            @endforelse
        </ul>
        
        <div id="buttonContainer">
            <a href="{{ route('toiletries.index') }}" id="backBtn">Back</a>
            @if(count($cartItems) > 0)
                <button id="placeOrderBtn">Place Order</button>
            @else
                <button id="placeOrderBtn" disabled>Place Order</button>
                <div id="successMessageContainer"></div>
            @endif
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        // Retrieve cart items from the server-side and convert them to a JavaScript variable
        var cartItems = {!! json_encode($cartItems) !!};

        // Function to remove cart item
        function removeCartItem(toiletriesId) {
            // Make an AJAX request to remove the item from the cart
            $.ajax({
                type: 'DELETE',
                url: '{{ route("toiletries.removeCartItem") }}',
                data: {
                    toiletries_id: toiletriesId,
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    // Remove the item from the page
                    $(`li[data-item-id="${toiletriesId}"]`).remove();
                },
                error: function(error) {
                    console.error(error);
                    // Handle error if needed
                }
            });
        }
// Function to update quantity and send AJAX request
function updateQuantity(toiletriesId, change) {
    // Make an AJAX request to update the quantity of the item in the cart
    $.ajax({
        type: 'PATCH',
        url: '{{ route("toiletries.updateQuantity") }}',
        data: {
            toiletries_id: toiletriesId,
            quantity_change: change, // Send the change in quantity
            _token: '{{ csrf_token() }}',
        },
        success: function(response) {
            // Update quantity on the page
            var newQuantity = parseInt($('.quantity[data-toiletries-id="' + toiletriesId + '"]').text()) + change;
            // Ensure the new quantity is at least 1
            if (newQuantity < 1) {
                newQuantity = 1;
            }
            // Update the quantity display on the page
            $('.quantity[data-toiletries-id="' + toiletriesId + '"]').text(newQuantity);
        },
        error: function(error) {
            console.error(error);
            // Handle error if needed
        }
    });
}



        $(document).ready(function() {
            // Bind click event to place order button
            $('#placeOrderBtn').click(function() {
                placeOrder(); // Call the placeOrder function when the button is clicked
            });
        });

        // Function to place order
        function placeOrder() {
            // Make an AJAX request to place the order
            $.ajax({
                type: 'POST',
                url: '{{ route("ToiletriesPlaceOrder") }}',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    // Display success message using SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: 'Order Successful!',
                        text: response.message,
                        timer: 3000, // Display alert for 3 seconds
                        showConfirmButton: true
                    }).then(() => {
                        // Redirect to the past_toi page after a delay
                        window.location.href = '{{ route("past_toi") }}';
                    });
                },
                error: function(error) {
                    console.error('Error placing order:', error);
                    // Handle error if needed
                }
            });
        }
    </script>
</body>
</html>
