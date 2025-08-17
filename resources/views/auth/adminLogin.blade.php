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
              <label for="user-name" class="form-label">Email Address</label>
              <input type="text" name="user-name" class="form-control" id="user-name" placeholder="Enter your user name" required>
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Email Address</label>
              <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" required>
            </div>           

            <button type="submit" class="btn btn-primary w-100">Login</button>            
          </form>
        </div>
      </div>
    </div>
  </div>
</section>    
@endsection