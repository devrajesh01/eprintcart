<header class="main-header">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <nav class="navbar navbar-expand-lg">
    <div class="container header-container ">
      <a class="logo" href="{{route('home')}}"><img src="{{asset('images/brand-logo.png')}}" alt="">Eprintcart</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
        aria-controls="offcanvasNavbar">
        <i class="fa-solid fa-bars"></i>
        </span>
      </button>
      <div class="offcanvas offcanvas-end slow" tabindex="-1" id="offcanvasNavbar"
        aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <div class="under-menu-logo">
            <a class="logo" href="{{route('home')}}"><img src="{{asset('images/brand-logo.png')}}" alt="">Eprintcart</a>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav">
            <li class="nav-item {{Route::is('home*')? 'active': ''}}">
              <a class="nav-link " aria-current="page" href="{{route('home')}}">Home</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link {{Route::is('shop*')? 'active': ''}}" href="{{route('shop')}}">Mug</a>
            </li>
            <li class="nav-item {{Route::is('about.page*')? 'active': ''}}">
              <a class="nav-link" href="{{route('about.page')}}"> About </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{Route::is('shop*')? 'active': ''}}" href="{{route('shop')}}">Shop </a>
            </li>


            <li class="nav-item {{Route::is('contact.page*')? 'active': ''}}">
              <a class="nav-link" href="{{route('contact.page')}}">Contact</a>
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
            <li><a href="{{route ('customer.cart.index')}}"><i class="fa-solid fa-cart-shopping"></i></a></li>
            @endauth
          </ul>
        </div>
      </div>
    </div>
  </nav>

</header>