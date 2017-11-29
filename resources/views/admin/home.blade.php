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
                <a href="{!! url('/dashboard') !!}" class="active">Tranquilo Users</a>
                <a href="{!! url('/permission') !!}">Permission Changes</a>
                <a href="{!! url('/profile') !!}">Profile <span class="badge" id="tranquilo_badge"></span></a>
            </div>
        </div>
    </header>
    
    <br>
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 col-centered">
            <div class="row">

                @if($r_count != 0)
                    <table class="table" style="background-color: white;border-radius: 10px;padding: 20px 20px!important;">
                        <thead>
                            <tr>
                                <th>IDS</th>
                                <th>Email</th>
                                <th>Name</th>
                                <th>Permission</th>
                                <th>Registered On</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $u)
                                <tr>
                                    <td>{{ $u->id }}</td>
                                    <td>{{ $u->email }}</td>
                                    <td>{{ $u->name }}</td>
                                    <td>{{ $u->role_title }}</td>
                                    <td>{{ $u->created_at }}</td>
                                    <td>
                                        
                                        <select name="status" id="status" class="form-control">
                                            @foreach($status as $s)
                                                @if($u->status == $s->user_status_id)
                                                    <option value="{{ $s->user_status_id }}" selected="selected">{{ $s->user_status_title }}</option>
                                                @else
                                                    <option value="{{ $s->user_status_id }}">{{ $s->user_status_title }}</option>
                                                @endif
                                            @endforeach
                                        </select>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $users->links() }}
                @else
                    <h4>No users is currently using this system. So sad bro</h4>

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
    <script src="myasset/js/tranquilo-sort-plugin.js"></script>
    <script>
        $(document).ready(function(){
            $('#sorting_board').hide();

            if($('#sort_check:checked').length > 0){

                $("#sorting_board").show();

            }

            if($('#sort_check:checked').length == 0){

                $('#sorting_board').hide();
            }
        });

        function viewModel(id,url){
            window.location.replace(url+'?m='+id);
        }
    </script>
</body>
</html>