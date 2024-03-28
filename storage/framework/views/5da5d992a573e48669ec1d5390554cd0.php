<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Laundry Orders</title>
</head>
<body>
  <?php echo $__env->make("layouts.navigation", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="container mt-5">

        <a href="<?php echo e(route("laundry")); ?>" class="btn btn-secondary my-3">Book Service</a>
    
    <table class="table table-striped text-center">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Booking No.</th>
                <th scope="col">Service</th>
                <th scope="col">Details</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($order->booking_reference_number); ?></td>
                    <td><?php echo e($order->laundry_service_type); ?></td>
                    <td><i class="fa-solid fa-circle-info mt-1" id="helpicon<?php echo e($loop->iteration); ?>" data-bs-toggle="popover" title="<?php echo e($order->special_request ? $order->special_request : 'NA'); ?>" tabindex="0"></i></td>
                        
                </tr>                      
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
      
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl);
        });

        document.addEventListener('click', function (event) {
            if (!event.target.closest('.popover')) {
                popoverList.forEach(function (popover) {
                    popover.hide();
                });
            }
        });
    });
</script>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\rsapp\resources\views/laundryorders.blade.php ENDPATH**/ ?>