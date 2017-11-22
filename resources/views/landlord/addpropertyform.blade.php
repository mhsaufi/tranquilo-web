<?php

$keygen = generateKey(20);

function generateKey($length) 
{
    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    
    return substr(str_shuffle($chars),0,$length);
}

?>

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
                <a href="#" class="active">Property</a>
                <a href="#">Rental</a>
                <a href="#">Favourite</a>
                <a href="#">History</a>
            </div>
        </div>
    </header>

    <br>
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 col-centered">
            <b><a href="{{ url('/home') }}">Property</a></b> > Add property
            <br><br>
            <h4>New Property</h4>
            <hr>
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-12" style="">
                    <label for="title">Property Name</label>
                    <input type="text" name="title" class="form-control" id="title" /><br>
                    <label for="description">Property Remark </label> &nbsp&nbsp&nbsp&nbsp
                    <input type="checkbox" name="html_d" id="html_d" onclick="inputChange()"><em><small> Interactive Description</small></em><br>
                    <textarea name="description" rows="8" class="form-control" id="description"></textarea>
                    <div id="summerarea"><div id="summernote"></div></div>
                    <br>
                    <label for="year">Property Age</label>
                    <input type="number" name="year" id="year" class="form-control">
                </div>

                <div class="col-lg-1- col-md-1 col-sm-12">
                    
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <label for="m_type">Type</label>
                    <select name="m_type" class="form-control" id="m_type">
                        <option value="0" selected="selected">not selected</option>
                        @foreach($h_type as $h)
                            <option value="{!! $h->h_type_id !!}">{!! $h->h_type_title !!}</option>
                        @endforeach
                    </select>
                    <br>
                    <label for="m_price">Property Value</label>
                    <input type="number" name="price" class="form-control" id="m_price" />
                    <br>

                    <label for="b_type">For</label><br>
                    <select name="b_type" class="form-control" id="b_type">
                        <option value="0" selected="selected">not selected</option>
                        @foreach($b_type as $b)
                            <option value={!! $b->b_type_id !!}>{!! $b->b_type_title !!}</option>
                        @endforeach
                    </select>

                    <br>
                    <label for="deal">Deal Price</label>
                    <input type="number" name="deal" class="form-control" id="deal" required/>
                    <br>
                    <label for="address">Property Location/ Address</label><br>
                    <textarea name="address" rows="3" class="form-control" id="address"></textarea>
                    <br>
                    <label for="state">State</label><br>
                    <select name="state" class="form-control" id="state">
                        <option value="0" selected="selected">not selected</option>
                        @foreach($state as $s)
                            <option value={!! $s->state_id !!}>{!! $s->state_title !!}</option>
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
                    <form action="upload_gallery" id="frmFileUpload" onsubmit="hideButton()" method="post" class="dropzone" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="model_key" id="img_key" value="{!! $keygen !!}">
                        <div class="row">
                            <div class="dz-message">
                                <h3><i class="fa icon-picture"></i>Photos for your property</h3>
                            </div>
                            <div class="fallback">
                                <input name="file" type="file"/>
                                <input type="hidden" name="user_id" value="{{ Auth::id() }}"/>
                            </div>
                        </div>
                    </form>
                    <br>
                    <button class="tranquilo-btn btn-block" onclick="checkOutDeal('{{ url('/checkout') }}')">Save</button>
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

    <script src="myasset/js/jquery.js"></script>
    <script src="myasset/js/bootstrap.min.js"></script>
    <script src="myasset/dropzone/dropzone.js"></script>
    <script src="myasset/js/jquery.prettyPhoto.js"></script>
    <script src="myasset/summernote/summernote.js"></script>
    <script src="myasset/js/main.js"></script>
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
            var b_type = $('#b_type :selected').val();
            var deal = $('#deal').val();
            var address = $('#address').val();
            var token = '{!! csrf_field() !!}';
            var err_msg = '';
            var keygen = '{!! $keygen !!}';
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
            else if(b_type == '' || b_type == 0)
            {
                err_msg = 'Your property value price is not given';
                $('#error-modal').modal('toggle');
                $('#error-message').html(err_msg);
            }
            else if(deal == '' || deal == 0)
            {
                err_msg = 'Value for your deal is not given';
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
                        b_type:b_type,
                        deal:deal,
                        address:address,
                        token:token,
                        keygen:keygen,
                        state:state
                    },
                    function(data){
                        // alert('SUCCESS!');
                        var home = '{!! url('/home') !!}';

                        window.location.replace(home);
                });

            }
        }
    </script>
</body>
</html>