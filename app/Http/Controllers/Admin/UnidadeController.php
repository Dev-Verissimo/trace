<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Unidade as UnidadeRequest;
use App\Models\Equipamento;
use App\Models\Local;
use App\Models\Unidade;
use Illuminate\Http\Request;

class UnidadeController extends Controller
{

    public function index($id)
    {
        $equipamento = Equipamento::with('categoria', 'fabricante', 'arquivo')
            ->where('id', '=', $id)->first();
        $unidades = Unidade::with('local')->where('equipamento_id', '=', $id)->orderBy('created_at', 'desc')->get();

        if (!$equipamento){
            $mensagem = "Equipamento não localizado";
            $tipo = 'info';
            return redirect()->back()->with(compact('mensagem', 'tipo'));
        }

        return view('admin.unidade.index', compact('equipamento', 'unidades'));
    }


    public function create($id)
    {
        $locais = Local::all();
        return view('admin.unidade.create', compact('id', 'locais'));
    }


    public function store(UnidadeRequest $request)
    {
        $unidade = Unidade::create($request->all());
        $mensagem = "Unidade salva com sucesso";
        $tipo = 'success';
        return redirect()->route('admin.unidade.index', $request->equipamento_id)->with(compact('mensagem', 'tipo'));

    }


    public function show($id)
    {
        $unidade = Unidade::with('local')->where('id', '=', $id)->first();
        return view('admin.unidade.show', compact('unidade'));
    }


    public function edit($id)
    {
        $unidade = Unidade::find($id);
        $locais = Local::all();
        return view('admin.unidade.edit', compact('id', 'locais', 'unidade'));
    }


    public function update(UnidadeRequest $request, $id)
    {
        $unidade = Unidade::find($id);
        $unidade->fill($request->all());
        $unidade->save();

        $mensagem = "Unidade atualizada com sucesso";
        $tipo = 'success';
        return redirect()->route('admin.unidade.index', $unidade->equipamento_id)->with(compact('mensagem', 'tipo'));

    }

    public function lista()
    {
       $unidades = Unidade::with('equipamento')
            ->where('data_proxima_inspecao' ,'>=' ,date('Y-m-d') )
            ->orderBy('tag', 'asc')
            ->get();
        return view('admin.unidade.lista', compact('unidades'));
    }
    public function listEquipamentos()
    {
        return Unidade::with('equipamento')
            ->where('data_proxima_inspecao' ,'>=' ,date('Y-m-d') )
            ->orderBy('data_proxima_inspecao', 'asc')
            ->limit('10')
            ->get();
    }

    public function destroy($id)
    {
        $unidade = Unidade::find($id);
        $unidade->delete();
        $mensagem = "Unidade excluida com sucesso";
        $tipo = 'success';
        return redirect()->route('admin.unidade.index', $unidade->equipamento_id)->with(compact('mensagem', 'tipo'));
    }
}
