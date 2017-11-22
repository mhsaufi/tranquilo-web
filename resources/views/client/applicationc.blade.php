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
                <a href="{!! url('/home') !!}">Property</a>
                <a href="{!! url('/myapplication') !!}" class="active">Application</a>
                <a href="{!! url('/mybookmark') !!}">Bookmark</a>
                <a href="#">History</a>
            </div>
        </div>
    </header>
    <br>

    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 col-centered">
            <h2><i class="fa icon-exchange"></i>Application</h2>
            <hr>
            @if($application_count == 0)
            <span style="opacity: 0.5;font-weight: bold;">You currently have no application.</span>
            @else
            <span style="opacity: 0.5;font-weight: bold;">You currently have {!! $application_count !!} applications.</span>
            <br><br>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Model Title</th>
                        <th>Deal Type</th>
                        <th>Deal On</th>
                        <th>Status</th>
                        <th>Bid On</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach($application as $app)
                    <tr>
                        <td>{!! $i !!}</td>
                        <td>{{ $app->m_title }}</td>
                        <td>{{ $app->b_type_title }}</td>
                        <td>{{ $app->d_date }}</td>
                        <td>{{ $app->application_status_title }}</td>
                        <td>{{ $app->application_installment }}</td>
                        <td>
                            <button class="btn btn-danger btn-block"><i class="fa icon-times"></i>Cancel</button>
                        </td>
                    </tr>
                    <?php $i++; ?>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
    <br><br><br>

    @include('layouts.tranquilo-footer')


    <script src="myasset/js/jquery.js"></script>
    <script src="myasset/js/bootstrap.min.js"></script>
    <script src="myasset/js/jquery.prettyPhoto.js"></script>
    <script src="myasset/js/main.js"></script>

</body>
</html>