<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Equipamento;
use App\Models\Inspecao;
use App\Models\Local;
use App\Models\Unidade;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    public function index()
    {
        return view('admin.relatorio.index');
    }

    public function loadFilesIndex()
    {
        $locais = Local::all();
        $categorias = Categoria::all();
        $equipamentos = Equipamento::all('id', 'nome');
        return response()->json([
            "locais" => $locais,
            "equipamentos" => $equipamentos,
            "categorias" => $categorias
        ], 200);
    }

    public function gerarRelatorio(Request $request)
    {
        /*
          'local_id' => string '2' (length=1)
          'categoria_id' => string '1' (length=1)
          'equipamento_id' => string '5' (length=1)
          'datainicial' => string '2021-08-17' (length=10)
          'datafinal' => string '2021-08-25' (length=10)
          'status' => string '1' (length=1)
         * */

        $inspecoes = $this->resultadoRelatorio($request);

        return response()
            ->json($inspecoes->get(), 200);
    }

    public function exportar(Request $request)
    {
        $inspecoes = $this->resultadoRelatorio($request);

//        return view('admin.relatorio.exportar', [
//            'inspecoes' => $inspecoes->get()
//        ]);
        return PDF::loadView('admin.relatorio.exportar', [
            'inspecoes' => $inspecoes->get()
        ])
            ->setPaper('a4', 'landscape')
            ->stream('relatorio.pdf');

    }

    public function resultadoRelatorio($request)
    {

        $insp = Inspecao::with('unidade.equipamento', 'user');


        if ($request->local_id != "0") {
            $insp = $insp->where('local_id', '=', $request->local_id);
        }


        if ($request->categoria_id != '0') {
            $insp = $insp->whereHas('unidade.equipamento', function ($query) use ($request) {
                $query->where('categoria_id', '=', $request->categoria_id);
            });
        }
        if ($request->equipamento_id != '0') {
            $insp = $insp->whereHas('unidade.equipamento', function ($query) use ($request) {
                $query->where('id', '=', $request->equipamento_id);
            });
        }
        if ($request->datainicial != null) {
            $insp = $insp->where('data_inspecao', '>=', $request->datainicial);
        }
        if ($request->datafinal != null) {
            $insp = $insp->where('data_inspecao', '<=', $request->datafinal);
        }
        if ($request->status != '0') {
            $insp = $insp->where('status', '=', $request->status);
        }
        return $insp;
    }
}
