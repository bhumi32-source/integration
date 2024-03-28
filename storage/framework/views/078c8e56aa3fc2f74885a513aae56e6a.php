<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <title>Extra Bed Order</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
  <?php echo $__env->make("layouts.navigation", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header text-center">
                   Order Extra Bed
                </div>
                <div class="card-body">
                    <form id="bookingForm" action="<?php echo e(route('extra-bed.add')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <label for="quantity">Rate</label>
                        <div class="form-group">
                            <input type="text" name="rate" value="&#8377; <?php echo e($rate->rate); ?>" class="form-control mb-2" required readonly>                     
                        </div>
                        <div class="form-group">
                            <input type="number" id="quantity" name="quantity" placeholder="No. Of Beds Required" class="form-control mb-2" min="1" required>                     
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
                    
                        <div class="form-group">
                            <label for="total_amount">Total Amount</label>
                            <input type="text" id="total_amount" name="total_amount" class="form-control mb-2" readonly>
                        </div>
                        
                        <center><button type="submit" class="btn btn-primary btn-block">Book</button></center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<center><a href="<?php echo e(route("extra-bed-orders")); ?>" class="btn btn-secondary  mt-3">View Order List</a></center>

<script>
    document.getElementById('quantity').addEventListener('input', function() {
        var rate = parseInt(document.getElementsByName('rate')[0].value.replace('₹ ', '').trim());
        var quantity = parseInt(this.value);
        var total_amount = rate * quantity;
        document.getElementById('total_amount').value = '₹ ' + total_amount.toFixed(2);
    });
</script>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\rsapp\resources\views/extrabed.blade.php ENDPATH**/ ?>