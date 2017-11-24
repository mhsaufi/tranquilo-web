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

    <header class="mini-header-user">
        <div class="row">
            <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
                
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 text-left">
                <a href="{!! url('/home') !!}" class="active">Property</a>
                <a href="{!! url('/myapplication') !!}">Application</a>
                <a href="{!! url('/mybookmark') !!}">Bookmark</a>
                <a href="{!! url('/profile') !!}">Profile <span class="badge" id="tranquilo_badge"></span></a>
                <a href="{!! url('/myhistory') !!}">History</a>
            </div>
        </div>
    </header>
    <br>

    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 col-centered view-a-property">
            <br>
            <b><a href="{!! url('/home') !!}">Property</a></b> > {!! $deal->m_title !!}<br>
            <hr>
            <div class="row view_property_card">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h4>Application for {!! $deal->m_title !!}</h4>
                    <hr>
                    Your application will be forwarded to property owner for review.<br>
                    Give your highest bid for deposit/installment to increase your chance to be accepted!<br>
                    <br>
                    <form action="{!! url('/apply') !!}" method="POST">
                        {!! csrf_field() !!}
                        <input type="hidden" name="d_id" value="{!! $deal->d_id !!}">
                        <div class="row">
                            <div class="col-lg-2 col-md-5 col-sm-12 col-xs-12">   
                                <input type="number" name="installment" class="form-control" placeholder="RM">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">   
                                <textarea name="remark" rows="3" class="form-control" placeholder="give a nice word.."></textarea>
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">   
                                <button role="submit" class="tranquilo-btn btn-block">Apply</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br><br><br>
    
    @include('layouts.tranquilo-footer')

    <script src="myasset/js/jquery.js"></script>
    <script src="myasset/js/bootstrap.min.js"></script>
    <script src="myasset/js/jquery.prettyPhoto.js"></script>
    <script src="myasset/js/main.js"></script>
    <script>
    </script>
</body>
</html>