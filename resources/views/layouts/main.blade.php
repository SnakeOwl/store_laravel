<!DOCTYPE html>
<!--
    icons: https://akveo.github.io/eva-icons/
-->
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/app.css">

    @include('layouts.include.head')

    <title>@yield('title')</title>

</head>
<body>
    @include('layouts.include.header')


    <div class="container mt-4">
        @yield('content')
    </div>

    @include('layouts.include.footer')
</body>
</html>
