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
                <a href="{!! url('/home') !!}" class="active">Property</a>
                <a href="{!! url('/board') !!}">Applications</a>
                <a href="{!! url('/dealboard') !!}">Deals</a>
                <a href="#">History</a>
            </div>
        </div>
    </header>

    <br>
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 col-centered">
            <br>
            <button class="tranquilo-btn-thin" onclick="goToAddProperty('{{ url('/addproperty') }}')">Add new propeprty</button>
            <hr>
            <h4>My Property</h4>
            <br>

            <div class="row">
                <?php $i = 1; ?>
                @foreach($models as $model)
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-left" style="padding-left: 0px;">
                        <?php

                            $g_arr = explode('|',$model->m_gallery);

                        ?>
                        <div class="property_card" onclick="viewModel('{{ $model->m_id }}','{{ url('/viewmodel') }}')">
                            <div class="row property_card_header">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <img src="{{ url('/galleries/'.$model->m_id.'/'.$g_arr[0]) }}" width="100%">
                                </div>
                            </div>
                            <div class="row property_card_body">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <h4>{!! $model->m_title !!}</h4>
                                    <hr>
                                    <?php
                                        if(strlen($model->m_price) > 3){

                                            $m_price = $model->m_price/1000;
                                            $str_m_price = $m_price."K";
                                        }else{
                                            $str_m_price = $model->m_price;
                                        }

                                    ?>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                            <span class="property_d_value">RM {{ $str_m_price }}</span>
                                            <br>
                                            <span class="property_address">{{ $model->m_address }}</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                
                    @if($i%4 == 0)

                            </div>
                        <br>
                    <div class="row">
                    @endif
                    </div>

                 <?php $i++;?>
                @endforeach
            </div>
        </div>
    </div>
    <br><br><br>

    @include('layouts.tranquilo-footer')

    @include('layouts.tranquilo-core-scripts')
    
    <script>
        function goToAddProperty(url){
            window.location.replace(url);
        }
        function viewModel(id,url){

            window.location.replace(url+'?m='+id);

        }
    </script>
</body>
</html>