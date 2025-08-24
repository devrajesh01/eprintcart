{{-- @extends('layout.masterlayout')
@section('content')

  
<section class="">
<div class="contact-header common-banner">
   <h1>Contact Us</h1>
      <p class="lead">We’d love to hear from you! Reach out with any questions, feedback, or just to say hi.</p>
    </div>
</div>
    <!-- Header -->
    <div class="container">

    <div class="row g-4">
      
      <!-- Contact Form -->
      <div class="col-lg-7">
        <div class="contact-card">
          <h4 class="mb-4">Send Us a Message</h4>
          <form>
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Your Name</label>
                <input type="text" class="form-control" placeholder="John Doe">
              </div>
              <div class="col-md-6">
                <label class="form-label">Your Email</label>
                <input type="email" class="form-control" placeholder="you@example.com">
              </div>
              <div class="col-12">
                <label class="form-label">Subject</label>
                <input type="text" class="form-control" placeholder="Subject">
              </div>
              <div class="col-12">
                <label class="form-label">Message</label>
                <textarea class="form-control" rows="5" placeholder="Write your message here..."></textarea>
              </div>
            </div>
            <button class="btn btn-primary btn-lg mt-4" type="submit">Send Message</button>
          </form>
        </div>
      </div>

      <!-- Contact Info -->
      <div class="col-lg-5">
        <div class="contact-card">
          <h4 class="mb-4">Get in Touch</h4>
          <p><strong>📍 Address:</strong> 6 Nalta Subhas Sarani, Dum Dum Cantonment, Kolkata , 700028</p>
          <p><strong>📞 Phone:</strong><a target="_blank" href="tel: 8274074022"> 8274074022</a></p>
          <p><strong>✉️ Email:</strong> <a target="_blank" href="mailto:eprintcart24x7@gmail.com"> eprintcart24x7@gmail.com</a></p>         
        </div>
      </div>
    </div>

    <!-- Map -->
    <div class="map-container mt-5">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4147.289165198775!2d88.41741527568513!3d22.64568043028711!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f89e6846723bf9%3A0x8955780386637295!2s6%2C%20Subhash%20Sarani%2C%20Nalta%2C%20Rajbari%2C%20Dum%20Dum%2C%20Kolkata%2C%20West%20Bengal%20700028!5e1!3m2!1sen!2sin!4v1755689422865!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      
    </div>
  </div>
  </section>


@endsection --}}

@extends('layout.masterlayout')
@section('content')

  
<section class="">
<div class="contact-header common-banner">
   <h1>Contact Us</h1>
      <p class="lead">We’d love to hear from you! Reach out with any questions, feedback, or just to say hi.</p>
    </div>
</div>


    <!-- Header -->
    
     
    <div class="container">

    <div class="row g-4">
      
      <!-- Contact Form -->
      <div class="col-lg-7">
        <div class="contact-card">
          <h4 class="mb-4">Send Us a Message</h4>
          @if(session('success'))
          <div class="alert alert-success" id="successMessage">
              {{ session('success') }}
          </div>
           @endif
          <form action="{{ route('contact.store') }}" method="POST">
              @csrf
              <div class="row g-3">
                  <div class="col-md-6">
                      <label class="form-label">Your Name</label>
                      <input type="text" name="name" class="form-control" placeholder="John Doe" required>
                  </div>
                  <div class="col-md-6">
                      <label class="form-label">Your Email</label>
                      <input type="email" name="email" class="form-control" placeholder="you@example.com" required>
                  </div>
                  <div class="col-md-6">
                      <label class="form-label">Phone</label>
                      <input type="tel" name="phone" class="form-control" placeholder="phone">
                  </div>
                  <div class="col-md-6">
                      <label class="form-label">Subject</label>
                      <input type="text" name="subject" class="form-control" placeholder="Subject">
                  </div>
                  <div class="col-12">
                      <label class="form-label">Message</label>
                      <textarea name="message" class="form-control" rows="5" placeholder="Write your message here..." required></textarea>
                  </div>
              </div>
              <button class="btn btn-primary btn-lg mt-4" type="submit">Send Message</button>
          </form>
        </div>
      </div>

      <!-- Contact Info -->
      <div class="col-lg-5">
        <div class="contact-card">
          <h4 class="mb-4">Get in Touch</h4>
          <p><strong>📍 Address:</strong> 6 Nalta Subhas Sarani, Dum Dum Cantonment, Kolkata , 700028</p>
          <p><strong>📞 Phone:</strong><a target="_blank" href="tel: 8274074022"> 8274074022</a></p>
          <p><strong>✉️ Email:</strong> <a target="_blank" href="mailto:eprintcart24x7@gmail.com"> eprintcart24x7@gmail.com</a></p>         
        </div>
      </div>
    </div>

    <!-- Map -->
    <div class="map-container mt-5">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4147.289165198775!2d88.41741527568513!3d22.64568043028711!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f89e6846723bf9%3A0x8955780386637295!2s6%2C%20Subhash%20Sarani%2C%20Nalta%2C%20Rajbari%2C%20Dum%20Dum%2C%20Kolkata%2C%20West%20Bengal%20700028!5e1!3m2!1sen!2sin!4v1755689422865!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      
    </div>
  </div>
  </section>

<script>
    // wait 3 seconds then hide the alert
    setTimeout(function() {
        let successMessage = document.getElementById('successMessage');
        if (successMessage) {
            successMessage.style.display = 'none';
        }
    }, 3000);
</script>

@endsection