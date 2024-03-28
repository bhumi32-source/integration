<?php $__env->startSection('main-content'); ?>
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <div class="hotel-image-container">
          <img src="<?php echo e(url("images/hotel.jpg")); ?>" alt="hotel img" class="img-fluid hotel-image">
        </div>
      </div>
    </div>
    <div class="full-width-container">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-5">
            <div class="logo mb-3">
              <img src="<?php echo e(url("images/hotel_logo.jpg")); ?>" alt="Logo" class="mb-3">
            </div>
            <br>
            <br>
            <br>
            <form id="otpForm" method="POST">
              <?php echo csrf_field(); ?>
              <div class="form-group mb-2">
                <div class="mb-2 text-center" style="font-size:18px;"><b>Login to your account</b></div>
                <input type="text" class="form-control" placeholder="Enter Your Email" name="email">
              </div>
              <div class="form-group">
               <center> <button type="button" id="requestOtpBtn" class="btn custom-btn btn-sm">Request OTP</button></center>
              </div>
              <i class="fa-solid fa-circle-info mt-1" id="helpicon"></i>
              <div class="bottom">
              <div class="text-center mt-1">Powered By RS.</div>
               <div class="text-center">n.</div>
              </div>
            </form>
          
            <div id="verifyOtpForm" style="display: none;">
              <form method="POST">
                <div class="form-group mb-2">
                  <div class="mb-1 text-center" style="font-size:18px;"><b>Enter OTP</b></div>
                  <div class="mb-2 text-center" style="font-size:12px;">A 6-digit code has been sent to your email.</div>
                  <input type="text" class="form-control" placeholder="Enter OTP" name="otp">
                </div>
                <div class="form-group">
                  <center><button type="button" id="verifyOtpBtn" class="btn custom-btn btn-sm">Login</button><center>
                </div>
                
                <div class="form-group text-center mt-1">
                  <span id="timer"></span> 
                </div>
                <div class="form-group mt-1 text-center" style="display: none; font-size:12px;" id="resendBtn">
                Didn’t receive the OTP? <a href="#" id="resendOtpBtn" class="custom-link mt-2">Resend Code</a>
                </div>
                <div class="form-group mt-1 text-center">
                  <a href="#" id="changeEmailLink" class="custom-link" style="font-size:12px;"><i class="fa-solid fa-angle-left""></i>&nbsp;Change Email</a>
                </div>
              </form>
            </div>
            <br>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php $__env->stopSection(); ?>
 

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rs_app\resources\views/login.blade.php ENDPATH**/ ?>