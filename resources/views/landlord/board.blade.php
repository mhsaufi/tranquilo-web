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

    <header class="mini-header-landlord">
        <div class="row">
            <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
                
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 text-left">
                <a href="{!! url('/feed') !!}">Feed</a>
                <a href="{!! url('/home') !!}">Property</a>
                <a href="{!! url('/board') !!}" class="active">Applications</a>
                <a href="{!! url('/dealboard') !!}">Deals</a>
                <a href="{!! url('/profile') !!}"><i class="fa icon-user"></i>Profile</a>
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
            <span style="opacity: 0.5;font-weight: bold;">No user applying for your property yet.</span>
            @else
            <span style="opacity: 0.5;font-weight: bold;">You currently have {!! $application_count !!} applications waiting.</span>
            <br><br>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Model Title</th>
                        <th>Deal Type</th>
                        <th>Deal On</th>
                        <th>Status</th>
                        <th>Bid On (RM)</th>
                        <th>Demand Value (RM)</th>
                    </tr>
                </thead>
                <tbody style="background-color: white;">
                    <?php $i = 1; ?>
                    @foreach($application as $app)
                    <tr class="tranquilo-datatable-list" onclick="viewApplication('{!! $app->application_id !!}','{!! url('/viewapplication') !!}')">
                        <td>{!! $i !!}</td>
                        <td>{{ $app->m_title }}</td>
                        <td>{{ $app->b_type_title }}</td>
                        <td>{{ $app->d_date }}</td>
                        <td>{{ $app->application_status_title }}</td>
                        <td>{{ $app->application_installment }}</td>
                        <td>{{ $app->d_value }}</td>
                    </tr>
                    <?php $i++; ?>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>

    @if($application_count > 6)
        @include('layouts.tranquilo-footer')
    @else
        <div class="tranquilo-push-bottom">
            @include('layouts.tranquilo-footer')
        </div>
    @endif

    @include('layouts.tranquilo-core-scripts')
    
    <script>
        function viewApplication(id,url){

            var full_url = url + '?app_id='+id;

            window.location.replace(full_url);

        }
    </script>

</body>
</html>