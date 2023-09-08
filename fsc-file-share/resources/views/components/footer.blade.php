<div class="container">
    <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-5 my-5 border-top">
      <div class="col mb-3">
        <a href="/" class="d-flex align-items-center mb-3 link-dark text-decoration-none">
          <p>Jacob Knox</p>
        </a>
        <p class="text-muted">© 2023</p>
      </div>
  
      <div class="col mb-3">
        <h5>Site Map</h5>
        <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Home</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Files</a></li>
            @if(Auth::check() || config('myconfig.testing'))
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Profile</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Settings</a></li>
            @else
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Login</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Sign Up</a></li>
            @endif
        </ul>
      </div>
  
      <div class="col mb-3">
        <h5>Important</h5>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Terms & Conditions</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Privacy Policy</a></li>
        </ul>
      </div>
  
      <div class="col mb-3">
        <h5>Contact</h5>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Home</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Features</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Pricing</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">FAQs</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">About</a></li>
        </ul>
      </div>
    </footer>
</div>