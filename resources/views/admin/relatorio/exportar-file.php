<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Relatório</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<body>
<div class="d-flex justify-content-between">
    <h4>Relatório</h4>
    <img src="http://127.0.0.1:8000/images/logo-4-trace.png" alt="">
</div>



<div>
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>Qtd No Item</th>
            <th>Nome</th>
            <th>Status</th>
            <th>Inspetor</th>
            <th> Última inspeção</th>
            <th>Data de Validade</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($unidades as $unidade): ?>

            <tr>
                <td></td>
            <td> <?=  $unidade->tag    ?>    </td>
            <td> <?=  $unidade->equipamento->nome    ?>    </td>
            <td> <?=  $unidade->status_string    ?>    </td>
            <td> <?=  $unidade->user->name    ?>    </td>
            <td> <?=  date("d/m/Y", strtotime($unidade->data_ultima_inspecao)) ?>    </td>
            <td> <?=  date("d/m/Y", strtotime($unidade->data_validade)) ?>    </td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>
</div>


</body>
</html>
