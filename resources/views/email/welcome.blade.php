<!DOCTYPE html>
<html>
<head>
    <title>Welcome Atharamediya.lk</title>
</head>

<a>
<h2>Welcome to the Atharamediya.lk {{$user['name']}}</h2>
<br/>
Your registered email-id is <a href="{{url('/confirm_email')}}/{{$user['email']}}/{{$user['confirmation_code']}}" >{{$user['email']}}</a>
</body>

</html>