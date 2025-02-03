<!DOCTYPE html>
<html>
<head>
    <title>Maintenance mode ->{{ env('APP_NAME') }}</title>
    <style>
        body { text-align: center; padding: 5%; }
        h1 { font-size: 50px; }
        body { font: 20px Helvetica, sans-serif; color: #333; }
        article { display: block; text-align: left; width: 70%; margin: 0 auto; }
        a { color: #dc8100; text-decoration: none; }
        a:hover { color: #333; text-decoration: none; }
        img{
            width: 25%;
            height: 20%;
        }
    </style>
</head>
<body>
    <img src="{{ asset('error/maintenance.png') }}">
    <article>

        <h1>We&rsquo;ll be back soon!</h1>
        <div>
            <p>Sorry for the inconvenience but we&rsquo;re performing some maintenance at the moment. If you need to you can always <a href="mailto:karim.cse007@gmail.com">contact us</a>, otherwise we&rsquo;ll be back online shortly!</p>
            <p>&mdash; {{ env('APP_NAME') }}</p>
        </div>
    </article>
</body>
</html>

