<?php $a = 2; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tranquilo | Inbox</title>
    @include('layouts.tranquilo-core-sheets')


</head><!--/head-->
<body>

    @include('layouts.tranquilo-header')

    @include('layouts.tranquilo-profile-header')
    <br>

    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 col-centered">
            <h2><i class="fa icon-envelope"></i>Inbox</h2>
            <hr>
            @if($message_count != 0)

                <p>{{ $unread_count }} unread message</p>

                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>From</th>
                            <th>Subject</th>
                        </tr>
                    </thead>
                    <tbody style="background-color: white;">
                        <?php $i = 1; ?>
                        @foreach($messages as $msg)
                        <tr class="tranquilo-datatable-list <?php if($msg->message_status == 1){ echo 'unread';} ?>" onclick="readMail('{{ $msg->message_id }}','{{ url('/readmail') }}')">
                            <td>{!! $msg->message_id !!}</td>
                            <td>{{ $msg->name }}</td>
                            <td>{{ $msg->message_subject }}</td>
                        </tr>
                        <?php $i++; ?>
                        @endforeach
                    </tbody>
                </table>
                {{ $messages->links() }}

                <?php $c = $messages->count(); ?>
            @else

                <?php $c = 0; ?>

                <p>No message in your inbox</p>

            @endif
        </div>
    </div>
    <br><br><br>

    @if($c > 6)
        @include('layouts.tranquilo-footer')
    @else
        <div class="tranquilo-push-bottom">
            @include('layouts.tranquilo-footer')
        </div>
    @endif


    @include('layouts.tranquilo-core-scripts')

    <script src="myasset/js/tranquilo-profile.js"></script>
    <script>
        function readMail(msg_id,url){
            var mail_url = url + '?message=' + msg_id;

            window.location.replace(mail_url);

        }
    </script>

</body>
</html>