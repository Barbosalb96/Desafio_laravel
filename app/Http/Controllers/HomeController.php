<?php

namespace App\Http\Controllers;

use App\TipoVeiculo;
use App\Veiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect()->route('home');
    }

    public function welcome()
    {
        $tipo_veiculos = TipoVeiculo::all();
        $dicas = Veiculo::query()->join('tipo_veiculos', 'tipo_veiculos.id', 'veiculos.id_tipo_veiculo')
            ->join('users', 'users.id', 'veiculos.id_user')
            ->select('modelo', 'marca', 'ano', 'tipo_veiculos.nome as categoria', 'descricao', 'versao', 'users.name')
            ->orderBy('veiculos.created_at', 'DESC')->paginate(6);
        return view('welcome', compact('dicas', 'tipo_veiculos'));

    }

    public function Admin()
    {
        $veiculos = Veiculo::all();
        $tipo_veiculos = TipoVeiculo::all();
        return view('home', compact('tipo_veiculos', 'veiculos'));
    }

    public function adminDicas()
    {
        $dicas = Veiculo::query()->join('tipo_veiculos', 'tipo_veiculos.id', 'veiculos.id_tipo_veiculo')
            ->select('veiculos.id as id_veiculo', 'modelo', 'marca', 'ano', 'tipo_veiculos.nome as categoria', 'descricao', 'versao')
            ->where('veiculos.id_user', Auth::user()->id)->paginate(6);
        return view('pages.My_dicas', compact('dicas'));
    }

    public function FiltroDica($id = null,Request $request)
    {
        $filter = $request->search;
        $filterAll = $request->all();
        $dicas_veiculos = $this->filtro();
        if (!is_null($id)){
            $dicas_veiculos->where('veiculos.id_user', Auth::user()->id);
        }
        $dicas = $dicas_veiculos->where(function ($query) use ($filter) {
            if (!is_null($filter)) {
                $query->orWhere('modelo', "LIKE", "%{$filter}%")
                    ->orWhere('marca', "LIKE", "%{$filter}%")
                    ->orWhere('versao', "LIKE", "%{$filter}%")
                    ->orWhere('tipo_veiculos.nome', "LIKE", "%{$filter}%");
            }
        })->orderBy('veiculos.created_at', 'DESC')->paginate(6);

        $view = !is_null($id) ? "pages.My_dicas":"welcome";

        return view($view, compact('dicas', 'filterAll'));
    }


    /** função que faz filtro
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function filtro()
    {
        $dicas_veiculos = Veiculo::query()->join('tipo_veiculos', 'tipo_veiculos.id', 'veiculos.id_tipo_veiculo')
            ->join('users', 'users.id', 'veiculos.id_user')
            ->select('veiculos.id as id_veiculo', 'modelo', 'marca', 'ano', 'tipo_veiculos.nome as categoria', 'descricao', 'versao', 'users.name');
        return $dicas_veiculos;
    }
}
