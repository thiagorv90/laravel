<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <link rel="icon" type="image/x-icon" href="/image/fibra_favicon.svg">

    <!-- Fonte do Google -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">

    <!-- Load icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- CSS da aplicação -->
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <script src="/js/scripts.js"></script>
    <script src="/public/js/scripts.js"></script>
</head>

<body>
<header class="cabecalho">
    <nav class="navbar navbar-light bg-light fixed-top"
         style="background-image: linear-gradient(160deg, #743190 0%, #B67FB9 100%);">
        <div class="container-fluid">
            <a class="navbar-brand" href="/inicial">
                <img src="/image/fibra1.png" alt="Fibra">
            </a>

            <h1 class="text-white">SGR - Sistema de Gestão de Representações</h1>

            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                    aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                 aria-labelledby="offcanvasNavbarLabel">

                <div class="offcanvas-header">
                    <a class="navbar-brand" href="/inicial">
                        <img src="/image/fibra.png" alt="Fibra">
                    </a>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                </div>

                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        @if(auth()->user()->statusadm ==1)
                            <li class="nav-item"><a class="nav-link" href="/agendas">Agenda</a></li>
                            <li class="nav-item"><a class="nav-link" href="/register">Cadastrar</a></li>
                            <li class="nav-item"><a class="nav-link" href="/contatos">Contatos</a></li>
                            <li class="nav-item"><a class="nav-link" href="/empresas">Empresas</a></li>
                            <li class="nav-item"><a class="nav-link" href="/escolaridade">Escolaridade</a></li>
                            <li class="nav-item"><a class="nav-link" href="/instancias">Instancias</a></li>
                            <li class="nav-item"><a class="nav-link" href="/instituicoes">Instituicoes</a></li>
                            <li class="nav-item"><a class="nav-link" href="/representacoes">Representacoes</a></li>
                            <li class="nav-item"><a class="nav-link" href="/repsup">Representantes</a></li>
                            <li class="nav-item"><a class="nav-link" href="/telcon">Telefone dos Contatos</a></li>
                            <li class="nav-item"><a class="nav-link" href="/temarep">Tema Representação</a></li>
                            <li class="nav-item"><a class="nav-link" href="/telrepsup">Telefone Representante</a></li>
                            <li class="nav-item"><a class="nav-link" href="/tipoinsta">Tipo de Instancias</a></li>
                        @endif
                    </ul>

                    <div class="container-fluid funcionalidades">
                        <x-jet-responsive-nav-link class="btn btn-info" href="{{ route('profile.show') }}"
                                                   :active="request()->routeIs('profile.show')">
                            {{ __('Perfil') }}
                        </x-jet-responsive-nav-link>

                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button class="btn btn-danger" type="submit">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

<div class="container">

    @yield('content')

</div>

<footer class="rodape">
    <p>Sistema Fibra &copy; 2022</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"
        integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"
        integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous">
</script>
<script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
</body>


</html>
