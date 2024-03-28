<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Decoration</title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <style>
        .decoration-image {
            max-width: 100%;
            max-height: 200px;
            width: auto;
            height: auto;
        }

        .decoration-info {
            margin-bottom: 10px;
        }

        .success-message {
            color: green;
        }

        /* Custom CSS to increase width of select */
        select[name="booking_time_from"] {
            width: 150px;
            /* Adjust width as needed */
        }

        /* Custom CSS to increase width of select */
        select[name="booking_time_to"] {
            width: 150px;
            /* Adjust width as needed */
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
   </head>

<body>
      <?php echo $__env->make("layouts.navigation", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container mt-5">
        <h1 class="mt-4">Custom Decoration</h1>

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Event Time Range</th>
                                <th>Booking Time From</th>
                                <th>Booking Time To</th>
                                <th>Booking Date</th>
                                <th>Booking</th> <!-- Booking button column -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $decorations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $decoration): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr id="decoration_<?php echo e($decoration->id); ?>">
                                <td><img class="decoration-image" src="<?php echo e(asset('images/' . $decoration->image)); ?>" alt="<?php echo e($decoration->name); ?> Image"></td>
                                <td><strong><?php echo e($decoration->name); ?></strong></td>
                                <td>₹ <?php echo e($decoration->price); ?></td>
                                <td>
                                    <div class="description-container">
                                        <div id="description_<?php echo e($decoration->id); ?>" style="display: none;">
                                            <?php echo e($decoration->description); ?>

                                        </div>
                                        <br>
                                        <button type="button" class="btn btn-primary" onclick="toggleDescription(<?php echo e($decoration->id); ?>)">View</button>
                                    </div>
                                </td>
                                <td><?php echo e($decoration->booking_time_from); ?> - <?php echo e($decoration->booking_time_to); ?></td>
                                <td>
                                    <form action="<?php echo e(route('decoration.book', ['id' => $decoration->id])); ?>" method="post" class="book-form">
                                        <?php echo csrf_field(); ?>
                                        <td>
                                            <div class="form-group">
                                                <label for="booking_time_from_<?php echo e($decoration->id); ?>">Booking Time From:</label>
                                                <select name="booking_time_from" id="booking_time_from_<?php echo e($decoration->id); ?>" class="form-control booking-time-from" required>
                                                    <option value="">Select From</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <label for="booking_time_to_<?php echo e($decoration->id); ?>">Booking Time To:</label>
                                                <select name="booking_time_to" id="booking_time_to_<?php echo e($decoration->id); ?>" class="form-control booking-time-to" required>
                                                    <option value="">Select To</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                        <div class="form-group">
                                            <label for="booking_date">Booking Date:</label>
                                            <input type="date" name="booking_date" id="booking_date_<?php echo e($decoration->id); ?>" class="form-control" required>
                                        </div>
                                        </td>
                                        <td>
                                            <input type="hidden" name="decoration_id" value="<?php echo e($decoration->id); ?>">
                                            <!-- Other form fields -->
                                            <br>
                                            <button type="submit" class="btn btn-primary book-btn">Book</button>
                                        </td>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       </tbody>
                        
                    </table>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col">
                <div class="success-message" id="successMessage" style="display: none;">Your order is successfully
                    placed.</div>
            </div>
        </div>
    </div>

    <script>

    document.addEventListener('DOMContentLoaded', function() {
    // Add event listeners and manipulate DOM elements here
    // For example:
    var button = document.getElementById('myButton');
    button.addEventListener('click', function() {
        // Handle button click event
        console.log('Button clicked!');
    });

    // You can also manipulate DOM elements here
    var paragraph = document.getElementById('myParagraph');
    paragraph.textContent = 'New content for the paragraph';
});

</script>

    <script>
        function populateFormFields(decorationId) {
        var decorationRow = document.getElementById('decoration_' + decorationId);
        var bookingTimeFrom = decorationRow.querySelector('.booking-time-from').value;
        var bookingTimeTo = decorationRow.querySelector('.booking-time-to').value;
        var bookingDate = decorationRow.querySelector('.booking-date').value;

        var form = document.getElementById('form_' + decorationId);
        form.querySelector('input[name="booking_time_from"]').value = bookingTimeFrom;
        form.querySelector('input[name="booking_time_to"]').value = bookingTimeTo;
        form.querySelector('input[name="booking_date"]').value = bookingDate;
    }

    function submitForm(decorationId) {
        populateFormFields(decorationId);
        document.getElementById('form_' + decorationId).submit();
    }

        // Event listener for time selection
        document.querySelectorAll('.booking-time-from, .booking-time-to').forEach(function(select) {
            select.addEventListener('change', function() {
                updateBookingTimeFields();
            });
        });

        document.querySelector('.book-form').addEventListener('submit', function(event) {
        // Update the booking date before submitting the form
        updateBookingTimeFields();
        }); 
    </script>

    <script>
        // Function to populate time dropdowns and handle selection
function populateTimeDropdowns() {
    // Loop through each decoration row
    document.querySelectorAll('.table tbody tr').forEach(function(row) {
        // Select time dropdowns within the current row
        var timeFromDropdown = row.querySelector('.booking-time-from');
        var timeToDropdown = row.querySelector('.booking-time-to');

        // Clear existing options
        timeFromDropdown.innerHTML = '';
        timeToDropdown.innerHTML = '';

        // Populate time dropdowns
        for (var hour = 0; hour < 24; hour++) {
            for (var minute = 0; minute <= 45; minute += 15) {
                var time = (hour < 10 ? '0' + hour : hour) + ':' + (minute === 0 ? '00' : minute);
                var option = new Option(time, time);
                timeFromDropdown.appendChild(option.cloneNode(true));
                timeToDropdown.appendChild(option.cloneNode(true));
            }
        }
    });
}

// Call the function to populate time dropdowns and handle selection when the DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    populateTimeDropdowns();
});

    </script>


<script>
    function toggleDescription(decorationId) {
        var description = document.getElementById('description_' + decorationId);
        if (description) {
            var button = document.getElementById('view_button_' + decorationId);
            if (description.style.display === 'none' || description.style.display === '') {
                description.style.display = 'block';
                button.textContent = 'Hide';
            } else {
                description.style.display = 'none';
                button.textContent = 'View';
            }
        }
    }

    // Function to handle form submission
    function submitForm(decorationId) {
        // Set the decoration ID in the corresponding form input field
        var form = document.getElementById('form_' + decorationId);
        if (form) {
            var decorationIdField = form.querySelector('input[name="decoration_id"]');
            if (decorationIdField) {
                decorationIdField.value = decorationId;
            }
        }
    }
</script>


</body>

</html>
<?php /**PATH C:\xampp\htdocs\rsapp\resources\views/custom_decoration.blade.php ENDPATH**/ ?>