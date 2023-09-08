@php
    $buttonStyles = "background-color: #0032A0; color: white; border: 2px black solid; border-radius: 10px; text-align: center; min-width: 80px;";
    $buttonClasses = "nav-item nav-link mx-0 mx-md-1 my-1 my-md-0 btn-block"
@endphp

<nav class="navbar sticky-top navbar-expand-md" style="background-color:#BA0C2F; color:white;">
    <ul class="navbar-nav mx-auto">
        <div class="nav-item">
            <a class="navbar-brand mx-0 mr-md-2" href="/">FSC File Share</a>
        </div>
        <div class="nav-item text-center">
            <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </ul>
    
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <ul class="navbar-nav mr-auto">
            <a class="{{$buttonClasses}}" href="/" style="{{$buttonStyles}}">Home</a>
            <a class="{{$buttonClasses}}" href="#" style="{{$buttonStyles}}">Files</a>
            <!-- If the user is logged in (authenticated), then display appropriate links -->
            @if(Auth::check() || config('myconfig.testing'))
                <a class="{{$buttonClasses}}" href="#" style="{{$buttonStyles}}">Profile</a>
                <a class="{{$buttonClasses}}" href="#" style="{{$buttonStyles}}">Settings</a>
                <span class="navbar-text text-center d-md-none">Welcome, user!</span>
            <!-- If they're not, then show the appropriate option to log in -->
            @else
                <!-- Login button, hidden on screens medium or bigger -->
                <a class="{{$buttonClasses}} d-md-none" href="#" style="{{$buttonStyles}}">Login</a>
                <a class="{{$buttonClasses}} d-md-none" href="#" style="{{$buttonStyles}}">Sign Up</a>
            @endif
        </ul>
        @if(Auth::check() || config('myconfig.testing'))
            <span class="navbar-text d-none d-md-block">Welcome, user!</span>
        @else
            <!-- Login form, hidden on screens smaller than medium (when burger pops up) -->
            <ul class="my-0">
                <form class="form-inline d-none d-md-block">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                        <input type="password" class="form-control" placeholder="Password" aria-label="Password">
                        <button class="btn btn-success ml-md-2" type="submit">Login</button>
                    </div>
                </form>
                <span class="navbar-text d-none d-md-block py-0 align-right" style="font-size: x-small;">Don't have an account? <a href="#" style="color:white; text-decoration: underline;">Create one!</a></span>
            </ul>
        @endif
    </div>  
</nav>