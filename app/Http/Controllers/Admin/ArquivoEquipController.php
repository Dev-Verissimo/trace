<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArquivoEquipamento;
use App\Models\Equipamento;
use Illuminate\Http\Request;

class ArquivoEquipController extends Controller
{
    public function index($id)
    {
        $equipamento = Equipamento::with('arquivo')->where('id', '=', $id)->first();
        return view('admin.equipamento-arquivo.index', compact('equipamento'));
    }


    public function create($id)
    {
        return view('admin.equipamento-arquivo.create', compact('id'));
    }


    public function store(Request $request)
    {
        $arquivo = ArquivoEquipamento::create($request->all());
        if (!empty($request->file('path_arquivo'))) {
            $arquivo->path_arquivo = $request->file('path_arquivo')->store('arquivos', 'public_uploads');
        }
        $arquivo->save();

        $mensagem = "Arquivo {$arquivo->nome} salvo com sucesso";
        $tipo = 'success';
        return redirect()->route('admin.arquivo.index', $arquivo->equipamento_id)->with(compact('mensagem', 'tipo'));
    }


    public function show($id)
    {
        $arquivo = ArquivoEquipamento::find($id);
        return view('admin.equipamento-arquivo.show', compact('arquivo'));
    }


    public function edit($id)
    {
        $arquivo = ArquivoEquipamento::find($id);
        return view('admin.equipamento-arquivo.edit', compact('arquivo'));
    }


    public function update(Request $request, $id)
    {
        $arquivo = ArquivoEquipamento::find($id);
        $arquivo->fill($request->all());
        if (!empty($request->file('path_arquivo'))) {
            $arquivo->path_arquivo = $request->file('path_arquivo')->store('arquivos', 'public_uploads');
        }
        $arquivo->save();
        $mensagem = "Arquivo {$arquivo->nome} atualizado sucesso";
        $tipo = 'success';
        return redirect()->route('admin.arquivo.index', $arquivo->equipamento_id)->with(compact('mensagem', 'tipo'));
    }


    public function destroy($id)
    {
        $arquivo = ArquivoEquipamento::destroy($id);
        $mensagem = "Arquivo excluido com sucesso";
        $tipo = 'danger';
        return redirect()->route('admin.arquivo.index', $id)->with(compact('mensagem', 'tipo'));
    }
}
