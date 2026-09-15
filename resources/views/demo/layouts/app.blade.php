<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    <style>
        .navbar {
            background: lightgray;
            padding: 15px;
        }
    </style>
</head>

<body>

    <x-demo::navbar class="navbar"></x-demo::navbar>
    <!-- <x-demo::navbar></x-demo::navbar> -->

    @include('demo.partials.header', ['nama' => 'Fulan'])
    <!-- @include('demo.partials.header') -->

    <main>
        @yield('content')
    </main>

</body>
</html>