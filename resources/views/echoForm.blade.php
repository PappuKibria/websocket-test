<!DOCTYPE html>
<html>
<head>
    <meta name="_token" content="{{ csrf_token() }}">
    <title>Laravel WebSocket Demo</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/laravel-echo-setup.js') }}" defer></script>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-md-center">
        <div class="col-md-6">
            <form id="message-form" method="post">
                @csrf
                <div class="form-group">
                    <label for="message">Message:</label>
                    <input type="text" class="form-control" id="message" name="message" required>
                </div>
                <button type="submit" class="btn btn-primary">Send</button>
            </form>
        </div>
    </div>
</div>
<script>
    $(function () {
        var messageForm = $('#message-form');
        var messageInput = $('#message');

        messageForm.on('submit', function (event) {
            event.preventDefault();

            var message = messageInput.val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                }
            });
            $.post('/send-message', { message: message }, function (response) {
                // messageInput.val('');

                var alertMessage = 'You sent: ' + message;
                alert(alertMessage);
            });
        });
    });
</script>
<script>
    window.laravel_echo_port='{{env("LARAVEL_ECHO_PORT")}}';
</script>
<script src="//{{ Request::getHost() }}:{{env('LARAVEL_ECHO_PORT')}}/socket.io/socket.io.js"></script>
<script src="{{ url('/js/laravel-echo-setup.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    var i = 0;
    var message = messageInput.val();
    window.Echo.channel('user-channel')
        .listen('.UserEvent', (data) => {
            i++;
            $("#notification").append('<div class="alert alert-success">'+i+'.'+message+'</div>');
        });
</script>
</body>
</html>
