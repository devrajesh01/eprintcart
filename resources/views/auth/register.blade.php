@extends('layout.masterlayout')

@section('content')
<section class="register-section py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="register-box p-4 shadow-lg rounded">
          <h2 class="text-center mb-4">Create an Account</h2>
          <form>
            <div class="mb-3">
              <label for="name" class="form-label">Full Name</label>
              <input type="text" class="form-control" id="name" placeholder="Enter your name" required>
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Email Address</label>
              <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" placeholder="Enter password" required>
            </div>

            <div class="mb-3">
              <label for="confirmPassword" class="form-label">Confirm Password</label>
              <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm password" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Register</button>

            <p class="text-center mt-3 mb-0">
              Already have an account? <a class="link" href="{{route('login')}}">Login</a>
            </p>
          </form>
        </div>
      </div>
    </div>s
  </div>
</section>
    
@endsection