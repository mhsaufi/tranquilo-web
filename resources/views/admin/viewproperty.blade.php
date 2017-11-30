<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tranquilo | Property</title>

    @include('layouts.tranquilo-core-sheets')

    <!-- <link rel="stylesheet" type="{!! asset('myasset/slideJS/css/slidejs.css') !!}" href=""> -->

    <style>
        .slidesjs-pagination li a {
            background-image: url('{!! asset('myasset/slideJS/img/pagination.png') !!}');
        }
    </style>

</head><!--/head-->
<body>
    
     @include('layouts.tranquilo-header-admin')

    <header class="mini-header-admin">
        <div class="row">
            <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
                
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 text-left">
                <a href="{!! url('/admin/dashboard') !!}"><i class="fa icon-th-large"></i>Admin Panel</a>
                <a href="{!! url('/admin/user') !!}"><i class="fa icon-user"></i>Tranquilo Users</a>
                <a href="{!! url('/admin/permission') !!}"><i class="fa icon-unlock"></i>Permission Changes</a>
                <a href="{!! url('/admin/propertyrecord') !!}" class="active"><i class="fa icon-home"></i>Tranquilo Properties</a>
                <a href="{!! url('/admin/dealsrecord') !!}"><i class="fa icon-briefcase"></i>Deals On Tranquilo</a>
            </div>
        </div>
    </header>

    <br>

    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 col-centered">
            <br>
            <b><a href="{{ url('/admin/propertyrecord') }}">Property</a></b> > {{ $model->m_title }}<br>
            <hr>
            <?php

                $img_arr = explode('|',$model->m_gallery);
                $count = sizeof($img_arr);

            ?>
            <div class="row view_property_card">
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <h3 class="property-header">{{ $model->m_title }}</h3>
                    <small>posted on {{ $model->created_at }} by <b>{{ $model->name }}</b></small>
                    <br><br>
                    <i class="fa icon-phone"></i> <span style="font-size: 20px;">{{ $model->phone_no }}</span><br>
                    <i class="fa icon-building"></i> <span style="font-size: 20px;">{{ $model->h_type_title }}</span><br>
                    <i class="fa icon-map-marker"></i> <span style="font-size: 20px;">{{ $model->m_address }}, {{ $model->state_title }}</span>
                    
                    <br><br><br>
                    <?php
                        if(strlen($model->m_price) > 3){
                            $m_price = $model->m_price/1000;
                            $str_m_price = $m_price."K";
                        }else{
                            $str_m_price = $model->m_price;
                        }
                    ?>
                    <p style="font-size: 20px;">Priced at RM{!! $str_m_price !!}</p>
                    @if($model->m_description == '')
                        {!! $model->m_description_html !!}
                    @else
                        {!! $model->m_description !!}
                    @endif
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                        @if($count <= 1)
                            <div class="tranquilo-carousel" 
                                    style="background-image: url('{{ url('/galleries/'.$model->m_id.'/'.$img_arr[0]) }}');
                                        border-radius: 10px;
                                        width: auto;
                                        height: 500px;
                                        background-size: cover;
                                        background-repeat: no-repeat;
                                        object-fit: fill;
                                        background-position: center; ">
                            </div>

                        @else
                            <div id="slides">
                                @foreach($img_arr as $img)
                                    <div class="tranquilo-carousel" 
                                    style="background-image: url('{{ url('/galleries/'.$model->m_id.'/'.$img) }}');
                                        border-radius: 10px; 
                                        width: auto;
                                        height: 500px;
                                        background-size: cover;
                                        background-repeat: no-repeat;
                                        object-fit: fill;
                                        background-position: center; ">
                                    </div>
                                @endforeach
                                <a href="#" class="slidesjs-previous slidesjs-navigation"><i class="icon-chevron-left icon-large"></i></a>
                                <a href="#" class="slidesjs-next slidesjs-navigation"><i class="icon-chevron-right icon-large"></i></a>                      
                            </div>
                        @endif
                </div>
            </div>
        </div>
    </div>
    <br><br><br>
    @include('layouts.tranquilo-footer')

    @include('layouts.tranquilo-core-scripts')

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

    </script>
</body>
</html>