<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>
 
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Room Cleaning Orders</title>
</head>
<body>
      @include("layouts.navigation")
      <br>
<div class="container mt-4">
    <a href="{{ route("room-cleaning") }}" class="btn btn-secondary my-3">Book Service</a>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" id="upcoming-tab" data-toggle="tab" href="#upcoming" role="tab" aria-controls="upcoming" aria-selected="true">Upcoming</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="view-all-tab" data-toggle="tab" href="#view-all" role="tab" aria-controls="view-all" aria-selected="false">View All</a>
        </li>
    </ul>
    <div class="tab-content mt-3">
        <div class="tab-pane fade show active" id="upcoming" role="tabpanel" aria-labelledby="upcoming-tab">
        <table class="table table-striped" id="futureorders">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Date</th>
        <th scope="col">Time</th>
        <th scope="col">Status</th>
        <th scope="col">Details</th>
        <th scope="col">Action</th>              
        </tr>
    </thead>
    <tbody>
    @foreach ($upcomingorders as $order)
                    <tr class="order-row">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ date('d-m-Y', strtotime($order->date)) }}</td>
                        <td>{{ date('h:ia', strtotime($order->time)) }}</td>
                        <td>
                        @if($order->status == 1)
                            Waiting for approval
                        @elseif($order->status == 2)
                            In Process
                        @elseif($order->status == 3)
                            Cancelled
                        @elseif($order->status == 4)
                            Confirmed
                        @elseif($order->status == 5)
                            Completed
                        @elseif($order->status == 6)
                            Awaiting Acknowledgement
                        @endif
                        </td>
                        <td><i class="fa-solid fa-circle-info mt-1" id="helpicon" data-bs-toggle="popover" title="{{ $order->special_request ? $order->special_request : 'NA' }}"></i></td>
                        
                        <td>
                            @if($order->status != 3 && $order->status != 5)
                                <form id="cancelForm{{ $loop->iteration }}" action="{{ route('rcco', ['id' => $order->id]) }}" method="POST">
                                    @csrf
                                    <button type="button" class="btn btn-danger cancel-btn" data-form-id="{{ $loop->iteration }}">Cancel</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
    </tbody>
</table>
        </div>
        <div class="tab-pane fade" id="view-all" role="tabpanel" aria-labelledby="view-all-tab" >
            <table class="table table-striped" id="all-orders">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">Status</th>
                        <th scope="col">Details</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allorders as $order)
                    <tr class="order-row">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ date('d-m-Y', strtotime($order->date)) }}</td>
                        <td>{{ date('h:ia', strtotime($order->time)) }}</td>
                        <td>
                        @if($order->status == 1)
                            Waiting for approval
                        @elseif($order->status == 2)
                            In Process
                        @elseif($order->status == 3)
                            Cancelled
                        @elseif($order->status == 4)
                            Confirmed
                        @elseif($order->status == 5)
                            Completed
                        @elseif($order->status == 6)
                            Awaiting Acknowledgement
                        @endif
                        </td>
                        <td><i class="fa-solid fa-circle-info mt-1" id="helpicon" data-bs-toggle="popover" title="{{ $order->special_request ? $order->special_request : 'NA' }}"></i></td>
                        
                        <td>
                            @if($order->status != 3 && $order->status != 5)
                                <form id="cancelForm{{ $loop->iteration }}" action="{{ route('rcco', ['id' => $order->id]) }}" method="POST">
                                    @csrf
                                    <button type="button" class="btn btn-danger cancel-btn" data-form-id="{{ $loop->iteration }}">Cancel</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
       
<script>
 document.addEventListener('DOMContentLoaded', function () {
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl);
        });

        document.addEventListener('click', function (event) {
            if (!event.target.closest('.popover')) {
                popoverList.forEach(function (popover) {
                    popover.hide();
                });
            }
        });
    });

$('.cancel-btn').click(function() {
    var formId = $(this).data('form-id');
    swal({
        title: "Are you sure you want to cancel the order?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willCancel) => {
        if (willCancel) {
            swal("Your order has been cancelled!", {
                icon: "success",
            });
            $('#cancelForm' + formId).submit();
        } else {
            swal("Your order is safe!");
        }
    });
});
</script>
</body>
</html>







{{--@extends('layouts.main')
@section('title', 'Room Cleaning')
@include('layouts.navigation')
@section('main-content')
<div class="container mt-5">
    <a href="{{ route("room-cleaning") }}" class="btn btn-secondary my-3">Book Service</a><br>
    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
        <button type="button" class="btn btn-outline-primary active" id="upcomingBtn">Upcoming</button>
        <button type="button" class="btn btn-outline-primary" id="viewAllBtn">View All</button>
    </div>
    @if ($allorders->isEmpty())
        <div class="alert alert-info mt-3" role="alert">
            No data found.
        </div>
    @else
        <table class="table table-striped" id="futureorders">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Status</th>
                    <th scope="col">Details</th>
                    <th scope="col">Action</th>     
                </tr>
            </thead>
            <tbody>
                @foreach ($allorders as $order)
                <tr class="order-row">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ date('d-m-Y', strtotime($order->date)) }}</td>
                    <td>{{ date('h:ia', strtotime($order->time)) }}</td>
                    <td>
                        @if($order->status == 1)
                            Waiting for approval
                        @elseif($order->status == 2)
                            In Process
                        @elseif($order->status == 3)
                            Cancelled
                        @elseif($order->status == 4)
                            Confirmed
                        @elseif($order->status == 5)
                            Completed
                        @elseif($order->status == 6)
                            Awaiting Acknowledgement
                        @endif
                    </td>
                    <td><i class="fa-solid fa-circle-info mt-1" id="helpicon" data-bs-toggle="popover" title="{{ $order->special_request ? $order->special_request : 'NA' }}"></i></td>
                    <td>
                        @if($order->status != 3 && $order->status != 5)
                        <form id="cancelForm{{ $loop->iteration }}" action="{{ route('rcco', ['id' => $order->id]) }}" method="POST">
                            @csrf
                            <button type="button" class="btn btn-danger cancel-btn" data-form-id="{{ $loop->iteration }}">Cancel</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('#upcomingBtn').trigger('click');
});

document.addEventListener('DOMContentLoaded', function () {
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });

    document.addEventListener('click', function (event) {
        if (!event.target.closest('.popover')) {
            popoverList.forEach(function (popover) {
                popover.hide();
            });
        }
    });

    $('#upcomingBtn').click(function() {
    console.log("Upcoming button clicked!");

    $('#upcomingBtn').addClass('active');
    $('#viewAllBtn').removeClass('active');

    var currentDateTime = new Date();
    console.log(currentDateTime);
    var index = 0;
    $('.order-row').hide();
    $('.order-row').each(function() {
        var orderDate = $(this).find('td:nth-child(2)').text().trim();
        var orderTime = $(this).find('td:nth-child(3)').text().trim();
        
        // Parse the date in the format "dd-mm-yyyy" to "yyyy-mm-dd" (ISO format)
        var orderDateISO = orderDate.split('-').reverse().join('-');
        
        // Parse the time in 12-hour format to 24-hour format
        var timeParts = orderTime.split(':');
        var hours = parseInt(timeParts[0]);
        var minutes = parseInt(timeParts[1].replace('am', '').replace('pm', ''));
        if (orderTime.includes('pm') && hours < 12) {
            hours += 12;
        } else if (orderTime.includes('am') && hours === 12) {
            hours = 0;
        }

        // Create a new Date object with the adjusted date and time
        var orderDateTime = new Date(orderDateISO + 'T' + hours.toString().padStart(2, '0') + ':' + minutes.toString().padStart(2, '0') + ':00');
   
        console.log(orderDateTime);
        if (orderDateTime > currentDateTime) {
            $(this).show();
            index++;
                $(this).find('td:first-child').text(index); 
        }
    });
});


    $('#viewAllBtn').click(function() {
        console.log("View All button clicked!");

        $('#viewAllBtn').addClass('active');
        $('#upcomingBtn').removeClass('active');
        $('.order-row').show().each(function(index) {
            $(this).find('td:first-child').text(index + 1); 
        });
    });

});

$('.cancel-btn').click(function() {
    var formId = $(this).data('form-id');
    Swal.fire({
        title: "Are you sure you want to cancel the order?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, cancel it!",
        cancelButtonText: "No, keep it"
    })
    .then((willCancel) => {
        if (willCancel.isConfirmed) {
            $.ajax({
                url: $('#cancelForm' + formId).attr('action'),
                method: 'POST',
                data: $('#cancelForm' + formId).serialize(),
                success: function(response) {
                    Swal.fire("Your order has been cancelled!", {
                        icon: "success",
                    }).then(() => {
                        window.location.reload(); 
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire("Error occurred while cancelling the order.", {
                        icon: "error",
                    });
                }
            });
        } else {
            Swal.fire("Your order is safe!");
        }
    });
});
</script>
@endsection --}}
