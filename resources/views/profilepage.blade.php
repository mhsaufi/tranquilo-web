<?php $a = 1; ?>
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

    @include('layouts.tranquilo-profile-header')
    <br>

    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 col-centered">
            <h2><i class="fa icon-user"></i>Profile</h2>
            <hr>
            <input type="hidden" id="update_url" value="{!! url('/updateprofile') !!}"/>
            <div class="row clearfix">
                <div class="col-lg-2 col-md-5 col-sm-12 col-xs-12">
                    @if(Auth::user()->img)
                        <div class="circular--landscape center" style="background-image: url('');background-size: cover;background-position: center;">
                        </div>
                    @else
                        <div class="circular--landscape" style="background-image: url({!! asset('myasset/images/piyad.jpg') !!});background-size: cover;background-position: center;"></div>
                    @endif
                    <br>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <p><span class="profile-email" id="profile-email">{!! Auth::user()->email !!}</span></p>
                    <p><span class="profile-name" id="profile-name">{!! Auth::user()->name !!}</span></p>
                    <p>
                        
                    </p>
                </div>
            </div>
            
        </div>
    </div>


    <div class="tranquilo-push-bottom">
        @include('layouts.tranquilo-footer')
    </div>


    @include('layouts.tranquilo-core-scripts')
    
    <script src="myasset/js/tranquilo-profile.js"></script>

</body>
</html>