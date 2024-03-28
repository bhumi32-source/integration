
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <p>Welcome to the dashboard, <?php echo e($username); ?></p>
    <a href="#">Order Food</a>
    <a href="<?php echo e(route('logout')); ?>" id="logout-link">Logout</a>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\New folder\rsapp\resources\views/dashboard.blade.php ENDPATH**/ ?>