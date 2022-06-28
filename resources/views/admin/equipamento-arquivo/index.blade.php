@extends('admin.master.master')
@section('title')
    Arquivos
@endsection
@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('admin.home')}}"><i class="fa fa-home mr5"></i> Home</a></li>
        <li class="">
            <a href="{{route('admin.equipamento.index')}}">
                <i class="fa fa-cubes mr5"></i>Equipamentos</a>
        </li>
        <li class="active"><i class="fa fa-file mr5"></i>Arquivos</li>
    </ol>

    <div class="well well-asset-options clearfix">

        <div class="btn-toolbar btn-toolbar-media-manager pull-left" role="toolbar">

            <div class="searchpanel" style="top: 44px; left: 24px">
                <div class="input-group">
                    <input type="text" class="form-control"
                           id="inputFilter"
                           placeholder="Filtrar">
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
                <a role="button" href="{{route('admin.arquivo.create', $equipamento->id)}}" type="button"
                   class="btn btn-success btn-quirk">
                    <i class="fa fa-plus"></i>
                    <span class="hidden-xs hidden-sm ng-binding">
                        Adicionar Arquivo
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
        <div class="col-md-12   ng-scope">
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
                                    Nome
                                </th>
                                <th>
                                    Url
                                </th>
                                <th class="text-right">
                                    Opções
                                </th>
                            </tr>
                            </thead>
                            <tbody id="tableFilter">
                            @foreach($equipamento->arquivo as $equipamento)

                                <tr>
                                    <td class="text-center">
                                        <img src="{{asset('images/doc.png')}}"
                                             class="media-object img-circle max-width-50" alt="">
                                    </td>
                                    <td>{{$equipamento->nome}}</td>
                                    <td>
                                        <a href="{{url($equipamento->arquivo_down)}}">Download</a>
                                    </td>
                                    <td class="text-right">
                                        <a href="{{route('admin.arquivo.edit', $equipamento->id)}}"
                                           class="btn btn-success text-white rounded-circle " title="Editar Usuário">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="{{route('admin.arquivo.show', $equipamento->id)}}" type="button"
                                           class="btn btn-danger  text-white rounded-circle"
                                           title="Excluir Usuário">
                                            <i class="fa fa-close"></i>
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
