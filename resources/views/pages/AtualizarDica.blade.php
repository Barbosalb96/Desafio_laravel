@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h4 class="">Bem Vindo : {{ucwords(Auth::user()->name) }}</h4>
            <p class="lead">Ops !! tem Alguma novidade ou dica nova para dividir com a gente!!</p>
            <p class="lead">Basta selecionar a opção que deseja atualizar !!</p>
        </div>

        @if($errors->any())
            @foreach($errors->all() as $error)
                <p class="alert alert-warning">{{ $error}}</p>
            @endforeach
        @endif

        @if(Session::has('sucess'))
            <p class="alert alert-success">{{ Session::get('sucess') }}</p>
        @endif

        @if(Session::has('error'))
            <p class="alert alert-warning">{{ Session::get('error') }}</p>
        @endif
        <div class="">
            <h3 class="">Tem alguma dica ?</h3>
            <hr class="h-50">
            <div class="row">

                <div class="card col-md-12">
                    <div class="pt-2">
                        <h3>Atualizar cadastro</h3>
                        <hr>
                    </div>
                    <form action="{{route('update',$veiculos->id_veiculo)}}" method="post">
                        @csrf
                        @method("PUT")
                        <input type="hidden" name="id" value="{{$veiculos->id_veiculo}}">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Digite o modelo</label>
                                <input type="text" required class="form-control" aria-invalid="modelo"
                                       value="{{$veiculos->modelo}}" name="modelo" list="modelo"
                                       placeholder="EX:MERCEDES-BENZ">
                                <datalist id="modelo">
                                    <option value="{{$veiculos->modelo}}"
                                            class="form-control">{{$veiculos->modelo}}</option>
                                </datalist>
                            </div>

                            <div class="col-md-6">
                                <label for="">Digite a Marca</label>
                                <input type="text" required class="form-control" name="marca" id="" list="marca"
                                       placeholder="EX:MERCEDES-BENZ C 180" value="{{$veiculos->marca}}">
                                <datalist id="marca">
                                    <option value="{{$veiculos->marca}}"
                                            class="form-control">{{$veiculos->marca}}</option>

                                </datalist>
                            </div>

                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="">Ano Fabricação</label>
                                <input type="date" required class="form-control" value="{{$veiculos->ano}}" name="ano"
                                       placeholder="EX:MERCEDES-BENZ C 180">
                            </div>
                            <div class="col-md-6">
                                <label for="">Varsão</label>
                                <input type="text" class="form-control" value="{{$veiculos->versao}}" name="versao"
                                       placeholder="EX: C 180">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="">Tipo de Veiculo</label>
                                <select class="form-control"  name="id_tipo_veiculo" id="id_tipo_veiculo">
                                    @if($veiculos->id_categoria != null)
                                        <option value="{{$veiculos->id_categoria}}">{{$veiculos->categoria}}</option>
                                    @endif
                                    @foreach($tipos as $tipo)
                                        <option value="{{$tipo->id}}">{{$tipo->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2 mb-2">
                            <div class="col-md-12">
                                <label for="">Digite sua dica</label>
                                <textarea required name="descricao" style="resize: none" class="form-control" id=""
                                          cols="50"
                                          rows="5">{{$veiculos->descricao}}</textarea>
                            </div>
                        </div>
                        <button class="btn btn-primary mr-2 mb-4" type="submit">
                            Atualizar
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
