@extends('admin.master.master')
@section('title')
    Listas de Envio
@endsection
@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('admin.home')}}"><i class="fa fa-home mr5"></i> Home</a></li>
        <li class="active">
            <a href="{{route('admin.unidade.lista')}}"> <i class="fa fa-arrow-right mr5"></i>
                Unidades
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

    <div class="row">
        <div class="col-md-12 ng-scope">

            <div class="panel panel-profile list-view">

                <div class="panel panel-site-traffic">

                    <div class="table-responsive">

                        <table class="table table-bordered table-default table-striped nomargin">

                            <thead class="success">
                            <tr>
                                <th>
                                    Nome
                                </th>
                                <th>
                                    Status
                                </th>
                                <th>
                                    Tag
                                </th>
                                <th>
                                    Próxima Inspeção
                                </th>

                                <th class="text-right ">Ações</th>
                            </tr>
                            </thead>
                            <tbody id="tableFilter">
                            @foreach($unidades as $unidade)
                                <tr>
                                    <td>
                                        {{$unidade->equipamento->nome}}
                                    </td>
                                    <td>
                                        {{$unidade->status_string}}
                                    </td>
                                    <td>
                                        {{$unidade->tag}}
                                    </td>
                                    <td>
                                        {{date('d/m/Y' , strtotime($unidade->data_proxima_inspecao))}}
                                    </td>
                                    <td class="text-right">
                                        <a href="{{route('admin.inspecao.index', $unidade->id)}}"
                                           class="btn btn-info btn-quirk btn-stroke" title="Visualizar">
                                            Visualizar
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                    </div><!-- table-responsive -->
                </div>
            </div><!-- panel -->


        </div>
    </div>

@endsection

