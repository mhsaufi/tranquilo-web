<?php $a = 1; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tranquilo | Profile</title>
    @include('layouts.tranquilo-core-sheets')

</head>
<body>

    @include('layouts.tranquilo-header')

    @include('layouts.tranquilo-profile-header')
    <br>

    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 col-centered">
            <b><a href="{{ url('/profile') }}">Profile</a></b> > Become a landlord
            <br><br>
            <hr>
            
            <p> To become a landlord, you must agree to our term and condition. Once you agree, click 'Apply'.</p>
            <p> Your application is subject for approval by Tranquilo administrative team. Any info on your application status will be informed by email, thank you</p>
            <br>
            <input type="checkbox" name="term" id="term"> Agree to our <a href="{{ url('/termandcondition') }}">Term and condition</a>
            <br><br>
            <button id="apply-btn" class="btn btn-danger">Apply</button>
        </div>
    </div>


    <div class="tranquilo-push-bottom">
        @include('layouts.tranquilo-footer')
    </div>


    @include('layouts.tranquilo-core-scripts')
    
    <script src="myasset/js/tranquilo-profile.js"></script>

    <script>
        $('#apply-btn').click(function(){

            var url_apply = '{{ url('/applying') }}';
            var redirect = '{{ url('/profile') }}';

                if ($('#term').is(':checked')){

                    $.post(url_apply,function(){

                        window.location.replace(redirect);

                    });

                }else{

                    alert('You must agree to our term and condition on applying for landlord');
                }



        });
    </script>

</body>
</html>