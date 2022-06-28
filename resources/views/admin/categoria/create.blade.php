@extends('admin.master.master')
@section('title')
    Adicionar Categoria
@endsection
@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('admin.home')}}"><i class="fa fa-home mr5"></i> Home</a></li>
        <li class=""><a href="{{route('admin.categoria.index')}}">Categorias</a></li>
        <li class="active"><a href="{{route('admin.categoria.create')}}">Cadastrar Categoria</a></li>
    </ol>


    <div class="row">
        <div class="col-sm-12">
            <div class="panel">
                <form action="{{route('admin.categoria.store')}}" method="post"  enctype="multipart/form-data">
                    @csrf
                    <div class="panel-heading">
                        <h4 class="panel-title">Adicionar Categoria </h4>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="nome">Nome*</label>
                            <input type="text" name="nome" id="nome" value="{{old('nome')}}" required placeholder="Nome" class="form-control"/>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-success btn-quirk btn-wide mr5">Salvar</button>
                        <a href="{{route('admin.usuarios.index')}}" class="btn btn-quirk btn-wide btn-default">Voltar</a>
                    </div>
                </form>
            </div><!-- panel -->


        </div><!-- col-sm-6 -->

    </div>

@endsection
