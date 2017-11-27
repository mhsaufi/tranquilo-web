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
                    <li><a href="{!! url('/property') !!}">Properties</a></li>
                    <li><a href="{!! url('/aboutus') !!}">About Us</a></li>
                    <li class="active"><a href="{!! url('/contactus') !!}"><i class="fa icon-phone"></i>Contact</a></li>
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
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                      <h2 class="section-title">Contact Form</h2>
                      <p>Any enquiries, do leave your message and our representative will respond to you later.
                        Thank you.</p>
                        <br>
                    </div>
                </div> <!-- end of contact form /.col-xs-12 .col-sm-offset-2 .col-sm-8 -->

                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12  col-centered text-center">
                      <input type="text" name="email" class="form-control"  placeholder="Your email" />
                      <br>
                      <input type="text" name="subject" class="form-control" placeholder="Subject" />
                      <br>
                      <textarea class="form-control" name="message"></textarea>
                      <br>
                      <button class="btn btn-block btn-info">Send</button>
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