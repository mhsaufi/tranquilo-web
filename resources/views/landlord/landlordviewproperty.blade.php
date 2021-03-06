<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tranquilo | Feed</title>
    
    @include('layouts.tranquilo-core-sheets')

    <link rel="stylesheet" type="{!! asset('myasset/slideJS/css/slidejs.css') !!}" href="">

    <style>
        .slidesjs-pagination li a {
            background-image: url('{!! asset('myasset/slideJS/img/pagination.png') !!}');
        }
    </style>
</head>
<body>
    
    @include('layouts.tranquilo-header')

    <header class="mini-header-landlord">
        <div class="row">
            <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
                
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 text-left">
                <a href="{!! url('/feed') !!}" class="active">Feed</a>
                <a href="{!! url('/home') !!}">Property</a>
                <a href="{!! url('/board') !!}">Applications</a>
                <a href="{!! url('/dealboard') !!}">Deals</a>
                <a href="{!! url('/profile') !!}"><i class="fa icon-user"></i>Profile</a>
                <!-- <a href="#">History</a> -->
            </div>
        </div>
    </header>
    <br>

    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 col-centered view-a-property">
            <br>
            <b><a href="{{ url('/feed') }}">Feed</a></b> > {{ $model->m_title }}<br>
            <hr>
            <?php
                $img_arr = explode('|',$model->m_gallery);
                $count = sizeof($img_arr);
            ?>
            <div class=" view_property_card">
                <div class="row">
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
                            {!! $model->d_description !!}
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        
                        <div class="container">
                            @if($count <= 1)
                                <div class="tranquilo-carousel" 
                                        style="background-image: url('{{ url('/galleries/'.$model->m_id.'/'.$img_arr[0]) }}');
                                            border-radius: 20px;
                                            height: 400px;
                                            background-size: contain;
                                            background-repeat: no-repeat;
                                            object-fit: fill;
                                            background-position: center; ">
                                </div>

                            @else
                                <div id="slides">
                                    <a href="#" class="slidesjs-previous slidesjs-navigation"><i class="icon-chevron-left icon-large"></i></a>
                                    <a href="#" class="slidesjs-next slidesjs-navigation"><i class="icon-chevron-right icon-large"></i></a>
                                    @foreach($img_arr as $img)
                                        <div class="tranquilo-carousel" 
                                        style="background-image: url('{{ url('/galleries/'.$model->m_id.'/'.$img) }}');
                                            border-radius: 20px;
                                            height: 400px;
                                            background-size: contain;
                                            background-repeat: no-repeat;
                                            object-fit: fill;
                                            background-position: center; ">
                                        </div>
                                    @endforeach                            
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @guest

                @else

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                            <button class="btn-block tranquilo-btn" style="margin-top: 30px!important;" onclick="applyProperty('{{ $model->d_id }}','{{ url('/apply') }}')">Apply for this property</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <hr>
                            <button class="btn btn-info" id="addreview">Add reviews</button>
                        </div>
                    </div>
                    <div class="row" id="addreviewarea">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <input type="hidden" id="user_id" value="{{ Auth::user()->id }}" >
                            <input type="hidden" id="url" value="{{ url('/postreview') }}" >
                            <input type="hidden" id="deal_id" value="{{ $model->d_id }}" >
                            <input type="hidden" id="_token" value="{{ Session::token() }}" >
                            <textarea class="form-control" id="reviewcontent" name="reviews" rows="2"></textarea>
                            <button class="btn btn-block" id="postreview">Post Review</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="reviewsection" style="padding-right: 30px;padding-left: 30px;">
                            @foreach($reviews as $review)
                            <div id="userreview">
                                <h4>{{ $review->name }}</h4>
                                <small><em>posted on {{ $review->review_date }}</em></small><br><br>
                                <p>{{ $review->review_content }}</p><hr>
                            </div>
                            @endforeach
                             
                        </div>
                    </div>

                @endif
                
            </div>
            


            
        </div>
    </div>
    <br><br><br>

    @include('layouts.tranquilo-footer')

    @include('layouts.tranquilo-core-scripts')

    <script src="{!! asset('myasset/js/tranquilo-rate.js') !!}"></script>
    <script src="{!! asset('myasset/js/tranquilo-review.js') !!}"></script>
    <script src="{!! asset('myasset/slideJS/js/jquery.slides.min.js') !!}"></script>
    <script>
        $(function(){

            $('#slides').slidesjs({
                width: 1000,
                height: 800,
                navigation: false,
                pagination: false
            });

        });

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