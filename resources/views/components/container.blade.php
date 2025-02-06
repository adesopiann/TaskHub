<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
     @vite('resources/css/app.css')
</head>
<body>

    @include('components.navbar')

    <main>
        @yield('main')
    </main>
</body>
</html>