@extends('admin.master.master')
@section('title')
    Perfis de usuários
@endsection
@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('admin.home')}}"><i class="fa fa-home mr5"></i> Home</a></li>
        <li class="active"><a href="{{route('admin.roles.index')}}">Perfis de usuários</a></li>
    </ol>

       <div class="well well-asset-options clearfix">

        <div class="btn-group pull-right">
            <div class="btn-group" role="group">
                <a role="button" href="{{route('admin.roles.create')}}" type="button"
                   class="btn btn-success btn-quirk">
                    <i class="fa fa-plus"></i>
                    <span class="hidden-xs hidden-sm ng-binding">
                        Adicionar Perfils
                    </span>
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
        <div class="col-md-12 col-lg-12 ">
            <div class="panel panel-profile list-view">
                <div class="panel panel-site-traffic">
                    <div class="table-responsive">
                        <table class="table table-bordered table-default table-striped nomargin">
                            <thead class="success">
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>Setor</th>
                                <th class="text-right ng-binding">Opções</th>
                            </tr>
                            </thead>
                            <tbody id="tableFilter">
                            @foreach($roles as $role)
                                <!-- ngRepeat: itemList in listaItens | filter : busca -->
                                <tr>
                                    <td>{{$role->id}}</td>
                                    <td>{{$role->name}}</td>

                                    <td class="text-right">
                                        <a href="{{route('admin.roles.edit', $role->id)}}"
                                           class="btn btn-success text-white rounded-circle " title="Editar Usuário">
                                            <i class="fa fa-edit"></i>
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
