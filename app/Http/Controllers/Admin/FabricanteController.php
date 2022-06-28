<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fabricante;
use Illuminate\Http\Request;

class FabricanteController extends Controller
{

    public function index()
    {
        $fabricantes = Fabricante::all();
        return view('admin.fabricante.index', compact('fabricantes'));
    }


    public function create()
    {
        return view('admin.fabricante.create');
    }


    public function store(Request $request)
    {
        $fabricante = Fabricante::create($request->all());
        $mensagem = "Fabricante {$fabricante->nome} criado com sucesso";
        $tipo = 'success';
        return redirect()->route('admin.fabricante.index')->with(compact('mensagem', 'tipo'));
    }


    public function show($id)
    {
        $fabricante = Fabricante::find($id);
        return view('admin.fabricante.delete', compact('fabricante'));
    }

    public function edit($id)
    {
        $fabricante = Fabricante::find($id);
        return view('admin.fabricante.edit', compact('fabricante'));
    }


    public function update(Request $request, $id)
    {
        $fabricante = Fabricante::find($id);
        $fabricante->fill($request->all());
        $fabricante->save();
        $mensagem = "Fabricante {$fabricante->nome} atualizado sucesso";
        $tipo = 'success';
        return redirect()->route('admin.fabricante.index')->with(compact('mensagem', 'tipo'));
    }


    public function destroy($id)
    {
        Fabricante::destroy($id);
        $mensagem = "Fabricante excluido com sucesso";
        $tipo = 'success';
        return redirect()->route('admin.fabricante.index')->with(compact('mensagem', 'tipo'));
    }
}
