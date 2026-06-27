<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <script>
        (function () {
            var theme = localStorage.getItem('sb-theme') || 'light';
            document.documentElement.setAttribute('data-theme', theme);
            document.documentElement.setAttribute('data-bs-theme', theme);
        })();
    </script>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>{{ config('app.name', 'sablonku') }}</title>
    <meta name="theme-color" content="#6366f1">
    @stack('before-styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    @stack('after-styles')
</head>

<body @hasSection('body-class') class="@yield('body-class')" @endif>

    <div class="theme-toggle-floating">
        @include('layouts.includes.theme-toggle')
    </div>

    <div class="min-vh-100 d-flex align-items-center justify-content-center @yield('wrapper-class', 'bg-light')">
        <div class="container">
            <div class="row justify-content-center">
                @yield('content')
            </div>
        </div>
    </div>
    @stack('before-scripts')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/coreui.bundle.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    @stack('after-scripts')
</body>

</html>
