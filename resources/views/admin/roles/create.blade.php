@extends('admin.master.master')
@section('title')
    Novo Perfil
@endsection
@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('admin.home')}}"><i class="fa fa-home mr5"></i> Home</a></li>
        <li class=""><a href="{{route('admin.roles.index')}}">Perfis de usuários</a></li>
        <li class="active"><a href="{{route('admin.roles.create')}}">Novo Perfil</a></li>
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

    <div class="panel panel-success">
        <div class="panel-heading">
            <h4 class="panel-title">Adicionar Perfil</h4>
        </div>
        <form class="app_form" action="{{route('admin.roles.store')}}" method="post">
            @csrf
            <div class="panel-body">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="name">
                </div>
            </div>
            <div class="panel-footer">
                <button class="btn btn-success">Salvar</button>
            </div>
        </form>
    </div>
@endsection
