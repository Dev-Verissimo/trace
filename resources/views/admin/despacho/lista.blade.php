@extends('admin.master.master')
@section('title')
    Listas de Envio
@endsection
@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('admin.home')}}"><i class="fa fa-home mr5"></i> Home</a></li>
        <li class="active">
            <a href="{{route('admin.solicitacao.lista')}}"> <i class="fa fa-arrow-right mr5"></i>
                Listas de Recebimento
            </a>
        </li>
    </ol>

    <div class="well well-asset-options clearfix">

        <div class="btn-toolbar btn-toolbar-media-manager pull-left" role="toolbar">

            <div class="searchpanel" style="top: 44px; left: 24px">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Filtrar"
                           id="inputFilter">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-filter"></i>
                        </button>
                    </span>
                </div>
            </div>

        </div><!-- btn-toolbar -->
        <div class="btn-group pull-right">
            <div class="btn-group" role="group">
                <a role="button" href="{{route('admin.solicitacao.index')}}" type="button"
                   class="btn btn-success btn-quirk">
                    <i class="fa fa-plus"></i>
                    <span class="hidden-xs hidden-sm ng-binding">
                        Adicionar solicitação
                    </span>
                </a>
                <a role="button" href="" type="button"
                   class="btn btn-danger btn-quirk hidden-xs hidden-sm hidden">
                    <i class="fa fa-lock"></i>
                    <span class="hidden-xs hidden-sm ng-binding">Cadastro Bloqueado</span>
                </a>
            </div>
        </div>

    </div>

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
    <div class="row" id="despacho-listar">

        <div class="col-md-12 ">

            <div class="panel panel-profile list-view">

                <div class="panel panel-site-traffic">

                    <div class="table-responsive">

                        <table class="table table-bordered table-default table-striped nomargin">

                            <thead class="success">
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Data de Envio
                                </th>
                                <th>
                                    Solicitante
                                </th>
                                <th>
                                    Destino
                                </th>
                                <th>
                                    Status
                                </th>
                                <th class="text-right ">Ações</th>
                            </tr>
                            </thead>
                            <tbody id="tableFilter">
                            @verbatim

                                <tr v-for="(item, i) in despachos" :key="i">

                                    <td>
                                        {{(i + 1)}}
                                    </td>

                                    <td>
                                        {{moment(item.created_at).format("DD/MM/YYYY")}}
                                    </td>

                                    <td>
                                        {{item.user_send.name}}
                                    </td>

                                    <td>
                                        {{item.local.nome}}
                                    </td>

                                    <td>
                                        <span class="label"
                                              :class="(item.status == 1 ? 'label-success' : 'label-danger')">{{(item.status == 1 ? 'Original' : 'Modificado')}}</span>
                                    </td>
                                    <td class="text-right d-flex justify-content-around">
                                        <a :href="'/admin/despacho/lista-detalhes/' + item.id "
                                           class="btn btn-info btn-quirk btn-stroke" title="Visualizar Solicitação">
                                            Visualizar
                                        </a>

                                        <button class="btn btn-danger btn-quirk btn-stroke" data-toggle="modal" data-target="#myModal" @click="despachoId = item.id">
                                            Excluir
                                        </button>


                                    </td>
                                </tr>
                            @endverbatim

                            </tbody>
                        </table>

                    </div><!-- table-responsive -->
                </div>
            </div><!-- panel -->


        </div>

        <!-- Modal -->
        <div class="modal bounceIn animated" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="max-width: 300px">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Tem certeza que deseja excluir?</h4>
                    </div>

                    <div class="modal-footer d-flex justify-content-around">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" @click="excluirDespachos">Excluir</button>
                    </div>
                </div><!-- modal-content -->
            </div><!-- modal-dialog -->
        </div><!-- modal -->


    </div>
@endsection

@section('js')
    <script>
        let appLista = new Vue({
            el: '#despacho-listar',
            data: {
                despachos: [],
                despachoId: 0,
            },
            methods: {
                carregarDespachos() {
                    axios.get('http://127.0.0.1:8000/api/despachos/todos').then(res => {
                        this.despachos = res.data
                    });
                },
                excluirDespachos(){
                    axios.post('http://127.0.0.1:8000/api/despachos/excluir', {
                        'despachoId': this.despachoId
                    }).then(res => {
                        this.carregarDespachos();
                    });
                }

            },
            beforeMount() {
                this.carregarDespachos();
            }
        })

    </script>

@endsection
