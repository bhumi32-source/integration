@extends ('layouts.main')
@section('title', 'Dashboard')
@section('main-content')
@section('styles')
  <link href="{{ url("css/dashboard.css") }}" rel="stylesheet">
@endsection
@include("layouts.navigation")

<div id="demo" class="carousel slide" data-bs-ride="carousel">

    <!-- Indicators/dots -->
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
      <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
      <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
    </div>
    
    <!-- The slideshow/carousel -->
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{ url('images/himg1.jpeg')}}" alt="Los Angeles" class="d-block" style="width:100%">
      </div>
      <div class="carousel-item">
        <img src="{{ url('images/himg2.jpeg')}}" alt="Chicago" class="d-block" style="width:100%">
      </div>
      <div class="carousel-item">
        <img src="{{ url('images/himg3.jpeg')}}" alt="New York" class="d-block" style="width:100%">
      </div>
    </div>
    
    <!-- Left and right controls/icons -->
    <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>
  

<div class="container-fluid mt-3">
<a href="{{ route("room-service")}}">
  <div class="row mb-2 mx-2 align-items-center rounded-4 py-2 custom-color">
    <div class="col-2 d-flex align-items-center justify-content-center">
      <img src="{{ url('images/cleaning-cart.png') }}" class="img-fluid">
    </div>
    <div class="col-10">
      Room <br>
      Services
      <div class="text-muted">Laundry, Cleaning, Toiletries...</div>
    </div>
  </div>
</a>

  <div class="row mx-2 mb-2">

    <div class="col-6 py-2">
    <a href="{{ route('food.index')}}">
      <div class="row border me-1 rounded-4 py-3 custom-color">
        <div class="col-4 d-flex align-items-center justify-content-center">
          <img src="{{ url('images/food.png')}}" class="img-fluid" >
        </div>
        <div class="col-8"> 
          Food <br>
          & Bar
        </div>
      </div>
      </a>
    </div>

  
    <div class="col-6 py-2">
    <a href="{{ route('menu.index')}}">
      <div class="row border ms-1 rounded-4 py-3 custom-color">
        <div class="col-3 d-flex align-items-center justify-content-center">
          <img src="{{ url('images/menu-of-the-day.png')}}" class="img-fluid" >
        </div>
        <div class="col-9">        
          Menu of<br>
          the day
        </div>
      </div>
      </a>
    </div>

  </div>

  <a href="{{ route("hotel-facilities")}}">
  <div class="row mb-2 mx-2 align-items-center rounded-4 py-2 custom-color">
    <div class="col-2 d-flex align-items-center justify-content-center">
      <img src="{{ url('images/taxi.png')}}" class="img-fluid">
    </div>
    <div class="col-10">
      Hotel <br>
      Facilities  
      <div class="text-muted">Book a cab, Spa, Local Guide...</div>
    </div>
  </div>
</a>
  </div>


  <div class="card mt-3 mx-2">
    <div class="card-body">
      <div class="card-title">Rate Us</div>
      <div class="card-subtitle text-muted">Let us know your experience</div>
      <form action="">
        <div class="ratings d-flex justify-content-around mt-4">
          <input id="star1" value="1" type="radio" class="star star-1"/>
          <label for="star1" class="far fa-star star star-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Very Bad"></label>
          
          <input id="star2" value="2" type="radio" class="star star-2"/>
          <label for="star2" class="far fa-star star star-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Poor"></label>
          
          <input id="star3" value="3" type="radio" class="star star-3"/>
          <label for="star3" class="far fa-star star star-3" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ok"></label>
          
          <input id="star4" value="4" type="radio" class="star star-4"/>
          <label for="star4" class="far fa-star star star-4" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Good"></label>
          
          <input id="star5" value="5" type="radio" class="star star-5"/>
          <label for="star5" class="far fa-star star star-5" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Excellent"></label>
        </div>
      </form>
    </div>
  </div>


  <div id="carouselExampleControls" class="carousel slide mx-2 mb-3 mt-3" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="card">
          <div class="card-body">
            <div class="card-title">comments</div>
            <p class="card-text">Some quick example text to build on the card title </p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <div class="card">
          <div class="card-body">
            <div class="card-title">comments</div>
            <p class="card-text">Some quick example text to build on the card title </p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <div class="card">
          <div class="card-body">
            <div class="card-title">comments</div>
            <p class="card-text">Some quick example text to build on the card title </p>
          </div>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</div>


<footer class="footer py-4 rounded-5 rounded-bottom" style="background-color: rgb(221, 231, 240);">
  <div class="container-fluid ">
    <span class>Place sticky footer content here.</span>
    <span class>Place sticky footer content here.</span>
    <span class>Place sticky footer content here.</span>
    <span class>Place sticky footer content here.</span>
  </div>
</footer>

@endsection

