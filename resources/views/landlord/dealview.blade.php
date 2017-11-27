<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tranquilo | Registration</title>
    @include('layouts.tranquilo-core-sheets')
    
</head>
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
                <a href="#">History</a>
            </div>
        </div>
    </header>
    
    <br>
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 center col-centered">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-centered text-left">
                    
                    <h2><i class="fa icon-tags"></i>My Deals</h2>
                    <hr>
                    <button class="tranquilo-btn-thin" onclick="goToAddDeal('{{ url('/adddeal') }}')">Add new Deal</button>
                    <br><br>
                    @foreach($models as $model)

                        <div class="row property_card_client">
                            <div class="col-lg-2 col-md-2 col-sm-12" onclick="viewDeal('{{ $model->d_id }}','{{ url('/viewdeal') }}')" style="cursor: pointer;">
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
                            <div class="col-lg-7 col-md-7 col-sm-12 text-left">
                                <h4 onclick="viewDeal('{{ $model->d_id }}','{{ url('/viewdeal') }}')" style="cursor: pointer;">{{ $model->m_title }}</h4>
                                <p><span style="opacity: 0.5;">Deal : </span>RM{{ $str_d_value }}, {{ $model->h_type_title }}</p>
                                <b>{{ $model->state_title }}</b>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 text-right">

                                <?php $rated_value = $model->m_rate_value;$unrated_value = 5 - $rated_value;  $j = 1;?>

                                @for($i=0;$i<$rated_value;$i++)
                                    <i class="icon-star icon-2x rate-checked" style="cursor: default!important;"></i>
                                    <?php  $j++; ?>
                                @endfor

                                @for($k=0;$k<$unrated_value;$k++)
                                    <i class="icon-star icon-2x" style="cursor: default!important;"></i>
                                    <?php  $j++; ?>
                                @endfor
                                <br><br><br>
                                <span style="margin-right: 20px;opacity: 0.8;"><em>{!! $model->m_view !!} </em> views</span>
                            </div>
                        </div>
                        <br>
                    @endforeach

                    {!! $models->links() !!}

                    <?php $c = $models->count();  ?>

                </div>
            </div>
            
        </div>
    </div>
    <br><br><br>

     @if($c > 2)

        @include('layouts.tranquilo-footer')

    @else
        <div class="tranquilo-push-bottom">
            @include('layouts.tranquilo-footer')
        </div>
    @endif

    @include('layouts.tranquilo-core-scripts')
    
    <script src="myasset/js/tranquilo-bookmark.js"></script>
    <script>
        function viewDeal(id,url){
            window.location.replace(url+'?m='+id);
        }
        function goToAddDeal(url){
            window.location.replace(url);
        }
    </script>
</body>
</html>