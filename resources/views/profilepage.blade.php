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
            <div class="row profile-card">
                <div class="col-lg-2 col-md-5 col-sm-12 col-xs-12">
                    @if(Auth::user()->img)
                        <div class="circular--landscape center" style="background-image: url('{{ url('/avatar/'.Auth::user()->id.'/'.Auth::user()->img) }}');background-size: cover;background-position: center;">
                        </div>
                    @else
                        <div class="circular--landscape" style="background-image: url({!! asset('myasset/images/piyad.jpg') !!});background-size: cover;background-position: center;"></div>
                    @endif
                    <br>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <p><span class="profile-email" id="profile-email">{!! Auth::user()->email !!}</span></p><br>
                    <p><span class="profile-name" id="profile-name">{!! Auth::user()->name !!}</span></p><br>
                    <button class="btn btn-success"><i class="fa icon-check"></i>{{ $users->user_status_title }}</button>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <b>Address</b><br>
                    @if(Auth::user()->address == null)
                        <textarea name="address" class="form-control" placeholder="you haven't given your address"></textarea>
                    @else
                        {{ $users->address }}
                    @endif
                    <hr>
                    <b>State</b><br>
                    @if(Auth::user()->state == null)
                        <select name="state" class="form-control">
                            @foreach($state as $st)
                                <option value="{!! $st->state_id !!}">{!! $st->state_title !!}</option>
                            @endforeach                                                        
                        </select>
                    @else
                        {{ $users->state_title }}
                    @endif
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="padding-left: 50px;">
                    
                    <span><a href="{{ url('/profilepicture') }}"><i class="fa icon-photo"></i>Change profile picture</a></span><br><br>
                    <span><a href="{{ url('/passwordchange') }}"><i class="fa icon-refresh"></i>Change password</a></span><br><br>
                    <span><a href="{{ url('/Change password') }}"><i class="fa icon-home"></i>Become a landlord</a><br></span><br>
                    <span><a href="{{ url('/Change password') }}"><i class="fa icon-ban"></i>Deactivate Account</a><br></span><br>
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