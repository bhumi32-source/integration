<!doctype html>
<html lang="en">
<head>
    <title>Spa Service</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>
    <style>
        .persons-input {
            display: none;
        }
    </style>
</head>
<body>
    <a href="#" class="btn btn-primary my-3">View Orders</a>

    <div class="container-fluid">
        <form action="<?php echo e(route("spa-booking.add")); ?>" method="post">
            <?php echo csrf_field(); ?>
            <ul class="nav nav-tabs" id="myTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="packages-tab" data-bs-toggle="tab" data-bs-target="#packages" type="button" role="tab" aria-controls="packages" aria-selected="true">Packages</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="services-tab" data-bs-toggle="tab" data-bs-target="#services" type="button" role="tab" aria-controls="services" aria-selected="false">Services</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="packages" role="tabpanel" aria-labelledby="packages-tab">
                    <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="row border rounded p-3 my-3">
                            <div class="col-md-8">
                                <div class="form-check">
                                    <img src="<?php echo e(url("images/{$package->image}")); ?>"><br>
                                    <label class="form-check-label" for="package_<?php echo e($package->package_id); ?>"> <?php echo e($package->package_name); ?> </label><br>
                                    <label class="form-check-label" for="package_<?php echo e($package->package_id); ?>">Duration: 
                                        <?php if($package->total_duration > 60): ?>
                                            <?php $hours = floor($package->total_duration / 60);
                                            $minutes = $package->total_duration % 60;
                                            ?>
                                            <?php echo e($hours); ?> hours  
                                            <?php if($minutes != 0 ): ?> and <?php echo e($minutes); ?> minutes <?php endif; ?>
                                        <?php else: ?>
                                            <?php echo e($package->total_duration); ?> minutes
                                        <?php endif; ?>
                                    </label>
                                </div>
                                Includes: 
                                <ul>
                                    <?php
                                        $array = explode(',', $package->included_services);
                                        foreach ($array as $item) {
                                            echo "<li>$item</li>";
                                        }
                                    ?>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <!-- Checkbox for selecting the number of persons -->
                                    <input type="checkbox" class="form-check-input persons-checkbox" data-target="persons_package_<?php echo e($package->package_id); ?>">
                                    <!-- Input field for entering the number of persons -->
                                    <input type="number" class="form-control persons-input" name="persons_package[<?php echo e($package->package_id); ?>]" id="persons_package_<?php echo e($package->package_id); ?>">
                                    <!-- Hidden input field for storing the selected item ID -->
                                    <input type="hidden" name="selected_items[]" value="<?php echo e($package->package_id); ?>">
                                </div>
                                <!-- <p class="mb-0">Rs.<?php echo e($package->package_price); ?></p> -->
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="tab-pane fade" id="services" role="tabpanel" aria-labelledby="services-tab">
                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="row border rounded p-3 my-3">
                            <div class="col-md-8">
                                <div class="form-check">
                                    <img src="<?php echo e(url("images/{$service->image}")); ?>" alt="Service Image"><br>
                                    <label class="form-check-label" for="service_<?php echo e($service->id); ?>"> <?php echo e($service->title); ?> </label><br>
                                    <label class="form-check-label" for="service_<?php echo e($service->id); ?>">
                                        Duration:  
                                        <?php if($service->duration > 60): ?>
                                            <?php $hours = floor($service->duration / 60);
                                            $minutes = $service->duration % 60;
                                            ?>
                                            <?php echo e($hours); ?> hours  
                                            <?php if($minutes != 0 ): ?> <?php echo e($minutes); ?> minutes <?php endif; ?>
                                        <?php else: ?>
                                            <?php echo e($service->duration); ?> minutes
                                        <?php endif; ?>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <!-- Checkbox for selecting the number of persons -->
                                    <input type="checkbox" class="form-check-input persons-checkbox" data-target="persons_service_<?php echo e($service->id); ?>">
                                    <!-- Input field for entering the number of persons -->
                                    <input type="number" class="form-control persons-input" name="persons_service[<?php echo e($service->id); ?>]" id="persons_service_<?php echo e($service->id); ?>">
                                    <!-- Hidden input field for storing the selected item ID -->
                                    <input type="hidden" name="selected_items[]" value="<?php echo e($service->id); ?>">
                                </div>
                                <!-- <p class="mb-0">Rs.<?php echo e($service->price); ?></p> -->
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="date" class="form-label">Date:</label>
                        <input type="date" name="date" class="form-control" id="date" min="<?php echo e(date('Y-m-d')); ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="time" class="form-label">Time:</label>
                        <input type="time" name="time" class="form-control" id="time">
                    </div>
                </div>
                <div>
                    <textarea placeholder="Special Request" name="special_request" rows="3" cols="50"></textarea>
                </div>
            </div>
            <button type="submit" id="submitBtn" class="btn btn-primary btn-submit mt-3">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-2+8h8BfMDq0UktI/bPkb4Y7wc+H1POqZv9U5gQW2qy4F8A7Sw7L6xK7BROv9i7ru" crossorigin="anonymous"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.persons-checkbox');
            
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const targetId = this.dataset.target;
                    const inputField = document.getElementById(targetId);
                    inputField.style.display = this.checked ? 'block' : 'none';
                });
            });
        });
    </script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\rsapp\resources\views/spaservice.blade.php ENDPATH**/ ?>