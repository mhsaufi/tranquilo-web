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
                <a href="{!! url('/feed') !!}">Feed</a>
                <a href="{!! url('/home') !!}">Property</a>
                <a href="{!! url('/board') !!}">Applications</a>
                <a href="{!! url('/dealboard') !!}" class="active">Deals</a>
                <a href="{!! url('/profile') !!}"><i class="fa icon-user"></i>Profile</a>
                <a href="#">History</a>
            </div>
        </div>
    </header>

    <br>
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 col-centered">
            <b><a href="{{ url('/dealboard') }}">My Deal</a></b> > <b><a href="{{ url('/viewdeal?m='.$model->m_id) }}">{{ $model->m_title }}</a></b> > Edit Deal
            <br><br>
            <hr>
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-12" style="">
                    <label for="description">Deal Description </label> &nbsp&nbsp&nbsp&nbsp

                    @if($model->d_description == strip_tags($model->d_description))

                        <input type="checkbox" name="html_d" id="html_d" onclick="inputChange()"><em><small> Interactive Description</small></em><br>
                    @else
                        <input type="checkbox" name="html_d" id="html_d" onclick="inputChange()" checked><em><small> Interactive Description</small></em><br>
                    @endif


                        <textarea name="description" rows="8" class="form-control" id="description">{{ $model->d_description }}</textarea>
                        <div id="summerarea"><div id="summernote">{!! $model->d_description !!}</div></div>
                    <br>
                </div>

                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <label for="b_type">For</label><br>
                    <select name="b_type" class="form-control" id="b_type">
                        <option value="0" selected="selected">not selected</option>
                        @foreach($b_type as $b)
                            @if($model->d_b_type == $b->b_type_id)
                                <option value="{!! $b->b_type_id !!}" selected="selected">{!! $b->b_type_title !!}</option>
                            @else
                                <option value="{!! $b->b_type_id !!}">{!! $b->b_type_title !!}</option>
                            @endif
                        @endforeach
                    </select>

                    <br>
                    <label for="deal">Deal Price</label>
                    <input type="number" name="deal" class="form-control" id="deal" value="{{ $model->d_value }}" required/>
                    <br>
                    <label for="title">Contact No</label> 
                    @if(Auth::user()->phone_no != '')
                    &nbsp&nbsp&nbsp&nbsp
                    <input type="checkbox" name="number_change" id="number_change" onclick="useMyNumber()">
                        <em><small> Just use my number</small></em>
                        <br>
                    @endif
                    <input type="text" name="contact" class="form-control" id="contact" value="{{ $model->d_contact }}" /><br>
                </div>
            </div>
            <br>

            <input type="hidden" id="_token" value="{{ Session::token() }}" />
            <button class="tranquilo-btn btn-block" onclick="updateDeal('{{ url('/updatedeal') }}')">Update</button>
        </div>
    </div>
    <br>
    
    <br><br><br>


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

        function updateDeal(url){

            var description = $('#description').val();
            var description_html = $('#summernote').summernote('code');
            var b_type = $('#b_type :selected').val();
            var deal = $('#deal').val();
            var deal_id = '{{ $model->d_id }}';
            var contact = $('#contact').val();
            var token = $('#_token').val();
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
                        contact:contact,
                        deal_id:deal_id,
                        b_type:b_type,
                        deal:deal,
                        _token:token
                    },
                    function(data){
                        // alert('SUCCESS!');
                        var dealboard = '{{ url('/viewdeal?m='.$model->d_id) }}';

                        window.location.replace(dealboard);
                });

            }
        }
    </script>
</body>
</html>