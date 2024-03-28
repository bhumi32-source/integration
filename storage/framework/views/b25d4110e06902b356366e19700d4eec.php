<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>
 
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Room Cleaning Orders</title>
</head>
<body>
      <?php echo $__env->make("layouts.navigation", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <br>
<div class="container mt-4">
    <a href="<?php echo e(route("room-cleaning")); ?>" class="btn btn-secondary my-3">Book Service</a>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" id="upcoming-tab" data-toggle="tab" href="#upcoming" role="tab" aria-controls="upcoming" aria-selected="true">Upcoming</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="view-all-tab" data-toggle="tab" href="#view-all" role="tab" aria-controls="view-all" aria-selected="false">View All</a>
        </li>
    </ul>
    <div class="tab-content mt-3">
        <div class="tab-pane fade show active" id="upcoming" role="tabpanel" aria-labelledby="upcoming-tab">
        <table class="table table-striped" id="futureorders">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Date</th>
        <th scope="col">Time</th>
        <th scope="col">Status</th>
        <th scope="col">Details</th>
        <th scope="col">Action</th>              
        </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $upcomingorders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="order-row">
                        <td><?php echo e($loop->iteration); ?></td>
                        <td><?php echo e(date('d-m-Y', strtotime($order->date))); ?></td>
                        <td><?php echo e(date('h:ia', strtotime($order->time))); ?></td>
                        <td>
                        <?php if($order->status == 1): ?>
                            Waiting for approval
                        <?php elseif($order->status == 2): ?>
                            In Process
                        <?php elseif($order->status == 3): ?>
                            Cancelled
                        <?php elseif($order->status == 4): ?>
                            Confirmed
                        <?php elseif($order->status == 5): ?>
                            Completed
                        <?php elseif($order->status == 6): ?>
                            Awaiting Acknowledgement
                        <?php endif; ?>
                        </td>
                        <td><i class="fa-solid fa-circle-info mt-1" id="helpicon" data-bs-toggle="popover" title="<?php echo e($order->special_request ? $order->special_request : 'NA'); ?>"></i></td>
                        
                        <td>
                            <?php if($order->status != 3 && $order->status != 5): ?>
                                <form id="cancelForm<?php echo e($loop->iteration); ?>" action="<?php echo e(route('rcco', ['id' => $order->id])); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="button" class="btn btn-danger cancel-btn" data-form-id="<?php echo e($loop->iteration); ?>">Cancel</button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
        </div>
        <div class="tab-pane fade" id="view-all" role="tabpanel" aria-labelledby="view-all-tab" >
            <table class="table table-striped" id="all-orders">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">Status</th>
                        <th scope="col">Details</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $allorders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="order-row">
                        <td><?php echo e($loop->iteration); ?></td>
                        <td><?php echo e(date('d-m-Y', strtotime($order->date))); ?></td>
                        <td><?php echo e(date('h:ia', strtotime($order->time))); ?></td>
                        <td>
                        <?php if($order->status == 1): ?>
                            Waiting for approval
                        <?php elseif($order->status == 2): ?>
                            In Process
                        <?php elseif($order->status == 3): ?>
                            Cancelled
                        <?php elseif($order->status == 4): ?>
                            Confirmed
                        <?php elseif($order->status == 5): ?>
                            Completed
                        <?php elseif($order->status == 6): ?>
                            Awaiting Acknowledgement
                        <?php endif; ?>
                        </td>
                        <td><i class="fa-solid fa-circle-info mt-1" id="helpicon" data-bs-toggle="popover" title="<?php echo e($order->special_request ? $order->special_request : 'NA'); ?>"></i></td>
                        
                        <td>
                            <?php if($order->status != 3 && $order->status != 5): ?>
                                <form id="cancelForm<?php echo e($loop->iteration); ?>" action="<?php echo e(route('rcco', ['id' => $order->id])); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="button" class="btn btn-danger cancel-btn" data-form-id="<?php echo e($loop->iteration); ?>">Cancel</button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
       
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

$('.cancel-btn').click(function() {
    var formId = $(this).data('form-id');
    swal({
        title: "Are you sure you want to cancel the order?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willCancel) => {
        if (willCancel) {
            swal("Your order has been cancelled!", {
                icon: "success",
            });
            $('#cancelForm' + formId).submit();
        } else {
            swal("Your order is safe!");
        }
    });
});
</script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\rsapp\resources\views/roomcleaningorder.blade.php ENDPATH**/ ?>