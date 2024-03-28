<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <title>Spa Orders</title>
</head>
<body>
  <?php echo $__env->make("layouts.navigation", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="container mt-5">
<a href="<?php echo e(route("spa")); ?>" class="btn btn-secondary my-3">Book Spa</a>
    <ul class="nav nav-tabs" id="myTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="upcoming-tab" data-bs-toggle="tab" data-bs-target="#upcoming" type="button" role="tab" aria-controls="upcoming" aria-selected="true">Upcoming</button>
        </li>
        <li class="nav-item" role="presentation">
        <button class="nav-link" id="viewall-tab" data-bs-toggle="tab" data-bs-target="#viewall" type="button" role="tab" aria-controls="viewall" aria-selected="false">View All</button>
        </li>
    </ul>

    <div class="tab-content mt-3">
        <div class="tab-pane fade show active" id="upcoming" role="tabpanel" aria-labelledby="upcoming-tab">
        <table class="table " id="futureorders">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Booking No.</th>
                        <th scope="col">Date-Time</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Status</th>
                        <th scope="col">Details</th>
                        <th scope="col">Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $upcomingorders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bookingRef => $orders): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $firstOrder = $orders->first(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td>
                                <strong><?php echo e($bookingRef); ?></strong>
                            </td>
                            <td><?php echo e(date('d-m-Y h:ia', strtotime($firstOrder->date . ' ' . $firstOrder->time))); ?></td>
                            <td>&#8377; <?php echo e(number_format($firstOrder->total_amount, 2)); ?></td>
                            <td>
                                <?php if($firstOrder->status == 1): ?>
                                    Waiting for approval
                                <?php elseif($firstOrder->status == 2): ?>
                                    In Process
                                <?php elseif($firstOrder->status == 3): ?>
                                    Cancelled
                                <?php elseif($firstOrder->status == 4): ?>
                                    Confirmed
                                <?php elseif($firstOrder->status == 5): ?>
                                    Completed
                                <?php elseif($firstOrder->status == 6): ?>
                                    Awaiting Acknowledgement
                                <?php endif; ?>
                            </td>
                            <td><i class="fa-solid fa-circle-info mt-1" id="helpicon" data-bs-toggle="popover" title="<?php echo e($firstOrder->special_request ? $firstOrder->special_request : 'NA'); ?>"></i></td>
                            </td>
                            <td>
                                <?php if($firstOrder->status != 3 && $firstOrder->status != 5): ?>
                                    <form id="cancelForm<?php echo e($firstOrder->id); ?>" action="<?php echo e(route('spa-cancel-order', ['id' => $firstOrder->id])); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <button type="button" class="btn btn-danger cancel-btn" data-form-id="<?php echo e($firstOrder->id); ?>">Cancel</button>
                                    </form>
                                <?php endif; ?>
                            </td>
                            <td><button class="btn btn-link toggle-orders" type="button"><i class="fa-solid fa-caret-down"></i></button></td>
                        </tr>
                        <tr class="order-details-row" style="display: none;">
                            <td colspan="8">
                                <ul>
                                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>Service Name: <?php echo e($order->item_name); ?></li>
                                        <?php
                                        $amount = ($order->amount/$order->number_of_persons)
                                        ?>
                                        <li>Amount: <?php echo e($order->number_of_persons); ?> &#215; &#8377; <?php echo e(number_format($amount, 2)); ?> = &#8377; <?php echo e(number_format($order->amount, 2)); ?></li>
                                        <li>No. of persons: <?php echo e($order->number_of_persons); ?></li> 
                                        <li>Duration:
                                            <?php if($order->duration > 60): ?>
                                                <?php $hours = floor($order->duration / 60);
                                                $minutes = $order->duration % 60;
                                                ?>
                                                <?php echo e($hours); ?> hours
                                                <?php if($minutes != 0 ): ?> <?php echo e($minutes); ?> minutes <?php endif; ?>
                                            <?php else: ?>
                                                <?php echo e($order->duration); ?> minutes
                                            <?php endif; ?> </li><br>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="viewall" role="tabpanel" aria-labelledby="viewall-tab">
        <table class="table " id="view-all">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Booking No.</th>
                <th scope="col">Date-Time</th>
                <th scope="col">Amount</th>
                <th scope="col">Status</th>
                <th scope="col">Details</th>
                <th scope="col">Action</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $allorders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bookingRef => $orders): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $firstOrder = $orders->first(); ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td>
                        <strong><?php echo e($bookingRef); ?></strong>
                    </td>
                    <td><?php echo e(date('d-m-Y h:ia', strtotime($firstOrder->date . ' ' . $firstOrder->time))); ?></td>
                    <td>&#8377; <?php echo e(number_format($firstOrder->total_amount, 2)); ?></td>
                    <td>
                        <?php if($firstOrder->status == 1): ?>
                            Waiting for approval
                        <?php elseif($firstOrder->status == 2): ?>
                            In Process
                        <?php elseif($firstOrder->status == 3): ?>
                            Cancelled
                        <?php elseif($firstOrder->status == 4): ?>
                            Confirmed
                        <?php elseif($firstOrder->status == 5): ?>
                            Completed
                        <?php elseif($firstOrder->status == 6): ?>
                            Awaiting Acknowledgement
                        <?php endif; ?>
                    </td>
                
                    <td><i class="fa-solid fa-circle-info mt-1" id="helpicon" data-bs-toggle="popover" title="<?php echo e($firstOrder->special_request ? $firstOrder->special_request : 'NA'); ?>"></i></td>
                    </td>
                    <td>
                        <?php if($firstOrder->status != 3 && $firstOrder->status != 5): ?>
                            <form id="cancelForm<?php echo e($firstOrder->id); ?>" action="<?php echo e(route('spa-cancel-order', ['id' => $firstOrder->id])); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <button type="button" class="btn btn-danger cancel-btn" data-form-id="<?php echo e($firstOrder->id); ?>">Cancel</button>
                            </form>
                        <?php endif; ?>
                    </td>
                    <td><button class="btn btn-link toggle-orders" type="button"><i class="fa-solid fa-caret-down"></i></button></td>
                </tr>
            
                    <tr class="order-details-row" style="display: none;">
                        <td colspan="8">
                            <ul>
                                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>Service Name: <?php echo e($order->item_name); ?></li>
                                    <?php
                                    $amount = ($order->amount/$order->number_of_persons)
                                    ?>
                                    <li>Amount: <?php echo e($order->number_of_persons); ?> &#215; &#8377; <?php echo e(number_format($amount, 2)); ?> = &#8377; <?php echo e(number_format($order->amount, 2)); ?></li>
                                    <li>No. of persons: <?php echo e($order->number_of_persons); ?></li> 
                                    <li>Duration:
                                            <?php if($order->duration > 60): ?>
                                                <?php $hours = floor($order->duration / 60);
                                                $minutes = $order->duration % 60;
                                                ?>
                                                <?php echo e($hours); ?> hours
                                                <?php if($minutes != 0 ): ?> <?php echo e($minutes); ?> minutes <?php endif; ?>
                                            <?php else: ?>
                                                <?php echo e($order->duration); ?> minutes
                                            <?php endif; ?> </li><br>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </td>
                    </tr>
               
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
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

        // Attach click event directly to toggle-orders button
        $('.toggle-orders').click(function() {
            $(this).closest('tr').next('.order-details-row').toggle();
        });
    
</script>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\rsapp\resources\views/spaorders.blade.php ENDPATH**/ ?>