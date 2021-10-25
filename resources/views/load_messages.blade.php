<html>

<head>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <meta http-equiv="refresh" content="2.5">
</head>

<body>

    <div class="message_area">
        @foreach($all_messages as $messages)
        <b>{{$messages->author}}: </b>{{$messages->message}}<br>
        <i style="color:grey; font-size:8pt;">~{{$messages->created_at}}</i>
        <hr><br>
        @endforeach
    </div>
    
</body>

</html>
