<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <title>Cab Booking</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
  <?php echo $__env->make("layouts.navigation", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header text-center">
                    Room Cleaning Service
                </div>
                <div class="card-body">
                    <form id="bookingForm" action="<?php echo e(route("room-cleaning-booking.add")); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <input type="date" class="form-control mb-2 <?php $__errorArgs = ['date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="date" name="date" placeholder="PickUp Date" min="<?php echo e(date('Y-m-d')); ?>" value="<?php echo e(old('date')); ?>">
                            <?php $__errorArgs = ['date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control <?php $__errorArgs = ['time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="time" name="time" placeholder="Time" required>
                            <?php $__errorArgs = ['time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-group">
                            <textarea class="form-control mb-2 <?php $__errorArgs = ['specialRequest'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="3" name="specialRequest" placeholder="Special Request"><?php echo e(old('specialRequest')); ?></textarea>
                            <?php $__errorArgs = ['specialRequest'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    
                        <button type="submit" class="btn btn-primary btn-block">Book</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<center><a href="<?php echo e(route("room-cleaning-list")); ?>" class="btn btn-secondary  mt-3">View Order List</a></center>


<script>
$(document).ready(function(){
    var currentDate = new Date();
    var currentHour = currentDate.getHours();
    var currentMinute = currentDate.getMinutes();

    function formatTime(hours, minutes) {
        var ampm = hours >= 12 ? 'pm' : 'am';
        hours = hours % 12;
        hours = hours ? hours : 12;
        return (hours < 10 ? '0' + hours : hours) + ':' + (minutes < 10 ? '0' + minutes : minutes) + ' ' + ampm;
    }

    $('#date').on('change', function() {
        $('#time').val('');
        var selectedDate = new Date($(this).val());
        var currentDate = new Date();
        
        if (selectedDate.getDate() === currentDate.getDate() && 
            selectedDate.getMonth() === currentDate.getMonth() &&
            selectedDate.getFullYear() === currentDate.getFullYear()) {
            // Selected date is today
            var currentHour = currentDate.getHours();
            var currentMinute = currentDate.getMinutes();
            currentMinute += 10;
            if (currentMinute >= 60) {
                currentHour++;
                currentMinute -= 60;
            }
            
            var minTime = formatTime(currentHour, currentMinute);
            $('#time').timepicker('option', 'minTime', minTime);
        } else {
            // Selected date is not today
            $('#time').timepicker('option', 'minTime', '8:00am');
        }
    });

    $('#time').timepicker({
        'minTime': '8:00am',
        'maxTime': '10:30pm',
        'showDuration': false,
    });

    $('#bookingForm').on('submit', function(event) {
        event.preventDefault(); 
        fetch($(this).attr('action'), {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
            },
            body: new URLSearchParams(new FormData(this))
        })
        .then(response => {
            if (response.ok) {
                swal({
                    icon: 'success',
                    title: 'Booking Successful',
                    text: 'Your room cleaning Service has been booked successfully!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    window.location.href = "<?php echo e(route('room-cleaning-list')); ?>";
                });
            } else {
                throw new Error('Network response was not ok');
            }
        })
        .catch(error => {
            swal({
                icon: 'error',
                title: 'Booking Failed',
                text: 'There was an error while processing your booking. Please try again later.',
            });
        });
    });
});
</script>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\rsapp\resources\views/roomcleaning.blade.php ENDPATH**/ ?>