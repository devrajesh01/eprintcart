@extends('layout.masterlayout')

@section('content')
<section class="register-section py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="register-box p-4 shadow-lg rounded">
          <h2 class="text-center mb-4">Verify OTP</h2>

          {{-- ✅ Flash messages --}}
          @if(session('success'))
            <div class="alert alert-success">
              {{ session('success') }}
            </div>
          @endif

          @if(session('error'))
            <div class="alert alert-danger">
              {{ session('error') }}
            </div>
          @endif

          <form method="POST" action="{{ route('otp.verify') }}">
            @csrf
            <div class="mb-3">
              <label for="otp" class="form-label">Enter OTP</label>
              <input type="text" name="otp" class="form-control" id="otp" placeholder="Enter OTP" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Verify OTP</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
