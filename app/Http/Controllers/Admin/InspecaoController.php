<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unidade;
use App\Models\Inspecao;
use App\Models\Local;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InspecaoController extends Controller
{
    public function index($id)
    {
        //  $unidade = Unidade::with('inspecao', 'user', 'local', 'equipamento')

        $unidade = Unidade::with(['inspecao' => function ($q) {
            $q->orderBy('data_inspecao', 'desc');
        }])->where('id', '=', $id)
            ->first();
        $unidade = $unidade->load('user', 'local', 'equipamento');

        $users = User::all();
        $locais = Local::all();

        return view('admin.inspecao.index',
            compact('unidade', 'users', 'locais'));
    }

    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'local_id' => 'required',
            'data_inspecao' => 'required',
            'status' => 'required',
        ]);

        DB::transaction(function () use ($request, $id) {
            $insp = new Inspecao();
            $insp->fill($request->all());
            if (!empty($request->file('imagem'))) {
                $insp->imagem = $request->file('imagem')->store('inspecoes', 'public_uploads');
            }
            $insp->unidade_id = $id;
            $insp->save();

            $un = Unidade::find($id);
            $un->status = $request->status;
            $un->data_ultima_inspecao = $request->data_inspecao;
            $un->data_proxima_inspecao = date('Y-m-d', strtotime($request->data_inspecao  . ' + 160 days'));
            $un->save();
        });

        $mensagem = "Inspeção salva com sucesso.";
        $tipo = 'success';
        return redirect()->route('admin.inspecao.index', $id)
            ->with(compact('mensagem', 'tipo'));
    }
}
