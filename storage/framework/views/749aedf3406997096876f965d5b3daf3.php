<!DOCTYPE html>
<html lang="en">
<head>
    <title>Order Success</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        h2 {
            color: #3498db;
        }

        p {
            font-size: 18px;
        }

        .btn-primary {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }

        .btn-primary:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
      <?php echo $__env->make("layouts.navigation", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                <h2>Order Successful</h2>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12">
                <p>Your order has been placed successfully. Your Order Will Shortly Arrive!</p>
            </div>
        </div>

       <div class="row mt-3">
            <div class="col-12 text-end">
                <!-- Add the button here -->
                <!-- order_success.blade.php -->
 <a href="<?php echo e(route('past_order.index')); ?>" class="btn btn-primary">View Past Orders</a>
            </div>
        </div>
    </div>

    <!-- Include necessary JS scripts here -->
</body>
</html>
<?php /**PATH C:\xampp\htdocs\rsapp\resources\views/order-success.blade.php ENDPATH**/ ?>