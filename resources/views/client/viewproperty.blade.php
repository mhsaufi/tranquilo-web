<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tranquilo | Registration</title>
    <link href="myasset/css/bootstrap.min.css" rel="stylesheet">
    <link href="myasset/css/font-awesome.min.css" rel="stylesheet">
    <link href="myasset/css/prettyPhoto.css" rel="stylesheet">
    <link href="myasset/css/animate.css" rel="stylesheet">
    <link href="myasset/css/main.css" rel="stylesheet">    
    <link rel="shortcut icon" href="{!! asset('myasset/images/tranquilo_nano.png') !!}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="myasset/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="myasset/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="myasset/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="myasset/images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->
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
                    <li><a href="{!! url('/') !!}">Home</a></li>
                    <li><a href="about-us.html">About Us</a></li>
                    <li><a href="services.html">Services</a></li>
                    <li><a href="portfolio.html">Contact</a></li>
                    @guest
                    <li class="active"><a href="{!! route('register') !!}">Sign Up</a></li>
                    @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">{!! Auth::user()->name !!} <i class="icon-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="{!! url('/home') !!}"><i class="fa icon-th-large"></i> Tranquilo Panel</a></li>
                            <li><a href="{!! url('/home') !!}"><i class="fa icon-user"></i> Profile</a></li>
                            <li><a href="{!! route('logout') !!}"><i class="fa icon-signout"></i>Sign Out</a></li>
                        </ul>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </header><!--/header-->
    @if(Auth::user()->role == 2)
    <header class="mini-header-user">
        <div class="row">
            <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
                
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 text-left">
                <a href="#" class="active">Property</a>
                <a href="#">Rental</a>
                <a href="#">Favourite</a>
                <a href="#">History</a>
            </div>
        </div>
    </header>
    @endif
    <br>

    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 col-centered view-a-property">
            <br>
            <b><a href="{{ url('/home') }}">Property</a></b> > {{ $model->m_title }}<br><br>
            <hr>
            <?php

                $img_arr = explode('|',$model->m_gallery);
                $count = sizeof($img_arr);

            ?>
            <div class="row view_property_card">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <h4 class="property-header">{{ $model->m_title }}</h4>
                    <small>posted on {{ $model->d_date }} by <b>{{ $model->name }}</b></small><br><br>
                    <span style="color: red;"><i class="fa icon-heart-empty"></i></span>
                    <span style="color:black;"><i class="fa icon-envelope"></i></span>
                    <br><br>
                    <i class="fa icon-phone"></i> <span style="font-size: 20px;">{{ $model->phone_no }}</span><br>
                    <i class="fa icon-briefcase"></i> <span style="font-size: 20px;">{{ $model->b_type_title }}</span><br>
                    <i class="fa icon-building"></i> <span style="font-size: 20px;">{{ $model->h_type_title }}</span><br>
                    <i class="fa icon-map-marker"></i> <span style="font-size: 20px;">{{ $model->m_address }}, {{ $model->state_title }}</span>
                    
                    <br><br><br>
                    <?php
                        if(strlen($model->d_value) > 3){
                            $d_value = $model->d_value/1000;
                            $str_d_value = $d_value."K";
                        }else{
                            $str_d_value = $model->d_value;
                        }
                    ?>
                    <p style="font-size: 20px;">Deal at RM{!! $str_d_value !!}</p>
                    @if($model->m_description == '')
                        {!! $model->m_description_html !!}
                    @else
                        {!! $model->m_description !!}
                    @endif
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                      <!-- Indicators -->
                      <ol class="carousel-indicators">
                        @for($i=0;$i<$count;$i++)
                            <li data-target="#myCarousel" data-slide-to="{!! $i !!}" class="active"></li>
                        @endfor
                      </ol>

                      <!-- Wrapper for slides -->
                      <div class="carousel-inner">
                        @foreach($img_arr as $img)
                        <div class="item active">
                          <img src="{{ url('/galleries/'.$model->m_id.'/'.$img) }}">
                        </div>
                        @endforeach

                        @if($count != 1)
                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                            <span class="sr-only">Next</span>
                        </a>
                        @endif
                    </div>
                    
                </div>
            </div>
            <br><br><br>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    
                    <button class="btn-block tranquilo-btn">Apply for this property</button>
                </div>
            </div>
        </div>
    </div>
    <br><br><br>


    <script src="myasset/js/jquery.js"></script>
    <script src="myasset/js/bootstrap.min.js"></script>
    <script src="myasset/js/jquery.prettyPhoto.js"></script>
    <script src="myasset/js/main.js"></script>
    <script>
        function goToAddProperty(url){
            window.location.replace(url);
        }
    </script>
</body>
</html>