@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h4 class="">Bem Vindo : {{ucwords(Auth::user()->name) }}</h4>
            <p class="lead">Aqui você pode publicar dicas de veiculos</p>
        </div>

        @if($errors->any())
            <div class="alert-warning">
                @foreach($errors->all() as $error)
                    <p class="p-1">{{ $error}}</p>
                @endforeach
            </div>
        @endif


        @if(Session::has('sucess'))
            <p class="alert alert-success">{{ Session::get('sucess') }}</p>
        @endif

        <div class="">
            <h3 class="">Tem alguma dica ?</h3>
            <hr class="h-50">
            <div class="row">
                <div class="card col-md-12">
                    <div class="pt-4">
                        <h4>Cadastrar Aqui !!</h4>
                        <hr class="h-50">
                    </div>
                    <form action="{{route('store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Digite o modelo</label>
                                <input type="text" required class="form-control" aria-invalid="modelo"
                                       value="{{old('modelo')}}" name="modelo" list="modelo"
                                       placeholder="EX:MERCEDES-BENZ">
                                <datalist id="modelo">
                                    @foreach($veiculos as $veiculo)
                                        <option value="{{$veiculo->modelo}}"
                                                class="form-control">{{$veiculo->modelo}}</option>
                                    @endforeach
                                </datalist>
                            </div>
                            <div class="col-md-6">
                                <label for="">Digite a Marca</label>
                                <input type="text" required class="form-control" name="marca" value="{{old('marca')}}"
                                       id="" list="marca"
                                       placeholder="EX:MERCEDES-BENZ C 180">
                                <datalist id="marca">
                                    @foreach($veiculos as $veiculo)
                                        <option value="{{$veiculo->marca}}"
                                                class="form-control">{{$veiculo->marca}}</option>
                                    @endforeach
                                </datalist>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="">Ano de Fabricação</label>
                                <input type="date" required class="form-control" value="{{old('ano')}}" name="ano" id=""
                                       placeholder="EX:MERCEDES-BENZ C 180">
                            </div>
                            <div class="col-md-6">
                                <label for="">Versão</label>
                                <input type="text" class="form-control" value="{{old('versao')}}" name="versao" id=""
                                       placeholder="EX: C 180">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="">Tipo de Veiculo</label>
                                <select class="form-control" required name="tipo" value="{{old('id_tipo_veiculo')}}"  id="">
                                    <option value="">Selecione aqui</option>
                                    @foreach($tipo_veiculos as $tipo)
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
                                          rows="5"> {{old('versao')}}  </textarea>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary mb-3" value="Salvar">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
