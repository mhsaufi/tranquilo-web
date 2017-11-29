<?php $a = 1; ?>
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

    @include('layouts.tranquilo-profile-header')
    <br>

    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 col-centered">
            <h2><i class="fa icon-user"></i>Profile</h2>
            <hr>
            <input type="hidden" id="update_url" value="{!! url('/updateprofile') !!}"/>
            <div class="profile-card">
                <div class="row">
                    <div class="col-lg-2 col-md-5 col-sm-12 col-xs-12">
                        @if(Auth::user()->img)
                            <div class="circular--landscape center" style="background-image: url('{{ url('/avatar/'.Auth::user()->id.'/'.Auth::user()->img) }}');background-size: cover;background-position: center;">
                            </div>
                        @else
                            <div class="circular--landscape" style="background-image: url({!! asset('myasset/images/piyad.jpg') !!});background-size: cover;background-position: center;"></div>
                        @endif
                        <br>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <p><span class="profile-email" id="profile-email">{!! Auth::user()->email !!}</span></p><br>
                        <p><span class="profile-name" id="profile-name">{!! Auth::user()->name !!}</span></p><br>
                        <button class="btn btn-success"><i class="fa icon-check"></i>{{ $users->user_status_title }}</button>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <b>Address</b><br>
                        @if(Auth::user()->address == null)
                            <textarea name="address" class="form-control" placeholder="you haven't given your address" id="address"></textarea>
                        @else
                            <span id="old_address">{{ $users->address }}</span>
                            <textarea name="address" class="form-control" id="editaddress">{{ $users->address }}</textarea>
                        @endif
                        <hr>
                        <b>State</b><br>
                        @if(Auth::user()->state == null)
                            <select name="state" class="form-control" id="state">
                                @foreach($state as $st)
                                    <option value="{!! $st->state_id !!}">{!! $st->state_title !!}</option>
                                @endforeach                                                        
                            </select>
                        @else
                            <span id="old_state">{{ $users->state_title }}</span>
                            <select name="edit_state" class="form-control" id="edit_state">
                                @foreach($state as $st)
                                    <option value="{!! $st->state_id !!}">{!! $st->state_title !!}</option>
                                @endforeach                                                        
                            </select>
                        @endif
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="padding-left: 50px;">
                        
                        <span><a href="{{ url('/profilepicture') }}"><i class="fa icon-photo"></i>Change profile picture</a></span><br><br>
                        <span><a href="{{ url('/passwordchange') }}"><i class="fa icon-refresh"></i>Change password</a></span><br><br>
                        @if(Auth::user()->role == 3)
                            <span><a href="{{ url('/applylandlord') }}"><i class="fa icon-home"></i>Become a landlord</a><br></span><br>
                        @endif
                        <span><a href="{{ url('/deactivate') }}"><i class="fa icon-ban"></i>Deactivate Account</a><br></span><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
                        <button class="btn btn-primary" id="update-btn">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div id="confirmation_dialog" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-body">
                    <h5>Ypur profile info saved <i class="fa icon-check"></i></h5>
                    <br><br>
              </div>
            </div>
        </div>
    </div>



    <div class="tranquilo-push-bottom">
        @include('layouts.tranquilo-footer')
    </div>


    @include('layouts.tranquilo-core-scripts')
    
    <script src="myasset/js/tranquilo-profile.js"></script>
    <script>
        $(document).ready(function(){
            $('#update-btn').hide();
            $('#confirmation_dialog').hide();
            $('#editaddress').hide();
            $('#edit_state').hide();
        });

        $('#address').blur(function(){

            var ad = $(this).val();
            var st = $('#state').find(":selected").val();

            if(ad != '' && st != ''){

                $('#update-btn').show();

            }

            if(ad == ''){
                $('#update-btn').hide();
            }

        });

        $('#update-btn').click(function(){

            var ad = $('#address').val();
            var st = $('#state').find(":selected").val();
            var url = '{{ url('/updateprofile') }}';
            var col = 'address';

            if(ad != '' && st != ''){

                $.post(url,{address:ad,state:st,col:col},function(){

                    $('#confirmation_dialog').modal('toggle');

                    window.setTimeout(function () { $('#confirmation_dialog').hide(); }, 3000); // hide after 5s

                    location.reload();

                });

            }

        });

        $('#old_address').click(function(){

            $('#editaddress').show();
            $('#old_address').hide();

        });

        $('#old_state').click(function(){

            $('#edit_state').show();
            $('#old_state').hide();

        });

        $('#editaddress').blur(function(){

            var old_address = $('#old_address').text();
            var new_address = $(this).val();
            
            var col = 'single_ad';

            if(new_address != '' && old_address != new_address){

                var url = '{{ url('/updateprofile') }}';

                $.post(url,{address:new_address,col:col},function(){

                    $('#confirmation_dialog').modal('toggle');

                    window.setTimeout(function () { $('#confirmation_dialog').hide(); }, 5000); // hide after 5s

                    location.reload();

                });

            }

            if(old_address == new_address){

                $(this).hide();
                $('#old_address').show();
            }

            if(new_address == ''){

                $('#edit_address').hide();
                $('#old_address').show();
            }

        });

        $('#edit_state').blur(function(){

            var old_state = $('#old_state').text();
            var new_state_text = $(this).find(":selected").text();
            var new_state = $(this).find(":selected").val();
            var col = 'single_st';

            if(old_state == new_state_text){

                $('#edit_state').hide();
                $('#old_state').show();
            }

            if(old_state != new_state_text){

                var update_state = '{{ url('/updateprofile') }}';

                $.post(update_state,{state:new_state,col:col},function(){

                    $('#confirmation_dialog').modal('toggle');

                    window.setTimeout(function () { $('#confirmation_dialog').hide(); }, 1000); // hide after 5s

                    location.reload();

                })
            }
    });


    </script>

</body>
</html>