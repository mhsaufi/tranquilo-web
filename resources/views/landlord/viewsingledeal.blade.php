<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tranquilo | Registration</title>
    
    @include('layouts.tranquilo-core-sheets')

</head><!--/head-->
<body>
    
    @include('layouts.tranquilo-header')
    
    <header class="mini-header-landlord">
        <div class="row">
            <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
                
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 text-left">
                <a href="{!! url('/home') !!}">Property</a>
                <a href="{!! url('/board') !!}">Applications</a>
                <a href="{!! url('/dealboard') !!}" class="active">Deals</a>
                <a href="#">History</a>
            </div>
        </div>
    </header>
    <br>

    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 col-centered view-a-property">
            <br>
            <b><a href="{{ url('/dealboard') }}">My Deal</a></b> > {{ $model->m_title }}<br><br>
            <hr>
            <?php

                $img_arr = explode('|',$model->m_gallery);
                $count = sizeof($img_arr);

            ?>
            <div class="row" style="vertical-align: top;">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <h4 class="property-header">{{ $model->m_title }}</h4>
                    <small><em>You posted this deal on <b>{{ $model->d_date }}</b></em></small>
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

        </div>
    </div>
    <br><br><br>


    @include('layouts.tranquilo-core-scripts')
</body>
</html>