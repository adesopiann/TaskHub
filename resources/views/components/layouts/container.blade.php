<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> TaskHub by Ade Sopian</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/feather-icons"></script>
</head>

<body>

    <!-- Navbar -->
    @include('components.navbar')

    <!-- Section Main -->
    <main>
        @yield('main')
    </main>
    @yield('script')
</body>

</html>
