<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tranquilo | Admin</title>

    @include('layouts.tranquilo-core-sheets')
    
</head>
<body>
   
    @include('layouts.tranquilo-header-admin')

    <header class="mini-header-admin">
        <div class="row">
            <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
                
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 text-left">
                <a href="{!! url('/dashboard') !!}">Tranquilo Users</a>
                <a href="{!! url('/permission') !!}" class="active">Permission Changes</a>
                <a href="{!! url('/mybookmark') !!}">Bookmark</a>
                <a href="{!! url('/profile') !!}">Profile <span class="badge" id="tranquilo_badge"></span></a>
            </div>
        </div>
    </header>
    
    <br>
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 col-centered">
            <div class="row">
                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                @if($count != 0)
                    <table class="table" style="background-color: white;border-radius: 10px;padding: 20px 20px!important;">
                        <thead>
                            <tr>
                                <th>IDS</th>
                                <th>Email</th>
                                <th>Name</th>
                                <th>Application Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($applications as $app)
                                <tr>
                                    <td>{{ $app->change_id }}</td>
                                    <td>{{ $app->email }}</td>
                                    <td>{{ $app->name }}</td>
                                    <td>{{ $app->created_at }}</td>
                                    <td>
                                        @if($app->application_status == 1)
                                            <span id="btn-area-{{ $app->change_id }}">
                                                <button class="btn btn-default" onclick="approve('{{ $app->change_id }}')">Approve</button> 
                                                <button class="btn btn-danger" onclick="reject('{{ $app->change_id }}')"">Reject</button>
                                            </span>
                                            <span id="afterclick-{!! $app->change_id !!}" style="font-weight: bold;">

                                            </span>
                                        @else
                                            <b>{{ $app->application_status_title }}</b>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else

                    <h4>No users is currently applying for permission changes</h4>

                @endif

            </div>
        </div>
    </div>
    <br><br><br>

    <div class="tranquilo-push-bottom">
        @include('layouts.tranquilo-footer')
    </div>


    @include('layouts.tranquilo-core-scripts')
    
    <script src="myasset/js/tranquilo-bookmark.js"></script>
    <script>

        function approve(change_id){

            alert(change_id);

            var ap_url = '{{ url('/approvelandlordapply') }}';
            var token = $('#csrf-token').val();

            $.post(ap_url,{change_id:change_id,token:token},function(){

                $('#btn-area-'+change_id).hide();
                var str = 'Accepted';
                $('#afterclick-'+change_id).html(str);

            });

        }

    </script>
</body>
</html>