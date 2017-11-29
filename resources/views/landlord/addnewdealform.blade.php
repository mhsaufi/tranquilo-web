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
    <title>Tranquilo | Deal</title>
    
    @include('layouts.tranquilo-core-sheets')

    <!-- Summernote Css -->
    <link href="myasset/summernote/summernote.css" rel="stylesheet" />
</head><!--/head-->
<body>
    
    @include('layouts.tranquilo-header')

    <header class="mini-header-landlord">
        <div class="row">
            <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
                
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 text-left">
                <a href="{!! url('/feed') !!}" class="active">Feed</a>
                <a href="{!! url('/home') !!}">Property</a>
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
            <b><a href="{{ url('/dealboard') }}">My Deal</a></b> > Add New Deal
            <br><br>
            <hr>
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-12" style="">
                    <label for="description">Deal Description </label> &nbsp&nbsp&nbsp&nbsp
                    <input type="checkbox" name="html_d" id="html_d" onclick="inputChange()"><em><small> Interactive Description</small></em><br>
                    <textarea name="description" rows="8" class="form-control" id="description"></textarea>
                    <div id="summerarea"><div id="summernote"></div></div>
                    <br>
                </div>

                <div class="col-lg-1- col-md-1 col-sm-12">
                    
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
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
                    <label for="title">Contact No</label> 
                    @if(Auth::user()->phone_no != '')
                    &nbsp&nbsp&nbsp&nbsp
                    <input type="checkbox" name="number_change" id="number_change" onclick="useMyNumber()">
                        <em><small> Just use my number</small></em>
                        <br>
                    @endif
                    <input type="text" name="contact" class="form-control" id="contact" /><br>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <label for="model">Your property to deal :</label>
                    <select name="h_type" class="form-control" id="model">
                        @foreach($model as $mod)
                            <option value="{{ $mod->m_id }}">
                                {{ $mod->m_title }} | {{ $mod->h_type_title }}
                            </option>
                        @endforeach
                    </select>
                    <br>
                    <br>
                    <button class="tranquilo-btn btn-block" onclick="postDeal('{{ url('/postdeal') }}')">Save</button>
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

            $('#contact').val('');
        });

        function goToAddProperty(url){
            window.location.replace(url);
        }

        function inputChange(){

            if($('#html_d:checked').length > 0){

                $("#description").hide();
                $("#description").val('');
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

        function useMyNumber(){

            if($('#number_change:checked').length > 0){

                $("#contact").val('{{ Auth::user()->phone_no }}');

            }

            if($('#number_change:checked').length == 0){

                $('#contact').val('');

            }
        }

        function postDeal(url){

            var description = $('#description').val();
            var description_html = $('#summernote').summernote('code');
            var b_type = $('#b_type :selected').val();
            var m_id = $('#model :selected').val();
            var deal = $('#deal').val();
            var contact = $('#contact').val();
            var token = '{!! csrf_field() !!}';
            var err_msg = '';

            if(deal == '' || deal == 0)
            {
                err_msg = 'Value for your deal is not given';
                $('#error-modal').modal('toggle');
                $('#error-message').html(err_msg);
            }
            else if(contact == '' || contact == 0 || contact.length < 9)
            {
                err_msg = 'Contact number given is invalid';
                $('#error-modal').modal('toggle');
                $('#error-message').html(err_msg);
            }
            else
            {
                $.post(
                    url,
                    {
                        description:description,
                        description_html:description_html,
                        model:m_id,
                        contact:contact,
                        b_type:b_type,
                        deal:deal,
                        _token:token
                    },
                    function(data){
                        // alert('SUCCESS!');
                        var dealboard = '{!! url('/dealboard') !!}';

                        window.location.replace(dealboard);
                });

            }
        }
    </script>
</body>
</html>