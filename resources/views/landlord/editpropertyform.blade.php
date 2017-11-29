<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tranquilo | Add Property</title>
    
    @include('layouts.tranquilo-core-sheets')

    <!-- Dropzone Css -->
    <link href="myasset/dropzone/dropzone.css" rel="stylesheet">
    <link href="myasset/summernote/summernote.css" rel="stylesheet" />
</head><!--/head-->
<body>
    
    @include('layouts.tranquilo-header')

    <header class="mini-header-landlord">
        <div class="row">
            <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
                
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 text-left">
                <a href="{!! url('/feed') !!}">Feed</a>
                <a href="{!! url('/home') !!}" class="active">Property</a>
                <a href="{!! url('/board') !!}">Applications</a>
                <a href="{!! url('/dealboard') !!}">Deals</a>
                <a href="{!! url('/profile') !!}"><i class="fa icon-user"></i>Profile</a>
                <!-- <a href="#">History</a> -->
            </div>
        </div>
    </header>

    <br>
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 col-centered">
            <b><a href="{{ url('/home') }}">Property</a></b> > 
            <b><a href="{{ url('/viewmodel?m='.$model->m_id) }}">{{ $model->m_title }}</a></b> > 
            Edit Property

            <br><br>
            <h4>Edit Property</h4>
            <hr>
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-12" style="">
                    <label for="title">Property Name</label>
                    <input type="text" name="title" class="form-control" id="title" value="{{ $model->m_title }}"/><br>

                    <label for="description">Property Remark </label> &nbsp&nbsp&nbsp&nbsp
                    @if($model->m_description == '')
                        <input type="checkbox" name="html_d" id="html_d" onclick="inputChange()" checked><em><small> Interactive Description</small></em><br>
                    @else
                        <input type="checkbox" name="html_d" id="html_d" onclick="inputChange()"><em><small> Interactive Description</small></em><br>
                    @endif

                    <textarea name="description" rows="8" class="form-control" id="description">{!! $model->m_description !!}</textarea>
                    <div id="summerarea"><div id="summernote">{!! $model->m_description_html !!}</div></div>

                    <br>
                    <label for="year">Property Age</label>
                    <input type="number" name="year" id="year" value="{{ $model->m_year }}" class="form-control">

                </div>

                <div class="col-lg-1- col-md-1 col-sm-12">
                    
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <label for="m_type">Type</label>
                    <select name="m_type" class="form-control" id="m_type">
                        <option value="0" selected="selected">not selected</option>
                        @foreach($h_type as $h)
                            @if($model->m_h_type == $h->h_type_id)
                                <option value="{!! $h->h_type_id !!}" selected="selected">{!! $h->h_type_title !!}</option>
                            @else
                                <option value="{!! $h->h_type_id !!}">{!! $h->h_type_title !!}</option>
                            @endif
                        @endforeach
                    </select>
                    <br>
                    <label for="m_price">Property Value</label>
                    <input type="number" name="price" class="form-control" value="{{ $model->m_price }}" id="m_price" />
                    <br>
                    <label for="address">Property Location/ Address</label><br>
                    <textarea name="address" rows="3" class="form-control" id="address">{{ $model->m_address }}</textarea>
                    <br>
                    <label for="state">State</label><br>
                    <select name="state" class="form-control" id="state">
                        <option value="0" selected="selected">not selected</option>
                        @foreach($state as $s)
                            @if($model->state == $s->state_id)
                                <option value="{!! $s->state_id !!}" selected="selected">{!! $s->state_title !!}</option>
                            @else
                                <option value="{!! $s->state_id !!}">{!! $s->state_title !!}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <br>
                    <b>Property Gallery</b><br>
                    <br>
                    <!-- Dropzone -->
                    <form action="{{ url('/newgallery') }}" id="frmFileUpload" method="post" class="dropzone" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="model" value="{!! $model->m_id !!}">
                        <div class="row">
                            <div class="dz-message">
                                <h3><i class="fa icon-picture"></i>New Photos for your property</h3>
                            </div>
                            <div class="fallback">
                                <input name="file" type="file"/>
                                <input type="hidden" name="user_id" value="{{ Auth::id() }}"/>
                            </div>
                        </div>
                    </form>
                    <br>
                    <button class="tranquilo-btn btn-block" onclick="updateProperty('{{ url('/updateproperty') }}')">Save</button>
                </div>
            </div>

        </div>
    </div>
    <br><br><br>

    <!-- Modal -->
    <div id="error-modal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-body">
            <p id="error-message"></p><br>
            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>

    @include('layouts.tranquilo-core-scripts')

    <script src="myasset/dropzone/dropzone.js"></script>
    <script src="myasset/summernote/summernote.js"></script>
    <script>
        $(document).ready(function(){
            // to do when tranquilo page load
            if($('#html_d:checked').length > 0){

                $("#description").hide();
                $('#summernote').summernote({
                    height: 200
                });
                $('#summerarea').slideDown(200);

            }

            if($('#html_d:checked').length == 0){

                $('#summerarea').hide();
                $("#description").slideDown(200);

            }
        });

        function goToAddProperty(url){
            window.location.replace(url);
        }

        function inputChange(){

            if($('#html_d:checked').length > 0){

                $("#description").hide();
                $('#summernote').summernote({
                    height: 200
                });
                $('#summerarea').slideDown(200);

            }

            if($('#html_d:checked').length == 0){

                $('#summerarea').hide();
                $("#description").slideDown(200);

            }
        }

        function checkOutDeal(url){

            var title = $('#title').val();
            var description = $('#description').val();
            var description_html = $('#summernote').summernote('code');
            var year = $('#year').val();
            var m_type = $('#m_type :selected').val();
            var m_price = $('#m_price').val();
            var address = $('#address').val();
            var token = '{!! Session::token() !!}';
            var err_msg = '';
            var m_id = '{!! $model->m_id !!}';
            var state = $('#state :selected').val();

            if(title == '' || title == null)
            {
                err_msg = 'Property name not given';
                $('#error-modal').modal('toggle');
                $('#error-message').html(err_msg);
            }
            else if(year == '' || year == '0')
            {
                err_msg = 'your property age is not given';
                $('#error-modal').modal('toggle');
                $('#error-message').html(err_msg);
            }
            else if(m_type == 0)
            {
                err_msg = 'Property type is not given';
                $('#error-modal').modal('toggle');
                $('#error-message').html(err_msg);
            }
            else if(m_price == '' || m_price == 0)
            {
                err_msg = 'Your property value price is not given';
                $('#error-modal').modal('toggle');
                $('#error-message').html(err_msg);
            }
            else if(address == '' || address == null)
            {
                err_msg = 'Your property location is not given';
                $('#error-modal').modal('toggle');
                $('#error-message').html(err_msg);
            }
            else
            {
                $.post(
                    url,
                    {
                        title:title,
                        description:description,
                        description_html:description_html,
                        year:year,
                        m_type:m_type,
                        m_price:m_price,
                        address:address,
                        token:token,
                        m_id:m_id,
                        state:state
                    },
                    function(data){
                        // alert('SUCCESS!');
                        var home = '{!! url('/viewmodel?m='.$model->m_id) !!}';

                        window.location.replace(home);
                });

            }
        }
    </script>
</body>
</html>