<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tranquilo Property</title>

    @include('layouts.tranquilo-core-sheets')

    </head>
    <body>

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
                    <li class="dropdown active">
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
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Client Area <i class="icon-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('login') }}">Members</a></li>
                            <li><a href="{{ route('login') }}">Landlord</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('register') }}">Sign Up</a></li>
                    @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">{!! Auth::user()->name !!} <i class="icon-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="{!! url('/home') !!}"><i class="fa icon-th-large"></i> Tranquilo Panel</a></li>
                            <li><a href="{!! url('/home') !!}"><i class="fa icon-user"></i> Profile</a></li>
                            <li><a href="{!! url('logout') !!}"><i class="fa icon-signout"></i>Sign Out</a></li>
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
    </header><!--/header-->
    </header>
    
    <section>
        <div class="row">
            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 col-centered">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center" id="logodesc">
                        <img src="{{ asset('myasset/images/tranquilo.png') }}" width="50%">
                        <hr>
                        <p>We provide service for people who have a problem in searching,
                        renting and advertising house. Throughout this project, involved contributor or
                        an organization which is Mosque community. This system is actually to help
                        Muslims community to find and rent suitable house nearby them. Furthermore, this
                        system also opens big chance for helping Muslims community to do business and
                        uphold Muslims tradition (Prophet&#8217;s Sunnah) indirectly. </p>
                    </div>

                    <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 text-left" id="logodesc">
                        <img src="{{ asset('myasset/images/airbnb.jpg') }}" width="100%">
                        <hr>
                        <p>Our team has been participating with AirBnb development career since 2012 to make sure
                        Tranquilo are able to achieve the offical standard in property and land management.
                        We will continuously participating to keep on developing more for Tranquilo</p>
                    </div>
                </div>
            </div>
        </div>        
    </section>

    <br><br><br>

    @include('layouts.tranquilo-public-footer')

    @include('layouts.tranquilo-footer')

    @include('layouts.tranquilo-core-scripts')
</body>
</html>