<?php $a = 2; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tranquilo | Inbox</title>
    @include('layouts.tranquilo-core-sheets')

</head><!--/head-->
<body>

    @include('layouts.tranquilo-header')

    @include('layouts.tranquilo-profile-header')
    <br>

    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 col-centered">
            <h5><b><a href="{{ url('/message') }}">Inbox</a></b> > {{ $mail->message_subject }}</h5>
            <hr>
            <div class="row view_application_card">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h3><i class="fa icon-envelope"></i> {{ $mail->message_subject }}</h3>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    {!! $mail->message_content !!}
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