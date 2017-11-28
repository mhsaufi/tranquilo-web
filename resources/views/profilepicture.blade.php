<?php $a = 1; ?>
<?php

$keygen = generateKey(20);

function generateKey($length) 
{
    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    
    return substr(str_shuffle($chars),0,$length);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tranquilo | Home</title>
    @include('layouts.tranquilo-core-sheets')
    <!-- Dropzone Css -->
    <link href="myasset/dropzone/dropzone.css" rel="stylesheet">

</head><!--/head-->
<body>

    @include('layouts.tranquilo-header')

    @include('layouts.tranquilo-profile-header')
    <br>

    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 col-centered">
            <b><a href="{{ url('/profile') }}">Profile</a></b> > Update Profile Picture
            <br><br>
            <hr>
            <div class="row profile-card">

                <div class="col-lg-3 col-md-5 col-sm-12 col-xs-12">
                    <!-- Dropzone -->
                    <form action="uploaddp" id="frmFileUpload" method="post" class="dropzone" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="dz-message">
                                <h3><i class="fa icon-picture"></i></h3>
                                <h5>drop or click</h5>
                            </div>
                            <div class="fallback">
                                <input name="file" type="file"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>


    <div class="tranquilo-push-bottom">
        @include('layouts.tranquilo-footer')
    </div>


    @include('layouts.tranquilo-core-scripts')
    
    <script src="myasset/js/tranquilo-profile.js"></script>
    <script src="myasset/dropzone/dropzone.js"></script>
</body>
</html>