@extends('admin.master.master')
@section('title')
    Equipamentos
@endsection
@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('admin.home')}}"><i class="fa fa-home mr5"></i> Home</a></li>
        <li class="active"><a href="{{route('admin.equipamento.index')}}"> <i
                    class="fa fa-cubes mr5"></i>Equipamentos</a>
        </li>
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
                <a role="button" href="{{route('admin.equipamento.create')}}" type="button"
                   class="btn btn-success btn-quirk">
                    <i class="fa fa-plus"></i>
                    <span class="hidden-xs hidden-sm ng-binding">
                        Adicionar equipamento
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
        <div class="col-md-12 col-lg-12 ng-scope">
            <div class="panel panel-profile list-view" style="padding-bottom: 15px">
                <div class="panel panel-site-traffic">
                    <div class="table-responsive">
                        <table class="table table-bordered table-default table-striped nomargin" id="dataTable">
                            <thead class="success">
                            <tr>
                                <th>
                                    Foto
                                </th>
                                <th>
                                    Nome
                                </th>
                                <th>
                                    Fabricante
                                </th>
                                <th>
                                    Unidades
                                </th>
                                <th class="text-right">
                                    Opções
                                </th>
                            </tr>
                            </thead>
                            <tbody id="tableFilter">
                            @foreach($equipamentos as $equipamento)

                                <tr>
                                    <td class="text-center">
                                        <a href="{{route('admin.unidade.index', $equipamento->id)}}">
                                            <img src="{{$equipamento->url_img == null ? env('app_url') . '/backend/assets/images/equipamento_sem_foto.png' :  $equipamento->url_img }}"
                                                 class="media-object img-circle max-width-50" alt="">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{route('admin.unidade.index', $equipamento->id)}}">
                                        {{$equipamento->nome}}
                                        </a>
                                    </td>
                                    <td>
                                        {{$equipamento->fabricante->first()->nome}}
                                    </td>
                                    <td class="text-center">
                                        <span class="label label-success">{{$equipamento->unidade->count() }}</span>
                                    </td>
                                    <td class="text-right">

                                        <a href="{{route('admin.unidade.index', $equipamento->id)}}" type="button"
                                           class="btn btn-default rounded-circle"
                                           title="Unidades">
                                            <i class="fa fa-cubes"></i>
                                        </a>

                                        <a href="{{route('admin.arquivo.index', $equipamento->id)}}" type="button"
                                           class="btn btn-default rounded-circle"
                                           title="Arquivos">
                                            <i class="fa fa-file-pdf-o"></i>
                                        </a>
                                        <a href="{{route('admin.equipamento.edit', $equipamento->id)}}"
                                           class="btn btn-success text-white rounded-circle "
                                           title="Editar Equipamento">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="{{route('admin.equipamento.show', $equipamento->id)}}" type="button"
                                           class="btn btn-danger  text-white rounded-circle"
                                           title="Excluir Equipamento">
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
