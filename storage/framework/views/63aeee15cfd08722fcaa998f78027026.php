<!doctype html>
<html lang="en">
    <head>
        <title>Room Service</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>
          <?php echo $__env->make("layouts.navigation", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <div class="mt-5">
            <br>
       <a href="<?php echo e(route("room-cleaning")); ?>">Room cleaning</a><br>
       <a href="<?php echo e(route("extra-bed")); ?>">Extra bed</a><br>
       <a href="<?php echo e(route("extend-stay")); ?>">Extend Stay/Modify Stay </a><br>
       <a href="<?php echo e(route("laundry")); ?>">Laundry</a><br>
       <a href="<?php echo e(route("linen.index")); ?>">Linen</a><br>
       <a href="<?php echo e(route("toiletries.index")); ?>">Toiletries</a><br>

    </div>
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\rsapp\resources\views/roomservice.blade.php ENDPATH**/ ?>