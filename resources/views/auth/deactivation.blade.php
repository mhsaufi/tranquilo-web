<?php $a = 1; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tranquilo | Terms</title>
    @include('layouts.tranquilo-core-sheets')

</head>
<body>

    @include('layouts.tranquilo-header')

    @include('layouts.tranquilo-profile-header')
    <br>

    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 col-centered">
            <b><a href="{{ url('/profile') }}">Profile</a></b> > Term And Condition
            <br><br>
            <hr>
            
            <div class="profile-card">
                After you click the activation button, you will not be able to log into your account anymore.<br>
                However, we will keep your account for your future reference as you might wish to re-activate your account later.<br>
                @if(Auth::user()->role == 2)
                All of your properties and deal you posted will be kept hidden from public.<br><br> 
                @endif
                <br>

                Once you click the button, you will automatically be kicked out of your account and your next log in will redirect you to notification page.

                <br><br>
                <button class="btn btn-danger" onclick="deactivate()">Deactivate</button>
                <br><br><br>
            </div>
        </div>
    </div>

    <br><br><br>

    <div class="tranquilo-push-bottom">
        @include('layouts.tranquilo-footer')
    </div>


    @include('layouts.tranquilo-core-scripts')
    
    <script src="myasset/js/tranquilo-profile.js"></script>
    <script>
        function deactivate(){

            var url = '{{ url('/deactivating') }}';

            window.location.replace(url);

        }
    </script>

</body>
</html>