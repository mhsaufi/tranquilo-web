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
                <li><a href="{!! url('/') !!}"><i class="fa icon-home"></i>Home</a></li>
                <!-- <li><a href="{!! url('/aboutus') !!}">About Us</a></li> -->
                <li class="dropdown">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown">
                            <i class="fa icon-random"></i>Explore <i class="icon-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="{!! url('/ourpartner') !!}">Our Partners</a></li>
                            <li><a href="{!! url('/developers') !!}">Developers</a></li>
                            <li><a href="{!! url('/aboutus') !!}">About Us</a></li>
                        </ul>
                    </li>
                    <li><a href="{!! url('/property') !!}"><i class="fa icon-briefcase"></i> Our Deals</a></li>
                <li><a href="{!! url('/contactus') !!}"><i class="fa icon-phone"></i>Contact</a></li>
                @guest
                <li class="active"><a href="{!! route('register') !!}">Sign Up</a></li>
                @else
                <li class="dropdown active">
                    <a href="#" class="dropdown-toggle active" data-toggle="dropdown">
                        {!! Auth::user()->name !!} <i class="icon-angle-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="{!! url('/home') !!}"><i class="fa icon-th-large"></i> Tranquilo Panel</a></li>
                        <li><a href="{!! url('/profile') !!}">
                            <i class="fa icon-user"></i> Profile</a> 
                        </li>
                        <li><a href="{!! route('logout') !!}"><i class="fa icon-signout"></i>Sign Out</a></li>
                    </ul>
                </li>
                <li>
                    @if(Auth::user()->img)
                        <div class="circular--landscape--micro center" style="background-image: url('{{ url('/avatar/'.Auth::user()->id.'/'.Auth::user()->img) }}');background-size: cover;background-position: center;">
                        </div>
                    @else
                        <div class="circular--landscape--micro" style="background-image: url({!! asset('myasset/images/piyad.jpg') !!});background-size: cover;background-position: center;"></div>
                    @endif
                </li>
                @endguest
            </ul>
        </div>
    </div>
</header>