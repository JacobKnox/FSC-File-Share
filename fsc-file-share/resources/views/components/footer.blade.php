<div class="container text-center text-md-start">
    <footer class="row pt-5 mt-5 border-top">
      <div class="col-12 col-sm-6 col-md-3 mb-3">
        <a class=" nav-link text-muted" href="#">Jacob Knox</a>
        <p class="text-muted">© 2023</p>
      </div>
      <div class="col-12 col-sm-6 col-md-3 mb-3">
        <h5>Site Map</h5>
        <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="/" class="nav-link p-0 text-muted">Home</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Files</a></li>
            @if(Auth::check() || config('myconfig.testing')) {{-- Convert to @auth when account system is implemented --}}
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Profile</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Settings</a></li>
            @else
                <li class="nav-item mb-2"><a href="/login" class="nav-link p-0 text-muted">Login</a></li>
                <li class="nav-item mb-2"><a href="/signup" class="nav-link p-0 text-muted">Sign Up</a></li>
            @endif
        </ul>
      </div>
  
      <div class="col-12 col-sm-6 col-md-3 mb-3">
        <h5>Important</h5>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Terms & Conditions</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Privacy Policy</a></li>
        </ul>
      </div>
  
      <div class="col-12 col-sm-6 col-md-3 mb-3">
        <h5>Contact</h5>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="mailto:jacobknoxa@gmail.com" class="nav-link p-0 text-muted">jacobknoxa@gmail.com</a></li>
          <li class="nav-item mb-2"><a href="/bug" class="nav-link p-0 text-muted">Bug Report</a></li>
        </ul>
      </div>
    </footer>
</div>