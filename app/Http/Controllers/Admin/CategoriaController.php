<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{

    public function index()
    {
        $categorias = Categoria::all();
        return view('admin.categoria.index', compact('categorias'));
    }


    public function create()
    {
        return view('admin.categoria.create');
    }


    public function store(Request $request)
    {
        $fabricante = Categoria::create($request->all());
        $mensagem = "Categoria {$fabricante->nome} criada com sucesso";
        $tipo = 'success';
        return redirect()->route('admin.categoria.index')->with(compact('mensagem', 'tipo'));
    }


    public function show($id)
    {
        $categoria = Categoria::find($id);
        return view('admin.categoria.delete', compact('categoria'));
    }


    public function edit($id)
    {
        $categoria = Categoria::find($id);
        return view('admin.categoria.edit', compact('categoria'));
    }


    public function update(Request $request, $id)
    {
        $categoria = Categoria::find($id);
        $categoria->fill($request->all());
        $categoria->save();
        $mensagem = "Categoria {$categoria->nome} atualizada sucesso";
        $tipo = 'success';
        return redirect()->route('admin.categoria.index')->with(compact('mensagem', 'tipo'));
    }


    public function destroy($id)
    {
        Categoria::destroy($id);
        $mensagem = "Categoria excluida com sucesso";
        $tipo = 'success';
        return redirect()->route('admin.categoria.index')->with(compact('mensagem', 'tipo'));
    }
}
