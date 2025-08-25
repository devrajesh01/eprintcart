@extends('layout.masterlayout')

@section('content')
<div class="container-fluid">
  <div class="row">
    
    <!-- Sidebar -->
    <div class="col-md-3 col-lg-2 bg-dark text-white min-vh-100 p-3">
      <h4 class="mb-3">Dashboard</h4>
      <ul class="nav flex-column admin-menu">
        <li class="nav-item mb-2">
          <a href="{{route('list.products')}}" class="nav-link text-white {{ Route::is('list.products*') ? 'active' : '' }}"
          >
            <i class="fa-solid fa-user me-2"></i> All Products
          </a>
        </li>
        <li class="nav-item mb-2">
          <a href="{{route ('add.product')}}" class="nav-link text-white {{ Route::is('add.product*') ? 'active' : '' }}">
            <i class="fa-solid fa-user me-2"></i> Add Products
          </a>
        </li>
        <li class="nav-item mb-2">
          <a href="{{route ('admin.contacts')}}" class="nav-link text-white {{ Route::is('admin.contacts*') ? 'active' : '' }}">
            <i class="fa-solid fa-user me-2"></i> Contacts
          </a>
        </li>
        <li class="nav-item mb-2">
          <a href="#" class="nav-link text-white ">
            <i class="fa-solid fa-clipboard-list me-2"></i> Orders
          </a>
        </li>
        <li class="nav-item mb-2">
          <a href="#" class="nav-link text-white ">
            <i class="fa-solid fa-cog me-2"></i> Settings
          </a>
        </li>       
      </ul>
     
    </div>
    <!-- Main Content -->
    <div class="col-md-9 col-lg-10 p-4">
      <h2 class="mb-1">Welcome </h2>
      @yield('dashboardcontent')
      @yield('addproduct')
      @yield('editProduct')
    </div>

  </div>
</div>
@endsection