<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Past Linen Orders</title>
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
            position: relative; /* Enable positioning for child elements */
        }

        h2 {
            color: #3498db;
            margin-bottom: 20px;
            text-align: center;
        }

        .back-button {
            text-align: center;
            margin-top: 20px;
        }

        .back-button button {
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 5px 10px;
            cursor: pointer;
        }

        .back-button button:hover {
            background-color: #2980b9;
        }

        .order-container {
            margin-bottom: 20px;
            overflow: auto; /* Enable vertical scrolling */
            border-bottom: 2px solid #ddd; /* Add border between order groups */
            padding-bottom: 10px; /* Add padding to separate orders */
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
      <?php echo $__env->make("layouts.navigation", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container">
        <h2>Past Linen Orders</h2>
        <?php if($pastOrders->isNotEmpty()): ?>
            <?php $__currentLoopData = $pastOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pastOrder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="order-container">
                <h3>Order ID: <?php echo e($pastOrder->order_id); ?></h3>
                <h4>Date: <?php echo e($pastOrder->created_at->format('d/m/Y')); ?></h4>
                <button class="toggle-details">More Info</button>
                <div class="order-details">
                    <div class="order-details-container">
                        <div class="image-container">
                            <img src="<?php echo e(asset('images/' . $pastOrder->image_path)); ?>" alt="<?php echo e($pastOrder->name); ?>">
                        </div>
                        <div>
                            <p><strong>Name:</strong> <?php echo e($pastOrder->name); ?></p>
                            <p><strong>Quantity:</strong> <?php echo e($pastOrder->quantity); ?></p>
                            <p><strong>Price:</strong> <?php echo e($pastOrder->price); ?></p>
                            <p class="total-price"><strong>Total Price:</strong> Rs. <?php echo e($pastOrder->quantity * $pastOrder->price); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <p>No past orders available.</p>
        <?php endif; ?>
    </div>

    <div class="back-button">
        <button onclick="window.location.href='<?php echo e(route("linen.index")); ?>'>Back</button>
    </div>

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
<?php /**PATH C:\xampp\htdocs\rsapp\resources\views/past_linen.blade.php ENDPATH**/ ?>