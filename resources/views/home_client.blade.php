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
    @if(Auth::user()->role == '3')
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
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 center col-centered">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-centered">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <input type="text" name="from" class="form-control" placeholder="Deal from" />
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <input type="text" name="to" class="form-control" placeholder="Deal to" />
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <select name="state" class="form-control">
                                <option value="0">--property type--</option>
                                @foreach($h_type as $h)
                                    <option value="{!! $h->h_type_id !!}">{!! $h->h_type_title !!}</option>
                                @endforeach                                                        
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <select name="state" class="form-control">
                                <option value="0">--select state--</option>
                                @foreach($state as $st)
                                    <option value="{!! $st->state_id !!}">{!! $st->state_title !!}</option>
                                @endforeach                                                        
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-12">
                            <button class="tranquilo-btn"><i class="icon-search" style="margin-right: 10px;"></i>Find Property</button>
                        </div>
                    </div>
                    <hr>
                    @foreach($models as $model)

                        <div class="row property_card_client">
                            <div class="col-lg-2 col-md-2 col-sm-12" onclick="viewModel('{{ $model->m_id }}','{{ url('/viewmodelc') }}')" style="cursor: pointer;">
                                <?php
                                    $img_arr = explode('|',$model->m_gallery);
                                    $count = sizeof($img_arr);

                                    if(strlen($model->d_value) > 3){
                                        $d_value = $model->d_value/1000;
                                        $str_d_value = $d_value."K";
                                    }else{
                                        $str_d_value = $model->d_value;
                                    }
                                ?>
                                <img src="{{ url('/galleries/'.$model->m_id.'/'.$img_arr[0]) }}" width="100%" class="img-thumbnail">
                                
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-12 text-left">
                                <h4  onclick="viewModel('{{ $model->m_id }}','{{ url('/viewmodelc') }}')" style="cursor: pointer;">{{ $model->m_title }}</h4>
                                <p><span style="opacity: 0.5;">Deal : </span>RM{{ $str_d_value }}, {{ $model->h_type_title }}</p>
                                <b>{{ $model->state_title }}</b>
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-12 text-left">
                                <i class="fa icon-heart-empty"></i>
                                <i class="fa icon-envelope"></i>
                            </div>
                        </div>
                        <br>
                    @endforeach

                    {!! $models->links() !!}

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
        function viewModel(id,url){

            window.location.replace(url+'?m='+id);

        }
    </script>
</body>
</html>