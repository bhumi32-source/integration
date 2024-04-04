@extends ('layouts.main')
@section('title', 'Dashboard')
@section('main-content')
@section('styles')
  <link href="{{ url("css/dashboard.css") }}" rel="stylesheet">
@endsection
@include("layouts.navigation")

<div id="demo" class="carousel slide" data-bs-ride="carousel">
    <!-- Carousel Indicators -->
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
    </div>
    
    <!-- Carousel Slides -->
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
    
    <!-- Carousel Controls -->
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

    <div class="card mt-3 mx-2">
        <div class="card-body">
            <div class="card-title">Rate Us</div>
            <div class="card-subtitle text-muted">Let us know your experience</div>
            <div class="container d-flex justify-content-around" style="max-width: 100%">
                <div class="row">
                    <div class="col-md-12">
                        <div class="stars">
                            <form id="feedbackForm">
                                <!-- Star ratings inputs and labels -->
                                <input class="star star-5" id="star-5" type="radio" name="star" value="5"/>
                                <label class="star star-5" for="star-5"></label>
                                <input class="star star-4" id="star-4" type="radio" name="star" value="4"/>
                                <label class="star star-4" for="star-4"></label>
                                <input class="star star-3" id="star-3" type="radio" name="star" value="3"/>
                                <label class="star star-3" for="star-3"></label>
                                <input class="star star-2" id="star-2" type="radio" name="star" value="2"/>
                                <label class="star star-2" for="star-2"></label>
                                <input class="star star-1" id="star-1" type="radio" name="star" value="1"/>
                                <label class="star star-1" for="star-1"></label>

                                <textarea class="form-control mt-3 w-100" id="comments" name="comments" rows="3" placeholder="Leave your comments here..."></textarea>
                                <center><button type="submit" class="btn btn-primary mt-3">Submit Feedback</button></center>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="toast align-items-center position-fixed top-0 end-0 m-3" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
        <strong class="me-auto">Feedback Submitted</strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
        Thank you for your feedback!
    </div>
    </div>


    <div id="carouselExampleDark" class="carousel carousel-dark slide mx-2 mb-3 mt-3">
  <div class="carousel-inner">
  @foreach ($comments as $comment)
        <div class="carousel-item active">
            <div class="card">
                <div class="card-body">
                    <div class="card-title text-center">Comments</div>
                    <p class="card-text text-center">{{$comment->comments}} </p>
                </div>
            </div>
        </div>
        @endforeach
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
</div>

<footer class="footer py-4 rounded-5 rounded-bottom" style="background-color: rgb(221, 231, 240);">
    <div class="container-fluid ">
      <div class="d-flex justify-content-center">
    <i class="fa-brands fa-facebook"></i>&nbsp;&nbsp;&nbsp;
    <i class="fab fa-instagram-square"></i>&nbsp;&nbsp;&nbsp;
    <i class="fa-brands fa-twitter"></i>&nbsp;&nbsp;&nbsp;
    <i class="fa-brands fa-whatsapp-square"></i>
    </div>
        <p class="text-center">&copy; RS App</p>
    </div>
</footer>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#feedbackForm').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            formData += '&_token={{ csrf_token() }}';
            $.ajax({
                url: '{{ route('feedback.store') }}', 
                type: 'POST',
                data: formData,
                success: function(response) {
                    console.log(response);
                    $('.toast').toast('show');
                    setTimeout(function() {
                        $('.toast').toast('hide');
                    }, 3000);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>

@endsection
