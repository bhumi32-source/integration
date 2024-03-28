<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Linen Cart</title>
    <!-- Include necessary stylesheets, such as Bootstrap or custom CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: 500;
            color: #333;
        }
        .list-group-item {
            border: none;
            padding: 20px 0;
        }
        .list-group-item img {
            width: 100px;
            height: auto;
            border-radius: 5px;
        }
        .list-group-item .col-md-9 {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .list-group-item h5 {
            margin: 0;
            font-size: 1.2rem;
            color: #333;
        }
        .list-group-item p {
            margin: 5px 0;
            font-size: 1rem;
            color: #555;
        }
        #buttonContainer {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        #backBtn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
            font-size: 1rem;
            font-weight: 500;
        }
        #backBtn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
      @include("layouts.navigation")
    <div class="container">
        <h1>Linen Cart</h1>
        <ul id="cartItemList" class="list-group">
            <!-- Cart items will be dynamically added here -->
            @forelse($cartItems as $index => $cartItem)
                <li class="list-group-item" data-item-id="{{ $cartItem->id }}" data-original-quantity="{{ $cartItem->quantity }}">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="{{ asset('images/' . $cartItem->image_path) }}" alt="{{ $cartItem->name }}" class="img-fluid rounded">
                        </div>
                        <div class="col-md-9">
                            <h5>{{ $cartItem->name }}</h5>
                            <p>Price: Rs. {{ $cartItem->price }}</p>
                            <!-- Display quantity with a span having class "quantity" -->
                            <p>Quantity: <span class="quantity" data-linen-id="{{ $cartItem->id }}">{{ $cartItem->quantity }}</span></p>
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
            <a href="{{ route('linen.index') }}" id="backBtn">Back</a>
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
        function removeCartItem(linenId) {
            // Make an AJAX request to remove the item from the cart
            $.ajax({
                type: 'DELETE',
                url: '{{ route("linen.removeCartItem") }}',
                data: {
                    linen_id: linenId,
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    // Remove the item from the page
                    $(`li[data-item-id="${linenId}"]`).remove();
                },
                error: function(error) {
                    console.error(error);
                    // Handle error if needed
                }
            });
        }

         // Function to update quantity and send AJAX request
       function updatePlaceOrderButton() {
            var cartItemCount = $('.list-group-item').length;
            if (cartItemCount > 0) {
                $('#placeOrderBtn').prop('disabled', false);
            } else {
                $('#placeOrderBtn').prop('disabled', true);
            }
        }

        // Function to remove cart item
        function removeCartItem(linenId) {
            // AJAX request to remove the item from the cart
            $.ajax({
                type: 'DELETE',
                url: '{{ route("linen.removeCartItem") }}',
                data: {
                    linen_id: linenId,
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    // Remove the item from the page
                    $(`li[data-item-id="${linenId}"]`).remove();
                    // Update the state of the "Place Order" button
                    updatePlaceOrderButton();
                },
                error: function(error) {
                    console.error(error);
                    // Handle error if needed
                }
            });
        }

        // Function to update quantity and send AJAX request
        function updateQuantity(linenId, change) {
            // AJAX request to update the quantity of the item in the cart
            $.ajax({
                type: 'PATCH',
                url: '{{ route("linen.updateQuantity") }}',
                data: {
                    linen_id: linenId,
                    quantity: change,
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    // Update quantity on the page
                    var newQuantity = parseInt($('.quantity[data-linen-id="' + linenId + '"]').text()) + change;
                    if (newQuantity < 1) {
                        newQuantity = 1;
                    }
                    $('.quantity[data-linen-id="' + linenId + '"]').text(newQuantity);
                    // Update the state of the "Place Order" button
                    updatePlaceOrderButton();
                },
                error: function(error) {
                    console.error(error);
                    // Handle error if needed
                }
            });
        }

        // Function to place order
        function placeOrder() {
            // AJAX request to place the order
            $.ajax({
                type: 'POST',
                url: '{{ route("placeOrder") }}',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    // Display success message using SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: 'Order Successful!',
                        text: response.message,
                        timer: 3000,
                        showConfirmButton: true
                    }).then(() => {
                        // Redirect to the past_linen page after a delay
                        window.location.href = '{{ route("past_linen") }}';
                    });
                },
                error: function(error) {
                    console.error('Error placing order:', error);
                    // Handle error if needed
                }
            });
        }

        $(document).ready(function() {
            // Initially update the state of the "Place Order" button
            updatePlaceOrderButton();

            // Bind click event to place order button
            $('#placeOrderBtn').click(function() {
                placeOrder();
            });
        });
    </script>
</body>
</html>
