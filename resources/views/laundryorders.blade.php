@extends('layouts.main')
@section('title', 'Laundry Orders')
@include('layouts.navigation')
@section('main-content')
<div class="container mt-5">

        <a href="{{ route("laundry") }}" class="btn btn-secondary my-3">Book Service</a>
    
    <table class="table table-striped text-center">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Booking No.</th>
                <th scope="col">Service</th>
                <th scope="col">Details</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$order->booking_reference_number}}</td>
                    <td>{{$order->laundry_service_type}}</td>
                    <td><i class="fa-solid fa-circle-info mt-1" id="helpicon{{$loop->iteration}}" data-bs-toggle="popover" title="{{ $order->special_request ? $order->special_request : 'NA' }}" tabindex="0"></i></td>
                        
                </tr>                      
            @endforeach
        </tbody>
    </table>
</div>
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
</script>

</body>
</html>
