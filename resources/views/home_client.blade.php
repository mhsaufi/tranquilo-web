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

    @if(Auth::user()->role == '3')
    <header class="mini-header-user">
        <div class="row">
            <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
                
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 text-left">
                <a href="{!! url('/home') !!}" class="active">Property</a>
                <a href="{!! url('/myapplication') !!}">Application</a>
                <a href="{!! url('/mybookmark') !!}">Bookmark</a>
                <a href="{!! url('/myhistory') !!}">History</a>
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
                        <div class="col-lg-4 col-md-6 col-sm-12">
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

                    {!! $models->links() !!}

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
    <script src="myasset/js/tranquilo-bookmark.js"></script>
    <script>
        function viewModel(id,url){
            window.location.replace(url+'?m='+id);
        }
    </script>
</body>
</html>