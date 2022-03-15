<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Hotel Chino Pokhara</title>
    <link href="{{ asset('css/frontend/1.style.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/frontend/style.css') }}" rel="stylesheet" />
</head>

<body>
    <!-- Navbar -->
    @include('layouts.frontend.partials.navbar')
    <!-- /.navbar -->
    <main>
        @yield('content')
    </main>
    <!-- Footer -->
    @include('layouts.frontend.partials.footer')
    <!-- /.footer -->
    @include('layouts.frontend.partials.script')
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

</html>