<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tranquilo | Admin</title>
    @include('layouts.tranquilo-core-sheets')
</head><!--/head-->
<body style="background-color: #34495e;">
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
                    <li><a href="{!! url('/') !!}">Home</a></li>
                    <li><a href="about-us.html">About Us</a></li>
                    <li><a href="services.html">Services</a></li>
                    <li><a href="portfolio.html">Contact</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Client Area <i class="icon-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('login') }}">Members</a></li>
                            <li><a href="{{ route('login') }}">Landlord</a></li>
                        </ul>
                    </li>
                    <li class="active"><a href="{{ route('register') }}">Sign Up</a></li>
                </ul>
            </div>
        </div>
    </header><!--/header-->   
    <br>
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 center col-centered">
            <img src="{!! asset('myasset/images/tranquilo.png') !!}" width="30%">
            <form method="POST" action="{{ url('loginadmin') }}" class="center" role="form">
                {{ csrf_field() }}
                    <div class="form-group">
                        <label for="email">
                            @if(isset($message))
                            <span style="color: white;"><i class="fa icon-exclamation-circle"></i> {{ $message }}</span><br>
                            @endif
                        </label>
                        <input type="text" id="email" name="email" placeholder="E-mail" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" id="password" name="password" placeholder="Password" class="form-control">
                    </div>
                    <div class="form-group">
                        <button role="submit" class="btn btn-success btn-md btn-block">Sign In</button>
                    </div>
                    <span style="font-weight: bold;"><a href="{{ url('/administrator') }}" style="color: white;">Sign Up</a></span>
            </form>
            
        </div>
    </div>
    <br><br><br>


    <div class="tranquilo-push-bottom">
            @include('layouts.tranquilo-footer')
    </div>

    <script src="myasset/js/jquery.js"></script>
    <script src="myasset/js/bootstrap.min.js"></script>
    <script src="myasset/js/jquery.prettyPhoto.js"></script>
    <script src="myasset/js/main.js"></script>

</body>
</html>