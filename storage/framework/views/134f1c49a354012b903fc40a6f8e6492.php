<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Decoration</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
      <?php echo $__env->make("layouts.navigation", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container">
        <h1>Order Decoration</h1>
    
        <!-- Add a button to go back to the hotel facilities page -->
        <a href="/hotel_facilities" class="btn btn-primary mb-3">Hotel Facilities</a>
    
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Decoration ID</th>
                    <th>Decoration Name</th>
                    <th>Price</th>
                    <th>Booking Date</th>
                    <th>Booking Time From</th>
                    <th>Booking Time To</th>
                    <th>Status</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr id="booking_<?php echo e($booking->id); ?>">
                        <td><?php echo e($booking->id); ?></td>
                        <td><?php echo e($booking->decoration_id); ?></td>
                        <td><?php echo e($booking->decoration_name); ?></td>
                        <td><?php echo e($booking->price); ?></td>
                        <td><?php echo e($booking->booking_date); ?></td> <!-- Display booking date -->
                        <td><?php echo e($booking->booking_time_from); ?></td>
                        <td><?php echo e($booking->booking_time_to); ?></td>
                        <td class="status"><?php echo e($booking->status); ?></td>
                        <td><?php echo e($booking->description); ?></td>
                        <td>
                            <?php if($booking->status === 'booked' || $booking->status === 'pending'): ?>
                                <button class="btn btn-danger cancel-btn" data-booking-id="<?php echo e($booking->id); ?>">Cancel</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    
    <script>
        $(document).ready(function () {
            $('.cancel-btn').click(function (e) {
                e.preventDefault();
                var bookingId = $(this).data('booking-id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You are about to cancel this booking.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, cancel it!',
                    cancelButtonText: 'No, keep it'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/cancel-booking/' + bookingId,
                            method: 'PUT',
                            data: {_token: '<?php echo e(csrf_token()); ?>'},
                            success: function (response) {
                                if (response.success) {
                                    $('#booking_' + bookingId).remove();
                                    // Show success notification
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Booking Canceled!',
                                        text: 'Your booking has been canceled successfully.',
                                        showConfirmButton: false,
                                        timer: 2000
                                    }).then(() => {
                                        // Reload the page after successful cancellation
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'Failed to cancel the booking: ' + response.message
                                    });
                                }
                            },
                            error: function (xhr, status, error) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'An error occurred while canceling the booking.'
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
    
    
</body>
</html>
<?php /**PATH C:\xampp\htdocs\rsapp\resources\views/order_decoration.blade.php ENDPATH**/ ?>