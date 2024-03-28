<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Cab Orders</title>
</head>
<body>
<a href="<?php echo e(route("cab-booking")); ?>" class="btn btn-secondary  mt-3">Book Cab</a>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Trip Type</th>
      <th scope="col">PickUp Location</th>
      <th scope="col">Date-Time</th>
      <th scope="col">Drop Location</th>
      <th scope="col">No. of Persons</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

  <?php
    $counter = 1;
  ?>
  <?php $__currentLoopData = $cabbooking; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <?php if($order->status != 3): ?>
    <tr>
        <th scope="row"><?php echo e($counter); ?></th>
        <td><?php echo e($order->trip_type); ?></td>
        <td><?php echo e($order->pickup_location); ?></td>
        <td><?php echo e($order->pickup_date); ?>-<?php echo e($order->pickup_time); ?></td>
        <td><?php echo e($order->drop_location); ?></td>
        <td><?php echo e($order->no_of_persons); ?></td>
        <td> 
            <form action="<?php echo e(route('cancel-order', ['id' => $order->id])); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-danger">Cancel</button>
            </form>
        </td>
    </tr>
    <?php endif; ?>
    <?php
        $counter++;
    ?>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

  </tbody>
</table>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\rsapp\resources\views/cabordercancel.blade.php ENDPATH**/ ?>