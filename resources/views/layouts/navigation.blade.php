


<nav class="navbar bg-light fixed-top mb-5">
  <div class="container-fluid">
    <a class="navbar-brand" href="/dashboard">RS APP</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Welcome {{$username}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route("dashboard") }}">Home</a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}" id="logout-link">Logout</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Services
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{ route("room-cleaning") }}">Room Cleaning</a></li>
              <li><a class="dropdown-item" href="{{ route("extra-bed") }}">Order Extra Bed</a></li>
              <li><a class="dropdown-item" href="{{ route("extend-stay") }}">Extend Stay</a></li>
              <li><a class="dropdown-item" href="{{ route("laundry") }}">Laundry</a></li>
              <li><a class="dropdown-item" href="{{ route("toiletries.index") }}">Order Toiletries</a></li>
              <li><a class="dropdown-item" href="{{ route("linen.index") }}">Order Linen</a></li>
            </ul>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="{{ route("food.index") }}" >Order Food</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Facilities
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{ route("cab-booking") }}">Book Cab</a></li>
              <li><a class="dropdown-item" href="{{ route("spa") }}">Book Spa</a></li>
              <li><a class="dropdown-item" href="{{ route("book_guide") }}">Book Guide</a></li>
              <li><a class="dropdown-item" href="{{ route("custom_decoration") }}">Custom Decoration</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>