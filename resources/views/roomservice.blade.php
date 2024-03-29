@extends('layouts.main')

@section('title', 'Room Services')

@include('layouts.navigation')

@section('main-content')
<h2 class="text-center mt-5 mb-4">Our Services</h2> <!-- Increase the top margin of the heading -->
<div class="container mt-4"> <!-- Add top margin to the container -->
  <div class="row row-cols-1 row-cols-md-3 g-4">
    @foreach($services as $service)
    <div class="col">
      <div class="card h-100">
        <img src="{{ asset('images/' . $service->image) }}" class="card-img-top img-fluid" alt="Service Image" style="object-fit: cover; height: 200px;">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title text-center">{{ $service->title }}</h5>
          <p class="card-text">{{ $service->description }}</p>
          @switch($service->title)
              @case('Room Cleaning')
                  <a href="{{ route('room-cleaning') }}" class="btn btn-primary mt-auto">Book Now</a>
                  @break
              @case('Extra Bed')
                  <a href="{{ route('extra-bed') }}" class="btn btn-primary mt-auto">Book Now</a>
                  @break
              @case('Extend Stay')
                  <a href="{{ route('extend-stay') }}" class="btn btn-primary mt-auto">Book Now</a>
                  @break
              @case('Laundry')
                  <a href="{{ route('laundry') }}" class="btn btn-primary mt-auto">Book Now</a>
                  @break
              @case('Linen Order')
                  <a href="{{ route('linen.index') }}" class="btn btn-primary mt-auto">Book Now</a>
                  @break
              @case('Toiletries Order')
                  <a href="{{ route('toiletries.index') }}" class="btn btn-primary mt-auto">Book Now</a>
                  @break
          @endswitch
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection
