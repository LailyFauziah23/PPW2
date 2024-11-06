<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel ="stylesheet" href="{{ asset ('lightbox2/dist/css/lightbox.min.css')}}">
</head>
<body>
    <header>
        <h1>Our Company</h1>
    </header>

    @include('partials.nav')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')
    <script src="{{ asset('lightbox2/dist/js/lightbox-plus-jquery.min.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>
