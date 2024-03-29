<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Cab Orders</title>
</head>
<body>
      @include("layouts.navigation")
<div class="container mt-5">
    <a href="{{ route("cab-booking") }}" class="btn btn-secondary my-3">Book Cab</a>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" id="upcoming-tab" data-bs-toggle="tab" href="#upcoming" role="tab" aria-controls="upcoming" aria-selected="true">Upcoming</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="view-all-tab" data-bs-toggle="tab" href="#view-all" role="tab" aria-controls="view-all" aria-selected="false">View All</a>
        </li>
    </ul>
    <div class="tab-content mt-3">
        <div class="tab-pane fade show active" id="upcoming" role="tabpanel" aria-labelledby="upcoming-tab">
            <table class="table table-striped" id="futureorders">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">PickUp Location</th>
            <th scope="col">Date-Time</th>
            <th scope="col">Trip Type</th>
            <th scope="col">Drop Location</th>
            <th scope="col">No. of Persons</th>
            <th scope="col">Amount</th>
            <th scope="col">Status</th>
            <th scope="col">Details</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($upcomingorders as $order)
                    <tr class="order-row">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $order->pickup_location }}</td>
                        <td>{{ date('d-m-Y h:ia', strtotime($order->pickup_date . ' ' . $order->pickup_time)) }}</td>
                        <td>{{ $order->trip_type }}</td>
                        <td>{{ $order->drop_location }}</td>
                        <td class="text-center">{{ $order->no_of_persons }}</td>
                        <td class="text-right">&#8377; {{ number_format($order->total_amount, 2) }}</td>
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
                        <td><i class="fa-solid fa-circle-info mt-1" id="helpicon{{$loop->iteration}}" data-bs-toggle="popover" title="{{ $order->special_request ? $order->special_request : 'NA' }}" tabindex="0"></i></td>
                        <td>
                            @if($order->status != 3 && $order->status != 5)
                                <form id="cancelForm{{ $loop->iteration }}" action="{{ route('cab-cancel-order', ['id' => $order->id]) }}" method="POST">
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
        <div class="tab-pane fade" id="view-all" role="tabpanel" aria-labelledby="view-all-tab">
            <table class="table table-striped" id="all-orders">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">PickUp Location</th>
                        <th scope="col">Date-Time</th>
                        <th scope="col">Trip Type</th>
                        <th scope="col">Drop Location</th>
                        <th scope="col">No. of Persons</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Status</th>
                        <th scope="col">Details</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allorders as $order)
                    <tr class="order-row">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $order->pickup_location }}</td>
                        <td>{{ date('d-m-Y h:ia', strtotime($order->pickup_date . ' ' . $order->pickup_time)) }}</td>
                        <td>{{ $order->trip_type }}</td>
                        <td>{{ $order->drop_location }}</td>
                        <td class="text-center">{{ $order->no_of_persons }}</td>
                        <td class="text-right">&#8377; {{ number_format($order->total_amount, 2) }}</td>
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
                        <td><i class="fa-solid fa-circle-info mt-1" id="helpicon{{$loop->iteration}}" data-bs-toggle="popover" title="{{ $order->special_request ? $order->special_request : 'NA' }}" tabindex="0"></i></td>
                        <td>
                            @if($order->status != 3 && $order->status != 5)
                                <form id="cancelForm{{ $loop->iteration }}" action="{{ route('cab-cancel-order', ['id' => $order->id]) }}" method="POST">
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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
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



















{{-- @extends('layouts.main')
@section('title', 'Cab Booking Orders')
@include('layouts.navigation')
@section('main-content')
<div class="container mt-5">
    <a href="{{ route("cab-booking") }}" class="btn btn-secondary my-3">Book Cab</a><br>
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
                    <th scope="col">PickUp Location</th>
                    <th scope="col">Date-Time</th>
                    <th scope="col">Trip Type</th>
                    <th scope="col">Drop Location</th>
                    <th scope="col">No. of Persons</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Status</th>
                    <th scope="col">Details</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
        <tbody>
            @foreach ($allorders as $order)
            <tr class="order-row" data-pickup="{{ $order->pickup_date . ' ' . $order->pickup_time }}">
                <td></td>
                <td>{{ $order->pickup_location }}</td>
                <td>{{ date('d-m-Y h:ia', strtotime($order->pickup_date . ' ' . $order->pickup_time)) }}</td>
                <td>{{ $order->trip_type }}</td>
                <td>{{ $order->drop_location }}</td>
                <td class="text-center">{{ $order->no_of_persons }}</td>
                <td class="text-right">&#8377; {{ number_format($order->total_amount, 2) }}</td>
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
                <td><i class="fa-solid fa-circle-info mt-1" id="helpicon{{$loop->iteration}}" data-bs-toggle="popover" title="{{ $order->special_request ? $order->special_request : 'NA' }}" tabindex="0"></i></td>
                <td>
                    @if($order->status != 3 && $order->status != 5)
                    <form id="cancelForm{{ $loop->iteration }}" action="{{ route('cab-cancel-order', ['id' => $order->id]) }}" method="POST">
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
        $('#upcomingBtn').addClass('active');
        $('#viewAllBtn').removeClass('active');
        $('.order-row').hide();
        var index = 0;
        $('.order-row').each(function() {
            var pickupDateTime = new Date($(this).data('pickup'));
            var currentDateTime = new Date();
            if (pickupDateTime > currentDateTime) {
                $(this).show();
                index++;
                $(this).find('td:first-child').text(index); 
            }
        });
    });

    $('#viewAllBtn').click(function() {
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

