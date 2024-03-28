<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cab Booking</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.js"></script>

  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
</head>
<body>
  <!-- Navigation Bar -->
  <?php echo $__env->make("layouts.navigation", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<br>
<div class="container mt-5">
    <div class="row justify-content-center ">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <form id="loginForm" action="<?php echo e(route("cab-booking.add")); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="tripType">Options</label>
                            <select class="form-select form-control" id="tripType" name="tripType">
                                <option <?php echo e(old('tripType') ? '' : 'selected'); ?> disabled>Choose Your Trip Type</option>
                                <option value="OneWay" <?php echo e(old('tripType') == 'OneWay' ? 'selected' : ''); ?>>One Way</option>
                                <option value="RoundTrip" <?php echo e(old('tripType') == 'RoundTrip' ? 'selected' : ''); ?>>Round Trip</option>
                                <option value="Rentals" <?php echo e(old('tripType') == 'Rentals' ? 'selected' : ''); ?>>Rentals</option>
                            </select>
                        </div>
                        <div id="oneWayForm" class="form-group <?php if(old('tripType') == 'OneWay' || $errors->has('tripType')): ?> d-block <?php endif; ?>" style="display: none;">
                            <input type="text" class="form-control mb-1 <?php $__errorArgs = ['pickupLocationOneWay'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="pickupLocationOneWay" placeholder="PickUp Location" value="<?php echo e(old('pickupLocationOneWay')); ?>">
                            <?php $__errorArgs = ['pickupLocationOneWay'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            <input type="text" class="form-control mb-1 <?php $__errorArgs = ['dropLocationOneWay'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="dropLocationOneWay" placeholder="Drop Location" value="<?php echo e(old('dropLocationOneWay')); ?>">
                            <?php $__errorArgs = ['dropLocationOneWay'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            <input type="date" class="form-control mb-1 <?php $__errorArgs = ['pickupDateOneWay'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="pickupDateOneWay" placeholder="PickUp Date" min="<?php echo e(date('Y-m-d')); ?>" value="<?php echo e(old('pickupDateOneWay')); ?>">
                            <?php $__errorArgs = ['pickupDateOneWay'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            <input type="text" class="form-control mb-1 pickup-time <?php $__errorArgs = ['pickupTimeOneWay'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="pickupTimeOneWay" id="pickupTimeOneWay" placeholder="PickUp Time" value="<?php echo e(old('pickupTimeOneWay')); ?>">
                            <?php $__errorArgs = ['pickupTimeOneWay'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            <input type="number" class="form-control mb-1 <?php $__errorArgs = ['numberOfPersonsOneWay'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="numberOfPersonsOneWay" placeholder="Number of Persons" min="1" value="<?php echo e(old('numberOfPersonsOneWay')); ?>">
                            <?php $__errorArgs = ['numberOfPersonsOneWay'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            <textarea class="form-control mb-2 <?php $__errorArgs = ['specialRequestOneWay'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="3" name="specialRequestOneWay" placeholder="Special Request"><?php echo e(old('specialRequestOneWay')); ?></textarea>
                            <?php $__errorArgs = ['specialRequestOneWay'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            <button type="submit" class="btn btn-primary btn-block">Book One Way Cab</button>
                        </div>


                        <div id="roundTripForm" class="form-group <?php if(old('tripType') == 'RoundTrip' || $errors->has('tripType')): ?> d-block <?php endif; ?>" style="display: none;">
                            <input type="text" class="form-control mb-1 <?php $__errorArgs = ['pickupLocationRoundTrip'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="pickupLocationRoundTrip" placeholder="PickUp Location" value="<?php echo e(old('pickupLocationRoundTrip')); ?>">
                            <?php $__errorArgs = ['pickupLocationRoundTrip'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            <input type="text" class="form-control mb-1 <?php $__errorArgs = ['dropLocationRoundTrip'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="dropLocationRoundTrip" placeholder="Drop Location" value="<?php echo e(old('dropLocationRoundTrip')); ?>">
                            <?php $__errorArgs = ['dropLocationRoundTrip'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            <input type="date" class="form-control mb-1 <?php $__errorArgs = ['pickupDateRoundTrip'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="pickupDateRoundTrip" placeholder="PickUp Date" min="<?php echo e(date('Y-m-d')); ?>" value="<?php echo e(old('pickupDateRoundTrip')); ?>">
                            <?php $__errorArgs = ['pickupDateRoundTrip'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            <input type="text" class="form-control mb-1 pickup-time <?php $__errorArgs = ['pickupTimeRoundTrip'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="pickupTimeRoundTrip" id="pickupTimeRoundTrip" placeholder="PickUp Time" value="<?php echo e(old('pickupTimeRoundTrip')); ?>">
                            <?php $__errorArgs = ['pickupTimeRoundTrip'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            <input type="number" class="form-control mb-1 <?php $__errorArgs = ['numberOfPersonsRoundTrip'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="numberOfPersonsRoundTrip" placeholder="Number of Persons" min="1" value="<?php echo e(old('numberOfPersonsRoundTrip')); ?>">
                            <?php $__errorArgs = ['numberOfPersonsRoundTrip'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            <textarea class="form-control mb-2 <?php $__errorArgs = ['specialRequestRoundTrip'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="3" name="specialRequestRoundTrip" placeholder="Special Request"><?php echo e(old('specialRequestRoundTrip')); ?></textarea>
                            <?php $__errorArgs = ['specialRequestRoundTrip'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            <button type="submit" class="btn btn-primary btn-block">Book Round Trip</button>
                        </div>

                        <div id="rentalsForm" class="form-group <?php if(old('tripType') == 'Rentals' || $errors->has('tripType')): ?> d-block <?php endif; ?>" style="display: none;">
                            <input type="text" class="form-control mb-1 <?php $__errorArgs = ['pickupLocationRentals'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="pickupLocationRentals" placeholder="PickUp Location" value="<?php echo e(old('pickupLocationRentals')); ?>">
                            <?php $__errorArgs = ['pickupLocationRentals'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            <input type="date" class="form-control mb-1 <?php $__errorArgs = ['pickupDateRentals'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="pickupDateRentals" placeholder="PickUp Date" min="<?php echo e(date('Y-m-d')); ?>" value="<?php echo e(old('pickupDateRentals')); ?>">
                            <?php $__errorArgs = ['pickupDateRentals'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            <input type="text" class="form-control mb-1 pickup-time <?php $__errorArgs = ['pickupTimeRentals'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="pickupTimeRentals" id="pickupTimeRentals" placeholder="PickUp Time" value="<?php echo e(old('pickupTimeRentals')); ?>">
                            <?php $__errorArgs = ['pickupTimeRentals'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            <input type="number" class="form-control mb-1 <?php $__errorArgs = ['numberOfPersonsRentals'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="numberOfPersonsRentals" placeholder="Number of Persons" min="1" value="<?php echo e(old('numberOfPersonsRentals')); ?>">
                            <?php $__errorArgs = ['numberOfPersonsRentals'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            <input type="text" class="form-control mb-1 <?php $__errorArgs = ['numberOfHoursRentals'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="numberOfHoursRentals" placeholder="Number of Hours" value="<?php echo e(old('numberOfHoursRentals')); ?>">
                            <?php $__errorArgs = ['numberOfHoursRentals'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            <textarea class="form-control mb-2 <?php $__errorArgs = ['specialRequestRentals'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="3" name="specialRequestRentals" placeholder="Special Request"><?php echo e(old('specialRequestRentals')); ?></textarea>
                            <?php $__errorArgs = ['specialRequestRentals'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            <button type="submit" class="btn btn-primary btn-block">Book Rental Cab</button>
                        </div>

                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<center><a href="<?php echo e(route("cab-order-list")); ?>" class="btn btn-secondary  mt-3">View Order List</a></center>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        $('#tripType').on('change', function() {
            var selectedOption = $(this).val();

            $('#oneWayForm, #roundTripForm, #rentalsForm').hide();
            if(selectedOption === 'OneWay') {
                $('#oneWayForm').show();
            } else if(selectedOption === 'RoundTrip') {
                $('#roundTripForm').show();
            } else if(selectedOption === 'Rentals') {
                $('#rentalsForm').show();
            }
        });

       function setMinTimeForTimePicker(selectedDate, timePickerId) {
            var currentDate = new Date();
            var currentHour = currentDate.getHours();
            var currentMinute = currentDate.getMinutes();

            if (selectedDate.getDate() === currentDate.getDate() && 
                selectedDate.getMonth() === currentDate.getMonth() &&
                selectedDate.getFullYear() === currentDate.getFullYear()) {
                // Selected date is today
                currentHour += 2; // Minimum time 2 hours ahead of current time
                if (currentMinute >= 60) {
                    currentHour++;
                    currentMinute -= 60;
                }
                if(16<=currentMinute<=29){
                    currentMinute = 30;
                }
                var minTime = currentHour + ':' + (currentMinute < 10 ? '0' + currentMinute : currentMinute);
                $(timePickerId).timepicker('option', 'minTime', minTime);
                $(timePickerId).timepicker('option', 'maxTime', '11:45pm');
            } else {
                // Selected date is not today
                $(timePickerId).timepicker('option', 'minTime', null);
            }
        }

        // Event handler for date change
        $('input[type="date"]').on('change', function() {
            var selectedDate = new Date($(this).val());
            setMinTimeForTimePicker(selectedDate, '#pickupTimeOneWay');
            setMinTimeForTimePicker(selectedDate, '#pickupTimeRoundTrip');
            setMinTimeForTimePicker(selectedDate, '#pickupTimeRentals');
        });

        // Initialize time pickers
        $('.pickup-time').timepicker({
            showDuration: false,
            scrollbar: true,
            step: 15
        }); 
        
        
    /*    $('#loginForm').on('submit', function(event) {
            event.preventDefault();

            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            fetch($(this).attr('action'), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-CSRF-TOKEN': csrfToken 
                },
                body: new URLSearchParams(new FormData(this))
            })
            .then(response => {
                if (response.ok) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Booking Successful',
                        text: 'Your cab booking has been successful!',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    setTimeout(function() {
                        window.location.href = "<?php echo e(route('cab-order-list')); ?>";
                    }, 1500);
                } else {
                    throw new Error('Network response was not ok');
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Booking Failed',
                    text: 'There was an error while processing your booking. Please try again later.',
                });
            });
        });     */
    

    });
</script>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\rsapp\resources\views/cabbooking.blade.php ENDPATH**/ ?>