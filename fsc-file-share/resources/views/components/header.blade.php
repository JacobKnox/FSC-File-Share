<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">FSC File Share</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link" href="#">Home</a>
            <a class="nav-item nav-link" href="#">Files</a>
            <!-- If the user is logged in (authenticated), then display appropriate links -->
            @if(Auth::check())
                <a class="nav-item nav-link" href="#">Profile</a>
                <a class="nav-item nav-link" href="#">Settings</a>
            <!-- If they're not, then show the appropriate option to log in -->
            @else
                <!-- Login form, hidden on screens smaller than large (when burger pops up) -->
                <form class="form-inline d-none d-lg-block">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                        <input type="password" class="form-control" placeholder="Password" aria-label="Password">
                        <button class="btn btn-outline-success" type="submit">Login</button>
                    </div>
                </form>
                <!-- Login button, hidden of screens large or bigger -->
                <a class="nav-item nav-link d-lg-none" href="#">Login</a>
            @endif
        </div>
    </div>
</nav>