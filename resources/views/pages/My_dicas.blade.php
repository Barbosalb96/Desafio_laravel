@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h4 class="">Bem Vindo : {{ucwords(Auth::user()->name) }}</h4>
            <p class="lead">Aqui você pode ver suas dicas</p>
        </div>
        @if(Session::has('sucess'))
            <p class="alert alert-success">{{ Session::get('sucess') }}</p>
        @endif

        <div class="">
            <h3 class="">Suas Dicas !!</h3>
            <hr class="h-50">
            <div class="row">
                <div class="card col-md-12">
                    <div class="pt-4">
                        <div>
                                <form action="{{route('filterDicas',Auth::user()->id)}}" method="post" class="">
                                @csrf
                                <div class="col-md-4">
                                    <label for="">Buscar</label>
                                    <div class="d-flex">
                                        <input type="text" class="form-control" name="search" placeholder="Ex: Gol">
                                        <button type="submit"
                                                class="btn sm-btn btn-warning ml-3 d-flex align-items-center"><i
                                                class="fas fa-search mr-2"></i>Buscar
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <hr class="h-50">
                    </div>
                    <div class="row">
                        <div class=" p-4  container_card">
                            @if(count($dicas) == 0)
                                <h2>Nenhum registro encontrado</h2>
                            @else
                                @foreach($dicas as $dados)
                                    <div class="card col-md-11" id="card-custom">
                                        <div class="card-body">
                                            <div class="d-flex">
                                                <div><strong>Modelo</strong> : {{$dados->modelo}}</div>
                                                <div class="ml-2"><strong>Marca</strong> : {{$dados->marca}}</div>
                                            </div>
                                            <div class="d-flex">
                                                <div><strong>Ano</strong> :{{date("Y",strtotime($dados->ano))}}</div>
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
                                                    <strong>Autor: </strong> {{ ucwords(Auth::user()->name)}}
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <form action="{{route('delete',$dados->id_veiculo)}}" method="post">
                                                        @csrf
                                                        @method("DELETE")
                                                        <input type="hidden" value="{{$dados->id_veiculo}}">
                                                        <button class="btn btn-danger mr-2" type="submit"><i
                                                                class="fas fa-trash text-light"></i>
                                                        </button>
                                                    </form>
                                                    <a href="{{route('edit',$dados->id_veiculo)}}" class="btn btn-info"><i
                                                            class="fas fa-edit text-light"></i>
                                                    </a>
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
@endsection
