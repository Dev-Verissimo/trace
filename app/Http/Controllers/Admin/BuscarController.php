<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Equipamento;
use App\Models\Unidade;
use Illuminate\Http\Request;

class BuscarController extends Controller
{
    public function pesquisar(Request $request)
    {

        $equipamentos = Equipamento::with('unidade.local', 'categoria', 'fabricante');
        $unidades = Unidade::with('equipamento.categoria', 'local');

        $equipamentos = $equipamentos->where('nome', 'LIKE', '%' . $request->pesquisa . '%');
        $unidades = $unidades->where('tag', 'LIKE', $request->pesquisa . '%');
        return view('admin.busca.index', [
            'equipamentos' => $equipamentos->get(),
            'unidades' => $unidades->get(),
            'pesquisa' => $request->pesquisa
        ]);

    }

    public function index()
    {
        $equipamentos = Equipamento::with('unidade.local', 'categoria', 'fabricante');
        $equipamentos = $equipamentos->where('nome', 'LIKE', '%' . 'stop' . '%');

        $unidades = Unidade::with('equipamento.categoria', 'local')->get();

        return view('admin.busca.index', [
            'equipamentos' => $equipamentos->get(),
            'unidades' => $unidades,
            'pesquisa' => 'Chave'
        ]);
    }
}
