<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.css') }}">
    @yield('styles')
</head>

<body>
    <!-- Navbar included  -->

    @include('user.partials.navbar')

    <!-- Sweetalert included  -->

    @include('sweetalert::alert')


    <!-- Main content -->
    <main>
        <div class="my-5">
            @yield('content')
        </div>
    </main>

    <!-- JS Libraies -->

    <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    <script src="{{ asset('assets/modules/bootstrap/js/bootstrap5.bundle.min.js') }}"></script>
    @yield('scripts')
</body>

</html>
