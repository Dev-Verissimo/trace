@extends('admin.master.master')
@section('title')
    Editar Fabricante
@endsection
@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('admin.home')}}"><i class="fa fa-home mr5"></i> Home</a></li>
        <li class=""><a href="{{route('admin.fabricante.index')}}">Fabricantes</a></li>
        <li class="active"><a href="{{route('admin.fabricante.edit', $fabricante->id)}}">Editar Fabricante</a></li>
    </ol>


    <div class="row">
        <div class="col-sm-12">
            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">Editar Fabricante </h4>
                </div>
                <form action="{{route('admin.fabricante.destroy', $fabricante->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="nome">Nome*</label>
                            <input type="text" name="nome" id="nome" value="{{$fabricante->nome}}" required placeholder="Nome"
                                   class="form-control"/>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-danger btn-quirk btn-wide mr5">Excluir</button>
                        <a href="{{route('admin.fabricante.index')}}"
                           class="btn btn-quirk btn-wide btn-default">Voltar</a>
                    </div>
                </form>
            </div><!-- panel -->


        </div><!-- col-sm-6 -->

    </div>

@endsection
