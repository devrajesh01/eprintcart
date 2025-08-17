@extends('layout.masterlayout')

@section('content')
<section class="register-section py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="register-box p-4 shadow-lg rounded">
          <h2 class="text-center mb-4">Login In</h2>
          <form>
            

            <div class="mb-3">
              <label for="email" class="form-label">Email Address</label>
              <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" placeholder="Enter password" required>
            </div>

            

            <button type="submit" class="btn btn-primary w-100">Login</button>

            <p class="text-center mt-3 mb-0">
              Do Not Have An Account? <a class="link" href="{{route('register')}}">Register Now</a>
            </p>
          </form>
        </div>
      </div>
    </div>s
  </div>
</section>
    
@endsection