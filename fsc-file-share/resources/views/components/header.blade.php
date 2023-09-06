@php
    $buttonStyles = "background-color: #0032A0; color: white; border: 2px black solid; border-radius: 10px; width: 80px; text-align: center;";
    $buttonClasses = "nav-item nav-link mx-0 mx-md-1 my-1 my-md-0 col"
@endphp

<nav class="navbar sticky-top navbar-expand-md" style="background-color:#BA0C2F; color:white;">
    <a class="navbar-brand" href="/">FSC File Share</a>
    <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <ul class="navbar-nav mr-auto text-center container">
            <div class="row row-cols-1 @php echo(Auth::check() ? "row-cols-md-4" : "row-cols-md-2") @endphp">
                <a class="{{$buttonClasses}}" href="/" style="{{$buttonStyles}}">Home</a>
                <a class="{{$buttonClasses}}" href="#" style="{{$buttonStyles}}">Files</a>
                <!-- If the user is logged in (authenticated), then display appropriate links -->
                @if(Auth::check() || config('myconfig.testing'))
                    <a class="{{$buttonClasses}}" href="#" style="{{$buttonStyles}}">Profile</a>
                    <a class="{{$buttonClasses}}" href="#" style="{{$buttonStyles}}">Settings</a>
                <!-- If they're not, then show the appropriate option to log in -->
                @else
                    <!-- Login button, hidden on screens medium or bigger -->
                    <a class="{{$buttonClasses}} d-md-none" href="#" style="{{$buttonStyles}}">Login</a>
                @endif
            </div>
            
        </ul>
        @if(Auth::check() || config('myconfig.testing'))
            <span class="navbar-text">Welcome, user!</span>
        @else
            <!-- Login form, hidden on screens smaller than medium (when burger pops up) -->
            <form class="form-inline d-none d-md-block">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">@</span>
                    </div>
                    <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                    <input type="password" class="form-control" placeholder="Password" aria-label="Password">
                    <button class="btn btn-outline-success" type="submit">Login</button>
                </div>
            </form>
        @endif
    </div>
</nav>