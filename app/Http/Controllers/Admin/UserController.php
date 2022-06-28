<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }


    public function create()
    {
        return view('admin.users.create');
    }


    public function store(Request $request)
    {

        $user_create = User::create($request->all());
        $user_create->status = true;
        if (!empty($request->file('imagemup'))) {
            $user_create->imagem = $request->file('imagemup')->store('users', 'public_uploads');
        }
        $user_create->save();

        $mensagem = 'Usuário criado com sucesso';
        $tipo = 'success';
        return redirect()->route('admin.usuarios.index')->with(compact('mensagem', 'tipo'));
    }

    public function show($id)
    {
        $user = User::find($id);
        return  view('admin.users.excluir',
            compact('user'));
    }


    public function edit($id)
    {
        $user = User::find($id);
        return  view('admin.users.edit', compact('user'));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'telefone' => 'required',
        ]);
        $user = User::find($id);
        $user->fill($request->all());
        if (!empty($request->file('imagemup'))) {
            $user->imagem = $request->file('imagemup')->store('users', 'public_uploads');
        }
        $user->save();
        $mensagem = "Usuário {$user->name} atualizado com sucesso.";
        $tipo = 'success';
        return redirect()->route('admin.usuarios.index')->with(compact('mensagem', 'tipo'));
    }


    public function destroy($id)
    {
        $user = User::destroy($id);
        $mensagem = 'Usuário excluido com sucesso';
        $tipo = 'danger';
        return redirect()->route('admin.usuarios.index')->with(compact('mensagem', 'tipo'));
    }
}
