<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tranquilo | Sign In</title>
    @include('layouts.tranquilo-core-sheets')
</head><!--/head-->
<body>
    
    @include('layouts.tranquilo-header')

    <br>
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 center col-centered">
            <img src="{!! asset('myasset/images/tranquilo.png') !!}" width="30%">
            <form method="POST" action="{{ route('login') }}" class="center" role="form">
                {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" id="email" name="email" placeholder="E-mail" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" id="password" name="password" placeholder="Password" class="form-control">
                    </div>
                    <div class="checkbox text-left">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                        </label>
                    </div>
                    <div class="form-group">
                        <button role="submit" class="btn btn-success btn-md btn-block">Sign In</button>
                    </div>
            </form>
            
        </div>
    </div>
    <br><br><br>

    <div class="tranquilo-push-bottom">
        @include('layouts.tranquilo-footer')
    </div>


    @include('layouts.tranquilo-core-scripts')

</body>
</html>