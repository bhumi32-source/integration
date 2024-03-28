<!-- File: resources/views/cart.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Cart</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Your custom styles here */
  </style>
</head>
<body>
      <?php echo $__env->make("layouts.navigation", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <div class="container mt-3">
    <div class="row">
      <div class="col-12">
        <h2>Your Cart</h2>
      </div>
    </div>
<div class="row mt-3">
    <div class="col-12">
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
                            <p><?php echo e($cartItem->description); ?></p>
                            <p>Price: Rs. <?php echo e($cartItem->price); ?></p>
                            <p>Quantity: <span class="quantity"><?php echo e($cartItem->quantity); ?></span></p>
                        </div>
                    </div>
                  <!-- Replace the existing button group code -->
<div class="input-group mt-3">
    <div class="input-group-prepend">
        <button class="btn btn-outline-secondary" type="button" onclick="updateQuantity('<?php echo e($cartItem->id); ?>', -1)">-</button>
    </div>
    
    <div class="input-group-append">
        <button class="btn btn-outline-secondary" type="button" onclick="updateQuantity('<?php echo e($cartItem->id); ?>', 1)">+</button>
        <button class="btn btn-danger" type="button" onclick="removeCartItem('<?php echo e($cartItem->id); ?>')">Remove</button>
    
</div>     
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <li class="list-group-item">Your cart is empty</li>
            <?php endif; ?>
        </ul>
    </div>
</div>



    <div class="row mt-3">
      <div class="col-12 text-end">
        <!-- Back button to go back to the food order page -->
        <a href="<?php echo e(route('food.index')); ?>" class="btn btn-secondary">Back</a>
        <?php if(count($cartItems) > 0): ?>
                <button class="btn btn-primary" onclick="placeOrder()">Place Order</button>
            <?php else: ?>
                <button class="btn btn-primary" disabled>Place Order</button>
                <div id="successMessageContainer"></div>
            <?php endif; ?>
      </div>
    </div>
  </div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    // Retrieve cart items from the server-side and convert them to a JavaScript variable
    var cartItems = <?php echo json_encode($cartItems); ?>;
    console.log(cartItems);

    // Function to display cart items on the page
function displayCartItems() {
    // Select the HTML element with the ID 'cartItemList'
    var cartItemList = $('#cartItemList');
    console.log(cartItemList.length); // Check the length

    // Check if there are items in the cart
    if (cartItems.length > 0) {
        // Clear the existing HTML content inside the 'cartItemList' element
        cartItemList.html('');

        // Initialize the total price variable
        var totalPrice = 0;

        // Iterate through each item in the 'cartItems' array
        cartItems.forEach(function(item, index) {
            // Calculate the total price for each item based on the quantity
            var totalItemPrice = item.price * item.quantity;
            
            // Update the total price variable
            totalPrice += totalItemPrice;

            // Create an HTML string for each item
            var cartItem = `
                <li class="list-group-item" data-item-id="${item.id}" data-original-quantity="${item.quantity}">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="<?php echo e(asset('images/')); ?>/${item.image_path}" alt="${item.name}" class="img-fluid rounded">
                        </div>
                        <div class="col-md-9">
                            <h5>${index + 1}. ${item.name}</h5>
                            <p>${item.description}</p>
                            <p>Price For One: Rs. ${item.price}</p>
                            <p>Total Price: Rs. <span class="totalPrice" data-item-id="${item.id}">${totalItemPrice}</span></p>
                            <p>Quantity: <span class="quantity">${item.quantity}</span></p>
                            <div class="input-group">
                                <button class="btn btn-outline-secondary" type="button" onclick="updateQuantity('${item.id}', -1)">-</button>
                                
                                <button class="btn btn-outline-secondary" type="button" onclick="updateQuantity('${item.id}', 1)">+</button>
                                <button class="btn btn-danger ms-1" type="button" onclick="removeCartItem('${item.id}')">Remove</button>
                            </div>
                        </div>
                    </div>
                </li>`;

            // Append the HTML for each item to the 'cartItemList' element
            cartItemList.append(cartItem);
        });

        // Display the total price at the end
        var totalPriceElement = `
            <li class="list-group-item">
                <h5>Total Price: Rs. <span id="overallTotalPrice">${totalPrice}</span></h5>
            </li>`;
        cartItemList.append(totalPriceElement);

        // Update the total price span with the dynamic total price
        $('#overallTotalPrice').text(totalPrice);
    } else {
        // If the cart is empty, display a message
        cartItemList.html('<li class="list-group-item">Your cart is empty</li>');
    }
}


    // Function to remove cart item
     function removeCartItem(itemId) {
        // Make an AJAX request to remove the item from the cart
        $.ajax({
            type: 'DELETE',
            url: '<?php echo e(route("cart.removeCartItem")); ?>', // Updated route name
            data: {
                item_id: itemId,
                _token: '<?php echo e(csrf_token()); ?>',
            },
            success: function(response) {
                console.log(response);
                // Handle success response if needed
                // Remove the item from the page
                $(`li[data-item-id="${itemId}"]`).remove();
            },
            error: function(error) {
                console.error(error);
                // Handle error if needed
            }
        });
    }


    // Function to update quantity and send AJAX request
    // Function to update quantity and send AJAX request
function updateQuantity(itemId, change) {
    var itemIndex = cartItems.findIndex(item => item.id == itemId);
    if (itemIndex !== -1) {
        var originalQuantity = cartItems[itemIndex].quantity;

        // Update quantity locally
        cartItems[itemIndex].quantity += change;

        // Update quantity on the page
        var quantityElement = $(`li[data-item-id="${itemId}"] .quantity`);
        quantityElement.text(cartItems[itemIndex].quantity);

        // Update item price dynamically
        updateItemPrice(itemId);

        // Send AJAX request to update quantity in the database
        $.ajax({
            url: '<?php echo e(route("cart.updateQuantity")); ?>',
            method: 'PATCH',
            data: {
                item_id: itemId,
                quantity: cartItems[itemIndex].quantity,
                _token: '<?php echo e(csrf_token()); ?>',
            },
            success: function(response) {
                console.log(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
}

// Function to update item price dynamically
function updateItemPrice(itemId) {
    var itemIndex = cartItems.findIndex(item => item.id == itemId);
    if (itemIndex !== -1) {
        var totalItemPrice = cartItems[itemIndex].price * cartItems[itemIndex].quantity;

        // Update the total price span with the dynamic total price
        $(`span.totalPrice[data-item-id="${itemId}"]`).text(totalItemPrice);

        // Update the overall total price
        var overallTotalPrice = cartItems.reduce((total, item) => total + item.price * item.quantity, 0);
        $('#overallTotalPrice').text(overallTotalPrice);
    }
}

function placeOrder() {
    // Make an AJAX request to place the order
    $.ajax({
        type: 'POST',
        url: '<?php echo e(route("cart.placeOrder")); ?>',
        data: {
            _token: '<?php echo e(csrf_token()); ?>',
        },
        success: function(response) {
            // Display success message using SweetAlert
            Swal.fire({
                icon: 'success',
                title: 'Order Successful!',
                text: response.message,
                timer: 3000, // Display alert for 4 seconds
                showConfirmButton: false
            }).then(() => {
                // Redirect to the order success page after a delay
                window.location.href = '<?php echo e(route("order-success")); ?>';
            });
        },
        error: function(error) {
            console.error(error);
            // Handle error if needed
        }
    });
}


function displaySuccessMessage(message) {
    // Get the success message container element
    var successMessageContainer = $('#successMessageContainer');

    // Create a new element to hold the success message
    var successMessageElement = $('<div class="alert alert-success" role="alert">' + message + '</div>');

    // Append the success message to the container
    successMessageContainer.html(successMessageElement);

    // Optionally, you can hide the message after a certain duration
    setTimeout(function() {
        successMessageContainer.empty();
    }, 5000); // Hide the message after 5 seconds (adjust the duration as needed)
}




    // Function to initialize the cart page
    function initializeCartPage() {
        displayCartItems();
    }

    // Call the function when the content is loaded
    initializeCartPage();
</script>



</body>
</html>
<?php /**PATH C:\xampp\htdocs\rsapp\resources\views/cart.blade.php ENDPATH**/ ?>