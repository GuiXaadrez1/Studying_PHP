<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!--
        {{asset()}} -> estamos usando basicamente uma funcao que acessa arquivos
        estáticos de forma padrao na pasta public do projeto
    -->
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}" />
    @yield('header')
</head>

<body class="bg-light">

    <div class="container py-4 container-limit">
        @include('partials.header')

        <div class="body-content">
            @yield('body')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('footer')
</body>

</html>