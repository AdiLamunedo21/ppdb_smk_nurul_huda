<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.frontsite.meta')
    <title>@yield('title') | PPDB SMK Nurul-Huda </title>
</head>
<body>
    @include('component.frontsite.header')

        @yield('content')

    @include('component.frontsite.footer')

</body>
</html>

