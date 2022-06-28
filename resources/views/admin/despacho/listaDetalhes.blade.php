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
            <a href="{{route('admin.despacho.lista')}}">
                <i class="fa fa-arrow-right mr5"></i>
                Movimentações
            </a>
        </li>
        <li class="active">
            <a href="{{route('admin.despacho.detalhes', $despacho->id)}}">
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

        <form action="{{route('admin.solicitacao.storeDespacho')}}" method="post">
            @csrf
            <input type="hidden" name="localDestino_id" value="{{$despacho->local_id}}">
            <input type="hidden" name="userRequest_id" value="{{$despacho->id}}">
            <input type="hidden" name="userSend_id" value="{{Auth::user()->id}}">
            <input type="hidden" name="solicitacao_id" value="{{$despacho->id}}">

            <div class="row" style="display: flex; flex-direction: row; flex-wrap: wrap;">

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel list-announcement">

                        <div class="panel-body">

                            @if($despacho->mensagem != null)
                                <h4 class="panel-title" style="margin: 20px;">
                                    Mensagem:
                                </h4>
                                <p style="margin: 20px;">
                                    {{$despacho->mensagem}}
                                </p>
                            @endif

                            <div class="table-responsive">
                                <table
                                    class="table table-bordered nomargin">
                                    <thead
                                        class="success">
                                    <tr>
                                        <th class="text-center">
                                            Equipamento
                                        </th>
                                        <th>Tag</th>
                                        <th>Local</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($despacho->equi_despachos as $ep)
                                        <tr class="">
                                            <td>
                                                <i class="fa fa-cubes"></i> {{ $ep->unidade->equipamento->nome }}
                                            </td>

                                            <td>
                                                <i class="fa fa-tag"></i>
                                                {{$ep->unidade->tag }}

                                            </td>
                                            <td>
                                                {{$ep->unidade->local->nome }}
                                            </td>
                                            <td>
                                                {{$ep->unidade->status_string }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel">

                        <div class="panel-heading">
                            <h4 class="panel-title panel-title-alt">Despacho </h4>
                            <p>Todos os equipamentos selecionados serão enviados para o local:

                            </p>
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 d-flex justify-content-between">
                                    <a href="{{route('admin.despacho.lista')}}"
                                       class="btn btn-wide btn-danger btn-quirk mr5 mt20 ">
                                        Voltar
                                    </a>
                                    <a href="{{route('admin.solicitacao.listadetalhes', $despacho->solicitacao_id)}}"
                                       class="btn btn-wide btn-info btn-quirk mr5 mt20 ">
                                        Alterar
                                    </a>

                                    <a href="{{route('admin.despacho.acetarDespacho', $despacho->id)}}"
                                       class="btn btn-wide btn-primary btn-quirk mr5 mt20">
                                        Aceitar
                                    </a>

                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </form>
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

                    this.mensagem = 1;
                    document.querySelector("#aceito-com-modificacao").checked = true;
                }
            }
        })
    </script>
@endsection
