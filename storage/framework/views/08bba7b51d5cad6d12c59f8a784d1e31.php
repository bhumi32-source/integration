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
      <?php echo $__env->make("layouts.navigation", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container">
        <h1>Toiletries Cart</h1>
        <ul id="cartItemList" class="list-group">
            <!-- Cart items will be dynamically added here -->
            <?php $__empty_1 = true; $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $cartItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <li class="list-group-item" data-item-id="<?php echo e($cartItem->id); ?>" data-original-quantity="<?php echo e($cartItem->quantity); ?>">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="<?php echo e(asset('images/' . $cartItem->image_path)); ?>" alt="<?php echo e($cartItem->name); ?>" class="img-fluid rounded">
                        </div>
                        <div class="col-md-9">
                            <h5><?php echo e($index + 1); ?>. <?php echo e($cartItem->name); ?></h5>
                            <p>Price: Rs. <?php echo e($cartItem->price); ?></p>
                            <p>Quantity: <span class="quantity" data-toiletries-id="<?php echo e($cartItem->id); ?>"><?php echo e($cartItem->quantity); ?></span></p>
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
            <a href="<?php echo e(route('toiletries.index')); ?>" id="backBtn">Back</a>
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
        function removeCartItem(toiletriesId) {
            // Make an AJAX request to remove the item from the cart
            $.ajax({
                type: 'DELETE',
                url: '<?php echo e(route("toiletries.removeCartItem")); ?>',
                data: {
                    toiletries_id: toiletriesId,
                    _token: '<?php echo e(csrf_token()); ?>',
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
                url: '<?php echo e(route("toiletries.updateQuantity")); ?>',
                data: {
                    toiletries_id: toiletriesId,
                    quantity: change,
                    _token: '<?php echo e(csrf_token()); ?>',
                },
                success: function(response) {
                    // Update quantity on the page (if necessary)
                    $('.quantity[data-toiletries-id="' + toiletriesId + '"]').text(response.quantity);
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
                        window.location.href = '<?php echo e(route("past_toi")); ?>';
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
<?php /**PATH C:\xampp\htdocs\rsapp\resources\views/toiletries_cart.blade.php ENDPATH**/ ?>