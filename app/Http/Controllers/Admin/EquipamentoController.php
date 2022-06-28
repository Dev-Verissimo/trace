<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Equipamento;
use App\Models\Fabricante;
use Illuminate\Http\Request;

class EquipamentoController extends Controller
{

    public function index()
    {
         $equipamentos = Equipamento::with('unidade')->get();
        //return $equipamentos = Equipamento::with('fabricante')->get();
        return view('admin.equipamento.index', compact('equipamentos'));
    }


    public function create()
    {
        $fabricantes = Fabricante::all();
        $categorias = Categoria::all();
        return view('admin.equipamento.create', compact('categorias', 'fabricantes'));
    }



    public function store(Request $request)
    {
        $equipamento = Equipamento::create($request->all());
        if (!empty($request->file('imagem'))) {
            $equipamento->imagem = $request->file('imagem')->store('equipamentos','public_uploads');
            $equipamento->save();
        }
        $mensagem = "{$equipamento->nome} criado com sucesso";
        $tipo = 'success';
        return redirect()->route('admin.equipamento.index')->with(compact('mensagem', 'tipo'));
    }



    public function edit($id)
    {
        $equipamento = Equipamento::find($id);
        $fabricantes = Fabricante::all();
        $categorias = Categoria::all();
        return view('admin.equipamento.edit', compact('equipamento', 'fabricantes','categorias'));
    }

    public function show($id)
    {
        $equipamento = Equipamento::find($id);
        $fabricantes = Fabricante::all();
        $categorias = Categoria::all();
        return view('admin.equipamento.delete', compact('equipamento', 'fabricantes','categorias'));
    }


    public function update(Request $request, $id)
    {
        $equipamento = Equipamento::find($id);
        $equipamento->fill($request->all());
        if (!empty($request->file('imagem'))) {
            $equipamento->imagem = $request->file('imagem')->store('equipamentos','public_uploads');
        }
        $equipamento->save();
        $mensagem = "Equipamento {$equipamento->nome} atualizado sucesso";
        $tipo = 'success';
        return redirect()->route('admin.equipamento.index')->with(compact('mensagem', 'tipo'));
    }


    public function destroy($id)
    {
        $equipamento = Equipamento::destroy($id);
        $mensagem = 'Equipamento excluido com sucesso';
        $tipo = 'danger';
        return redirect()->route('admin.equipamento.index')->with(compact('mensagem', 'tipo'));
    }
}
