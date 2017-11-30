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
                <a href="{!! url('/admin/dashboard') !!}" class="active"><i class="fa icon-th-large"></i>Admin Panel</a>
                <a href="{!! url('/admin/user') !!}"><i class="fa icon-user"></i>Tranquilo Users</a>
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
                <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 dashboard_report_card wet-asphalt" onclick="jumpTo('{{ url('/admin/user') }}')">
                    <div class="row text-center">
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="color: white;">
                            <h4><i class="fa icon-user"></i></h4>
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                            <h5>{{ $users }} Registered Users</h5>
                        </div>
                    </div>
                </div>
               <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 dashboard_report_card nephritis" onclick="jumpTo('{{ url('/admin/propertyrecord') }}')">
                    <div class="row text-center">
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="color: white;">
                            <h4><i class="fa icon-home"></i></h4>
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                            <h5>{{ $properties }} Properties</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 dashboard_report_card turquoise" onclick="jumpTo('{{ url('/admin/dealsrecord') }}')">
                    <div class="row text-center">
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="color: white;">
                            <h4><i class="fa icon-briefcase"></i></h4>
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                            <h5>{{ $deals }} Deals</h5>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <h4>Display Model</h4>
                <div class="row">
                    <div class="col-lg-3 col-md-5 col-sm-12 col-xs-12">
                        <select class="form-control" id="model" name="model">
                            @foreach($models as $m)
                                <option value="{{ $m->m_id }}">{{ $m->m_title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                        <div id="display_model_area">
                            <div id="model_img" class="circular--landscape center">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <h3 id="m_title"></h3>
                        <p id="m_address"></p>
                    </div>
                </div>
            </div>

            <div class="row">
                <h4>Display Review</h4>
                <div class="row">
                    <table class="table" style="background-color: white;">
                        <thead>
                            <tr>
                                <th>IDS</th>
                                <th>Review</th>
                                <th>Users</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reviews as $review)
                            <tr>
                                <td>{{ $review->review_id }}</td>
                                <td>{{ $review->review_content }}</td>
                                <td>{{ $review->name }}</td>
                                <td>{{ $review->review_status_title }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <br><br><br>


    @include('layouts.tranquilo-footer')



    @include('layouts.tranquilo-core-scripts')
    
    <script>
        function jumpTo(url){

            window.location.replace(url);

        }

        $('#model').change(function(){

            var model = $('#model :selected').val();
            var url = '{{ url('/api/model') }}'+'?m='+model;

            $.get(url,function(data){

                var obj = JSON.parse(data);

                var images = obj.m_gallery;

                var img_arr = images.split('|');

                var img_url = '{{ url('/galleries') }}'+'/'+obj.m_id+'/'+img_arr[0];

                $('#model_img').css('background-size','cover');
                $('#model_img').css('background-position','center');
                $('#model_img').css('background-image','url('+img_url+')');

                $('#m_title').html(obj.m_title);
                $('#m_address').html(obj.m_address);

            });
        });

    </script>
</body>
</html>