<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tranquilo | Admin</title>

    @include('layouts.tranquilo-core-sheets')

    <style>
        .refresh-icon{
            opacity: 0.5;
            cursor: pointer;
        }
        .refresh-icon:hover{
            opacity: 1.0;
        }
    </style>
    
</head>
<body>
   
    @include('layouts.tranquilo-header-admin')

    <header class="mini-header-admin">
        <div class="row">
            <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
                
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 text-left">
                <a href="{!! url('/admin/dashboard') !!}"><i class="fa icon-th-large"></i>Admin Panel</a>
                <a href="{!! url('/admin/user') !!}" class="active"><i class="fa icon-user"></i>Tranquilo Users</a>
                <a href="{!! url('/admin/permission') !!}"><i class="fa icon-unlock"></i>Permission Changes</a>
                <a href="{!! url('/admin/propertyrecord') !!}"><i class="fa icon-home"></i>Tranquilo Properties</a>
                <a href="{!! url('/admin/dealsrecord') !!}"><i class="fa icon-briefcase"></i>Deals On Tranquilo</a>
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
                                <th width="5%">IDS</th>
                                <th width="20%">Email</th>
                                <th width="20%">Name</th>
                                <th width="5%">Permission</th>
                                <th width="20%">Registered On</th>
                                <th width="10%">Status &nbsp&nbsp&nbsp<i class="fa icon-retweet refresh-icon" id="clear_stat" title="clear"></i></th>
                                <th width="20%">Action&nbsp&nbsp&nbsp<i class="fa icon-retweet refresh-icon" id="clear_act" title="clear"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $u)
                                <tr class="admin_tbl_record" style="cursor: default!important;">
                                    <td>{{ $u->id }}</td>
                                    <td>{{ $u->email }}</td>
                                    <td>{{ $u->name }}</td>
                                    <td>{{ $u->role_title }}</td>
                                    <td>{{ $u->created_at }}</td>
                                    <td>
                                        
                                        <select name="status" id="<?php echo "status_".$u->id; ?>" class="form-control status-select" onchange="chooseAction('{{ $u->id }}')">
                                            @foreach($status as $s)
                                                @if($u->status == $s->user_status_id)
                                                    <option value="{{ $s->user_status_id }}" selected="selected">{{ $s->user_status_title }}</option>
                                                @else
                                                    <option value="{{ $s->user_status_id }}">{{ $s->user_status_title }}</option>
                                                @endif
                                            @endforeach
                                        </select>

                                    </td>
                                    <td>
                                        <button class="btn btn-block btn-action" id="<?php echo "action_".$u->id; ?>"></button>
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

            $('.btn-action').hide();

        });

        $('#clear_act').click(function(){
             $('.btn-action').hide();
        });

        $('#clear_stat').on('click', function () {

           $('.status-select').prop('selectedIndex',0);

        });

        function chooseAction(id){

            var action = $('#status_'+id+' :selected').val();

            if(action == 1){

                var text = '<i class="fa icon-check"></i>Activate';
                $('#action_'+id).show();
                $('#action_'+id).css({'background-color':'green','color':'white'});
                $('#action_'+id).html(text);

            }
            if(action == 2){

                var text = '<i class="fa icon-lock"></i>Lock Account';
                $('#action_'+id).show();
                $('#action_'+id).css({'background-color':'#4a235a','color':'white'});
                $('#action_'+id).html(text);

            }
            if(action == 3){

                var text = '<i class="fa icon-ban"></i>Blacklist Account';
                $('#action_'+id).show();
                $('#action_'+id).css({'background-color':'#922b21','color':'white'});
                $('#action_'+id).html(text);

            }
            if(action ==4){

                var text = '<i class="fa icon-close"></i>Inactivate';
                $('#action_'+id).show();
                $('#action_'+id).css({'background-color':'#a04000','color':'white'});
                $('#action_'+id).html(text);

            }

        }
    </script>
</body>
</html>