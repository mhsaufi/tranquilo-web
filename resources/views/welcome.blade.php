<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tranquilo Property</title>
    
    @include('layouts.tranquilo-core-sheets')

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
                    <li class="active"><a href="{!! url('/') !!}"><i class="fa icon-home"></i>Home</a></li>
                    <li><a href="{!! url('/property') !!}">Properties</a></li>
                    <li><a href="{!! url('/aboutus') !!}">About Us</a></li>
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
    <section id="main-slider" class="no-margin">
        <div class="carousel slide wet-asphalt">
            <div class="carousel-inner">
                <div class="item active" style="background-image: url(myasset/images/banner1.jpg)">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="carousel-content centered">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 text-center">

                                            <br><br>
                                            <p style="font-size: 2.0em;">
                                                <b style="color: pink;">Find</b> 
                                            your property</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-centered">
                                            <div class="row">
                                                <form action="{{ url('/property') }}" method="GET">
                                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                                        <input type="text" name="from" class="form-control" placeholder="From" />
                                                        <br><br>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                                        <input type="text" name="to" class="form-control" placeholder="To" />
                                                        <br><br>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                                        <select name="state" class="form-control">
                                                            <option value="0">Select state</option>
                                                            @foreach($state as $st)
                                                                <option value="{!! $st->state_id !!}">{!! $st->state_title !!}</option>
                                                            @endforeach                                                        
                                                        </select>
                                                        <br><br>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                                        <button class="tranquilo-btn"><i class="icon-search" style="margin-right: 10px;"></i>Find Property</button>
                                                        <br><br>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="services" class="emerald">
        <div class="container text-right">
            <div class="row">
                @foreach($models as $model)
                <?php

                    $g_arr = explode('|',$model->m_gallery);
                    if(strlen($model->d_value) > 3){

                        $d_value = $model->d_value/1000;
                        $str_d_value = $d_value."K";

                    }else{
                        $str_d_value = $model->d_value;
                    }
                ?>
                <div class="col-md-4 col-sm-6 text-left">

                    <div class="row homepage-special-model">
                        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                            @guest
                            <a href="{{ url('/viewmodelp?m='.$model->m_id ) }}">
                            @else
                            <a href="{{ url('/viewmodelc?m='.$model->m_id ) }}">
                            @endguest

                            <div class="circular--landscape center" style="background-image: url({{ url('/galleries/'.$model->m_id.'/'.$g_arr[0]) }});background-size: cover;background-position: center;">
                            </div></a>
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                            <h4>{{ $model->m_title }}</h4>
                            <hr>
                            <p>{{ $model->m_address }}</p>
                        </div>
                    </div>

                </div><!--/.col-md-4-->
                @endforeach
            </div>                    
        </div>
    </section>


    <section id="testimonial" class="alizarin">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="center">
                        <h2>What Tranquilo users says?</h2>
                        <p>Our users has been reviewing properties on our site. What they say?</p>
                    </div>
                    <div class="gap"></div>
                    <div class="row">
                        <?php $i = 1; ?>
                        @foreach($reviews as $review)
                        <div class="col-md-6">
                            <blockquote>
                                <p>{{ $review->review_content }}</p>
                                <small>by {{ $review->name }} on <cite title="Source Title">{{ $review->review_date }}</cite></small>
                            </blockquote>
                        </div>

                            @if($i%2 == 0)

                            </div>
                            <div class="row">
                            @endif

                            <?php $i++; ?>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/#testimonial-->

    @include('layouts.tranquilo-public-footer')

    @include('layouts.tranquilo-footer')

    @include('layouts.tranquilo-core-scripts')

</body>
</html>