@extends('admin.master.master')
@section('title')
    Perfis de usuários
@endsection
@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('admin.home')}}"><i class="fa fa-home mr5"></i> Home</a></li>
        <li class="active"><a href="{{route('admin.roles.index')}}">Perfis de usuários</a></li>
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

    <div class="row">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h4 class="panel-title">
                    {{$role->name}}
                </h4>
            </div>
            <form action="{{route('admin.roles.update', $role->id)}}" method="post">
                <div class="panel-body">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        @foreach($allPermissions as $permission)
                            <div class="col-xs-12 col-sm-4 col-md-4">
                                <div class="form-check mb-2 ">
                                    <input type="checkbox"
                                           {{in_array($permission->id, array_column($role->permissions->toArray(), 'id')) == 1 ? 'checked' : '' }}
                                           value="{{$permission->id}}"
                                           name="{{$permission->id}}"
                                           class="form-check-input"
                                           id="{{$permission->slug}}">
                                    <label class="form-check-label" for="{{$permission->slug}}">
                                        {{$permission->name}}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{route('admin.roles.index')}}" class="btn btn-info"> Voltar</a>
                        <button type="submit" class="btn btn-success">Salvar</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection
