<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guide Details</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /* Custom CSS for styling */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .table-responsive {
            overflow-x: auto;
        }
        th, td {
            text-align: center;
        }
        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
      <?php echo $__env->make("layouts.navigation", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container mt-5">
        <h1 class="mt-4 mb-4">Guide Details</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Guide ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Experience</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $guides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($guide->guide_id); ?></td>
                        <td><img src="/images/<?php echo e($guide->image); ?>" alt="<?php echo e($guide->name); ?>"></td>
                        <td><?php echo e($guide->name); ?></td>
                        <td><?php echo e($guide->age); ?></td>
                        <td><?php echo e($guide->experience); ?></td>
                        <td><?php echo e($guide->price); ?></td>
                        <td><?php echo e($guide->description); ?></td>
                        <td>
                            <form method="POST" action="<?php echo e(route('book_guide.book', ['id' => $guide->id])); ?>">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="guide_id" value="<?php echo e($guide->guide_id); ?>">
                                <input type="hidden" name="name" value="<?php echo e($guide->name); ?>">
                                <input type="hidden" name="age" value="<?php echo e($guide->age); ?>">
                                <input type="hidden" name="experience" value="<?php echo e($guide->experience); ?>">
                                <input type="hidden" name="image" value="<?php echo e($guide->image); ?>">
                                <input type="hidden" name="price" value="<?php echo e($guide->price); ?>">
                                <input type="hidden" name="description" value="<?php echo e($guide->description); ?>">
                                <!-- Include other necessary fields here -->
                                <button type="submit" class="btn btn-primary">Book</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\rsapp\resources\views/book_guide.blade.php ENDPATH**/ ?>