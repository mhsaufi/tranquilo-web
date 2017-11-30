<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tranquilo</title>

    @include('layouts.tranquilo-core-sheets')

</head><!--/head-->
<body style="background-color: #34495e;">
    @include('layouts.tranquilo-header')
    <br>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 center col-centered" style="color: white;">
            <img src="{!! asset('myasset/images/tranquilo.png') !!}" width="30%">
            <span class="text-left">
            <h4>We are very sorry to inform you that your account has been deactivated.<br><br>
            Do contact our adminitrative team to reactivate your accout. Thank you.</h4></span>
            
        </div>
    </div>
    <br><br><br>


    <div class="tranquilo-push-bottom">
            @include('layouts.tranquilo-footer')
    </div>

    <script src="myasset/js/jquery.js"></script>
    <script src="myasset/js/bootstrap.min.js"></script>
    <script src="myasset/js/jquery.prettyPhoto.js"></script>
    <script src="myasset/js/main.js"></script>

</body>
</html>