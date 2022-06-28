@extends('admin.master.master')
@section('title')
    Excluir Categoria
@endsection
@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('admin.home')}}"><i class="fa fa-home mr5"></i> Home</a></li>
        <li class=""><a href="{{route('admin.categoria.index')}}">Categorias</a></li>
        <li class="active"><a href="{{route('admin.categoria.show', $categoria->id)}}">Excluir Categoria</a></li>
    </ol>


    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h4 class="panel-title">Excluir Categoria </h4>
                </div>
                <form action="{{route('admin.categoria.destroy', $categoria->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="nome">Nome*</label>
                            <input type="text" name="nome" id="nome" value="{{$categoria->nome}}" required placeholder="Nome"
                                   class="form-control"/>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-danger btn-quirk btn-wide mr5">Excluir</button>
                        <a href="{{route('admin.categoria.index')}}"
                           class="btn btn-quirk btn-wide btn-default">Voltar</a>
                    </div>
                </form>
            </div><!-- panel -->


        </div><!-- col-sm-6 -->

    </div>

@endsection
