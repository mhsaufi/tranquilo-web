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
    <!-- Dropzone Css -->
    <link href="myasset/dropzone/dropzone.css" rel="stylesheet">

</head><!--/head-->
<body>

    @include('layouts.tranquilo-header')

    @include('layouts.tranquilo-profile-header')
    <br>

    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 col-centered">
            <b><a href="{{ url('/profile') }}">Profile</a></b> > Change password
            <br><br>
            <hr>
            <div class="row profile-card">

                <div class="col-lg-3 col-md-5 col-sm-12 col-xs-12 col-centered">
                    <!-- Dropzone -->
                        <input type="password" name="password" id="password" class="form-control" /><br>
                        <input type="password" id="retype" class="form-control">
                        <span id="alert-msg"><em>Password not match!</em></span>
                        <span id="update-btn"><br><button class="btn btn-block btn-danger">Update password</button></span>
                </div>
            </div>
            
        </div>
    </div>


    <div class="tranquilo-push-bottom">
        @include('layouts.tranquilo-footer')
    </div>


    @include('layouts.tranquilo-core-scripts')
    
    <script src="myasset/js/tranquilo-profile.js"></script>

    <script>

        $(document).ready(function(){
            $('#alert-msg').hide();
            $('#update-btn').hide();
        });

        $('#password').blur(function(){

            var ar = $(this).val();
            var br = $('#retype').val();

            if(ar != '' && br != ''){

                if(ar == br){
                    $('#update-btn').show();
                }else{
                    $('#alert-msg').show();
                }

            }

        });

        $('#retype').blur(function(){

            var ar = $(this).val();
            var br = $('#password').val();

            if(ar != '' && br != ''){

                if(ar == br){
                    $('#update-btn').show();
                    $('#alert-msg').hide();
                }else{
                    $('#alert-msg').show();
                    $('#update-btn').hide();
                }

            }

        });

        $('#update-btn').click(function(){

            var ar = $('#password').val();
            var url = '{{ url('/updatepassword') }}';

            $.post(url,{ar:ar},function(){

                var red = '{{ url('/profile') }}';

                window.location.replace(red);
            });

        });

    </script>
</body>
</html>