<header class="navbar navbar-inverse navbar-fixed-top wet-asphalt" role="banner">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{!! url('/') !!}">
                <img src="{!! asset('myasset/images/tranquilo_mini.png') !!}" width="40%">
            </a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{!! url('/dashboard') !!}"><i class="fa icon-home"></i>Home</a></li>
                @guest
                <li class="active"><a href="{!! route('register') !!}">Sign Up</a></li>
                @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle active" data-toggle="dropdown">{!! Auth::user()->name !!} <i class="icon-angle-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="{!! url('/dashboard') !!}"><i class="fa icon-th-large"></i>Admin Panel</a></li>
                        <li><a href="{!! route('logout') !!}"><i class="fa icon-signout"></i>Sign Out</a></li>
                    </ul>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</header>