<!--navbar-->
<nav style="top: 0;position: fixed;width: 100%; z-index: 99999999999;"
     class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="{{route('root')}}">Cv Processing</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
            aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation" style="">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{route('home')}}">Home<span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('search.form')}}">Find The best</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('cvs.upload')}}">Upload new Cvs</a>
            </li>
        </ul>
        <ul class="navbar-nav right">
            @if(!fauth()->check())
                <li class="nav-item" style="display: flex;">
                    <a class="nav-link" href="{{route('login')}}">Login</a>
                    <a class="nav-link" href="{{route('register')}}">Register</a>
                </li>
            @endif
            @if(fauth()->check())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                       aria-haspopup="true"
                       aria-expanded="false">{{fauth()->user()->first_name .' '. fauth()->user()->last_name}}</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('profile.edit')}}">Edit Profile</a>
                        <a class="dropdown-item" href="{{route('root')}}">Upload new Cv</a>
                        <a class="dropdown-item" href="{{route('cvs.history')}}">History</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" id="item" href="{{route('logout')}}">Logout</a>
                    </div>
                </li>
            @endif
        </ul>
    </div>
</nav>


<!--navbar-->