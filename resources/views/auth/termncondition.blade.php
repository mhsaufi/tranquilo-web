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
                <h4>Landlord Term And Condition</h4>

                <hr>

                <h4>WE ARE TAKING THIS SERIOUS!</h4>
                <p>(1) Any application to become a landlord is considered a <b>one-way change of permission</b>.<br>You will not be able to revert back to usual user once accepted. <br>To revert, deactivate your current account and register for new account with the same email. The old account will be locked.<br>
                Dont't worry, your properties and info in your old account will be kept safe and you can transfer your data back anytime</p>

                <p>(2) <b>We are not taking any credit on your dea with your users nor involved in your deal. Your properties are yours.</b><br>
                We will help in promoting your properties to make sure our users satisfied to request more.</p>

                <p>(3) <b>We are not involved in any illegal transaction between you and our customers.</b> <br>Your act on illegallize your deal are your resposibility. <br>Get a legal licensed permission for your business and get your own platform for your business if you wish<br>
                to do so. <b>Remember, we are a free platform for users</b></p>

                <p>(4) <b>Your misbehavior upon our users will be penaltized</b>. Do not accept user application if you dont mean to do so.</p>
                <p>(5) <b>We recommended you to register all your properties although you don't wish to do a deal with it. <br>Any properties taken from third party resources either legal or illegal is your responsibilites. </b><br>
                    We will not hesitate to hand your detail information to related authority if we receive reports on your illegal act. </p>

                <p> (6) <b>We will send notice to our users on your act of reviewing and accepting the application</b>.
                <br><br><br>
            </div>
        </div>
    </div>

    <br><br><br>

    @include('layouts.tranquilo-footer')


    @include('layouts.tranquilo-core-scripts')
    
    <script src="myasset/js/tranquilo-profile.js"></script>

</body>
</html>