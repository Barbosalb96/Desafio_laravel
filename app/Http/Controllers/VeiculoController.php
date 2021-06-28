<?php

namespace App\Http\Controllers;

use App\DicasVeiculos;
use App\Http\Requests\VeiculosRequest;
use App\TipoVeiculo;
use App\Veiculo;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class VeiculoController extends Controller
{

    public function store(VeiculosRequest $request)
    {
        $id_user = Auth::user()->id;
        $veiculo = new Veiculo();
        $veiculo->id_user = $id_user;
        $veiculo->modelo = $request->modelo;
        $veiculo->marca = $request->marca;
        $veiculo->ano = $request->ano;
        $veiculo->versao = is_null($request->versao) ? 'Versao não infomada' : $request->versao;
        $veiculo->id_tipo_veiculo = $request->tipo;
        $veiculo->descricao = $request->descricao;
        $veiculo->save();
        return redirect()->route('admin')->with('sucess', 'Cadastro efetudo com sucesso');

    }

    public function edit($id)
    {
        $tipos = TipoVeiculo::all();
        $veiculos = Veiculo::query()->join('tipo_veiculos', 'tipo_veiculos.id', 'veiculos.id_tipo_veiculo')
            ->join('users', 'users.id', 'veiculos.id_user')
            ->select('veiculos.id as id_veiculo', 'modelo', 'marca', 'ano', 'tipo_veiculos.nome as categoria', 'tipo_veiculos.id as id_categoria', 'descricao', 'versao', 'users.name')
            ->where('veiculos.id', $id)->first();

        return view('pages.AtualizarDica', compact('veiculos', 'tipos'));

    }

    public function update(Request $request)
    {
        Veiculo::query()->findOrFail($request->id)->update($request->all());

        return redirect()->route('dicas')->with('sucess', 'Atualizado com Sucesso !!');


    }

    public
    function delete($id)
    {
        try {
            Veiculo::query()->findOrFail($id)->delete();
            return redirect()->route('dicas')->with('sucess', 'O registro foi deletado com sucesso!!');
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }


}
