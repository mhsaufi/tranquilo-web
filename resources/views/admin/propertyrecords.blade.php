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
                <a href="{!! url('/admin/dashboard') !!}"><i class="fa icon-th-large"></i>Admin Panel</a>
                <a href="{!! url('/admin/user') !!}"><i class="fa icon-user"></i>Tranquilo Users</a>
                <a href="{!! url('/admin/permission') !!}"><i class="fa icon-unlock"></i>Permission Changes</a>
                <a href="{!! url('/admin/propertyrecord') !!}" class="active"><i class="fa icon-home"></i>Tranquilo Properties</a>
                <a href="{!! url('/admin/dealsrecord') !!}"><i class="fa icon-briefcase"></i>Deals On Tranquilo</a>
            </div>
        </div>
    </header>
    
    <br>
    <div class="row">
        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 col-centered">
            <div class="row">

                @if($r_count != 0)
                    <table class="table" style="background-color: white;border-radius: 10px;padding: 20px 20px!important;">
                        <thead>
                            <tr>
                                <th>IDS</th>
                                <th>Property Name</th>
                                <th>Type</th>
                                <th>Value</th>
                                <th>Year</th>
                                <th>State</th>
                                <th>Owner</th>
                                <th>Rating</th>
                                <th>Views</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($models as $model)
                                <tr class="admin_tbl_record" onclick="viewProperty('{{ $model->m_id }}')">
                                    <td>{{ $model->m_id }}</td>
                                    <td>{{ $model->m_title }}</td>
                                    <td>{{ $model->h_type_title }}</td>
                                    <td>{{ $model->m_price }}</td>
                                    <td>{{ $model->m_year }}</td>
                                    <td>{{ $model->state_title }}</td>
                                    <td>{{ $model->name }}</td>
                                    <td>
                                        <?php $rated_value = $model->m_rate_value;$unrated_value = 5 - $rated_value;  $j = 1;?>

                                        @for($i=0;$i<$rated_value;$i++)
                                            <i class="icon-star rate-checked" style="cursor: default!important;"></i>
                                            <?php  $j++; ?>
                                        @endfor

                                        @for($k=0;$k<$unrated_value;$k++)
                                            <i class="icon-star" style="cursor: default!important;"></i>
                                            <?php  $j++; ?>
                                        @endfor
                                    </td>
                                    <td>{{ $model->m_view }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $models->links() }}
                @else
                    <h4>No properties is currently registered with the system</h4>

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

        function viewProperty(id){
            
            var url = '{{ url('/admin/viewproperty') }}';

            window.location.replace(url+'?m='+id);
        }
    </script>
</body>
</html>