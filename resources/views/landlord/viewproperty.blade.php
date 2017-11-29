<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tranquilo | Property</title>

    @include('layouts.tranquilo-core-sheets')

    <link rel="stylesheet" type="{!! asset('myasset/slideJS/css/slidejs.css') !!}" href="">

    <style>
        .slidesjs-pagination li a {
            background-image: url('{!! asset('myasset/slideJS/img/pagination.png') !!}');
        }
    </style>

</head><!--/head-->
<body>
    
    @include('layouts.tranquilo-header')
    
    <header class="mini-header-landlord">
        <div class="row">
            <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
                
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 text-left">
                <a href="{!! url('/feed') !!}">Feed</a>
                <a href="{!! url('/home') !!}" class="active">Property</a>
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
            <b><a href="{{ url('/home') }}">Property</a></b> > {{ $model->m_title }}<br><br>
            <button class="tranquilo-btn-thin" onclick="goToAddProperty('{{ url('/addproperty') }}')">Add new propeprty</button>
            <hr>
            <?php

                $img_arr = explode('|',$model->m_gallery);
                $count = sizeof($img_arr);

            ?>
            <div class="row" style="vertical-align: top;">
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <h4 class="property-header">{{ $model->m_title }}</h4>
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
                    <div class="container">
                        @if($count <= 1)
                            <div class="tranquilo-carousel" 
                                    style="background-image: url('{{ url('/galleries/'.$model->m_id.'/'.$img_arr[0]) }}');
                                        border-radius: 10px; 
                                        width: 700px;
                                        height: 500px;
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
                                        border-radius: 10px; 
                                        width: 700px;
                                        height: 500px;
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
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <button class="btn btn-default" onclick="editProperty('{{ url('/editproperty') }}','{{ $model->m_id }}')">
                    <i class="fa icon-pencil"></i> Edit</button>
                    <button class="btn btn-danger" onclick="deleteProperty('{{ url('/deleteproperty') }}','{{ $model->m_id }}')">
                    <i class="fa icon-trash"></i> Delete</button>
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

        function editProperty(url,m_id){

            var edit_url = url + '?m=' + m_id;

            window.location.replace(edit_url);

        }

        function deleteProperty(url,m_id){

            var edit_url = url + '?m=' + m_id;

            window.location.replace(edit_url);

        }
    </script>
</body>
</html>