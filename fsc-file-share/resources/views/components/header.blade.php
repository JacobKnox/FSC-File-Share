<nav class="navbar sticky-top navbar-expand-md text-white mb-4 py-3 px-3" style="background-color:#BA0C2F;">
    <ul class="navbar-nav mx-auto">
        <div class="nav-item text-center">
            <a class="navbar-brand mx-0 mr-md-2" href="/"><img src="{{ asset('img/fsc-logo.png') }}" alt="FSC Logo" width="44" height="40"></a>
        </div>
        <div class="nav-item text-center mt-2 mb-1">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </ul>
    
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <ul class="navbar-nav mr-auto flex-fill">
            <a class="{{ config('styles.buttonClasses') }}" href="/" style="{{ config('styles.buttonStyles') }}">Home</a>
            <a class="{{ config('styles.buttonClasses') }}" href="/files" style="{{ config('styles.buttonStyles') }}">Files</a>
            {{-- If the user is logged in (authenticated), then display appropriate links --}}
            @auth
                <a class="{{ config('styles.buttonClasses') }}" href="/users/{{$auth_user->id}}" style="{{ config('styles.buttonStyles') }}">Profile</a>
                <a class="{{ config('styles.buttonClasses') }}" href="/users/settings/{{$auth_user->id}}" style="{{ config('styles.buttonStyles') }}">Settings</a>
                @if($auth_user->checkRoles(["mod", "admin"], False))
                    <a class="{{ config('styles.buttonClasses') }}" href="/dashboard" style="{{ config('styles.buttonStyles') }}">Mod Dashboard</a>
                @endif
                <span class="navbar-text text-center d-md-none text-white">Welcome, {{ $auth_user->username }}!</span>
                <a href="/logout" class="btn btn-bg-danger d-md-none">Logout</a>
            {{-- If they're not, then show the appropriate option to log in --}}
            @else
                {{-- Login button, hidden on screens medium or bigger --}}
                <a class="{{ config('styles.buttonClasses') }} d-md-none" href="/login" style="{{ config('styles.buttonStyles') }}">Login</a>
                <a class="{{ config('styles.buttonClasses') }} d-md-none" href="/signup" style="{{ config('styles.buttonStyles') }}">Sign Up</a>
            @endif
        </ul>
        @auth
            <span class="navbar-text d-none d-md-flex text-white flex-fill justify-content-end">Welcome, {{ $auth_user->username }}!</span>
            <a href="/logout" class="d-none d-md-flex btn btn-bg-danger">Logout</a>
        @else
            {{-- Login form, hidden on screens smaller than medium (when burger pops up) --}}
            <ul class="my-0">
                <form class="form-inline d-none d-md-block" method="POST" action="/login">
                    @csrf

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="text" id="username" name="username" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" aria-label="Password">
                        <button class="btn btn-success ml-md-2" type="submit">Login</button>
                    </div>
                </form>
                <span class="navbar-text d-none d-md-block py-0 align-right text-white" style="font-size: x-small;">Don't have an account? <a href="/signup" class="text-white">Create one!</a></span>
            </ul>
        @endif
    </div>  
</nav>