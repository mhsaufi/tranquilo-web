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

    <header class="mini-header-landlord">
        <div class="row">
            <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
                
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 text-left">
                <a href="{!! url('/home') !!}">Property</a>
                <a href="{!! url('/board') !!}" class="active">Applications</a>
                <a href="#">Deals</a>
                <a href="#">History</a>
            </div>
        </div>
    </header>
    <br>

    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 col-centered">
            <br>
            <b><a href="{{ url('/board') }}">Application</a></b> > Application by {{ $application->name }}<br>
            <br>
            <h2><i class="fa icon-exchange"></i>Application</h2>
            <hr>
            <div class="row view_property_card">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h3 class="tranquilo-header">{{ $application->m_title }}</h3>
                    <hr>
                    <span style="opacity: 0.8;"><em>Application made on {{ $application->application_date }} by <b>{{ $application->name }}</b></em></span>


                </div>
            </div>
        </div>
    </div>

    <div class="tranquilo-push-bottom">
        @include('layouts.tranquilo-footer')
    </div>

    <script src="myasset/js/jquery.js"></script>
    <script src="myasset/js/bootstrap.min.js"></script>
    <script src="myasset/js/jquery.prettyPhoto.js"></script>
    <script src="myasset/js/main.js"></script>

</body>
</html>