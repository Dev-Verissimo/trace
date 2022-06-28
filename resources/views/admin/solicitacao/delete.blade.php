@extends('admin.master.master')
@section('title')
    Detalhes da Solicitação
@endsection
@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li>
            <a href="{{route('admin.home')}}">
                <i class="fa fa-home mr5"></i> Home
            </a>
        </li>
        <li class="">
            <a href="{{route('admin.solicitacao.lista')}}">
                <i class="fa fa-arrow-right mr5"></i>
                Listas de Envio
            </a>
        </li>
        <li class="active">
            <a href="{{route('admin.solicitacao.listadetalhes', $solicitacao->id)}}">
                Detalhes da Lista
            </a>
        </li>
    </ol>

    @if($errors->all())
        @foreach($errors->all() as $error)
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{$error}}
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    @if(session()->exists('mensagem'))
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="alert alert-{{session()->get('tipo')}}">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{session()->get('mensagem')}}
                </div>
            </div>
        </div>
    @endif

    <div id="app">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <h3 class="panel-title">Tem certeza que deseja excluir ?</h3>
                    </div>
                </div>

            </div>
        </div>


        <div class="row" style="display: flex; flex-direction: row; flex-wrap: wrap;">
            @foreach($solicitacao->equipamentos as $ep)
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="panel list-announcement">
                        <ul class="panel-options">
                            <li>
                                {{$solicitacao->local->nome}} &nbsp;
                            </li>

                        </ul>

                        <div class="panel-heading">
                            <h3>
                                Quantidade:
                                <code
                                    class="{{ $ep->quantidade <= $ep->equipamento->unidade->count()  ? 'text-success' : 'text-danger'}} ">
                                    {{$ep->equipamento->unidade->count() <= $ep->quantidade ? $ep->equipamento->unidade->count() :  $ep->quantidade }}
                                    /{{$ep->quantidade}}

                                    @if($ep->quantidade <= $ep->equipamento->unidade->count())
                                        <i class='fa fa-thumbs-up'></i>
                                    @else
                                        <i class='fa fa-warning'></i>
                                    @endif
                                </code>
                            </h3>

                        </div>
                        <div class="panel-body">
                            <div>
                                <h4 class="panel-title" style="margin: 20px;">
                                    <i class="fa fa-cubes"></i>
                                    {{$ep->equipamento->nome}}
                                </h4>
                                <div class="table-responsive">
                                    <table
                                        class="table table-bordered nomargin {{$ep->quantidade <= $ep->equipamento->unidade->count() ? 'table-success' : 'table-danger'}}">
                                        <thead
                                            class="{{$ep->quantidade <= $ep->equipamento->unidade->count() ? 'success' : 'danger'}}">
                                        <tr>

                                            <th>Tag</th>
                                            <th>Local atual</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @php
                                            $num = $ep->equipamento->unidade->count() <= $ep->quantidade ? $ep->equipamento->unidade->count() :  $ep->quantidade ;
                                        @endphp

                                        @for($x = 0; $x < $num; $x++ )
                                            <tr class="">
                                                <td>
                                                    <i class="fa fa-tag"></i>
                                                    {{$ep->equipamento->unidade[$x]->tag}}

                                                </td>
                                                <td>
                                                    {{$ep->equipamento->unidade[$x]->local->nome}}
                                                </td>
                                                <td>
                                                    Aprovado
                                                </td>
                                            </tr>
                                        @endfor
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="panel">

                    <div class="panel-heading">
                        <h4 class="panel-title panel-title-alt">Despacho </h4>
                        <p>Todos os equipamentos selecionados serão enviados para o local:
                            <strong>{{$solicitacao->local->nome}}</strong>
                        </p>
                    </div>

                    <div class="panel-body">

                        <div class="row">

                            <div class="col-xs-12 col-sm-12 col-md-12">

                                <form action="{{route('admin.solicitacao.destroy', $solicitacao->id)}}" method="post"
                                      class="d-flex justify-content-between">
                                    @method('DELETE')
                                    @csrf
                                    <a href="{{route('admin.solicitacao.lista')}}"
                                       class="btn btn-wide btn-primary btn-quirk mr5 mt20 ng-binding  ">
                                        Voltar
                                    </a>
                                    <button type="submit"
                                            class="btn btn-wide btn-danger btn-quirk mr5 mt20 ng-binding  ">
                                        EXCLUIR
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('js')
    <script>

        var app = new Vue({
            el: '#app',
            data: {
                equipamentos: [],
                destino: [],
                mensagem: 0,
                localOrigem: [],
                localDestino: []
            },
            methods: {
                carregarEquipamentos() {
                    axios.get('http://127.0.0.1:8000/api/equipamentos/todos').then(res => {
                        this.equipamentos = res.data;
                    });
                },
                inputChange(e) {
                    // if (e.srcElement.checked) {
                    //     e.srcElement.defaultValue = "ativo"
                    // } else {
                    //     e.srcElement.defaultValue = "falso"
                    // }
                    this.mensagem = 1;
                    document.querySelector("#aceito-com-modificacao").checked = true;
                }
            }
        })
    </script>
@endsection
