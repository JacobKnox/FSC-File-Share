@php
    $buttonStyles = "background-color: #0032A0; min-width: 80px;";
    $buttonClasses = "nav-item nav-link mx-0 mx-md-1 my-1 my-md-0 btn-block text-center text-white border rounded-pill border-2 border-dark"
@endphp

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
            <a class="{{$buttonClasses}}" href="/" style="{{$buttonStyles}}">Home</a>
            <a class="{{$buttonClasses}}" href="#" style="{{$buttonStyles}}">Files</a>
            {{-- If the user is logged in (authenticated), then display appropriate links --}}
            @if(Auth::check() || config('myconfig.testing')) {{-- Convert to @auth when account system is implemented --}}
                <a class="{{$buttonClasses}}" href="#" style="{{$buttonStyles}}">Profile</a>
                <a class="{{$buttonClasses}}" href="#" style="{{$buttonStyles}}">Settings</a>
                <span class="navbar-text text-center d-md-none text-white">Welcome, user!</span>
            {{-- If they're not, then show the appropriate option to log in --}}
            @else
                {{-- Login button, hidden on screens medium or bigger --}}
                <a class="{{$buttonClasses}} d-md-none" href="/login" style="{{$buttonStyles}}">Login</a>
                <a class="{{$buttonClasses}} d-md-none" href="/signup" style="{{$buttonStyles}}">Sign Up</a>
            @endif
        </ul>
        @if(Auth::check() || config('myconfig.testing'))
            <span class="navbar-text d-none d-md-flex text-white flex-fill justify-content-end">Welcome, user!</span>
        @else
            {{-- Login form, hidden on screens smaller than medium (when burger pops up) --}}
            <ul class="my-0">
                <form class="form-inline d-none d-md-block" method="POST" action="/login">
                    @csrf

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                        <input type="password" class="form-control" placeholder="Password" aria-label="Password">
                        <button class="btn btn-success ml-md-2" type="submit">Login</button>
                    </div>
                </form>
                <span class="navbar-text d-none d-md-block py-0 align-right text-white" style="font-size: x-small;">Don't have an account? <a href="/signup" class="text-white">Create one!</a></span>
            </ul>
        @endif
    </div>  
</nav>