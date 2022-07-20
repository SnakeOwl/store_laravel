<!DOCTYPE html>
<!--
    icons: https://akveo.github.io/eva-icons/
-->
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @include('layouts.include.head')

    <title>@yield('title')</title>

</head>
<body>
    @include('layouts.include.header')
    @include('layouts.include.messages')
    @include('layouts.include.errors')



    <div class="container-fluid p-0">

            @yield('content')

    </div>

    @include('layouts.include.footer')
</body>
</html>
