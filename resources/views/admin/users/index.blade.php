@extends('admin.master.master')
@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('admin.home')}}"><i class="fa fa-home mr5"></i> Home</a></li>
        <li class="active"><a href="{{route('admin.usuarios.index')}}">Usuários</a></li>
    </ol>

    <div class="well well-asset-options clearfix">

        <div class="btn-toolbar btn-toolbar-media-manager pull-left" role="toolbar">

            <div class="searchpanel" style="top: 44px; left: 24px">
                <div class="input-group">
                    <input type="hidden" class="form-control ng-pristine ng-untouched ng-valid ng-empty"
                           placeholder="Filtrar">
                    <span class="input-group-btn">
{{--                        <button class="btn btn-default" type="button">--}}
{{--                            <i class="fa fa-filter"></i>--}}
{{--                        </button>--}}
                    </span>
                </div>
            </div>

        </div><!-- btn-toolbar -->
        <div class="btn-group pull-right">
            <div class="btn-group" role="group">
                <a role="button" href="{{route('admin.usuarios.create')}}" type="button"
                   class="btn btn-success btn-quirk">
                    <i class="fa fa-plus"></i>
                    <span class="hidden-xs hidden-sm ng-binding">
                        Adicionar Usuário
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

            @foreach($users as $user)
                <div class="panel panel-profile list-view">
                    <div class="panel-heading">
                        <div class="media">
                            <div class="media-left">
                                <img class="media-object img-circle"
                                     src="{{ ($user->imagem == '' ? url(asset('images/avatar.jpg')) : url('uploads/' . $user->imagem))}}"
                                     alt="">
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading ng-binding">{{$user->name}}</h4>
                            </div>
                        </div><!-- media -->
                        <ul class="panel-options">
                            <li>
                                <a href="{{route('admin.usuarios.edit', $user->id)}}"
                                   class="btn btn-success text-white rounded-circle " title="Editar Usuário">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin.usuarios.show', $user->id)}}" type="button"
                                   class="btn btn-danger  text-white rounded-circle"
                                   title="Excluir Usuário">
                                    <i class="fa fa-close"></i>
                                </a>
                            </li>
                        </ul>
                    </div><!-- panel-heading -->

                    <div class="panel-body people-info">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="info-group">
                                    <label><i class="fa fa-group"></i>
                                        <span class="ng-binding">Perfil de usuário</span></label>
                                    <span class="label label-warning ng-binding">Administradores</span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="info-group ng-binding">
                                    <label>
                                        <i class="fa fa-envelope"></i>
                                        <span class="ng-binding">E-mail</span></label>
                                    {{$user->email}}
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="info-group ng-binding">
                                    <label>
                                        <i class="fa fa-phone-square"></i>
                                        <span class="ng-binding">Telefone</span></label>
                                    {{$user->telefone}}
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="info-group ng-binding">
                                    <label><i class="fa fa-map-marker"></i>
                                        <span class="ng-binding">Endereço</span></label>
                                    {{$user->endereco}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- panel -->


            @endforeach


        </div>
    </div>

@endsection
