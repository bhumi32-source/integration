<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Extended Stay Orders</title>
</head>
<body>
  @include("layouts.navigation")
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
                                <form id="cancelForm{{ $loop->iteration }}" action="{{ route('extend-stay-cancel', ['id' => $order->id]) }}" method="POST">
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
