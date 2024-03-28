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
      <?php echo $__env->make("layouts.navigation", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container">
        <h1>Linen Cart</h1>
        <ul id="cartItemList" class="list-group">
            <!-- Cart items will be dynamically added here -->
            <?php $__empty_1 = true; $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $cartItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <li class="list-group-item" data-item-id="<?php echo e($cartItem->id); ?>" data-original-quantity="<?php echo e($cartItem->quantity); ?>">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="<?php echo e(asset('images/' . $cartItem->image_path)); ?>" alt="<?php echo e($cartItem->name); ?>" class="img-fluid rounded">
                        </div>
                        <div class="col-md-9">
                            <h5><?php echo e($cartItem->name); ?></h5>
                            <p>Price: Rs. <?php echo e($cartItem->price); ?></p>
                            <!-- Display quantity with a span having class "quantity" -->
                            <p>Quantity: <span class="quantity" data-linen-id="<?php echo e($cartItem->id); ?>"><?php echo e($cartItem->quantity); ?></span></p>
                            <div class="input-group">
                                <button class="btn btn-outline-secondary" type="button" onclick="updateQuantity('<?php echo e($cartItem->id); ?>', -1)">-</button>
                                <button class="btn btn-outline-secondary" type="button" onclick="updateQuantity('<?php echo e($cartItem->id); ?>', 1)">+</button>
                                <button class="btn btn-danger ms-1" type="button" onclick="removeCartItem('<?php echo e($cartItem->id); ?>')">Remove</button>
                            </div>
                        </div>
                    </div>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <li class="list-group-item">Your cart is empty</li>
            <?php endif; ?>
        </ul>
        <div id="buttonContainer">
            <a href="<?php echo e(route('linen.index')); ?>" id="backBtn">Back</a>
            <?php if(count($cartItems) > 0): ?>
                <button id="placeOrderBtn">Place Order</button>
            <?php else: ?>
                <button id="placeOrderBtn" disabled>Place Order</button>
                <div id="successMessageContainer"></div>
            <?php endif; ?>
        </div>
       
    </div>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script>
        // Retrieve cart items from the server-side and convert them to a JavaScript variable
        var cartItems = <?php echo json_encode($cartItems); ?>;

        // Function to remove cart item
        function removeCartItem(linenId) {
            // Make an AJAX request to remove the item from the cart
            $.ajax({
                type: 'DELETE',
                url: '<?php echo e(route("linen.removeCartItem")); ?>',
                data: {
                    linen_id: linenId,
                    _token: '<?php echo e(csrf_token()); ?>',
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
        function updateQuantity(linenId, change) {
            // Make an AJAX request to update the quantity of the item in the cart
            $.ajax({
                type: 'PATCH',
                url: '<?php echo e(route("linen.updateQuantity")); ?>',
                data: {
                    linen_id: linenId,
                    quantity: change,
                    _token: '<?php echo e(csrf_token()); ?>',
                },
                success: function(response) {
                    // Update quantity on the page
                    $('.quantity[data-linen-id="' + linenId + '"]').text(response.quantity);
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
                url: '<?php echo e(route("placeOrder")); ?>',
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
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
                        window.location.href = '<?php echo e(route("past_linen")); ?>';
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
<?php /**PATH C:\xampp\htdocs\rsapp\resources\views/linen_cart.blade.php ENDPATH**/ ?>