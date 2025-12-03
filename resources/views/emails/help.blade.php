<!DOCTYPE html>
<html>
<head>
    <title>Need Help?</title>
</head>
<body>
    <h2>Hello, {{ $user->name }}!</h2>
    <p>We noticed you’ve been browsing our website for a while. Do you need any assistance?</p>
    <p><a href="{{ url('/contact') }}">Click here to contact us</a></p>
</body>
</html>
