<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tranquilo | Home</title>
    
    @include('layouts.tranquilo-core-sheets')

</head>
<body>
    
    @include('layouts.tranquilo-header')

    <header class="mini-header-user">
        <div class="row">
            <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
                
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 text-left">
                <a href="{!! url('/home') !!}" class="active">Property</a>
                <a href="{!! url('/myapplication') !!}">Application</a>
                <a href="{!! url('/mybookmark') !!}">Bookmark</a>
                <a href="{!! url('/profile') !!}">Profile <span class="badge" id="tranquilo_badge"></span></a>
                <a href="{!! url('/myhistory') !!}">History</a>
            </div>
        </div>
    </header>
    <br>

    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 col-centered view-a-property">
            <br>
            <b><a href="{{ url('/home') }}">Property</a></b> > {{ $model->m_title }}<br>
            <hr>
            <?php

                $img_arr = explode('|',$model->m_gallery);
                $count = sizeof($img_arr);

            ?>
            <div class="row view_property_card">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <h4 class="property-header">{{ $model->m_title }}</h4>
                    <small>posted on {{ $model->d_date }} by <b>{{ $model->name }}</b></small><br><br>
                    <input type="hidden" name="rate_url" id="rate_url" value="{{ url('/rateproperty') }}"/>
                    <input type="hidden" name="model_id" id="model_id" value="{{ $model->m_id }}"/>
                    <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}"/>

                    @if($model_rated == false)
                        <span style="margin-right: 10px;color: grey;">
                            <span id="rate-1"><i class="icon-star icon-2x rate"></i></span>
                            <span id="rate-2"><i class="icon-star icon-2x rate"></i></span>
                            <span id="rate-3"><i class="icon-star icon-2x rate"></i></span>
                            <span id="rate-4"><i class="icon-star icon-2x rate"></i></span>
                            <span id="rate-5"><i class="icon-star icon-2x rate"></i></span>
                        </span>
                    @else
                        <?php $unrated_value = 5 - $rated_value;  $j = 1;?>

                            @for($i=0;$i<$rated_value;$i++)
                                <span><i class="icon-star icon-2x rate rate-checked"></i></span>
                                <?php  $j++; ?>
                            @endfor

                            @for($k=0;$k<$unrated_value;$k++)
                                <span><i class="icon-star icon-2x rate"></i></span>
                                <?php  $j++; ?>
                            @endfor
                    @endif
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
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <button class="btn-block tranquilo-btn" style="margin-top: 30px!important;" onclick="applyProperty('{{ $model->d_id }}','{{ url('/applyproperty') }}')">Apply for this property</button>
                </div>
            </div>
        </div>
    </div>
    <br><br><br>

    @include('layouts.tranquilo-footer')

    <script src="myasset/js/jquery.js"></script>
    <script src="myasset/js/bootstrap.min.js"></script>
    <script src="myasset/js/jquery.prettyPhoto.js"></script>
    <script src="myasset/js/main.js"></script>
    <script src="myasset/js/tranquilo-rate.js"></script>
    <script>
        function goToAddProperty(url){
            window.location.replace(url);
        }
        function applyProperty(d_id,url){

            url = url + '?d=' + d_id;

            window.location.replace(url);

        }
    </script>
</body>
</html>