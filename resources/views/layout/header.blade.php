<header class="main-header">

  <nav class="navbar navbar-expand-lg">
    <div class="container header-container ">
      <a class="logo" href="#"><img src="{{asset('images/brand-logo.png')}}" alt="">Eprintcart</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
        aria-controls="offcanvasNavbar">
        <i class="fa-solid fa-bars"></i>
        </span>
      </button>
      <div class="offcanvas offcanvas-end slow" tabindex="-1" id="offcanvasNavbar"
        aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <div class="under-menu-logo">
            <a class="logo" href="#"><img src="{{asset('images/brand-logo.png')}}" alt="">Eprintcart</a>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="#">Link2</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="#">Policy Consultations </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="event.html">Events</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="#"> About </a>
            </li>
          </ul>
          <ul class="right-side">
            @guest
            {{-- Shown only when no one is logged in --}}
            <li><a href="{{ route('login') }}">Login</a></li>
            @endguest

            @auth
            {{-- Shown when admin OR customer is logged in --}}
            <li>
              <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Log Out
              </a>
            </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
            @endauth

            <li><a href="#"><i class="fa-solid fa-cart-shopping"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

</header>