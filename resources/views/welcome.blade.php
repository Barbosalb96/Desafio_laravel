<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <scriptsrc
    ="https://code.jquery.com/jquery-3.6.0.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="pb-3">
<nav class="navbar navbar-expand-md navbar-light bg-warning shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            Desafio Laravel
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Desafio Laravel">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                @if (Route::has('login'))
                    <div class="top-right links">
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/admin') }}"><i
                                        class="fas fa-user mr-1"></i>Profile</a>
                            </li>
                        @else
                            <div class="row">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                                    </li>
                                @endif
                            </div>
                        @endauth
                    </div>
                @endif
            </ul>
        </div>

    </div>
</nav>
<div class="container mt-2">
    <div class="jumbotron">
        <h2 class="">Desafio ....</h2>
        <p class="lead">Aqui você pode tirar duvidas e receber dicas sobre Veiculos</p>
    </div>

    <h3 class="">Tire suas duvidas aqui !!</h3>
    <hr class="h-50">
    <div class="row">
        <div class="card col-md-12">
            <div class="pt-4">
                <div>
                    <form action="{{route('filterDicas')}}" method="post" class="">
                        @csrf
                        <div class="col-md-4">
                            <label for="">Buscar</label>
                            <div class="d-flex">
                                <input type="text" class="form-control" name="search" placeholder="Ex: Gol">
                                <button type="submit" class="btn sm-btn btn-warning ml-3 d-flex align-items-center"><i
                                        class="fas fa-search mr-2"></i>Buscar
                                </button>
                            </div>
                        </div>
                    </form>
                    <a href="{{route('welcome')}}" class="nav-link text-dark">Limpar Tudo</a>
                </div>
                <hr class="h-50">
            </div>
            <div class="row">
                <div class="pl-1 container_card">
                    @if(count($dicas) == 0)
                        <h2>Nenhum registro encontrado</h2>
                    @else
                        @foreach($dicas as $dados)
                            <div class="card col-md-11 mb-2" id="card-custom">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div><strong>Modelo</strong> : {{$dados->modelo}}</div>
                                        <div class="ml-2"><strong>Marca</strong> : {{$dados->marca}}</div>
                                    </div>
                                    <div class="d-flex">
                                        <div><strong>Ano</strong> : {{date("Y",strtotime($dados->ano))}}</div>
                                        <div class="ml-2"><strong>Versão</strong> : {{$dados->versao }}</div>
                                    </div>
                                    <div class="d-flex">
                                        <div><strong>Categoria</strong> : {{$dados->categoria}}</div>
                                    </div>
                                    <div class="">
                                        <div><strong>Dica</strong> : {{$dados->descricao}}
                                        </div>
                                    </div>
                                </div>
                                <div class="container mb-2">
                                    <div class="footer d-flex align-items-center justify-content-between">
                                        <div class="d-flex">
                                            <strong>Autor: </strong> {{ ucwords($dados->name)}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="pl-2">
                @if(isset($filterAll))
                    {{$dicas->appends($filterAll)->render()}}
                @else
                    {{$dicas->render()}}
                @endif
            </div>
        </div>
    </div>
</div>
</body>
<script src="https://kit.fontawesome.com/051cf22837.js" crossorigin="anonymous"></script>
</html>
