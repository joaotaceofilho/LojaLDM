<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    

    
    @vite(['resources/css/style.css','resources/css/welcome.css','resources/css/app.css', 'resources/css/header.css', 'resources/css/footer.css', 'resources/css/contact.css', 'resources/js/app.js'])

</head>
<body>
    
        @include('partials.header')

    @yield('content')

    
    
    @include('partials.footer')
</body>
</html>
