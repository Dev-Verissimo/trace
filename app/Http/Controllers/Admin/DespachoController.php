<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Despacho;
use App\Models\Unidade;
use Illuminate\Http\Request;

class DespachoController extends Controller
{
    public function listar()
    {
        return view('admin.despacho.lista');
    }

    public function apiListar()
    {
        return Despacho::with('local', 'userSend', 'solicitacao')->where('status', '!=', 4)->orderBy('created_at', 'desc')
            ->get();
    }

    public function listaDetalhes($id)
    {
        $despacho = Despacho::with('solicitacao', 'equi_despachos.unidade.equipamento', 'local')
            ->where('id', '=', $id)
            ->first();
        return view('admin.despacho.listaDetalhes', compact('despacho'));
    }

    public function acetarDespacho($id)
    {
        $despacho = Despacho::find($id);

        if (!$despacho) {
            $mensagem = "Despacho não encontrado";
            $tipo = 'info';
            return redirect()->route('admin.despacho.lista')
                ->with(compact('mensagem', 'tipo'));
        }

        $despacho->load('equi_despachos.unidade', 'local');

        foreach ($despacho->equi_despachos as $equi) {
            $uni = Unidade::find($equi->unidade->id);
            $uni->status = 1;
            $uni->local_id = $despacho->localDestino_id;
            $uni->save();
        }
        $despacho->status = 4;
        $despacho->save();

        $mensagem = "Solicitação salva com sucesso";
        $tipo = 'success';
        return redirect()->route('admin.despacho.lista')
            ->with(compact('mensagem', 'tipo'));
    }

    public function excluirDespacho(Request $request)
    {
        Despacho::destroy($request->despachoId);
    }
}
