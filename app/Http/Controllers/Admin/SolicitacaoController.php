<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Despacho;
use App\Models\Equipamento;
use App\Models\EquipDespacho;
use App\Models\EquipSolicitatodo;
use App\Models\Local;
use App\Models\Solicitacao;
use App\Models\Unidade;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Utils;
use function PHPUnit\Framework\exactly;

class SolicitacaoController extends Controller
{

    public function index()
    {
        $equipamentos = Equipamento::all();
        return view('admin.solicitacao.index', compact('equipamentos'));
    }

    public function lista()
    {
        // 'solicitacao.equipamento'
        $solicitacoes = Solicitacao::with('user', 'local')
            ->where('status', '=', '1')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.solicitacao.lista',
            compact('solicitacoes'));
    }

    public function listaDetalhes($id)
    {
        $solicitacao = Solicitacao::with('local', 'user', 'equipamentos.equipamento.unidade.local')
            ->where('id', '=', $id)
            ->first();

        return view('admin.solicitacao.listaDetalhes', compact('solicitacao'));
    }

    public function create()
    {
        /*
         * localDestino
         * userRequest
         * userSend
         * solicitacaoinId
         * mensagem
         * status
         *
         *  */
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'local_id' => 'required',
        ]);
        $num = count($request->except('_token', 'local_id')) / 2;

        $chaves = array();
        foreach ($request->except('_token', 'local_id') as $item) {
            array_push($chaves, $item);
        }
        DB::transaction(function () use ($request, $num, $chaves) {
            $sl = new Solicitacao();
            $sl->status = 1;
            $sl->local_id = $request->local_id;
            $sl->user_id = Auth::user()->id;
            $sl->save();

            $indice = 0;
            for ($x = 0; $x < $num; $x++) {
                $epD = new EquipSolicitatodo();
                $epD->solicitacao_id = $sl->id;
                if ($x == 0) {
                    $epD->equipamento_id = $chaves[$x];
                    $indice = $indice + 1;
                    $epD->quantidade = $chaves[$indice];

                } else {
                    $indice = $indice + 1;
                    $epD->equipamento_id = $chaves[$indice];
                    $indice = $indice + 1;
                    $epD->quantidade = $chaves[$indice];
                }
                $epD->save();
            }
        });
        $mensagem = "Solicitação salva com sucesso";
        $tipo = 'success';

        return redirect()->route('admin.solicitacao.index')->with(compact('mensagem', 'tipo'));
    }

    public function storeDespacho(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $despacho = new Despacho();
                $despacho->fill($request->all());
                $despacho->save();

                $chaves = array();
                foreach ($request->except('_token', 'localDestino_id', 'userRequest_id', 'userSend_id', 'solicitacao_id', 'status', 'mensagem') as $item) {
                    array_push($chaves, $item);
                }

                for ($x = 0; $x < count($chaves); $x++) {
                    $epD = new EquipDespacho();
                    $epD->despacho_id = $despacho->id;
                    $epD->unidade_id = $chaves[$x];
                    $epD->save();

                    if ((int)$request->status < 3){
                        $unidade = Unidade::find($chaves[$x]);
                        $unidade->status = '4';
                        $unidade->save();
                    }
                }
                /* apaga a solicitação */
                $soli =  Solicitacao::find((int)$request->solicitacao_id);
                $soli->status = 2;
                $soli->save();

            });


            $mensagem = "Solicitação salva";
            $tipo = 'success';

            return redirect()->route('admin.solicitacao.lista',)->with(compact('mensagem', 'tipo'));

        } catch (QueryException $ex) {

        }

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function excluir($solicitacaoId)
    {
        $solicitacao = Solicitacao::with('local', 'user', 'equipamentos.equipamento.unidade.local')
            ->where('id', '=', $solicitacaoId)
            ->first();

        return view('admin.solicitacao.delete',
            compact('solicitacao'));
    }

    public function destroy($id)
    {
        Solicitacao::destroy($id);
        $mensagem = "Solicitação excluido com sucesso";
        $tipo = 'success';

        return redirect()
            ->route('admin.solicitacao.lista',)
            ->with(compact('mensagem', 'tipo'));
    }

    public function equipamentos($local_id = null)
    {
        if ($local_id == null) {
            return Unidade::with('equipamento.unidade')->select("equipamento_id")->distinct('equipamento_id')->get();
        }
        return Unidade::with('equipamento.unidade')->where('local_id', '=', $local_id)->select("equipamento_id", "local_id")->distinct('equipamento_id')->get();

    }

}
