<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.header.head')
</head>

<body>
    <header>
        @include('layouts.navs.index')
    </header>

    <main class="py-4">
        @yield('content')
    </main>

    <footer>
        @include('layouts.footer.footer')
    </footer>
</body>

</html>
