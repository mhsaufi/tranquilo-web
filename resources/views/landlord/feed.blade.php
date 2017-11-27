<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tranquilo | Feed</title>
    @include('layouts.tranquilo-core-sheets')
    
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
                <a href="#">History</a>
            </div>
        </div>
    </header>
    
    <br>
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 center col-centered">
            <div class="row">
                <form action="{{ url('/feed') }}" method="GET">
                    {{ csrf_field() }}
                <div class="col-lg-12 col-md-12 col-sm-12 col-centered">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <input type="text" name="from" class="form-control" placeholder="Deal from" />
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <input type="text" name="to" class="form-control" placeholder="Deal to" />
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <select name="h_type" class="form-control">
                                <option value="0">--property type--</option>
                                @foreach($h_type as $h)
                                    <option value="{!! $h->h_type_id !!}">{!! $h->h_type_title !!}</option>
                                @endforeach                                                        
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <select name="state" class="form-control">
                                <option value="0" selected="selected">All</option>
                                @foreach($state as $st)
                                    <option value="{!! $st->state_id !!}">{!! $st->state_title !!}</option>
                                @endforeach                                                        
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left">
                            <input type="checkbox" id="sort_check" /> Sort
                            <br><br>
                            <div class="row" id="sorting_board">
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                    By Rating
                                    <select name="rate_sort" class="form-control">
                                        <option value="none">not selected</option>
                                        <option value="asc">Lowest To Highest</option>
                                        <option value="desc">Highest To Lowest</option>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                    By Date
                                    <select name="date_sort" class="form-control">
                                        <option value="none">not selected</option>
                                        <option value="asc">Newest first</option>
                                        <option value="desc">Oldest first</option>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                    By Price
                                    <select name="price_sort" class="form-control">
                                        <option value="none">not selected</option>
                                        <option value="asc">Lowest First</option>
                                        <option value="desc">Highest First</option>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                    By most viewed
                                    <select name="view_sort" class="form-control">
                                        <option value="none">not selected</option>
                                        <option value="asc">Most views first</option>
                                        <option value="desc">Less views first</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <button class="tranquilo-btn" role="submit"><i class="icon-search" style="margin-right: 10px;"></i>Find Property</button>
                        </div>
                    </div>
                </form>
                    <hr>

                    @if($model_count != 0)

                    @foreach($models as $model)

                        <div class="row property_card_client">
                            <div class="col-lg-2 col-md-2 col-sm-12" onclick="viewModel('{{ $model->m_id }}','{{ url('/viewmodelland') }}')" style="cursor: pointer;">
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
                                <h4 onclick="viewModel('{{ $model->m_id }}','{{ url('/viewmodelc') }}')" style="cursor: pointer;">{{ $model->m_title }}</h4>
                                <p><span style="opacity: 0.5;">Deal : </span>RM{{ $str_d_value }}, {{ $model->h_type_title }}</p>
                                <b>{{ $model->state_title }}</b>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 text-right">

                                <!-- check if this user has bookmark this deal -->
                                @if(in_array($model->d_id,$bookmarked))
                                    <span>
                                        <i class="fa icon-bookmark tranquilo-bookmark-property-checked" title="you bookmark this"></i>
                                    </span>
                                @else
                                    <span id="tranquilo-bookmark-{!! $model->d_id !!}" onclick="bookmarkThis('{{ $model->d_id }}','{{ url('/bookmarkdeal') }}')">
                                        <i class="fa icon-bookmark tranquilo-bookmark-property" title="bookmark this property"></i>
                                    </span>
                                @endif

                                <i class="fa icon-envelope"></i><br><br>
                                <?php $rated_value = $model->m_rate_value;$unrated_value = 5 - $rated_value;  $j = 1;?>

                                @for($i=0;$i<$rated_value;$i++)
                                    <i class="icon-star rate-checked" style="cursor: default!important;"></i>
                                    <?php  $j++; ?>
                                @endfor

                                @for($k=0;$k<$unrated_value;$k++)
                                    <i class="icon-star" style="cursor: default!important;"></i>
                                    <?php  $j++; ?>
                                @endfor
                                <br><br><br>
                                <span style="margin-right: 10px;opacity: 0.8;"><em>{!! $model->m_view !!} views</em></span>
                            </div>
                        </div>
                        <br>
                    @endforeach

                    {!! $models->appends(['from'=>$cond_from,'to'=>$cond_to,'h_type'=>$cond_h_type,'state'=>$cond_state,'rate_sort'=>$sort_rate,'date_sort'=>$sort_date,'price_sort'=>$sort_price,'view_sort'=>$sort_view,'model_count'=>$model_count])->links() !!}

                    <?php $c = $models->count(); ?>

                    @else

                    <?php $c = 0; ?>

                    <p>No deal found for this filter

                    @endif
                </div>
            </div>
            
        </div>
    </div>
    <br><br><br>

    @if($c > 6)
        @include('layouts.tranquilo-footer')
    @else
        <div class="tranquilo-push-bottom">
            @include('layouts.tranquilo-footer')
        </div>
    @endif

    @include('layouts.tranquilo-core-scripts')
    
    <script src="myasset/js/tranquilo-bookmark.js"></script>
    <script src="myasset/js/tranquilo-sort-plugin.js"></script>
    <script>
        $(document).ready(function(){
            $('#sorting_board').hide();

            if($('#sort_check:checked').length > 0){

                $("#sorting_board").show();

            }

            if($('#sort_check:checked').length == 0){

                $('#sorting_board').hide();
            }
        });

        function viewModel(id,url){
            window.location.replace(url+'?m='+id);
        }
    </script>
</body>
</html>