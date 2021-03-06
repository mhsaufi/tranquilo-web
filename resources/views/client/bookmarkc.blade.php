<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tranquilo | Home</title>
    
    @include('layouts.tranquilo-core-sheets')

</head><!--/head-->
<body>
    
    @include('layouts.tranquilo-header')

    <header class="mini-header-user">
        <div class="row">
            <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
                
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 text-left">
                <a href="{!! url('/home') !!}">Property</a>
                <a href="{!! url('/myapplication') !!}">Application</a>
                <a href="{!! url('/mybookmark') !!}" class="active">Bookmark</a>
                <a href="{!! url('/profile') !!}">Profile <span class="badge" id="tranquilo_badge"></span></a>
                <!-- <a href="{!! url('/myhistory') !!}">History</a> -->
            </div>
        </div>
    </header>
    <br>

    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 col-centered">
            <h2><i class="fa icon-bookmark"></i>Bookmarks</h2>
            <hr>
            @if($bookmark_count == 0)
            <span style="opacity: 0.5;font-weight: bold;">You haven't bookmark any deal yet.</span>
            @else
            <span style="opacity: 0.5;font-weight: bold;">You bookmarked {!! $bookmark_count !!} deals.</span>
            <br><br>

            <?php $i = 1; ?>

                <div class="row">
                @foreach($deals as $deal)
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-left">
                        <?php
                            $g_arr = explode('|',$deal->m_gallery);
                        ?>
                        <div class="property_card" onclick="viewModel('{{ $deal->d_id }}','{{ url('/viewmodelc') }}')">
                            <div class="row property_card_header">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <img src="{{ url('/galleries/'.$deal->m_id.'/'.$g_arr[0]) }}" width="100%">
                                </div>
                            </div>
                            <div class="row property_card_body">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <h4>{!! $deal->m_title !!}</h4>
                                    <hr>
                                    <?php
                                        if(strlen($deal->d_value) > 3){

                                            $d_value = $deal->d_value/1000;
                                            $str_d_value = $d_value."K";
                                        }else{
                                            $str_d_value = $deal->d_value;
                                        }

                                    ?>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                            <span class="property_d_value">RM {{ $str_d_value }}</span>
                                            <br>
                                            <span class="property_address">{{ $deal->m_address }}</span>
                                        </div>
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



                    <?php $i++;?>

                @endforeach
                </div>
            
            @endif
        </div>
    </div>
    <br><br><br>

    <div class="tranquilo-push-bottom">
        @include('layouts.tranquilo-footer')
    </div>


    @include('layouts.tranquilo-core-scripts')

    <script>
        function viewModel(id,url){

            window.location.replace(url+'?m='+id);

        }
    </script>

</body>
</html>