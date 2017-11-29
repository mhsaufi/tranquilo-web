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
                <a href="{!! url('/profile') !!}">Profile <span class="badge" id="tranquilo_badge"></span></a>
                <!-- <a href="{!! url('/myhistory') !!}">History</a> -->
            </div>
        </div>
    </header>

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
                    @foreach($application as $app)
                    <tr id="app_{{ $app->application_id }}">
                        <td>{!! $app->application_id !!}</td>
                        <td>{{ $app->m_title }}</td>
                        <td>{{ $app->b_type_title }}</td>
                        <td>{{ $app->d_date }}</td>
                        <td>{{ $app->application_status_title }}</td>
                        <td>{{ $app->application_installment }}</td>
                        <td>
                            <button class="btn btn-danger btn-block" onclick="cancelApplication('{{ $app->application_id }}','{{ url('/cancelapplication') }}')"><i class="fa icon-times"></i>Cancel</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            {{ $application->links() }}
            @endif
        </div>
    </div>
    <br><br><br>

    <div class="tranquilo-push-bottom">
        @include('layouts.tranquilo-footer')
    </div>


    <script src="myasset/js/jquery.js"></script>
    <script src="myasset/js/jquery-ui.js"></script>
    <script src="myasset/js/bootstrap.min.js"></script>
    <script src="myasset/js/jquery.prettyPhoto.js"></script>
    <script src="myasset/js/main.js"></script>
    <script>
        function cancelApplication(application_id,url){

            $.post(url,{application:application_id},function(data){

                if(data == 0){
                    $('#app_'+application_id).hide('fade','slow',function(){

                    });
                }
                else
                {
                    alert('Cannot cancel this application');
                }

            });

        }
    </script>

</body>
</html>