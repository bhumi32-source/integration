<!DOCTYPE html>
<html lang="en">

<head>
    <title>Toiletries</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            background-color: #f0f0f0;
            margin: 0;
            padding-top: 60px;
            font-family: Arial, sans-serif;
        }
        #cartButton {
            position: fixed;
            top: 20px; /* Adjusted position from top */
            right: 20px; /* Adjusted position from right */
            z-index: 1;
            padding: 10px;
            font-size: 16px;
            background-color: #008a00; /* Green color */
            color: white; /* White text color */
            border: none;
            border-radius: 3px;
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        #cartButton i {
            margin-right: 5px;
        }

        #cartButton:hover {
            background-color: #006e00; /* Darken the color on hover */
        }

        #hero-section {
            background-image: url('<?php echo e(asset('images/img.jpg')); ?>');
            background-size: cover;
            background-position: center;
            height: 50vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            position: relative;
        }

        #hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        #hero-text {
            z-index: 1;
            text-align: center;
        }

        .toiletry-container {
            background-color: white;
            border-radius: 10px;
            margin: 20px auto;
            padding: 20px;
            max-width: 800px;
        }

        .toiletry-image {
            max-height: 150px;
            width: auto;
        }

        .input-group button {
            color: black;
        }

        .input-group .btn-success {
            border-radius: 0;
        }

        .input-group .form-control {
            border-radius: 0;
            padding: 5px;
            width: 50px; /* Adjusted width */
        }

        .input-group-btn {
            display: flex;
            gap: 1px;
        }

        .badge {
            border-radius: 3px;
            color: white; /* White number color */
            padding: 5px;
            font-size: 12px;
        }
    </style>
</head>

<body>

    <a id="cartButton" href="<?php echo e(route('toiletries.cart')); ?>" class="btn btn-success p-1">
        Cart
        <span id="cartCountBadge" class="badge bg-secondary">0</span>
    </a>

    <div id="hero-section">
        <div id="hero-overlay"></div>
        <div id="hero-text">
            <h1>Order Toiletries</h1>
        </div>
    </div>

   <div class="container-fluid toiletry-container" id="ToiletriesContainer">
    <?php if(isset($toiletries)): ?>
        <?php $__currentLoopData = $toiletries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $toiletry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="row mx-2 mt-3 rounded position-relative align-items-center">
                <div class="col-4 p-0 text-center">
                    <img src="<?php echo e(asset('images/' . $toiletry->image_path)); ?>" class="img-fluid rounded toiletry-image" alt="Toiletry-Image">
                </div>
                <div class="col-8">
                    <div>
                        <b><?php echo e($toiletry->name); ?></b>
                    </div>
                    <div class="input-group input-group-btn">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-secondary" type="button" onclick="adjustQuantity(this, 'decrement')">-</button>
                        </div>
                        <input type="number" class="form-control text-center quantity-input" value="1" data-toiletry-id="<?php echo e($toiletry->id); ?>" min="1">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" onclick="adjustQuantity(this, 'increment')">+</button>
                            <button class="btn btn-success ms-1 addToCartBtn" data-toiletry-id="<?php echo e($toiletry->toiletries_id); ?>" data-toiletry-name="<?php echo e($toiletry->name); ?>" data-toiletry-image="<?php echo e($toiletry->image_path); ?>">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        <p>No toiletries found.</p>
    <?php endif; ?>
</div>


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
   <script>
    // Function to adjust quantity
    function adjustQuantity(button, action) {
        var quantityInput = $(button).closest('.input-group').find('.quantity-input');
        var currentQuantity = parseInt(quantityInput.val()) || 1;

        if (action === 'increment') {
            var newQuantity = currentQuantity + 1;
        } else if (action === 'decrement' && currentQuantity > 1) {
            var newQuantity = currentQuantity - 1;
        } else {
            return;
        }

        quantityInput.val(newQuantity);
        quantityInput.trigger('change');
    }

  $(document).ready(function () {

    // Click event for "Add to Cart" button
    $(document).on('click', '.addToCartBtn', function () {
        var quantityInput = $(this).closest('.input-group').find('.quantity-input');
        var quantity = parseInt(quantityInput.val()) || 1;
        var toiletryId = $(this).data('toiletry-id'); // Corrected attribute name
        var toiletryName = $(this).data('toiletry-name');
        var toiletryImage = $(this).data('toiletry-image');

        // Update the cart badge with the new quantity
        var totalQuantity = parseInt($('#cartCountBadge').text()) + quantity;
        $('#cartCountBadge').text(totalQuantity);

        // Send AJAX request to add item to toiletries_cart table
        $.ajax({
            type: 'POST',
            url: '<?php echo e(route("toiletries.cart.add")); ?>',
            data: {
                toiletries_id: toiletryId, // Corrected field name
                name: toiletryName,
                quantity: quantity,
                image_path: toiletryImage,
                _token: '<?php echo e(csrf_token()); ?>'
            },
            success: function (response) {
                // Handle success response if needed
                console.log(response);
            },
            error: function (error) {
                // Handle error if needed
                console.error(error);
            }
        });

        // Log
        console.log("Added to cart:", toiletryName, "Quantity:", quantity);
    });

    // Function to adjust quantity
    function adjustQuantity(button, action) {
        var quantityInput = $(button).closest('.input-group').find('.quantity-input');
        var currentQuantity = parseInt(quantityInput.val()) || 1;

        if (action === 'increment') {
            var newQuantity = currentQuantity + 1;
        } else if (action === 'decrement' && currentQuantity > 1) {
            var newQuantity = currentQuantity - 1;
        } else {
            return;
        }

        quantityInput.val(newQuantity);
        quantityInput.trigger('change');
    }

});

</script>


</body>

</html>
<?php /**PATH C:\xampp\htdocs\rsapp\resources\views/toiletries.blade.php ENDPATH**/ ?>