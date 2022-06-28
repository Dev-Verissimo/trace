<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Local;
use Illuminate\Http\Request;

class LocalController extends Controller
{

    public function index()
    {
        $locais = Local::all();
        return view('admin.local.index', compact('locais'));
    }


    public function create()
    {
        return view('admin.local.create');
    }


    public function store(Request $request)
    {
        $local = Local::create($request->all());
        $local->status = true;
        $local->save();
        $mensagem = "Local {$local->nome} criado com sucesso";
        $tipo = 'success';
        return redirect()->route('admin.local.index')->with(compact('mensagem', 'tipo'));
    }


    public function show($id)
    {
        $local = Local::find($id);
        return view('admin.local.delete', compact('local'));
    }


    public function edit($id)
    {
        $local = Local::find($id);
        return view('admin.local.edit', compact('local'));
    }


    public function update(Request $request, $id)
    {
        $local = Local::find($id);
        $local->fill($request->all());
        $local->save();
        $mensagem = "Local {$local->nome} atualizado sucesso";
        $tipo = 'success';
        return redirect()->route('admin.local.index')->with(compact('mensagem', 'tipo'));
    }


    public function destroy($id)
    {
        Local::destroy($id);
        $mensagem = "Local excluido com sucesso";
        $tipo = 'success';
        return redirect()->route('admin.local.index')->with(compact('mensagem', 'tipo'));
    }

    public function locais()
    {
        return Local::all();
    }
    public function locaiExceto($id)
    {
        return Local::where('id','!=',$id)->get();
    }
}
