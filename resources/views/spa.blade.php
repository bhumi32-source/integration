<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Spa Services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.js"></script>

</head>
<body>

@include("layouts.navigation", ['username' => $username])

<div class="container mt-5">
<a href="{{ route("spa-order-list") }}" class="btn btn-secondary my-3">View Orders</a>
    <ul class="nav nav-tabs" id="myTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="packages-tab" data-bs-toggle="tab" data-bs-target="#packages" type="button" role="tab" aria-controls="packages" aria-selected="true">Packages</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="services-tab" data-bs-toggle="tab" data-bs-target="#services" type="button" role="tab" aria-controls="services" aria-selected="false">Services</button>
        </li>
    </ul>

    <div class="tab-content mt-3">
        <div class="tab-pane fade show active" id="packages" role="tabpanel" aria-labelledby="packages-tab">
            @foreach($packages as $package)
                <div class="row mb-3 border">
                    <div class="col">
                        <input type="checkbox" id="package-checkbox-{{ $package->package_id }}" name="selected_items[]" class="form-check-input package-checkbox" value="package-{{ $package->package_id }}" style="margin-right: 5px;">
                        <label for="package-checkbox-{{ $package->package_id }}">
                            <img src="{{ url("images/{$package->image}") }}" alt="Image" width="80px" height="80px">
                            {{$package->package_name}} - Rs {{$package->package_price}} per person.
                        </label>
                        <p>Duration:
                            @if ($package->total_duration > 60)
                                @php $hours = floor($package->total_duration / 60);
                                $minutes = $package->total_duration % 60;
                                @endphp
                                {{$hours}} hours
                                @if($minutes != 0 ) and {{$minutes}} minutes @endif
                            @else
                                {{ $package->total_duration }} minutes
                            @endif
                        </p>
                        <p>Includes:
                            <ul>
                                @php
                                    $array = explode(',', $package->included_services);
                                    foreach ($array as $item) {
                                        echo "<li>$item</li>";
                                    }
                                @endphp
                            </ul>
                        </p>
                        <input type="number" class="form-control mt-2 no-of-persons" id="package-no-of-persons-{{ $package->package_id }}" name="no_of_persons[]" placeholder="Enter number of persons" style="display: none;">
                    </div>
                </div>
            @endforeach
        </div>
        <div class="tab-pane fade" id="services" role="tabpanel" aria-labelledby="services-tab">
            @foreach($services as $service)
                <div class="row mb-3 border">
                    <div class="col">
                        <input type="checkbox" id="service-checkbox-{{ $service->id }}" name="selected_items[]" class="form-check-input service-checkbox" value="service-{{ $service->id }}" style="margin-right: 5px;">
                        <label for="service-checkbox-{{ $service->id }}">
                            <img src="{{ url("images/{$service->image}") }}" alt="Image" width="80px" height="80px">
                            {{$service->title}} - Rs {{$service->price}} per person.
                        </label>
                        <p>Duration:
                            @if ($service->duration > 60)
                                @php $hours = floor($service->duration / 60);
                                $minutes = $service->duration % 60;
                                @endphp
                                {{$hours}} hours
                                @if($minutes != 0 ) {{$minutes}} minutes @endif
                            @else
                                {{ $service->duration }} minutes
                            @endif
                        </p>
                        <input type="number" class="form-control mt-2 no-of-persons" id="service-no-of-persons-{{ $service->id }}" name="no_of_persons[]" placeholder="Enter number of persons" style="display: none;">
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="container mt-5">
    <form id="spaForm" action="{{ route('spa.add') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="date" class="form-label">Date:</label>
            <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" min="{{ date('Y-m-d') }}" required>
            @error('date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="time" class="form-label">Time:</label>
            <input type="text" class="form-control @error('time') is-invalid @enderror" id="time" name="time" required>
            @error('time')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="special_request" class="form-label">Special Request:</label>
            <textarea class="form-control" id="special_request" name="special_request" rows="3"></textarea>
        </div>
        <button type="button" id="submitForm" class="btn btn-primary">Submit</button>
    </form>
</div>


<script>
   $(document).ready(function(){
    var currentDate = new Date();

    var currentHour = currentDate.getHours();
    var currentMinute = currentDate.getMinutes();

    var currentTime = currentHour + ":" + currentMinute;

    console.log("Current Time: " + currentTime);

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

        var currentHour = currentDate.getHours();
        var currentMinute = currentDate.getMinutes();
        currentMinute += 30;
        if (currentMinute >= 60) {
            currentHour++;
            currentMinute -= 60;
        }
        if(01<=currentMinute<=29){
            currentMinute = 30;  
        }
      
        console.log('Current Time:', currentHour + ':' + currentMinute);
        var minTime = formatTime(currentHour, currentMinute);
        console.log('Selected Date is Today.');
        console.log('Current Time:', currentHour + ':' + currentMinute);
        console.log('Min Time:', minTime);
        $('#time').timepicker('option', 'minTime', minTime);
    } else {
        // Selected date is not today
        console.log('Selected Date is Not Today.');
        $('#time').timepicker('option', 'minTime', '10:00am');
    }
});


    $('#time').timepicker({
        'minTime': '10:00am',
        'maxTime': '10:30pm',
        'showDuration': false,
    });

    document.querySelectorAll('.form-check-input').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            var noOfPersonsField = this.closest('.row').querySelector('.no-of-persons');
            if (this.checked) {
                noOfPersonsField.style.display = 'block';
                noOfPersonsField.setAttribute('required', true);
            } else {
                noOfPersonsField.style.display = 'none';
                noOfPersonsField.removeAttribute('required');
            }
        });
    });

    document.getElementById('submitForm').addEventListener('click', function() {
    var selectedItems = [];
    var noOfPersons = [];

    // Check if at least one checkbox is checked
    var atLeastOneChecked = false;
    document.querySelectorAll('.form-check-input:checked').forEach(function(checkbox) {
        atLeastOneChecked = true;
        var itemId = checkbox.value.split('-')[1];
        var itemType = checkbox.value.split('-')[0];
        var quantityField = document.getElementById(`${itemType}-no-of-persons-${itemId}`);
        var quantity = quantityField.value;
        
        // Check if quantity is specified for the checked item
        if (!quantity.trim()) {
            swal("Error!", "Please specify the number of persons for the selected items.", "error");
            return; // Exit the loop and stop form submission
        }
        
        selectedItems.push({ type: itemType, id: itemId });
        noOfPersons.push(quantity);
    });

    if (!atLeastOneChecked) {
        swal("Error!", "Please select at least one item.", "error");
        return; 
    }

    var data = {
        date: document.getElementById('date').value,
        time: document.getElementById('time').value,
        special_request: document.getElementById('special_request').value,
        selected_items: selectedItems,
        no_of_persons: noOfPersons
    };

    fetch('{{ route('spa.add') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        if (response.ok) {
            swal("Success!", "Your booking has been submitted successfully.", "success")
            .then(() => {
                window.location.href = '{{ route("spa-order-list") }}';
            });
        } else {
            throw new Error('Failed to submit form');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        swal("Error!", "Failed to submit the form. Please try again.", "error");
    });
});

});

</script>

</body>
</html>
