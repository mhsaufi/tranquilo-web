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
                <a href="{!! url('/home') !!}">Property</a>
                <a href="{!! url('/board') !!}" class="active">Applications</a>
                <a href="{!! url('/dealboard') !!}">Deals</a>
                <a href="#">History</a>
            </div>
        </div>
    </header>
    <br>

    <?php
        $g_arr = explode('|',$application->m_gallery);
    ?>
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 col-centered">
            <div class="row view_application_card">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <br>
                            <b><a href="{{ url('/board') }}">Application</a></b> > Application by {{ $application->name }}<br><br>
                            <div class="tranquilo-application-banner" style="background-image: url({{ url('/galleries/'.$application->m_id.'/'.$g_arr[0]) }});background-size: cover;background-position: center;">

                                <h2 class="tranquilo-header" style="margin-left: 20px;color: white;text-shadow: 0 0 5px black;">{{ $application->m_title }}</h2>
                            </div>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <span style="opacity: 0.8;"><em>Application made on {{ $application->application_date }} by <b>{{ $application->name }}</b></em></span>
                            <br><br><br>
                            <p>Requested to be valued at RM{{ $application->application_installment }}</p>
                            <p>"{!! $application->application_description !!}"</p>
                            <p>
                                <i class="fa icon-phone"></i>
                                @if($application->phone_no != '')
                                    {{ $application->phone_no }}
                                @else
                                    Not given
                                @endif
                            </p>
                            <p>
                                <i class="fa icon-envelope"></i>
                                @if($application->email != '')
                                    {{ $application->email }}
                                @else
                                    Not given
                                @endif
                            </p>
                            <br><br>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            
                        </div>
                    </div>
                    @if($application->application_status != 4)
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <button class="btn btn-block btn-danger" onclick="rejectApplication('{{ $application->application_id }}','{{ url('/reject') }}')">Reject</button>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <button class="btn btn-block btn-success" onclick="acceptApplication('{{ $application->application_id }}','{{ url('/accept') }}')">Accept</button>
                        </div>
                    </div>
                    @endif
                </div>
                
                
            </div>
        </div>
    </div>
    <br><br><br>

        @include('layouts.tranquilo-footer')


    @include('layouts.tranquilo-core-scripts')
    
    <script>
        function acceptApplication(app_id,url){

            var redirect_url = "{{ url('/board') }}";

            $.post(url,{app_id:app_id},function(){
                window.location.replace(redirect_url);
            });


        }
        function rejectApplication(app_id,url){

            var redirect_url = "{{ url('/board') }}";

            $.post(url,{app_id:app_id},function(){   
                window.location.replace(redirect_url);
            });
        }
    </script>

</body>
</html>