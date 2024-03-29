@extends('layouts.main')
@section('title', 'Extend Stay Requests')
@include('layouts.navigation')
@section('main-content')
<div class="container mt-5">
    <a href="{{ route("extend-stay") }}" class="btn btn-secondary my-3">Extend Stay</a>
    <table class="table table-striped text-center">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Booking No.</th>
                <th scope="col">Extended Till</th>
                <th scope="col">Status</th>
                <th scope="col">Details</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$order->booking_reference_number}}</td>
                    <td>{{ date('d-m-Y', strtotime($order->extend_till_date)) }}</td>
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
                            <button type="button" class="btn btn-danger cancel-btn" data-order-id="{{ $order->id }}">Cancel</button>
                        @endif
                    </td>
                </tr>                      
            @endforeach
        </tbody>
    </table>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
    var orderId = $(this).data('order-id');
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
                type: 'POST',
                url: '{{ route("extend-stay-cancel", ["id" => "__id__"]) }}'.replace('__id__', orderId),
                data: { _token: '{{ csrf_token() }}' },
                success: function(response) {
                    if (response.success) {
                        Swal.fire("Your order has been cancelled!", "", "success")
                        .then(function() {
                            location.reload();
                        });
                    } else {
                        Swal.fire("Failed to cancel the order. Please try again later.", "", "error");
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire("Failed to cancel the order. Please try again later.", "", "error");
                }
            });
        } else {
            Swal.fire("Your order is safe!", "", "info");
        }
    });
});
</script>
@endsection
