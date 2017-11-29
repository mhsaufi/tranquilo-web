<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tranquilo | Registration</title>
    
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
                <a href="{!! url('/home') !!}">Property</a>
                <a href="{!! url('/board') !!}">Applications</a>
                <a href="{!! url('/dealboard') !!}" class="active">Deals</a>
                <a href="{!! url('/profile') !!}"><i class="fa icon-user"></i>Profile</a>
                <!-- <a href="#">History</a> -->
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
                    <br>
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
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <button class="btn btn-default" onclick="editDeal('{{ url('/editdeal') }}','{{ $model->d_id }}')">
                    <i class="fa icon-pencil"></i> Edit</button>
                    <button class="btn btn-danger" onclick="deleteDeal('{{ $model->d_id }}')">
                    <i class="fa icon-trash"></i> Delete</button>
                </div>
            </div>
        </div>
    </div>
    <br><br><br>


    <div id="confirmation_dialog" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-body">
                    <h5> Are you sure you want to remove this deal?</h5>
                    <button class="btn btn-danger left" id="yes">Yes i'm sure</button>
                    <button class="btn btn-info right" id="no">No, cancel</button>
              </div>
            </div>
        </div>
    </div>

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

        function editDeal(url,deal_id){

            var edit_url = url + '?d=' + deal_id;

            window.location.replace(edit_url);

        }

        function deleteDeal(id){

            var deal_id = '{{ $model->d_id }}';
            var redirect = '{{ url('/dealboard') }}';

            $("#confirmation_dialog").modal('toggle');
            $("#no").click(function(){
                $("#confirmation_dialog").modal('hide');
            });
            $("#yes").click(function(){
                
                $.post("{!! url('/deletedeal') !!}", {deal_id:deal_id}, function(result){

                    window.location.replace(redirect);

                });

            });
        }
    </script>
</body>
</html>