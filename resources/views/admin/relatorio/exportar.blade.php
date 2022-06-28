<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Relatório</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
          integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<body>

<div class="d-flex justify-content-between">

    <img src="{{asset('images/logo-4-trace.png')}}" style="max-width: 220px" alt="">
</div>
<div class="d-block mt-2 mb-2" style="font-size: 18px">Data: {{date('d/m/Y')}} - Responsável: {{\Illuminate\Support\Facades\Auth::user()->name}}</div>
<div class="d-none">
{{$i = 1}}
</div>
<div class="mt-3">
    <table style="margin: auto; width: 90%">
        <thead>
        <tr>
            <th>#</th>
            <th>Tag</th>
            <th>Nome</th>
            <th>Status</th>
            <th>Inspetor</th>
            <th>Última Inspeção</th>
            <th>Data de Validade</th>
        </tr>
        </thead>
        <tbody>
        @foreach($inspecoes as $insp)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$insp->tag}}</td>
                <td>{{$insp->unidade->equipamento->nome}}</td>
                <td>{{$insp->status_inspecao}}</td>
                <td>{{$insp->user->name}}</td>
                <td>{{date("d/m/Y", strtotime($insp->data_inspecao))}}</td>
                <td>{{date("d/m/Y", strtotime($insp->unidade->data_validade))}}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>



</body>
</html>
