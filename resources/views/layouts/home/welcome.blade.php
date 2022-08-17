<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @yield('title', 'Denumeris')
    </title>
    </title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    {{-- <link rel="icon" type="image/png" href="/favicon.png" /> --}}
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Google fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@0,600;1,600&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,300;0,500;0,600;0,700;1,300;1,500;1,600;1,700&amp;display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,400;1,400&amp;display=swap"
        rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />

</head>


<body>
    @include('layouts.home.navbar')
    <div id="app" class="p-5">
        @yield('content')
    </div>

    <!-- Footer-->
    <footer class="bg-black footer text-center py-5">
        <div class="container px-5">
            <div class="text-white-50 small">

                <span>Desarrollado por:</span>
                <span class="mx-1">&middot;</span>
                <a href="https://kratoxx.com">Kratoxx</a>

            </div>
        </div>
    </footer>

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> --}}



    @stack('scripts')
    <script src="{{mix('js/app.js')}}"></script>

</body>
<style>
    .logo-img {
        height: 40vh;
        margin: 100px;
        padding-bottom: 100px !important;
    }

    html,
    body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    #map {
        height: 100%;
    }
</style>

</html>
