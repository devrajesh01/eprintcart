<header class="main-header">

  <nav class="navbar navbar-expand-lg">
    <div class="container header-container ">
      <a class="logo" href="{{ route('home') }}"><img src="{{ asset('images/brand-logo.png') }}" alt="">Eprintcart</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
        aria-controls="offcanvasNavbar">
        <i class="fa-solid fa-bars"></i>
        </span>
      </button>
      <div class="offcanvas offcanvas-end slow" tabindex="-1" id="offcanvasNavbar"
        aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <div class="under-menu-logo">
            <a class="logo" href="{{ route('home') }}"><img src="{{ asset('images/brand-logo.png') }}"
                alt="">Eprintcart</a>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav">
            <li class="nav-item {{ Route::is('home*') ? 'active' : '' }}">
              <a class="nav-link " aria-current="page" href="{{ route('home') }}">Home</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link {{ Route::is('shop*') ? 'active' : '' }}" href="{{ route('shop') }}">Mug</a>
            </li>
            <li class="nav-item {{ Route::is('about.page*') ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('about.page') }}"> About </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ Route::is('shop*') ? 'active' : '' }}" href="{{ route('shop') }}">Shop
              </a>
            </li>


            <li class="nav-item {{ Route::is('contact.page*') ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('contact.page') }}">Contact</a>
            </li>

          </ul>
          <ul class="right-side">
            @guest
              {{-- Shown only when no one is logged in --}}
              <li><a href="{{ route('login') }}">Login</a></li>
            @endguest

            @auth
              {{-- Shown when admin OR customer is logged in --}}
              {{-- <li>
                <a href="{{ route('logout') }}"
                  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  Log Out
                </a>
              </li>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form> --}}
              <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); confirmLogout();">
                  Log Out
                </a>
              </li>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
              <li><a href="{{ route('customer.cart.index') }}"><i class="fa-solid fa-cart-shopping"></i></a>
              </li>
            @endauth

            <div class="header-icons position-relative">
              <!-- 🔍 Search toggle button -->
              <button id="searchToggle" class="btn btn-link p-0 border-0">
                <i class="fas fa-search fa-lg"></i>
              </button>
            </div>

            <!-- 🔎 Search overlay -->
            <div id="searchOverlay" class="position-fixed w-100 h-100 top-0 start-0 bg-dark bg-opacity-75 d-none"
              style="z-index:2000;">
              <div class="d-flex justify-content-center align-items-start pt-5">
                <div class="bg-white rounded p-3 shadow" style="width: 600px;">
                  <input type="text" id="searchInput" class="form-control" placeholder="Search products...">
                  <div id="searchResults" class="list-group mt-2" style="max-height:300px; overflow:auto;"></div>
                </div>
              </div>
            </div>

          </ul>
        </div>
      </div>
    </div>
    @auth
        @if(Auth::user()->user_type === 'customer')
            <div class="profile">
                <a href="{{route('user.profile')}}"><i class="fa-solid fa-user"></i></a>
            </div>
        @endif
       @endauth
  </nav>

</header>
<div id="searchBar"> <button id="closeSearch"><i class="fas fa-times"></i></button> <input type="text"
    placeholder="Search products..." /> <button class="search-btn"><i class="fas fa-search"></i></button> </div>




<script>
  // Search js
  $(document).ready(function () {
    // Only run if button exists
    if ($('#searchToggle').length) {
      // 🔘 Toggle overlay
      $('#searchToggle').on('click', function () {
        $('#searchOverlay').removeClass('d-none');
        $('#searchInput').focus();
      });

      // ❌ Close overlay on outside click
      $('#searchOverlay').on('click', function (e) {
        if (!$(e.target).closest('#searchInput, #searchResults').length) {
          $('#searchOverlay').addClass('d-none');
        }
      });

      // 🔎 AJAX search
      $('#searchInput').on('keyup', function () {
        let query = $(this).val();

        if (query.length > 1) {
          $.ajax({
            url: "{{ route('products.search') }}",
            type: "GET",
            data: { query: query },
            success: function (data) {
              let results = '';
              if (data.length > 0) {
                data.forEach(product => {
                  results += `
                                    <a href="/product/${product.id}" class="list-group-item list-group-item-action">
                                        <strong>${product.product_name}</strong><br>
                                        <small>${product.product_category}</small>
                                    </a>`;
                });
              } else {
                results = `<div class="list-group-item">No products found</div>`;
              }
              $('#searchResults').html(results).show();
            }
          });
        } else {
          $('#searchResults').html('');
        }
      });
    }
  });



  // Logout js
  function confirmLogout() {
    if (confirm("Are you sure you want to log out?")) {
      document.getElementById('logout-form').submit();
    }
  }

</script>