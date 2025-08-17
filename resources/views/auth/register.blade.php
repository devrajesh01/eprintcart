@extends('layout.masterlayout')

@section('content')
<section class="register-section py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="register-box p-4 shadow-lg rounded">
          <h2 class="text-center mb-4">Create an Account</h2>
          <form action="{{ route('register.store') }}" method="POST">
            @csrf

            <div class="mb-3">
              <label for="name" class="form-label">Full Name</label>
              <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name') }}" placeholder="Enter your name">
              @error('name')
              <div class="text-danger small">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Email Address</label>
              <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}" placeholder="Enter your email">
              @error('email')
              <div class="text-danger small">{{ $message }}</div>
              @enderror
            </div>

            <input type="hidden" name="user_type" value="customer">

            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                placeholder="Enter password">
              @error('password')
              <div class="text-danger small">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="password_confirmation" class="form-label">Confirm Password</label>
              <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password">
            </div>

            <button type="submit" class="btn btn-primary w-100">Register</button>

            <p class="text-center mt-3 mb-0">
              Already have an account? <a class="link" href="{{ route('login') }}">Login</a>
            </p>
          </form>

        </div>
      </div>
    </div>s
  </div>
</section>

@endsection